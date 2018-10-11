<?php

$aSensor = new SensorClass($_POST);
$aSensor->create();
echo json_encode($aSensor);