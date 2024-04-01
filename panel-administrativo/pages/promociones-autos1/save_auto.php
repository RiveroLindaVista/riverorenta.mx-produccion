<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$ano = $_POST["ano"];
$imagen = $_POST["imagen"];
$titulo_uno = $_POST["titulo_uno"];
$tipo = $_POST["tipo"];
$status = $_POST["status"];

$param["marca"] = $marca;
$param["modelo"] = $modelo;
$param["ano"] = $ano;
$param["imagen"] = $imagen;
$param["titulo_uno"] = $titulo_uno;
$param["tipo"] = $tipo;
$param["status"] = $status;

$registro=$conn->query_insertar_promociones_autos($param);

?>