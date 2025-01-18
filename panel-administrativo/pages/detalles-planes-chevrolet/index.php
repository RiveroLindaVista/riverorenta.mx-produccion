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



echo $auto["slug"];


$versiones = $conne->get_lista_versiones_chevrolet($auto["modelo"], $auto["ano"]);
//var_dump($versiones);

/* $enganches = $conne->get_lista_enganches_chevrolet($auto["slug"]);
var_dump($enganches); */

for($i=0;$i<count($versiones);$i++){
    $params = base64_encode(json_encode($value));
    $lista_versiones.=  '<div class="col-md-4 col-sm-12 col-12">
                            <div class="card" >
                                <div class="card-body" style="padding:5px;">
                                    <h3 style="display: flex; align-items: center; justify-content: center;" class="card-title">'.$versiones[$i]["version"].'</h3><hr/>
                                    <h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">ENGANCHE: $ '.money_format('%.2n',$versiones[$i]["enganche"]).'</h5>
                                    <h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">MENSUALIDAD: $ '.money_format('%.2n',$versiones[$i]["mensualidad"]).' </h5>
                                    <h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">PRECIO CONTADO: '.money_format('%.2n',$versiones[$i]["precio"]).'</h5>
                                    <a onclick="modalEditar(\''.$versiones[$i]["version"].'\',\''.$versiones[$i]["enganche"].'\',\''.$versiones[$i]["mensualidad"].'\',\''.$versiones[$i]["tipo"].'\',\''.$auto["modelo"].'\',\''.$auto["ano"].'\')" style="display: flex; align-items: center; justify-content: center;color:white;" class="btn btn-warning" >Editar </a>
                                </div>
                            </div>
                        </div>';
}

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
            <div class="row clearfix">
                <h2 style="text-align:center"> <?= $auto["modelo"]?> - <?=$auto["ano"]?></h2>

                <hr/>

                <div>
                    <?= $lista_versiones; ?>
                </div>
            </div>
        </div>
    </section>

     <!-- Modal de edicion de inventarios versiones -->
    <div class="modal fade bs-example-modal-lg" id="modal-edit-plan" name="modal-edit-plan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="tituloModal">Version</h4>
                </div>
                    <div class="modal-body">
                        <div>
                            <div>
                                <input id="idVersion" type="hidden">
                                <input id="ano" type="hidden">
                                <input id="modelo" type="hidden">
                                <input id="tipo" type="hidden">
                            </div>
                            <div>
                                <label for="">Enganche</label>
                                <input id="enganche" class="form-control" type="text">
                            </div>
                            <div>
                                <label for="">Mensualidad</label>
                                <input id="mensualidad" class="form-control" type="text">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="guardarPlan()">Guardar cambios</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">

       function modalEditar(version, enganche, mensualidad, tipo, modelo, ano) {

            console.log(version,enganche,mensualidad,modelo,ano);
            $("#modal-edit-plan").modal('show');
            $("#idVersion").val(version);
            $("#enganche").val(enganche);
            $("#mensualidad").val(mensualidad);
            $("#tipo").val(tipo);
            $("#modelo").val(modelo);
            $("#ano").val(ano);
        }

        function guardarPlan() {
            let version = $("#idVersion").val();
            let enganche = $("#enganche").val();
            let mensualidad = $("#mensualidad").val();
            let tipo = $("#tipo").val();
            let modelo = $("#modelo").val();
            let ano = $("#ano").val();

            let params = {
                version: version,
                enganche: enganche,
                tipo: tipo,
                mensualidad: mensualidad,
                modelo:modelo,
                ano: ano,
            }

            $.ajax({
                data: params,
                type: 'POST',
                dataType: 'json',
                url: 'update_plan.php',
                success: function(res) {
                    console.log(res);
                    //location.reload(true);
                }

            });

        }
    </script>

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