<?php
class SensorClass {
    public $sensorID;
    public $sensorName;
    public $sensorDescription;
    public $manufacturer;
    public $totalLifeExpectancy;

    public function __construct($row) {
        $this->sensorID = isset($row['sensorID']) ? $row['sensorID'] : null;
        $this->sensorName = isset($row['sensorName']) ? $row['sensorName'] : null;
        $this->sensorDescription = isset($row['sensorDescription']) ? $row['sensorDescription'] : null;
        $this->manufacturer = isset($row['manufacturer']) ? $row['manufacturer'] : null;
        $this->totalLifeExpectancy = isset($row['totalLifeExpectancy']) ? $row['totalLifeExpectancy'] : null;
    }

    public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'INSERT INTO Sensor (sensorName, sensorDescription, manufacturer, totalLifeExpectancy) VALUES (?,?,?,?);';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
             $this->sensorName,
             $this->sensorDescription,
             $this->manufacturer,
             $this->totalLifeExpectancy
            ]
        );
            $this->sensorID = $db->lastInsertId();
        }
            
    public static function getSensorData($sensorID) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Sensor WHERE sensorID = ?;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([$sensorID]);
        $arrayOfSensors = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aSensor = new SensorClass($row);
            array_push($arrayOfSensors, $aSensor);
        }
        return $arrayOfSensors;
    }
}
