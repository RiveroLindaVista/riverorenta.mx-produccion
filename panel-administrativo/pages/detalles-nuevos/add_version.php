<?php
include ("../../_inc/_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

if (count($_POST)) {
	$tipo=strtoupper($_POST['n_tipo']);
	$n_version=strtoupper($_POST['n_version']);
	$n_trans=$_POST['n_trans'];
	$n_vehiculo=$_POST['n_vehiculo'];
	$modelo=$_POST['modelo'];
	$marca=$_POST['marca'];
	$ano=$_POST['ano'];
	$color=strtoupper($_POST['n_color']);
	$precio=$_POST['n_precio'];

    $query = "INSERT INTO inventario_nuevos (ano,marca,modelo,tipo,tipo_vehiculo,color_exterior,transmision,precio,vin) VALUES(
    '$ano',
    '$marca',
    '$modelo',
    '$tipo',
    '$n_vehiculo',
    '$color',
    '$n_trans',
    '$precio','')";
	$conn->query($query);
	$query2 = "INSERT INTO versiones (modelo,ano,tipo,version) VALUES('$modelo','$ano','$tipo','$n_version')";
	$conn->query($query2);

}

$conn->close();

?>
