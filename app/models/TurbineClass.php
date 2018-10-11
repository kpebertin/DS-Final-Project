<?php
class TurbineClass {
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

    public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'INSERT INTO Sensor (turbineID, turbineName, turbineDescription, capacity, rampUpTime, maintenaceInterval) VALUES (?,?,?,?,?,?);';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
             $this->turbineID,
             $this->turbineName,
             $this->turbineDescription,
             $this->capacity,
             $this->rampUpTime,
             $this->maintenaceInterval,
            ]
        );
    public static function getTurbineData($turbineID) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Turbine WHERE turbineID = ?;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([$turbineID]);
        $arrayOfSensors = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aClient = new TurbineClass($row);
            array_push($arrayOfTurbines, $aTurbine);
        }
        return $arrayOfTurbines;
    }
}
