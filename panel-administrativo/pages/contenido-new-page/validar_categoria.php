<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$categoria=$_POST['categoria'];
$conne = new Construir();
$anios = $conne->get_meta_key_new($categoria);
print_r($anios);

?>