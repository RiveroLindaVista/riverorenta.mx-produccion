<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$conne = new Construir();
$modelos = $conne->get_modelos_valuacion($marca,$modelo);
print_r($modelos);
?>