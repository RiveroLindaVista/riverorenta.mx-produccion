<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title></title>
    <?php include('../../_inc/_header.php'); ?>
    <link rel='icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />


    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">


    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">
    
    <!-- CSS Local-->
    <link rel="stylesheet" href="style.css">



   <!-- DataTables CSS -->
   <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">



    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <!-- <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


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
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            LISTA DE EMPLEADOS
                        </div>
                        <div class="body">
                            <div class="card-title">
                                <p class="card-text">Lista de empleados que aceptaron politicas</p>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group" id="ul-modal-status">
                                        <!-- <li style="border: transparent;" class="list-group-item list-group-item-warning">This is a warning list group item</li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="overflow-x: auto;">

                                    <table id="table-politicas" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NOMINA</th>
                                                <th>EMPLEADO</th>
                                                <th>NOMBRE DE POLITICA</th>
                                                <th>STATUS</th>
                                                <th>FECHA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>





    <script src="script.js"></script>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.all.min.js"></script>

    
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

</body>

</html>