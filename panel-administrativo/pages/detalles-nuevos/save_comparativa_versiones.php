<?php
include ("../../_inc/_config.php");


$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {

    $version_id = $_POST['version_id'];
    $comparativa_id =$_POST['comparativa_id'];
    $valor =utf8_decode($_POST['valor']);

    $query = "SELECT *  FROM versiones_relacion WHERE version_id = '$version_id' and comparativa_id='$comparativa_id'";
	$result = $conn->query($query);

    if(mysqli_num_rows($result) == 1 ){
          $querySave = "UPDATE versiones_relacion set valor='$valor' WHERE version_id='$version_id' and comparativa_id='$comparativa_id'";
			$conn->query($querySave);
           

    }else{
    	 $querySave = "INSERT INTO versiones_relacion (version_id,comparativa_id,valor) VALUES ('$version_id','$comparativa_id','$valor')";
			$conn->query($querySave);
    }   
    
}

$conn->close();

?>
