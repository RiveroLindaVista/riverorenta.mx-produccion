<?php
include("../../_inc/consultas.php");

$conn=new Conexion();
$id=$_POST['obj'];
$status = $_POST['status'];

$param["id"] = $id;
$registro=$conn->query_eliminar_publicidad($param);

   echo 'Se ha eliminado!.';

?>