<?php
class TurbineDeployedClass {
    public $turbineDeployedID;
    public $turbineID;
    public $siteID;
    public $serialNumber;
    public $deployedDate;
    public $totalFiredHours;
    public $totalStarts;
    public $lastPlannedOutageDate;
    public $lastUnplannedOutageDate;

    public function __construct($row) {
        $this->turbineDeployedID = isset($row['turbineDeployedID']) ? $row['turbineDeployedID'] : null;
        $this->turbineID = isset($row['turbineID']) ? $row['turbineID'] : null;
        $this->siteID = isset($row['siteID']) ? $row['siteID'] : null;
        $this->serialNumber = isset($row['serialNumber']) ? $row['serialNumber'] : null;
        $this->deployedDate = isset($row['deployedDate']) ? $row['deployedDate'] : null;
        $this->totalFiredHours = isset($row['totalFiredHours']) ? $row['totalFiredHours'] : null;
        $this->totalStarts = isset($row['totalStarts']) ? $row['totalStarts'] : null;
        $this->lastPlannedOutageDate = isset($row['lastPlannedOutageDate']) ? $row['lastPlannedOutageDate'] : null;
        $this->lastUnplannedOutageDate = isset($row['lastUnplannedOutageDate']) ? $row['lastUnplannedOutageDate'] : null;

    }

    public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'INSERT INTO TurbineDeployed (turbineID,siteID,serialNumber,deployedDate,totalFiredHours,totalStarts,lastPlannedOutageDate,lastUnplannedOutageDate) VALUES (?,?,?,?,?,?,?,?);';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
                $this->turbineID,
                $this->siteID,
                $this->serialNumber,
                $this->deployedDate,
                $this->totalFiredHours,
                $this->totalStarts,
                $this->lastPlannedOutageDate,
                $this->lastUnplannedOutageDate
            ]
        );
    $this->turbineDeployedID = $db->lastInsertId();
    }
    
    public static function getTurbineDeployedData($aSite) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM TurbineDeployed WHERE siteID = ?;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute([$aSite]);
        $arrayOfTurbinesDeployed = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aTurbineDeployed = new TurbineDeployedClass($row);
            array_push($arrayOfTurbinesDeployed, $aTurbineDeployed);
        }
        return $arrayOfTurbinesDeployed;
    }
}
