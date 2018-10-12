<?php

class TimeSeriesDataClass {
    public $sensorDeployedID
    public $sensorDeployedID;
    public $dataCollectedDate;
    public $output;
    public $heatRate;
    public $compressorEfficiency;
    public $availability;
    public $reliability;
    public $firedHours;
    public $trips;
    public $starts;
    
    public function __construct($row) {
        $this->sensorDeployedID = isset($row['sensorDeployedID']) ? $row['sensorDeployedID'] : null;
        $this->dataCollectedDate = isset($row['dataCollectedDate']) ? $row['dataCollectedDate'] : null;
        $this->output = isset($row['output']) ? $row['output'] : null;
        $this->heatRate = isset($row['heatRate']) ? $row['heatRate'] : null;
        $this->compressorEfficiency = isset($row['compressorEfficiency']) ? $row['compressorEfficiency'] : null;
        $this->availability = isset($row['availability']) ? $row['availability'] : null;
        $this->reliability = isset($row['reliability']) ? $row['reliability'] : null;
        $this->firedHours = isset($row['firedHours']) ? $row['firedHours'] : null;
        $this->trips = isset($row['trips']) ? $row['trips'] : null;
        $this->starts = isset($row['starts']) ? $row['starts'] : null;
    }

    public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'INSERT INTO SensorTimeSeries (sensorDeployedID, dataCollectedDate, output, heatRate, compressorEfficiency, availability, reliability, firedHours, trips, starts) VALUES (?,?,?,?,?,?,?,?,?,?);';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
                $this->sensorDeployedID,
                $this->dataCollectedDate,
                $this->output,
                $this->heatRate,
                $this->compressorEfficiency,
                $this->availability,
                $this->reliability,
                $this->firedHours,
                $this->trips,
                $this->starts
            ]
        );
        
        $this->sensorDeployedID = $db->lastInsertId();
    }
    
    public static function getTimeSeriesData($anID) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM SensorTimeSeries WHERE sensorDeployedID = ?;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([
            $anID
        ]);
        $arrayOfSensorTimeSeries = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aTime = new TimeSeriesDataClass($row);
            array_push($arrayOfSensorTimeSeries, $aTime);
        }
        return $arrayOfSensorTimeSeries;
    } 
}