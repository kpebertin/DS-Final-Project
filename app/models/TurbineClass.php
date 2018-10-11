<?php
class SensorClass {
    public $turbineID;
    public $turbineName;
    public $turbineDescription;
    public $capacity;
    public $rampUpTime;
    public $maintenaceInterval;

    public function __construct($row) {
        $this->turbineID = isset($row['turbineID']) ? $row['turbineID'] : null;
        $this->turbineName = isset($row['turbineName']) ? $row['turbineName'] : null;
        $this->turbineDescription = isset($row['turbineDescription']) ? $row['turbineDescription'] : null;
        $this->capacity = isset($row['capacity']) ? $row['capacity'] : null;
        $this->rampUpTime = isset($row['rampUpTime']) ? $row['rampUpTime'] : null;
        $this->maintenaceInterval = isset($row['maintenaceInterval']) ? $row['maintenaceInterval'] : null;
    }

    public static function getTurbineData() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Turbine;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([]);
        $arrayOfSensors = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aClient = new TurbineClass($row);
            array_push($arrayOfTurbines, $aTurbine);
        }
        return $arrayOfTurbines;
    }
}
