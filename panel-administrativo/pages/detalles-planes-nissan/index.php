<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);

$conne = new Construir();
// $marcas = $conne->get_lista_marcas();
//echo $_GET["id"];

$sql = 'SELECT * FROM catalogo WHERE id="' . $_GET["id"] . '"';
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while ($row = $resultQuery->fetch_assoc()) {
        $auto = $row;
    }
}



//echo $auto[0]["modelo"];

$versiones = $conne->get_lista_versiones_nissan($auto["modelo"], $auto["ano"]);
var_dump($versiones);
foreach ($versiones as $key => $value) {
    $params = base64_encode(json_encode($value));
    $lista_versiones.='<div class="card" >' +
                        '<div class="card-body" >' +
                            '<h3 style="display: flex; align-items: center; justify-content: center;" class="card-title">'.$value["version"].'</h3><hr/>' +
                            '<h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">ENGANCHE:</h5>' +
                            '<input class="form-control" style="width: 100%" type="text" id="enganche_'.$value["version"].'" hidden>'+
                            '<h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">MENSUALIDAD:</h5>' +
                            '<input class="form-control" style="width: 100%" type="text" id="mensualidad_'.$value["version"].'" hidden>'+
                            '<h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">PRECIO CONTADO: '.$value["precio"].'</h5>' +
                            '<input class="form-control" style="width: 100%" type="text" id="precio_'.$value["version"].'" value="'.$value["precio"].'" hidden>'+
/*                             '<a onclick="modalEditar(\''.$value["version"].'\')" style="display: flex; align-items: center; justify-content: center;" class="btn btn-primary" >Editar </a>' + */
                        '</div>' +
                    '</div>';
}
?>

