<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
require_once("../../_inc/_config.php");

//var_dump($_POST);

$slug = 'chevrolet-'.strtolower($_POST["modelo"]).'-'.$_POST["ano"];
$slug = str_replace(' ', '-', $slug);

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
$sql = 'SELECT * FROM planes_chevrolet WHERE modelo="'.$_POST["modelo"].'" and version="'.$_POST["version"].'" and ano="'.$_POST["ano"].'"';

$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while ($row = $resultQuery->fetch_assoc()) {
        $auto = $row;
    }
}

if($auto){
    $queryUpdate = 'UPDATE planes_chevrolet set mensualidad="'.$_POST["mensualidad"].'", enganche="'.$_POST["enganche"].'" WHERE modelo="'.$_POST["modelo"].'" and version="'.$_POST["version"].'" and ano="'.$_POST["ano"].'"';
	$conn->query($queryUpdate);
    echo json_encode($queryUpdate);
} else {
    $queryInsert = 'INSERT INTO planes_chevrolet (slug,marca,modelo,version,tipo,ano,mensualidad,enganche) VALUES("'.$slug.'","CHEVROLET","'.$_POST["modelo"].'","'.$_POST["version"].'","'.$_POST["tipo"].'","'.$_POST["ano"].'","'.$_POST["mensualidad"].'","'.$_POST["enganche"].'")';
	$conn->query($queryInsert);
    echo json_encode($queryInsert);
}

$conn->close();

?>