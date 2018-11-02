<?php

require '../../app/common.php';
$emailArray = EmailProblem::getEmailData();
$json = json_encode($emailArray);
echo $json;