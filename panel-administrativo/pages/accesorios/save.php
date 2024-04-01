<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();

if ($_POST["insert"] == "accesorio") {
	$asignado = $_POST["asignado"];
	$inventario = $_POST["inventario"];
	$instalacion = $_POST["instalacion"];
	$precio = $_POST["precio"];
	$costo_inst = $_POST["costo_inst"];
	$categoria = $_POST["categoria"];
	$descripcion = $_POST["descripcion"];

	$param["asignado"] = $asignado;
	$param["inventario"] = $inventario;
	$param["instalacion"] = $instalacion;
	$param["precio"] = $precio;
	$param["costo_inst"] = $costo_inst;
	$param["categoria"] = $categoria;
	$param["descripcion"] = $descripcion;

	$accesorio=$conn->query_insertar_accesorio($param);

}else if($_POST["insert"] == "anio"){
	$anios = $_POST["anios"];
	$inventario = $_POST["id_accesorio"];
	$param["inventario"] = $inventario;

	for ($i=0; $i < count($anios); $i++) { 
		if ($anios[$i] != "") {
			$param["anio"] = $anios[$i];
			
			$accesorio=$conn->query_insertar_accesorio_anio($param);
		}
	}
		
}



?>