<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");

$this_page = "versiones";
if ($this_page=="versiones") { $versiones="active"; } else{ $versiones="active"; }

$conne = new Construir();
$tipos = $conne->get_tipos_autos();

$tabla_autos = $conne->getCarsWithoutVersion();

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('../../_inc/_header.php');?>
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

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"> 
</head>
<body class="theme-blue">
  <!-- #Top Bar -->
   <?php include('../../_inc/_search-bar.php');?>
<!-- #Menu -->
    <section>
    <?php include('../../_inc/_menu.php');?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
    <?//include('../../_inc/_gadgets.php');?>
        <!-- #END# Right Sidebar -->
    </section>

    <!-- Tabs With Icon Title -->
    <section class="content">
        <div class="container-fluid">

        <div class="row clearfix">
                <div id="table-autosnuevos" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Lista de autos sin versiones
                            </h2>
                        </div>
                        <div class="body">
                           
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Año</th>
                                            <th>Tipo</th>
                                            <th>Version</th>
                                            <th>Model code</th>
                                            <th>Boa key</th>
                                            <th>Fecha</th>
                                            <th>opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $tabla_autos;?>
                                    </tbody>
                                </table>
                                                     
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->
            

<!-- Large modal -->


<div class="modal fade bs-example-modal-lg" id="modal-edit" name="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Versiones</h4>
      </div>
      <div class="modal-body">
        <div>
        <div>
            <input id="ctrl-id" type="hidden">
        </div>
        <div>
            <label for="">Marca</label>
            <input id="ctrl-marca" class="form-control" type="text" disabled>
        </div>
        <div>
            <label for="">Modelo</label>
            <input id="ctrl-modelo" class="form-control" type="text" disabled>
        </div>
        <div>
            <label for="">Tipo</label>
            <input id="ctrl-tipo" class="form-control" type="text" disabled>
        </div>
        <div>
            <label for="">Version</label>
            <input id="ctrl-version" class="form-control" type="text">
        </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="update()">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>


        </div>
    </section>
    
    <style>
        .table th {
            text-align: center;
        }
    </style>
    <script>
        function fun_open_edit_modal(params) {
            let param1 = JSON.parse(window.atob(params));
            $("#ctrl-id").val(param1['id']);
            $("#ctrl-marca").val(param1['marca']);
            $("#ctrl-modelo").val(param1['modelo']);
            $("#ctrl-tipo").val(param1['tipo']);
            $("#ctrl-version").val(param1['version']);
            $("#modal-edit").modal('show');
        }

        
        function update(){
            let version = $("#ctrl-version").val();
            let id = $("#ctrl-id").val();
            console.log(id);
            // call function ajax for save changes
            
            var param = {
                version: version,
                id: id
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: 'update.php',
                success: function(response) {
                    console.log(response);
                    location.reload();
                }
            });
        }
        
    </script>


    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>



    <!-- Jquery DataTable Plugin Js -->
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>


    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>


    <!-- Ckeditor -->
    <script src="../../plugins/ckeditor/ckeditor.js"></script>

    <!-- TinyMCE -->
    <script src="../../plugins/tinymce/tinymce.js"></script>
    <script src="../../js/pages/forms/editors.js"></script>
</body>
</html>