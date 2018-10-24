var dashboardApp = new Vue ({
    el: '#dashboardApp',
    data: {
        clients: [],
        activeClient: [],
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
                //console.log(JSON.stringify(myJSON))
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(clientData.php)");
                console.log(err);
            })
        )},
        setActiveClient: function(ac) {(
            //dashboardApp.activeClient = ac
            dashboardApp.activeClient = ac
        )},
        fetchSites: function(c) {(
            fetch('../api/siteData.php?clientID=' + c)
            .then( function(response) {
                return response.json()
            })
            .then( function(myJSON) {
                dashboardApp.sites = myJSON
                //console.log(JSON.stringify(myJSON))
            })
            .catch( function(err) {
                console.log("Fetch error on fetch(siteData.php)");
                console.log(err);
            })
        )}
        
    },
    created: function() {
        this.fetchClients();
        //this.setActiveClient(this.clients["0"]);
        //this.fetchSites(this.activeClient.clientID);
        // Currently use the below line instead of the above since client 1 has no sites which should be changed.
        this.fetchSites(2);
        //console.log(this.sites);
    }
})