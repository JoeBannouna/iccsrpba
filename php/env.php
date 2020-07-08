<?php
    
use Dotenv\Dotenv;


require_once(dirname(__FILE__) . '/vendor/autoload.php');
  
$dotenv  = Dotenv::createImmutable(dirname(__FILE__));
$dotenv->load();

define("LOG_PATH", dirname(__FILE__) . "/logs");
define("DEV_MODE", true);
$logPath = dirname(__FILE__) . "/logs";
$dateFormatted = date("m/d/Y h:i");

if (DEV_MODE) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}