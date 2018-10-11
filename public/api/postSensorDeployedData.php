<?php

$aSensor = new SensorDeployedClass($_POST);
$aSensor->create();
echo json_encode($aSensorDeployed);
