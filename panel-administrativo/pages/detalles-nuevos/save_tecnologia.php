<?php
include ("../../_inc/_config.php");


$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {

	$ano=$_POST['ano'];
	$modelo=$_POST['modelo'];
	$tipo=$_POST['tipo'];
	//$tecnologia=$_POST['tecnologia'];
	$tituloDetalle=$_POST['tituloDetalle'];
	if ($tipo=="detalle") {
		$tecnologia.='<strong>'.$tituloDetalle.'</strong><br><br>.'.$_POST['tecnologia'].'. ';
	}else{
		$tecnologia=utf8_decode($_POST['tecnologia']);
	}
	

    $query = "INSERT INTO inventario_tecnologia (ano, modelo, tecnologia, tipo) VALUES('$ano','$modelo','$tecnologia','$tipo')";
	$conn->query($query);
}

$conn->close();

?>
