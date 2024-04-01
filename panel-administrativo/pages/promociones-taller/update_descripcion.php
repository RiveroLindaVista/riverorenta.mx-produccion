<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
$conn=new Conexion();

$param["descripcion"] = $_POST["descripcion"];
$param["id"] = $_POST["id"];
var_dump($param);

$registro=$conn->query_descripcion_promociones($param);

?>