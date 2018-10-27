<?php
class TurbineClass {
    public $turbineID;
    public $turbineName;
    public $turbineDescription;
    public $capacity;
    public $rampUpTime;
    public $maintenanceInterval;

    public function __construct($row) {
        $this->turbineID = isset($row['turbineID']) ? $row['turbineID'] : null;
        $this->turbineName = isset($row['turbineName']) ? $row['turbineName'] : null;
        $this->turbineDescription = isset($row['turbineDescription']) ? $row['turbineDescription'] : null;
        $this->capacity = isset($row['capacity']) ? (int)$row['capacity'] : null;
        $this->rampUpTime = isset($row['rampUpTime']) ? (int)$row['rampUpTime'] : null;
        $this->maintenanceInterval = isset($row['maintenanceInterval']) ? (int)$row['maintenanceInterval'] : null;
    }

    public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'INSERT INTO Turbine (turbineName, turbineDescription, capacity, rampUpTime, maintenanceInterval) VALUES (?,?,?,?,?);';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
             $this->turbineName,
             $this->turbineDescription,
             $this->capacity,
             $this->rampUpTime,
             $this->maintenaceInterval,
            ]
        );
    $this->turbineID = $db->lastInsertId();
    }
    public static function getTurbineData($turbineID) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Turbine WHERE turbineID = ?;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([$turbineID]);
        $arrayOfTurbines = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aTurbine = new TurbineClass($row);
            array_push($arrayOfTurbines, $aTurbine);
        }
        return $arrayOfTurbines;
    }
}
