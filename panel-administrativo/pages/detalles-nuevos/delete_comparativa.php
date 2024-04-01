<?php
include ("../../_inc/_config.php");


$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {

    $id =$_POST['id'];

    $query = "DELETE FROM versiones_comparativa WHERE id='$id'";
	$conn->query($query);
	$query2 = "DELETE FROM versiones_relacion WHERE comparativa_id='$id'";
	$conn->query($query2);
}

$conn->close();

?>
