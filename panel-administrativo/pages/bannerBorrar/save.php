<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
//include("../../_inc/constructor.php");

$titulo =strtoupper($_POST['titulo']);
$title =strtoupper($_POST['title']);
$metakeys =$_POST['metakeys'];
$descripcion =$_POST['descripcion'];
//$contenido =$_POST['contenido'];
//$imagen =$_POST['imagen'];
$conn=new Conexion();
$param['imagen']=$imagen;
$param['titulo']=$titulo;
$param['title']=$title;
$param['metakeys']=$metakeys;
$param['descripcion']=$descripcion;
//$param['contenido']=$contenido;
//$param['imagen']=$imagen;

$registro=$conn->query_insertar_blog($param);
?>