<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$tipo=$_POST['tipo'];
$ano=$_POST['ano'];
$conne = new Construir();
$modelos = $conne->change_tipo_modelo_faltante_nissan($marca, $modelo, $ano, $tipo);

echo $modelos;
?>