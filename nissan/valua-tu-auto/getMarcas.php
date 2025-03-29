<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$ano=$_POST['ano'];
$conne = new Conexion();
$marcas = $conne->get_marcas($ano);
print_r($marcas);
?>