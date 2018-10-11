<?php
class SensorDeployedClass {
    public $sensorDeployedID;
    public $sensorID;
    public $turbineDeployedID;
    public $serialNumber;
    public $deployedDate;

    public function __construct($row) {
        $this->sensorDeployedID = isset($row['sensorDeployedID']) ? $row['sensorDeployedID'] : null;
        $this->sensorID = isset($row['sensorID']) ? $row['sensorID'] : null;
        $this->turbineDeployedID = isset($row['turbineDeployedID']) ? $row['turbineDeployedID'] : null;
        $this->serialNumber = isset($row['serialNumber']) ? $row['serialNumber'] : null;
        $this->deployedDate = isset($row['deployedDate']) ? $row['deployedDate'] : null;
    }

    public static function getSensorDeployedData() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM SensorDeployed;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([]);
        $arrayOfSensors = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aClient = new SensorDeployedClass($row);
            array_push($arrayOfSensorsDeployed, $aSensor);
        }
        return $arrayOfSensorsDeployed;
    }
}
