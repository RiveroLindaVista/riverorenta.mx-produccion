<?php
include("_config.php");
include("constructor.php");

$ano=$_POST['ano'];
$conne = new Construir();
$marcas = $conne->get_marcas($ano);
print_r($marcas);
?>