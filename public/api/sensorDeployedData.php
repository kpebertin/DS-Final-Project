<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postSensorDeployedData.php';
    die;
}

$aTurbineDeployedID = $_GET['turbineID'] ?? "";

#echo $aClientID;

$sensorDeployedArray = SensorDeployedClass::getSensorDeployedData($aTurbineDeployedID);
$json = json_encode($sensorDeployedArray);
header('Content-Type: application-json');
echo $json;
