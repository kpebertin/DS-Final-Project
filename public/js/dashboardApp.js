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
        fetchClients () {
            fetch('../api/clientData.php')
            .then(response => response.json())
            .then(json => {dashboardApp.clients = json})
            .catch(err => {
                console.log("Fetch error on fetch(clientList)")
            })
        }
        
    },
    created () {
        this.fetchClients();
    }
})