<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
//include("../../_inc/constructor.php");

var_dump($_POST);

$marca = ucfirst($_POST['marca']);
$nombre = strtoupper($_POST['nombre']);
$anio =$_POST['anio'];
$version = strtoupper($_POST['version']);
$slugin= $marca.'-'.$nombre.'-'.$anio;
//$slugin = str_replace(' ', '-', $_POST['titulo']);
$slug = strtolower($slugin);
$status = 1;
//$title =$_POST['titulo'];
//$title =strtoupper($_POST['title']);
//$metakeys =$_POST['metakeys'];
//$contenido =$_POST['contenido'];
//$imagen =$_POST['imagen'];

$conn=new Conexion();
//$param['imagen']=$imagen;
$param['marca']=$marca;
//$param['titulo']=$title;
//$param['titulo']=$metakeys;
$param['slug']=$slug;
$param['nombre']=$nombre;
$param['anio']=$anio;
$param['version']=$version;
//$param['imagen']=$imagen;

$registro=$conn->query_insertar_autonuevo($param);
?>