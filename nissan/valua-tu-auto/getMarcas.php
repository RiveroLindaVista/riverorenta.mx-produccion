<?php
require_once("_config.php");

$ano=$_POST['ano'];
$conne = new Conexion();
$marcas = $conne->get_marcas($ano);
print_r($marcas);
?>