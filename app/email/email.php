<?php

require 'environment.php';
require 'email/EmailProblem.php';
$emailArray = EmailProblem::getEmailData();
$json = json_encode($emailArray);
echo $json;