<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();
// $imagen = $_POST["imagen"];
$pagina_titulo = $_POST["pagina_titulo"];
$imagen_titulo = $_POST["imagen_titulo"];

$param["pagina_titulo"] = $pagina_titulo;
// $URL = pathinfo($imagen);
// $param["imagen"] = $URL["filename"].'.'.$URL["extension"];
// $param['imagen'] = str_replace(' ', '-', $imagen_titulo) .'.png';
$param['imagen'] = $imagen_titulo.'.png';
$param["slug"] = str_replace(' ', '-', $imagen_titulo);
$param["carros_select"] = $_POST["carros_select"];

$registro=$conn->query_insertar_adwords($param);
echo json_encode($registro);

?>