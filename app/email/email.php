<?php

require '../../app/common.php';
$emailArray = EmailProblem::getEmailData();
$json = json_encode($emailArray);
header('Content-Type: application-json');
echo $json;