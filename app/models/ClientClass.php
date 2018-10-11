<?php

class ClientClass {
    public $clientID;
    public $clientName;
    public $clientDescription;
    public $gicsSector;
    public $gicsSubIndustry;
    public $companyHeadquartersCity;
    public $companyHeadquartersState;
    
    public function __construct($row) {
        $this->clientID = isset($row['clientID']) ? $row['clientID'] : null;
        $this->clientName = isset($row['clientName']) ? $row['clientName'] : null;
        $this->clientDescription = isset($row['clientDescription']) ? $row['clientDescription'] : null;
        $this->gicsSector = isset($row['gicsSector']) ? $row['gicsSector'] : null;
        $this->gicsSubIndustry = isset($row['gicsSubIndustry']) ? $row['gicsSubIndustry'] : null;
        $this->companyHeadquartersCity = isset($row['companyHeadquartersCity']) ? $row['companyHeadquartersCity'] : null;
        $this->companyHeadquartersState = isset($row['companyHeadquartersState']) ? $row['companyHeadquartersState'] : null;
    }

    public static function getClientData($aName) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Client;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute(
            [
                $aName
            ]
        );
        $arrayOfClients = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aClient = new ClientClass($row);
            array_push($arrayOfClients, $aClient);
        }
        return $arrayOfClients;
    }
}