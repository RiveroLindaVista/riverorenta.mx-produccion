<?php
include ("../../_inc/_config.php");

$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

if (count($_POST)) {
    $id =$_POST['id'];
    $query = "DELETE FROM inventario_tecnologia WHERE id='.$id.'";
	if($conn->query($query)){
		echo "hecho";
	}else{
		echo "error";
	}
}
$conn->close();
?>
