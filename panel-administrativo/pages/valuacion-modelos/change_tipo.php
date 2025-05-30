<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$id=$_POST['id'];
$tipo=$_POST['tipo'];
$conne = new Construir();
$modelos = $conne->change_tipo_modelo($id,$tipo);

echo '0'; 
?>