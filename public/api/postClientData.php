<?php

$aClient = new ClientClass($_POST);
$aClient->create();
echo json_encode($aClient);