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
                for(var i = 0; i < dashboardApp.sites.length; i++) {
                    dashboardApp.fetchTurbinesDeployed(dashboardApp.sites[i]['siteID']);
                }
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
                console.log(myJSON)
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
        setOnClick: function(tid) {
            return "openTurbineTab(event, " + tid + ")";
        }
    },
    created: function() {
        this.fetchClients();
    }
})
