<?php

$aTimeSeries = new TimeSeriesDataClass($_POST);
$aTimeSeries->create();
echo json_encode($aTimeSeries);
