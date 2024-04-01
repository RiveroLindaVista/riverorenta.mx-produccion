<?php
include ("../../_inc/_config.php");

$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

if (count($_POST)) {
    $id =$_POST['id'];
    $query = "DELETE FROM inventario_colores WHERE id='$id'";
	$conn->query($query);
}

$conn->close();

?>
