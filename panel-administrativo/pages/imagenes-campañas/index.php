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

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4>Imagenes de campañas</h4>

                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label for="">Publicidad</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Seleccione...</option>
                                            <option value="">Facebook</option>
                                            <option value="">Google</option>
                                            <option value="">Tiktok</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Tipo</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Seleccione...</option>
                                            <option value="">Nuevo</option>
                                            <option value="">Seminuevo</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        
    </section>



    <style>

    </style>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>





</body>

</html>