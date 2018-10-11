<?php

require '../../app/common.php';

$aDeployedSensorID = $_GET['clientID'] ?? "";

$timeSeriesDataArray = TimeSeriesDataClass::getTimeSeriesData($aDeployedSensorID);
$json = json_encode($timeSeriesDataArrayArray);
header('Content-Type: application-json');
echo $json;