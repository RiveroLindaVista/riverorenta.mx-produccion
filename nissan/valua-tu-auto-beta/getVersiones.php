<?php
include("_config.php");
include("constructor.php");

$ano=$_POST['ano'];
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$conne = new Construir();
$versiones = $conne->get_versiones($modelo, $ano,$marca);

echo json_encode($versiones);
return json_encode($versiones);
?>