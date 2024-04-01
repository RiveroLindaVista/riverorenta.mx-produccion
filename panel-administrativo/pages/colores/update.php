<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$id=$_POST['id'];
$nombre=$_POST['nombre'];
$color = $_POST['color'];
$conne = new Construir();
$response = $conne->update_color($id, $nombre, $color);
print_r($response);
?>