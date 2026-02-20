<?php
include("_config.php");
include("constructor.php");

$ano=$_POST['ano'];
$marca=$_POST['marca'];
$conne = new Construir();
$modelos = $conne->get_modelos($ano,$marca);

echo json_encode($modelos);
return json_encode($modelos);
?>