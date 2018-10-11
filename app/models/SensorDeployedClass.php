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
        public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'INSERT INTO SensorDeployed (sensorDeployedID, sensorID, turbineDeployedID, serialNumber, deployedDate) VALUES (?,?,?,?,?);';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
                $this->sensorID,
                $this->sensorName,
                $this->sensorDescription,
                $this->manufacturer,
                $this->totalLifeExpectancy
            ]
        );
        }

    public static function getSensorDeployedData($sensorDeployedID) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM SensorDeployed WHERE sensorDeployedID = ?;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([$sensorDeployedID]);
        $arrayOfSensorsDeployed = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aSensor = new SensorDeployedClass($row);
            array_push($arrayOfSensorsDeployed, $aSensor);
        }
        return $arrayOfSensorsDeployed;
    }
}
