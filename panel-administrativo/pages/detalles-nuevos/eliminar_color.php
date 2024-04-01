<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$modelo = strtoupper($_POST['modeloE']);
$ano = $_POST['anoE'];
$color = strtoupper($_POST['colorE']);
$id = $_POST['keyE'];

$conn=new Conexion();
$param['modelo']=$modelo;
$param['ano']=$ano;
$param['color']=$color;
$param['id']=$id;

$eliminacion=$conn->query_eliminar_color($param);

echo 'Se ha eliminado el color ';
echo $color;
echo ' del modelo ';
echo $modelo;
echo ' ';
echo $ano;


?>