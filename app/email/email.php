<?php

class EmailProblem {
	
	public $clientID;
	public $siteName;
	public $primaryContact;
	public $primaryContactEmail;
	
	public function __construct($row) {
		$this->clientID = isset($row['clientID']) ? $row['clientID'] : null;
		$this->siteName = isset($row['siteName']) ? $row['siteName'] : null;
		$this->primarycontact = isset($row['primaryContact']) ? $row['primaryContact'] : null;
		$this->primaryContactEmail = isset($row['primaryContactEmail']) ? $row['primaryContactEmail'] : null;
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