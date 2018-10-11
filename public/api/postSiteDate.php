<?php

$aSensor = new SiteClass($_POST);
$aSensor->create();
echo json_encode($aSite);
