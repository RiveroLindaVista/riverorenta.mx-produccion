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
for($i=0;$i<count($versiones);$i++){
    echo $versiones[$i]["version"];
    $params = base64_encode(json_encode($value));
    $lista_versiones.=  '<div class="card" >
                            <div class="card-body">
                                <h3 style="display: flex; align-items: center; justify-content: center;" class="card-title">'.$versiones[$i]["version"].'</h3><hr/>
                                <h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">ENGANCHE:</h5>
                                <input class="form-control" style="width: 100%" type="text" id="enganche_'.$versiones[$i]["version"].'" hidden>
                                <h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">MENSUALIDAD:</h5>
                                <input class="form-control" style="width: 100%" type="text" id="mensualidad_'.$versiones[$i]["version"].'" hidden>
                                <h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">PRECIO CONTADO: '.$versiones[$i]["precio"].'</h5>
                                <input class="form-control" style="width: 100%" type="text" id="precio_'.$versiones[$i]["version"].'" value="'.$versiones[$i]["precio"].'" hidden>
                                <a onclick="modalEditar(\''.$versiones[$i]["version"].'\')" style="display: flex; align-items: center; justify-content: center;" class="btn btn-primary" >Editar </a>
                            </div>
                        </div>';


}

print_r($lista_versiones);
?>


<!DOCTYPE html>
<html>

<head>
    <title></title>
    <?php include('../../_inc/_header.php'); ?>
    <link rel='icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- Sweetalert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!-- <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"> -->


</head>

<body class="theme-blue">
    <!-- #Top Bar -->
    <?php include('../../_inc/_search-bar.php'); ?>
    <!-- #Menu -->
    <section>
        <?php include('../../_inc/_menu.php'); ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <? //include('../../_inc/_gadgets.php');
        ?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <h2> <?= $auto["modelo"] ?></h2>

            <hr/>

            <div>
                <?= $lista_versiones; ?>
            </div>
        </div>
    </section>