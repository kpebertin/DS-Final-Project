<?php

$aTurbinesDeployed = new TurbinesDeployedClass($_POST);
$aTurbinesDeployed->create();
echo json_encode($aTurbineDeployed);
