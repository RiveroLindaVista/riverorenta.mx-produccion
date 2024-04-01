<?php
include ("../../_inc/_config.php");


$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {

    $modelo = utf8_decode($_POST['modelo']);
    $valor =strtoupper(utf8_decode($_POST['valor']));
    $ano =$_POST['ano'];

    $query = "INSERT INTO inventario_colores (modelo,ano,color) VALUES('$modelo','$ano','$valor')";
	$conn->query($query);
}

$conn->close();

?>
