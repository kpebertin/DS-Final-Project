<?php

class ClientClass {
    public $clientName;
    public $clientDescription;
    public $gicsSector;
    public $gicsSubIndustry;
    public $companyHeadquartersCity;
    public $companyHeadquartersState;
    
    public function __construct($row) {
        $this->clientName = $row['clientName'];
        $this->clientDescription = $row['clientDescription'];
        $this->gicsSector = $row['gicsSector'];
        $this->gicsSubIndustry = $row['gicsSubIndustry'];
        $this->companyHeadquartersCity = $row['companyHeadquartersCity'];
        $this->companyHeadquartersState = $row['companyHeadquartersState'];
    }
    
    public static function getClient() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Client;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute();
        $arrayOfClients = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aClient = new ClientClass($row);
            array_push($arrayOfClients, $aClient);
        }
        return $arrayOfClients;
    }
}