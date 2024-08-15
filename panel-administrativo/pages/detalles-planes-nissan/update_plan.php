<?php
include ("../../_inc/_config.php");

$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

if (count($_POST)) {
    $query = 'SELECT * FROM planes_nissan WHERE modelo="'.$_POST["modelo"].'" and version="'.$_POST["version"].'" and ano="'.$_POST["ano"].'"';
	$conn->query($query);

    echo $conn;

/*     $query = "INSERT INTO accesorios (auto,num_inventario,descripcion,tiempo_instalacion,precio,status,instalacion,categoria) VALUES('$ano','$modelo','$tecnologia','$tipo')";
	$conn->query($query); */
}

$conn->close();

?>