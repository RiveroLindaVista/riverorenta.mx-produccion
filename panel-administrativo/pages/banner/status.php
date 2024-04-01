<?php
include("../../_inc/consultas.php");

$conn=new Conexion();
$id=$_POST['obj'];
$status = $_POST['status'];

$param["id"] = $id;
$param["status"] = $status;

$registro=$conn->query_actualizar_banner($param);

if ($_POST['status']==1) {
   echo 'Has Inhabilitado este Banner';
}
else if ($_POST['status']==0){
	echo 'Has Habilitado este Banner';
}
?>