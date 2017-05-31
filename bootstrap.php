<?php
//Just for development stage
ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT_PATH' , realpath(__DIR__));
define('SRC_PATH' , realpath(__DIR__.'/src'));
define('CONTROLLERS_PATH',SRC_PATH.'/Itinerary/App/Controllers');
define('VIEW_PATH',SRC_PATH.'/views');

require_once realpath(__DIR__ . '/vendor/autoload.php');
