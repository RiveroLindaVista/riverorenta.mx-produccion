<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$marca = strtolower($_POST['marca']);
$modelo = str_replace(' ', '-', $_POST['modelo']);
$ano = $_POST['ano'];
$color = $_POST['color'];
$slug = $marca.'-'.strtolower($modelo).'-'.$ano;
$sensor = 0;
$modeloC = $_POST['modelo'];

$conn=new Conexion();
$param['modelo']=$modeloC;
$param['ano']=$ano;
$param['color']=$color;
$param['slug']=$slug;
$param['modeloC']=$modeloC;

$revisionByCarro=$conn->query_lista_colores_by_carro($modeloC,$ano);

for($i=0;$i<=count($revisionByCarro);$i++){
    if($color=== $revisionByCarro[$i]["color"]){
        echo 'ESTE CARRO YA TIENE ASIGNADO ESTE COLOR';
        echo ': ';
        echo $revisionByCarro[$i]["color"];
        $sensor = $sensor + 1;
    } else{

    }
}

if($sensor == 0){
    echo 'Color "';
    echo $color;
    echo '" asignado correctamente';
    $registro=$conn->query_asignar_color($param);
}


?>