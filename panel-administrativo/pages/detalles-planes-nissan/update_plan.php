<?php
include("../../_inc/conexion.php");
include("../../_inc/consultas.php");

$conn=new Conexion();
//var_dump($_POST);

$sql = 'SELECT * FROM planes_nissan WHERE modelo="'.$_POST["modelo"].'" and version="'.$_POST["version"].'" and ano="'.$_POST["ano"].'"';

$result=$conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $out[]=$row;
    }
    echo json_encode($out);
}

/*     $query = "INSERT INTO accesorios (auto,num_inventario,descripcion,tiempo_instalacion,precio,status,instalacion,categoria) VALUES('$ano','$modelo','$tecnologia','$tipo')";
	$conn->query($query); */

$conn->close();

?>