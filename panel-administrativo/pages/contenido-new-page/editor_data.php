<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$contenido = $_POST['contenido'];
$num_id = $_POST['num_id'];

$conn=new Conexion();
$param['contenido']=$contenido;
$param['num_id']=$num_id;

$registro=$conn->query_insertar_blog_editor($param);
?>