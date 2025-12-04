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

	$ownerid=$_POST["ownerid"];
	$leadid=$_POST["leadid"];
	$opid=$_POST["opid"];
	$km=$_POST["km"];
	$version=$_POST["version"];
	$marca=$_POST["marca"];
	$ano=$_POST["ano"];
	$modelo=$_POST["modelo"];
	$ofrecido=$_POST["ofrecido"];
	$venta=$_POST["venta"];
	$compra=$_POST["compra"];

    echo $ownerid;

?>