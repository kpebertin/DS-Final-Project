<?php

$aTurbineDeployed = new TurbineDeployedClass($_POST);
$aTurbineDeployed->create();
echo json_encode($aTurbineDeployed);
