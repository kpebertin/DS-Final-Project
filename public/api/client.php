<?php

require '../../app/common.php';

$clientArray = ClientClass::getClient();
$json = json_encode($clientArray);
header('Content-Type: application-json');
echo $json;