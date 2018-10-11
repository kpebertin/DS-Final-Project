<?php

require '../../app/common.php';

$aTurbineID = $_GET['turbineID'] ?? ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postTurbineData.php';
    die;
}

#echo $aClientID;

$siteArray = TurbineClass::getTurbineData($aTurbineID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;
