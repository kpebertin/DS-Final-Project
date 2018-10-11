<?php

$aSensorDeployed = new SensorDeployedClass($_POST);
$aSensorDeployed->create();
echo json_encode($aSensorDeployed);
