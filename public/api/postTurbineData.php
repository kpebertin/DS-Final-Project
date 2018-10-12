<?php

$aTurbine = new TurbineClass($_POST);
$aTurbine->create();
echo json_encode($aTurbine);
