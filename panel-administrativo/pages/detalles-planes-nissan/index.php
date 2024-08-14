<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);

$conne = new Construir();
// $marcas = $conne->get_lista_marcas();
echo $_GET["id"];

$sql = 'SELECT * FROM catalogo WHERE id="' . $_GET["id"] . '"';
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while ($row = $resultQuery->fetch_assoc()) {
        $auto = $row;
    }
}

//var_dump($auto);

echo ' - ';


$versiones = $conne->get_lista_versiones_nissan($auto[0]["modelo"], $auto[0]["ano"]);
var_dump($versiones);
?>
