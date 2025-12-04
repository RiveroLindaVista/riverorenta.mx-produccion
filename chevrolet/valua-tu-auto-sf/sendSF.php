<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//$tipoSend='test';
$tipoSend='prod';
$urlDest='crear-Valuacion';

print_r(getenv()); 



?>