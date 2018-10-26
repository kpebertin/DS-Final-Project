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
        timeSeriesData: [],
        emwpdata: []
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
                dashboardApp.fetchTurbinesDeployed(dashboardApp.sites[0]['siteID']);
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(siteData.php)");
                console.log(err);
            })
        )},
        fetchTurbinesDeployed: function(tid) {(
            fetch('../api/turbineDeployedData.php?siteID=' + tid)
            .then( function(response) {
                return response.json()
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
        },
        setNewActiveSite: function(sid, firstTime) {
            dashboardApp.turbineDeployed = [];
            dashboardApp.fetchTurbinesDeployed(sid);
            if(firstTime == null) {
                var siteColorChange = document.getElementsByClassName("siteTable activeSite");
                for(var i = 0; i < siteColorChange.length; i++) {
                    siteColorChange[i].className = siteColorChange[i].className.replace(" activeSite", "");
                }
            }
            console.log(sid);
            document.getElementById("S" + sid).className += " activeSite";
        },
        setOnClickTurbine: function(tid) {
            return "openTab(event, " + tid + ")";
        }
    },
    created: function() {
        this.fetchClients();
    }
})
