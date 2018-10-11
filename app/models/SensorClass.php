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

    public static function getSensorData() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Sensor;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([]);
        $arrayOfSensors = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aClient = new SensorClass($row);
            array_push($arrayOfSensors, $aSensor);
        }
        return $arrayOfSensors;
    }
}
