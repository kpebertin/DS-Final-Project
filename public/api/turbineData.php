<?php

require '../../app/common.php';

$aTurbineID = $_GET['tubineID'] ?? "";

#echo $aClientID;

$siteArray = TurbineClass::getTurbineData($aTurbineID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;
