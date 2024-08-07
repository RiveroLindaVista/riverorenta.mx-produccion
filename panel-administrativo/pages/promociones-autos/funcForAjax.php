<?php

// include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();

$function = $_POST['function'];

$function($conn);

function modelos_by_marca($conn) {
    $marca = $_POST['marca'];
    $modelos_by_marca = $conn->query_modelos_by_marca($marca);
    
    echo json_encode($modelos_by_marca);
    // var_dump($conn);

}

function anos_by_model($conn){
    $modelo = $_POST['modelo'];
    $res = $conn->query_anos_by_model($modelo);
    echo json_encode($res);
}





?>