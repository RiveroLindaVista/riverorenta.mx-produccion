<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$ano=$_POST['ano'];
$tipo=$_POST['tipo'];
$conne = new Construir();
$modelos = $conne->check_full_modelo_valuacion($marca,$modelo,$ano,$tipo);
echo json_encode($modelos);
//echo $modelos 
?>