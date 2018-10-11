<?php

$aSensor = new TimeSeriesClass($_POST);
$aSensor->create();
echo json_encode($asensorDeployedID);
