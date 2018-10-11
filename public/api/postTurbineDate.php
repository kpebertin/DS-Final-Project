<?php

$aSensor = new TurbineClass($_POST);
$aSensor->create();
echo json_encode($aTurbineID);
