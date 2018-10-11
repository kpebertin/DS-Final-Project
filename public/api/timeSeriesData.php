<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postTimeSeriesData.php';
    die;
}

$aDeployedSensorID = $_GET['sensorDeployedID'] ?? "";

$timeSeriesDataArray = TimeSeriesDataClass::getTimeSeriesData($aDeployedSensorID);
$json = json_encode($timeSeriesDataArray);
header('Content-Type: application-json');
echo $json;
