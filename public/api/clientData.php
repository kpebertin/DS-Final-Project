<?php

require '../../app/common.php';

$clientName = $_GET['clientName'] ?? "";

$clientArray = ClientClass::getClientData($clientName);
$json = json_encode($clientArray);
header('Content-Type: application-json');
echo $json;