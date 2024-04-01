<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$color_name = strtoupper($_POST['color_name']);
$color_hex = $_POST['color_hex'];
$sensor = 0;

$conn=new Conexion();
$param['color_name']=$color_name;
$param['color_hex']=$color_hex;

$revision=$conn->query_lista_colores();

for($i=0;$i<=count($revision);$i++){
    if($color_name=== $revision[$i]["nombre"]){
        echo 'YA EXISTE ESTE COLOR';
        echo ': ';
        echo $revision[$i]["nombre"];
        $sensor = $sensor + 1;
    } else{

    }
}

if($sensor == 0){
    echo 'Color creado correctamente';
    $registro=$conn->query_crear_color($param);
}

//var_dump($revision);

?>