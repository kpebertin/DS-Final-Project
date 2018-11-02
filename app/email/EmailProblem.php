<?php

class EmailProblem {
	
	public $siteName;
	public $primaryContact;
	public $primaryContactEmail;
	
	public function __construct($row) {
		$this->siteName = isset($row['siteName']) ? $row['siteName'] : null;
		$this->primaryContact = isset($row['primaryContact']) ? $row['primaryContact'] : null;
		$this->primaryContactEmail = isset($row['primaryContactEmail']) ? $row['primaryContactEmail'] : null;
	}
	
	public static function getEmailData() {
		$db = new PDO(DB_SERVER, DB_USER, DB_PW);
		$sql = 'SELECT s.siteName as "siteName", s.primaryContact as "primaryContact", s.primaryContactEmail as "primaryContactEmail" FROM Site as s, TurbineDeployed as td, SensorDeployed as sd, SensorTimeSeries as sts WHERE sts.dataCollectedDate > "2016-05-31" AND s.siteID = td.siteID AND td.turbineDeployedID = sd.turbineDeployedID AND sd.sensorDeployedID = sts.sensorDeployedID;';
		$pdoStatement = $db->prepare($sql);
		$connection = $pdoStatement->execute([]);
		$arrayOfIssues = [];
		while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
			$aIssue = new EmailProblem($row);
			array_push($arrayOfIssues, $aIssue);
		}
		return $arrayOfIssues;
	}
}