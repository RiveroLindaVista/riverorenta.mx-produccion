<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$tipo=$_POST['tipo'];
$conne = new Construir();
$modelos = $conne->delete_modelo_valuacion($id);
echo json_encode($modelos);
//echo $modelos 
?>