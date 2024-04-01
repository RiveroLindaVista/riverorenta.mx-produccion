<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

//print_r($_POST);

$modelo= $_POST['modelo'];
$anio= $_POST['anio'];
$categoria= $_POST['categoria'];
$meta_key= $_POST['meta_key'];
$meta_value= $_POST['meta_value'];

$param['modelo']=$modelo;
$param['anio']=$anio;
$param['categoria']=$categoria;
$param['meta_key']=$meta_key;
$param['meta_value']=$meta_value;

$conn=new Conexion();
$registro=$conn->query_insertar_nevos_detalles($param);
if($registro){
    $res=1;
}else{
    $res=2;
}
echo $res;
?>