<?php

require '../../app/common.php';

$clientArray = ClientClass::getClientData();
$json = json_encode($clientArray);
header('Content-Type: application-json');
echo $json;