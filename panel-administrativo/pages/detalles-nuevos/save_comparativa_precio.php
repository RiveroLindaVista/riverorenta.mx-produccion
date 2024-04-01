<?php
include ("../../_inc/_config.php");


$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {

    $id = $_POST['id'];
    $valor =$_POST['valor'];

     $querySave = "UPDATE inventario_nuevos set precio='$valor' WHERE id='$id'";
            $conn->query($querySave);
}

$conn->close();

?>
