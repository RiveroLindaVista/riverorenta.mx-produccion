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
            <center><h3>Versiones Incompletos </h3></center>
        </div>
        
        <div class="card bg-light mb-3" style="min-height: 200px;">
            <div class="card-header">Versiones Incompletos</div>
            <div class="card-body">
                <h5 class="card-title"></h5>

                <table class="table table-striped" id="tabla_versiones_incompletos">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Slug</th>
                            <th>Con versiones</th>
                            <th>Con inventario versiones</th>
                            <th>Inventario versiones</th>
                            <th>Con Colores</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?= $tr_versiones ?> -->
                    </tbody>
                </table>

            </div>
        </div>


    </section>
    <hr>
    <section class="content">
        <div style="display: flex; align-items:center; justify-content: center">
            <center><h3>PROMOCIONES</h3></center>
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


<style>
    .tr_body_versions:hover{
        cursor: pointer;
        background-color: rgb(41, 129, 196) !important;
    }
</style>
<script>
    function go_to_unidades_nuevos(id){
        let host = '/produccion/panel-administrativo/pages/detalles-nuevos/index.php?id=' + id;
        // console.log(host);
        // location.replace(host);
        location.href = host;
        // window.location = host + '/produccion/panel-administrativo/pages/detalles-nuevos/index.php?id=' + id;
        return false;
    }

    function call_api() {
        console.log('CALL API');
        $.ajax({
            type: "POST",
            url: "versiones_incompletos.php",
            data: [],
            dataType: "json",           
            success: function (response) {
                console.log(response);
                $('#tabla_versiones_incompletos tbody').html(response);
            }
        });
    }


    call_api();


</script>



    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>




</body>

</html>
</body>
</html>