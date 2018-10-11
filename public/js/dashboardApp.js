var dashboardApp = new Vue ({
    el: '#dashboardApp',
    data: {
        clients: [
            {
                clientID: '',
                clientName: '',
                clientDescription: '',
                gicsSector: '',
                gicsSubIndustry: '',
                companyHeadquartersCity: '',
                companyHeadquartersState: ''
            }
        ],
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
        )}
        
    },
    created: function() {
        this.fetchClients();
    }
})