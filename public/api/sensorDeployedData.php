<?php

require '../../app/common.php';

$aTurbineDeployedID = $_GET['turbineDeployedID'] ?? "";

#echo $aClientID;

$sensorDeployedArray = SensorDeployedClass::getTurbineDeployedData($aTurbineDeployedID);
$json = json_encode($sensorDeployedArray);
header('Content-Type: application-json');
echo $json;
