<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$marca=$_POST['marca'];
$conne = new Construir();
$modelos_by_marca = $conne->get_modelos_by_marca($marca);
print_r($modelos_by_marca);
?>