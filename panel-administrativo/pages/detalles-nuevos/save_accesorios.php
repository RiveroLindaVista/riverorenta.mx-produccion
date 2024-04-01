<?php
include ("../../_inc/_config.php");


$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {

$auto=$_POST[''];
$num_inventario=$_POST['numero_inventario'];
$descripcion=$_POST[''];
$tiempo_instalacion=$_POST['tiempo_instalacion'];
$precio=$_POST['precio'];
$status=$_POST['status'];
$instalacion=$_POST[''];
$categoria=$_POST['categoria_accesorios'];

    $query = "INSERT INTO accesorios (auto,num_inventario,descripcion,tiempo_instalacion,precio,status,instalacion,categoria) VALUES('$ano','$modelo','$tecnologia','$tipo')";
	$conn->query($query);
}

$conn->close();

?>
