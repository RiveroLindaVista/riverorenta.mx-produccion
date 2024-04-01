<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");
$conn=new Conexion();

$param["slug"] = $_POST["slug"];
$param["id"] = $_POST["id"];

$validacion = $conn->validar_slug_qr($param);
$resultado = $validacion->fetch_assoc();

if ($resultado == null){
    $registro=$conn->query_slug_qr($param);
    echo '1';
} else {
    echo '0';
}

?>