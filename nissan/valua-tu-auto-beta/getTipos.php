<?php
include("_config.php");
include("constructor.php");

$ano=$_POST['ano'];
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];

$conne = new Construir();
$tipo = $conne->get_tipo($ano, $marca, $modelo);

echo json_encode($tipo);
return json_encode($tipo);
?>