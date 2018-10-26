<?php

chdir(__DIR__);
set_include_path (__DIR__);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}
require 'environment.php';
require 'models/ClientClass.php';
require 'models/SiteClass.php';
require 'models/TurbineDeployedClass.php';
require 'models/SensorDeployedClass.php';
require 'models/SensorClass.php';
require 'models/TurbineClass.php';
require 'models/TimeSeriesDataClass.php';
require 'models/ClientNoteClass.php';