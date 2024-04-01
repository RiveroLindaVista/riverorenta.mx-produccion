<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$auto=$_POST['auto'];
$conne = new Construir();
$autos_accesorios_anios = $conne->get_anios_accesorios_auto($auto);
print_r($autos_accesorios_anios);
?>