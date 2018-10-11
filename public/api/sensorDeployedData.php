<?php

require '../../app/common.php';

$aTurbineDeployedID = $_GET['turbinedeployedID'] ?? "";

#echo $aClientID;

$siteArray = SensorDeployedClass::getTurbineDeployedData($aTurbineDeployedID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;
