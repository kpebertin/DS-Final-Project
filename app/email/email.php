<?php

require '../environment.php';
require 'EmailProblem.php';
$emailArray = EmailProblem::getEmailData();
$json = json_encode($emailArray);
echo $json;