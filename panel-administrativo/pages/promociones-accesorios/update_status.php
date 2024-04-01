<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();

$param["id"] = $_POST["id"];
$param["status"] = $_POST["status"];

$registro=$conn->query_status_promociones($param);

?>