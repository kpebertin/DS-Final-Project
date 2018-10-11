<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postTurbineDeployedData.php';
    die;
}

$aSiteID = $_GET['siteID'] ?? "";

#echo $aClientID;

$siteArray = TurbineDeployedClass::getTurbineDeployedData($aSiteID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;
