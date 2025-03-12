<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
require_once("../../_inc/config_aws.php");

require '../../vendor/autoload.php';

$conn=new Conexion();

$titulo1=str_replace('ó', 'o', $_POST["imagen_titulo"]);
$titulo2=str_replace('Ó', 'o', $titulo1);
$titulo3=str_replace('á', 'a', $titulo2);
$titulo4=str_replace('í', 'i', $titulo3);
$titulo5=str_replace('ú', 'u', $titulo4);
$titulo6=str_replace('?', '', $titulo5);
$titulo7=str_replace('¿', '', $titulo6);
$titulo8=str_replace('!', '', $titulo7);
$titulo9=str_replace('¡', '', $titulo8);
$titulo10=str_replace(' ', '-', $titulo9);
$titulo11=str_replace('ñ', 'n', $titulo10);
$titulo12=str_replace('Ñ', 'N', $titulo11);
$titulo13=str_replace('*', '', $titulo12);
$_POST["imagen_titulo"]=str_replace('+', '', $titulo13);

$imagen = $_POST["imagen"];
$param["descripcion"] = $_POST["descripcion"];
$param["imagen_titulo"] = $_POST["tipo"]."/".$_POST["imagen_titulo"].".jpg";
$param["tipo"] = $_POST["tipo"];
$param["tipoUpper"] = $_POST["tipoUpper"];
$param["marca"] = $_POST["marca"];

$param["modelo_unidad"] = str_replace(' ', '-', $_POST["modelo_unidad"]);
$param["ano"] = $_POST["ano"];
$param["cantidad"] = $_POST["cantidad"];
$param["tipo_promo"] = $_POST["tipo_promo"];

var_dump($param);

$registro=$conn->query_insertar_promociones($param);


?>