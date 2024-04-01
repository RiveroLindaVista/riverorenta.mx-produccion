<?php
//include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();
if ($_POST['asignado']!='NOASIGNADO') {
    $asignado=$_POST['asignado'];	
}else{
	$asignado=$_POST['descripcion'];
}
$mes_banner= $_POST['mes_banner'];
$tipo= $_POST['tipo'];
if ($tipo=="banner-mobile") {
	$metakey="banner_mobile";
}else if ($tipo=="banner") {
	$metakey="banner";
}
$imagen1= $_POST['imagen'];

$meta_value = str_replace("https://www.gruporivero.com/assets/banners/img/", "", $imagen1);
$titulo=$asignado;
//$tipo=1;
//$status=1;

$param["metakey"] = $metakey;
$param["meta_value"] = $meta_value;
$param["titulo"] = $titulo;
$param["tipo"] = 0;
$param["status"] = $status;

$registro=$conn->query_insertar_banner($param);

?>