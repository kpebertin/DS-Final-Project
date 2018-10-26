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
        noteToSubmit: {}
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
                }
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
            dashboardApp.fetchTurbinesDeployed(sid);
        },
        setOnClickTurbine: function(tid) {
            return "openTab(event, " + tid + ")";
        },
        fetchNotes: function(cid) {(
            fetch('../api/clientNote.php?clientID=' + cid)
            .then( function(response) {
                console.log("Test 1");
                return response.json();
            })
            .then( function(myJSON) {
                console.log("Test 2");
                dashboardApp.notes = myJSON;
                console.log("Test 3");
            })
            .error( function(err) {
                console.log("Fetch error on fetch(clientNote.php)");
                console.log(err);
            })
        )},
        submitNote: function(aError) {
            dashboardApp.noteToSubmit.clientID = dashboardApp.activeClient['clientID'];
            const aNote = JSON.stringify(this.noteToSubmit);
            fetch (
                '../api/clientNote.php',
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "aplication/json; charset=utf-8"
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
        }
    },
    created: function() {
        this.fetchClients();
    }
})
