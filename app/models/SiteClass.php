<?php

class SiteClass {
    public $siteID;
    public $siteIDTwo;
    public $clientID;
    public $siteName;
    public $siteDescription;
    public $primaryContact;
    public $primaryContactEmail;
    public $plantCapacity;
    public $commercialDate;
    public $addressLineOne;
    public $addressLineTwo;
    public $addressCity;
    public $addressState;
    public $addressZip;
    public $addressCountry;
    public $lat;
    public $lng;
    
    public function __construct($row) {
        $this->siteID = isset($row['siteID']) ? $row['siteID'] : null;
        $this->siteIDTwo = isset($row['siteIDTwo']) ? $row['siteIDTwo'] : null;
        $this->clientID = isset($row['clientID']) ? $row['clientID'] : null;
        $this->siteName = isset($row['siteName']) ? $row['siteName'] : null;
        $this->siteDescription = isset($row['siteDescription']) ? $row['siteDescription'] : null;
        $this->primaryContact = isset($row['primaryContact']) ? $row['primaryContact'] : null;
        $this->primaryContactEmail = isset($row['primaryContactEmail']) ? $row['primaryContactEmail'] : null;
        $this->plantCapacity = isset($row['plantCapacity']) ? $row['plantCapacity'] : null;
        $this->commercialDate = isset($row['commercialDate']) ? $row['commercialDate'] : null;
        $this->addressLineOne = isset($row['addressLineOne']) ? $row['addressLineOne'] : null;
        $this->addressLineTwo = isset($row['addressLineTwo']) ? $row['addressLineTwo'] : null;
        $this->addressCity = isset($row['addressCity']) ? $row['addressCity'] : null;
        $this->addressState = isset($row['addressState']) ? $row['addressState'] : null;
        $this->addressZip = isset($row['addressZip']) ? $row['addressZip'] : null;
        $this->addressCountry = isset($row['addressCountry']) ? $row['addressCountry'] : null;
        $this->lat = isset($row['lat']) ? (float)$row['lat'] : null;
        $this->lng = isset($row['lng']) ? (float)$row['lng'] : null;
    }

     public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'INSERT INTO Site (clientID, siteName, siteDescription, primaryContact, primaryContactEmail, 
        plantCapacity,commercialDate, addressLineOne, addressLineTwo, addressCity, addressState, addressZip, addressCountry) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
             $this->clientID,
             $this->siteName,
             $this->siteDescription,
             $this->primaryContact,
             $this->primaryContactEmail,
             $this->plantCapacity,
             $this->commercialDate,
             $this->addressLineOne,
             $this->addressLineTwo,
             $this->addressCity,
             $this->addressState,
             $this->addressZip,
             $this->addressCountry
            ]
        );
         $this->siteID = $db->lastInsertId();
         $this->siteIDTwo = "S" + $this->siteID;
     }
    
    public static function getSiteData($aClient) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM Site WHERE clientID = ?;';
        $pdoStatement = $db->prepare($sql);
        $connection = $pdoStatement->execute(
            [$aClient]
        );
        $arrayOfSites = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aSite = new SiteClass($row);
            array_push($arrayOfSites, $aSite);
        }
        return $arrayOfSites;
    }
}
