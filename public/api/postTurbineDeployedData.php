<?php

$aSensor = new TurbinesDeployedClass($_POST);
$aSensor->create();
echo json_encode($aTurbineDeployed);
