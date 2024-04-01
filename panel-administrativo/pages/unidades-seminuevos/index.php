<?php 
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$conne = new Construir();
$get_seminuevos = $conne->get_all_catalogo_seminuevos_dev();

$this_page = "unidades";
    $this_subpage = "seminuevos";
    if ($this_page=="unidades") { $unidades="active"; } else{ $unidades="active"; }
    if ($this_subpage=="seminuevos") { $seminuevos="active"; } else{ $seminuevos="active"; }
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

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">
    <!-- Light Gallery Plugin Css -->
    <link href="../../plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

</head>
<body class="theme-blue">
	<!-- #Top Bar -->
   <?php include('../../_inc/_search-bar.php');?>
	<!-- #Menu -->
    <section>
    <?php include('../../_inc/_menu.php');?>
 
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Image Gallery -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SEMINUEVOS
                            </h2>
                        </div>
                        <div class="body">
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                <?=$get_seminuevos?>
                            </div>
                        </div>
                    </div>
                </div>
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

   <script src="../../plugins/light-gallery/js/lightgallery-all.js"></script>

    <!-- Custom Js -->
    <script src="../../js/pages/medias/image-gallery.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>

</body>
</html>