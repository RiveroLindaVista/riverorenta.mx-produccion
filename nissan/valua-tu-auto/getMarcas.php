<?php
include("_config.php");

$ano=$_POST['ano'];

$conne = new Construir();
echo 'POPO';
$marcas = $conne->get_marcas($ano);

?>