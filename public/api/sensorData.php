<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postSensorData.php';
    die;
}

$aSensorID = $_GET['sensorID'] ?? "";

$siteArray = SensorClass::getSensorData($aSensorID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;
