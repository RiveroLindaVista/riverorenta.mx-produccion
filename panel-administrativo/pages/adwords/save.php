<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();
$imagen = $_POST["imagen"];
$pagina_titulo = $_POST["pagina_titulo"];
$imagen_titulo = $_POST["imagen_titulo"];
$param["pagina_titulo"] = $pagina_titulo;
$param["imagen_titulo"] = $imagen_titulo;
$URL = pathinfo($imagen);

$param["imagen"] = $URL["filename"].'.'.$URL["extension"];

$registro=$conn->query_insertar_adwords($param);

?>