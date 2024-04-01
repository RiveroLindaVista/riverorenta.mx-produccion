<?php
include ("../../_inc/_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

if (count($_POST)) {

    $modelo = utf8_decode($_POST['modelo']);
    $nombre =utf8_decode($_POST['nombre']);
    $orden =$_POST['orden'];

    $query = "INSERT INTO versiones_comparativa (modelo,nombre,orden) VALUES('$modelo','$nombre','$orden')";
	$conn->query($query);
}

$conn->close();

?>
