<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$modelos_faltantes = $conne->check_modelos_faltantes_nissan();
echo json_encode($modelos_faltantes);
//echo $modelos 
?>