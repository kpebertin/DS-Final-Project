<?php

$aTimeSeries = new TimeSeriesClass($_POST);
$aTimeSeries->create();
echo json_encode($asensorDeployedID);
