<?php

$aTurbinesDeployed = new TurbineDeployedClass($_POST);
$aTurbinesDeployed->create();
echo json_encode($aTurbineDeployed);
