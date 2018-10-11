<?php

require '../../app/common.php';

$aDeployedSensorID = $_GET['sensorDeployedID'] ?? "";

$timeSeriesDataArray = TimeSeriesDataClass::getTimeSeriesData($aDeployedSensorID);
$json = json_encode($timeSeriesDataArray);
header('Content-Type: application-json');
echo $json;