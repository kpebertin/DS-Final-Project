var dashboardApp = new Vue ({
    el: '#dashboardApp',
    data: {
        clients: [],
        activeClient: {},
        sites: [],
        turbineDeployed: [],
        sensorDeployed: [],
        timeSeriesData: []
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
                console.log(JSON.stringify(myJSON))
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(clientData.php)");
                console.log(err);
            })
        )},
        setActiveClient: function() {(
            this.activeClient = this.clients[0]
        )},
        fetchSites: function(c) {(
            fetch('../api/siteData.php?clientID=' + c)
            .then( function(response) {
                return response.json()
            })
            .then( function(myJSON) {
                dashboardApp.sites = myJSON
                console.log(JSON.stringify(myJSON))
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(clientData.php)");
                console.log(err);
            })
        )}
        
    },
    created: function() {
        this.fetchClients();
        console.log(clients);
        this.setActiveClient();
        console.log(activeClient);
        //this.fetchSites(activeClient.clientID);
        //console.log(sites);
    }
})