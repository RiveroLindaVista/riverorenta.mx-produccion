<?php
include ("../../_inc/_config.php");


$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {

    $id =$_POST['id'];

    $query = "SELECT * FROM inventario_nuevos WHERE id='$id'";
	$result =$conn->query($query);
	$row = mysqli_fetch_assoc($result);

	$query1 = "DELETE FROM versiones WHERE modelo='".$row["modelo"]."' and ano='".$row["ano"]."' and tipo='".$row["tipo"]."'";
	$conn->query($query1);

	$query2 = "DELETE FROM inventario_nuevos WHERE id='$id'";
	$conn->query($query2);
}

$conn->close();

?>
