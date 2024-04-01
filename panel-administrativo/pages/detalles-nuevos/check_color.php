<?php  
include ("../../_inc/_config.php");


$url = $_POST["autoUrl"];
$color = $_POST["color"];
$marca = $_POST["marca"];

$path = URL.'/assets/img/autos-landing/'.strtolower($marca).'/'.$url.'/colores/'.strtoupper(str_replace(' ', '-',$color)).'.png';

if (file_exists($path)) {
	echo 1;
}else{
	echo 0;
}

?>