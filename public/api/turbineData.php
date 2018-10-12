<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postTurbineData.php';
    die;
}

$aTurbineID = $_GET['turbineID'] ?? ""; 

$siteArray = TurbineClass::getTurbineData($aTurbineID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;
