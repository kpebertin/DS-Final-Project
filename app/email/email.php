<?php

class ClientClass {
    public $clientID;
    
    public function __construct($row) {
        $this->clientID = isset($row['clientID']) ? $row['clientID'] : null;
    }
    
    public static function getClientData() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Client;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([]);
        $arrayOfClients = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aClient = new ClientClass($row);
            array_push($arrayOfClients, $aClient);
        }
        return $arrayOfClients;
    }
}