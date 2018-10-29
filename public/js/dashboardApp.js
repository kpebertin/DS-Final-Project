var dashboardApp = new Vue ({
    el: '#dashboardApp',
    data: {
        clients: [],
        activeClient: [],
        sites: [],
        activeSite: [],
        turbineDeployed: [],
        activeTurbine: [],
        sensorDeployed: [],
        notes: [],
        noteToSubmit: {},
        timeSeriesData: []
    },
    watch: {
        turbineDeployed: function (val) {
            setTimeout( function() {
                dashboardApp.setTabWidth();
            }, 500);
        },
        sensorDeployed: function (val) {
            setTimeout( function() {
                dashboardApp.setTabWidthSD();
            }, 500);
        }
    },
    computed: {},
    methods: {
        fetchClients: function() {(
            fetch('../api/clientData.php')
            .then( function(response) {
                return response.json()
            })
            .then( function(myJSON) {
                dashboardApp.clients = myJSON
                dashboardApp.activeClient = myJSON[0]
                dashboardApp.fetchSites(myJSON[0]['clientID'])
                dashboardApp.fetchNotes(myJSON[0]['clientID'])
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(clientData.php)");
                console.log(err);
            })
        )},
        setActiveClient: function(ac) {
            dashboardApp.activeClient = ac;
        },
        fetchSites: function(c) {(
            fetch('../api/siteData.php?clientID=' + c)
            .then( function(response) {
                return response.json()
            })
            .then( function(myJSON) {
                dashboardApp.sites = myJSON;
                dashboardApp.turbineDeployed = [];
                dashboardApp.setNewActiveSite(dashboardApp.sites[0]['siteID'], "Y");
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(siteData.php)");
                console.log(err);
            })
        )},
        fetchTurbinesDeployed: function(tid) {(
            fetch('../api/turbineDeployedData.php?siteID=' + tid)
            .then( function(response) {
                var tempSID = "S" + tid;
                document.getElementById(tempSID).className += " activeSite";
                return response.json();
            })
            .then( function(myJSON) {
                if(myJSON.length > 0) {
                    dashboardApp.turbineDeployed.push(myJSON[0]);
                    dashboardApp.fetchActiveTurbine(myJSON[0]['turbineID']);
                } else {
                    dashboardApp.fetchActiveTurbine(1);
                }
                document.getElementById("defaultOpen").click();
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(turbineDeployedData.php)");
                console.log(err);
            })
        )},
        newActiveClient: function(c) {
            dashboardApp.activeClient = dashboardApp.clients[Number(c) - 1];
            dashboardApp.fetchSites(dashboardApp.clients[Number(c) - 1]['clientID']);
            dashboardApp.fetchNotes(dashboardApp.activeClient['clientID']);
        },
        setNewActiveSite: function(sid, firstTime) {
            var siteColorChange = document.getElementsByClassName("siteTableRow activeSite");
            for(var i = 0; i < siteColorChange.length; i++) {
                siteColorChange[i].className = siteColorChange[i].className.replace(" activeSite", "");
            }
            dashboardApp.turbineDeployed = [];
            for(var i = 0; i < dashboardApp.sites.length; i++) {
                if(dashboardApp.sites[i]['siteID'] == sid) {
                    dashboardApp.activeSite = dashboardApp.sites[i];
                }
            }
            dashboardApp.fetchTurbinesDeployed(sid);
            initMap();
        },
        setOnClickTurbine: function(tid) {
            return "openTab(event, " + tid + ")";
        },
        setOnClickSD: function(sdid) {
            return "openTabSD(event, " + sdid + ")"
        },
        fetchNotes: function(cid) {(
            fetch('../api/clientNote.php?clientID=' + cid)
            .then( function(response) {
                return response.json();
            })
            .then( function(myJSON) {
                dashboardApp.notes = myJSON;
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(clientNote.php)");
                console.log(err);
            })
        )},
        submitNote: function(aError) {
            dashboardApp.noteToSubmit.clientID = parseInt(dashboardApp.activeClient['clientID']);
            const aNote = JSON.stringify(this.noteToSubmit);
            fetch (
                '../api/clientNote.php',
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json; charset=utf-8"
                    },
                    body: aNote
                })
            .then( function(response) {
                return response.json()
            })
            .then( function(myJSON) {
                dashboardApp.notes.push(myJSON)
            })
            .catch( function(err) {
                console.log("Error posting note.");
                console.log(err);
            })
        },
        emailLink: function(em) {
            return "mailto:" + em;
        },
        setTabWidth: function() {
            var numberOfTabs = 2 + dashboardApp.turbineDeployed.length;
            var listOfTabs = document.querySelectorAll('.tabLink');
            for(var i = 0; i < listOfTabs.length; i++) {
                listOfTabs[i].style.width = 'calc(100% / ' + numberOfTabs + ')';
            }
        },
        setTabWidthSD: function() {
            var numberOfTabs = 1 + dashboardApp.sensorDeployed.length;
            var listOfTabs = document.querySelectorAll('.tabLinkSD');
            for(var i = 0; i < listOfTabs.length; i++) {
                listOfTabs[i].style.width = 'calc(100% / ' + numberOfTabs + ')';
            }
        },
        fetchActiveTurbine: function(tid) {
            fetch('../api/turbineData.php?turbineID=' + tid)
            .then( function(response) {
                return response.json()
            })
            .then( function(myJSON) {
                dashboardApp.activeTurbine = myJSON[0];
                dashboardApp.sensorDeployed = [];
                dashboardApp.timeSeriesData = [];
                if(dashboardApp.turbineDeployed.length < 1) {
                    dashboardApp.fetchSensorsDeployed(1);
                } else {
                    var wasItRun = false;
                    for(var i = 0; i < dashboardApp.turbineDeployed.length; i++) {
                        if(dashboardApp.turbineDeployed[i]['turbineID'] == dashboardApp.activeTurbine['turbineID']) {
                            dashboardApp.fetchSensorsDeployed(dashboardApp.turbineDeployed[i]['turbineDeployedID']);
                            wasItRun = true;
                        }
                    } if(!wasItRun) {
                        dashboardApp.fetchSensorsDeployed(1);
                    }
                }
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(turbineData.php)");
                console.log(err);
            })
        },
        fetchSensorsDeployed: function(tid) {(
            fetch('../api/sensorDeployedData.php?turbineID=' + tid)
            .then( function(response) {
                return response.json()
            })
            .then( function(myJSON) {
                if(myJSON.length > 0) {
                    for (var i = 0; i < myJSON.length; i++) {
                        dashboardApp.sensorDeployed.push(myJSON[i]);
                        dashboardApp.fetchSensorTimeSeries(myJSON[i]['sensorDeployedID']);
                    }
                } else {
                    console.log("No Sensors.");
                    dashboardApp.sensorDeployed
                }
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(sensorDeployedData.php)");
                console.log(err);
            })
        )},
        fetchSensorTimeSeries: function(sid) {(
            fetch('../api/timeSeriesData.php?sensorDeployedID=' + sid)
            .then( function(response) {
                return response.json();
            })
            .then( function(myJSON) {
                dashboardApp.timeSeriesData = myJSON
                //dashboardApp.buildOutputChart();
            })
            .catch( function(err) {
                console.log("Error fetching time series data");
                console.log(err);
            })
        )},
        buildOutputChart: function() {
            var data = [];
            for(var i = 0; i < dashboardApp.timeSeriesData.length; i++) {
                data.push([Date.parse(dashboardApp.timeSeriesData[i].dataCollectedDate), parseInt(dashboardApp.timeSeriesData[i].output)]);
            }
            Highcharts.chart('outputChart', {
                chart: {
                    zoomType: 'x'
                },
                title: {
                    text: 'Output from January to June'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Output Rate'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },
                series: [{
                    type: 'line',
                    name: 'Output',
                    data: data
                }]
            });
        }
    },
    created: function() {
        this.fetchClients();
    }
})
