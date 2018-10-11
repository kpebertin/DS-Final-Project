<?php

require '../../app/common.php';

$aSensorID = $_GET['sensorID'] ?? "";

#echo $aClientID;

$siteArray = SensorClass::getSensorData($aSensorID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;
