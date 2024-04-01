<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$conne = new Construir();
//$autos = $conne->get_table_promociones('nuevos');
$modelo = $_POST["obj1"];
$anio = $_POST["obj2"];
$param["modelo"] = $modelo;
$param["anio"] = $anio;


$autos_promo_color= $conne->autos_promo_color($param);
var_dump($autos_promo_color);
?>