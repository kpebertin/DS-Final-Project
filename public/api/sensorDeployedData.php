<?php

require '../../app/common.php';

$aTurbineDeployedID = $_GET['turbineDeployedID'] ?? "";

#echo $aClientID;

$sensorDeployedArray = SensorDeployedClass::getSensorDeployedData($aTurbineDeployedID);
$json = json_encode($sensorDeployedArray);
header('Content-Type: application-json');
echo $json;
