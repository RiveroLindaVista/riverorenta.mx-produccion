<?php  
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$promoAutos = $conne->get_all_promos_autos();
$promoTaller = $conne->get_all_promos_taller();
$promoAccesorios = $conne->get_all_promos_accesorios();

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
    <section class="content">
        <div>
            <h1>PANEL ADMINISTRATIVO</h1><hr/>
        </div>
        <div class="container-fluid" style="display: flex; justify-content: center; align-items: center;">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="card" style="padding:0!important">
                    <div class="body" style="padding:0!important">
                        <div class="header">
                            <h2 style="text-align:center">Promociones Autos Activas</h2>
                        </div>
                        <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel" style="background: black;">
                            <!-- Indicators -->
                                <?= $promoAutos?>
                                                            
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                                                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="card" style="padding:0!important">
                    <div class="body" style="padding:0!important">
                        <div class="header">
                            <h2 style="text-align:center">Promociones Accesorios Activas</h2>
                        </div>
                        <div id="carousel-example-generic_1" class="carousel slide" data-ride="carousel" style="background: white;">
                            <!-- Indicators -->
                                <?= $promoAccesorios?>
                                                            
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic_1" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic_1" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                                                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="card" style="padding:0!important">
                    <div class="body" style="padding:0!important">
                        <div class="header">
                            <h2 style="text-align:center">Promociones Taller Activas</h2>
                        </div>
                        <div id="carousel-example-generic_3" class="carousel slide" data-ride="carousel" style="background: white;">
                            <!-- Indicators -->
                                <?= $promoTaller?>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic_3" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic_3" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                   
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

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
</body>
</html>