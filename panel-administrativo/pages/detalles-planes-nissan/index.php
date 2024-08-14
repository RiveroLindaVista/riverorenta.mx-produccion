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

$sqlVersiones = 'SELECT t1.version , t2.precio FROM versiones t1 LEFT JOIN catalogo t2 ON t1.tipo=t2.tipo WHERE t2.modelo="'.$auto["modelo"].'" AND t2.ano="'.$auto["ano"].'" group BY t1.version order BY t2.precio';
/* $versiones = $conn->query($sqlVersiones);

var_dump($versiones); */
/* foreach ($vers as $key => $value) {
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
                            '<a onclick="modalEditar(\''.$value["version"].'\')" style="display: flex; align-items: center; justify-content: center;" class="btn btn-primary" >Editar </a>' +
                        '</div>' +
                    '</div>';
} */
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
            <hr/>
            <div>
                <?= $lista_versiones; ?>
            </div>
        </div>
    </section>

        <!-- Jquery Core Js -->
        <script src="../../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<!-- <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

<!-- Dropzone Plugin Js 
<script src="../../plugins/dropzone/dropzone.js"></script>
-->
<!-- Jquery Spinner Plugin Js -->
<script src="../../plugins/jquery-spinner/js/jquery.spinner.js"></script>

<!-- Bootstrap Tags Input Plugin Js 
<script src="../../plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
-->
<!-- Waves Effect Plugin Js -->
<script src="../../plugins/node-waves/waves.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="../../plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom Js -->
<script src="../../js/admin.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<!-- <script src="../../js/admin.js"></script> -->
<script src="../../js/pages/tables/jquery-datatable.js"></script>

</body>

</html>
