<?php
include("_config.php");

$ano=$_POST['ano'];
echo 'POPO';
$conne = new Construir();
$marcas = $conne->get_marcas($ano);

?>