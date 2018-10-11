<?php

require '../../app/common.php';

$timeSeriesDataArray = TimeSeriesDataClass::getTimeSeriesData();
$json = json_encode($timeSeriesDataArrayArray);
header('Content-Type: application-json');
echo $json;