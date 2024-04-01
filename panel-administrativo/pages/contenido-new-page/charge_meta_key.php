<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$categoria=$_POST['categoria'];
$conne = new Construir();
$meta_key = $conne->charge_meta_key($categoria);
print_r($meta_key);

?>