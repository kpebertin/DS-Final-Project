<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postTurbineData.php';
    die;
}

$aTurbineID = $_GET['turbineID'] ?? ""; 

$turbineArray = TurbineClass::getTurbineData($aTurbineID);
$json = json_encode($turbineArray);
header('Content-Type: application-json');
echo $json;
