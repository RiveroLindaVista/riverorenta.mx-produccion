<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
require_once("../../_inc/_config.php");

//var_dump($_POST);

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
$sql = 'SELECT * FROM planes_nissan WHERE modelo="'.$_POST["modelo"].'" and version="'.$_POST["version"].'" and ano="'.$_POST["ano"].'"';

$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while ($row = $resultQuery->fetch_assoc()) {
        $auto = $row;
    }
}

var_dump($auto);

/*     $query = "INSERT INTO accesorios (auto,num_inventario,descripcion,tiempo_instalacion,precio,status,instalacion,categoria) VALUES('$ano','$modelo','$tecnologia','$tipo')";
	$conn->query($query); */

$conn->close();

?>