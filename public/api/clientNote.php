<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'postClientNote.php';
    die;
}

$aClientID = $_GET['clientID'] ?? 0;
#echo $aClientID;

$noteArray = ClientNoteClass::getClientNoteData($aClientID);
$json = json_encode($noteArray);
header('Content-Type: application-json');
echo $json;