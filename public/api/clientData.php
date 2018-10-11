<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postClient.php';
    die;
}

$clientArray = ClientClass::getClientData();
$json = json_encode($clientArray);
header('Content-Type: application-json');
echo $json;