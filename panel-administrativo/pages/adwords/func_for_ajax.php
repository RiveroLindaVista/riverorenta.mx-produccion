<?php
// include('../../_inc/conexion.php');
// include('../../_inc/consultas.php');
include('../../_inc/_config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);

$function = $_POST['function'];




if ($function == 'validate_image_name') {
    $imagen_titulo = $_POST['imagen_titulo'];
    $conn->set_charset("utf8");
    $sql = 'SELECT count(*) as count FROM adwords where imagen = "'.$imagen_titulo.'"';
    $res = $conn->query($sql);
    $out=array(); 
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $out = $row;
        }
        
    }
    echo json_encode($out);
}


$conn->close();


?>