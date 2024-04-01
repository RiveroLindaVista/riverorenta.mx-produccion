<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();

$param["id"] = $_POST["id"];
$param["nombre_nuevo"] = $_POST["nombre_nuevo"];

//echo $param["nombre_nuevo"];

$registro=$conn->query_update_nombre($param);

?>