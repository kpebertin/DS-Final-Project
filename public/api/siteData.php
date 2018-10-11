<?php

require '../../app/common.php';

$aClientID = $_GET['clientID'] ?? "";

$siteArray = SiteClass::getSiteData($aClientID);
$json = json_encode($siteArray);
header('Content-Type: application-json');
echo $json;