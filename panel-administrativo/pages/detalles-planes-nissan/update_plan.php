<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
require_once("../../_inc/_config.php");

//var_dump($_POST);

$slug = 'nissan-'.strtolower($_POST["modelo"]).'-'.$_POST["ano"];
echo $slug;
return $slug;

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
$sql = 'SELECT * FROM planes_nissan WHERE modelo="'.$_POST["modelo"].'" and version="'.$_POST["version"].'" and ano="'.$_POST["ano"].'"';

$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while ($row = $resultQuery->fetch_assoc()) {
        $auto = $row;
    }
}

if($auto){

    echo '1';
} else {
    $queryInsert = "INSERT INTO planes_nissan (auto,num_inventario,descripcion,tiempo_instalacion,precio,status,instalacion,categoria) VALUES('$ano','$modelo','$tecnologia','$tipo')";
	$conn->query($queryInsert);
    echo '0';
}

/*     $query = "INSERT INTO accesorios (auto,num_inventario,descripcion,tiempo_instalacion,precio,status,instalacion,categoria) VALUES('$ano','$modelo','$tecnologia','$tipo')";
	$conn->query($query); */

$conn->close();

?>