<?php
if ($this_page=="estadisticas") { $estadisticas="active"; } else{ $estadisticas="active"; }
$this_page = "estadisticas";
require_once("../../_inc/_config.php");  
include("../../_inc/constructor.php");
$conne = new Construir();
$get_ipes = $conne->get_ipes(); 
$get_paginas_vistas= $conne->get_paginas_vistas();
$get_acciones_click=$conne->get_acciones_click();
$get_formularios=$conne->get_formularios();
$get_conteo_forms=$conne->get_conteo_forms();
?>
<!DOCTYPE html>
<html>
<head>
   <?php include('../../_inc/_header.php');?>
    <link rel='icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />

        <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

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
    <section class="content"> 

        <!-- File Upload | Drag & Drop OR With Click & Choose -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- open -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                         IP MAS ACCESO
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>CANTIDAD</th>
                                                    <th>IP</th>
                                                     
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $get_ipes;?>
                                            </tbody>
                                        </table>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- close -->
                    <!-- open -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        PAGINAS VISTAS
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>PAGINA</th>
                                                     
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $get_paginas_vistas;?>
                                            </tbody>
                                        </table>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- close -->
                    <!-- open -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        ACCIONES MAS USADAS
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Elemento</th>
                                                     
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $get_acciones_click;?>
                                            </tbody>
                                        </table>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- close -->
                    <!-- open -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        FORMULARIOS
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>cantidad</th>
                                                    <th>url</th> 
                                                    <th>nombre_completo</th>
                                                    <th>correo</th>
                                                    <th>telefono</th>
                                                     <th>formulario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $get_formularios;?>
                                            </tbody>
                                        </table>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- close -->
                    <!-- open -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        CONTEO FORMULARIOS
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>formulario</th>
                                                     
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $get_conteo_forms;?>
                                            </tbody>
                                        </table>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- close -->

                </div>
            </div>
    </section>
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
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js 
    <script src="../../js/demo.js"></script>-->

</body>

</html>
