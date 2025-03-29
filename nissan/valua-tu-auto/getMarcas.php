<?php
require_once("_config.php");

$ano=$_POST['ano'];
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
$marcas = $conn->get_marcas($ano);
print_r($marcas);
?>