<?php

require '../../app/common.php';

$aSiteID = $_GET['siteID'] ?? "";

#echo $aClientID;

$siteArray = SiteClass::getSiteData($aSiteID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;