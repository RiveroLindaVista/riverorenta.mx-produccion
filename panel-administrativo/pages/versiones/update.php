<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$id=$_POST['id'];
$version=$_POST['version'];
$conne = new Construir();
$response = $conne->update_version_versiones($id, $version);
print_r($response);
?>