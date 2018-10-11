<?php

$aSite = new SiteClass($_POST);
$aSite->create();
echo json_encode($aSite);
