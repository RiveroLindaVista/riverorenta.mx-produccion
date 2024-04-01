<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$auto=$_POST['auto'];
$conne = new Construir();
$anios = $conne->get_anios_by_modelo($auto);
print_r($anios);

?>