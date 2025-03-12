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
    <?php include('../../_inc/_header.php'); ?>

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
        <div>

        </div>
        <div class="card bg-light" style="display: flex; align-items:center; justify-content:center; margin-bottom: 0px;">
            <div class="card-header">
                <h4 id="title_versiones_incompletas">VERSIONES INCOMPLETAS ()</h4>
            </div>
        </div>


        <div class="card bg-light mb-2" style="min-height: 200px;">
            <div class="card-header"></div>
            <div class="card-body" style="overflow-x: scroll;">
                <h5 class="card-title"></h5>
                <div class="row">
                    <div class="col-md-6" style="display: flex; justify-content:space-around;">
                        <div style="display: flex; align-items: center;">
                            <button class="flag-green"></button>
                            <label for="" style="margin-left: 10px; margin-top: 10px;">Completo</label>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <button class="flag-red"></button>
                            <label for="" style="margin-left: 10px; margin-top: 10px;">Faltante</label>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <button class="flag-gray"></button>
                            <label for="" style="margin-left: 10px; margin-top: 10px;">No Aplica</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <input onkeypress="if(event.keyCode == 13){func_search()}" id="input-search" class="form-control" type="text" placeholder="Escribir...">
                    </div>
                    <div class="col-md-1">
                        <button onclick="func_search()" type="button" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
                <hr>
                <table class="table table-striped" id="tabla_versiones_incompletos" style="text-align: center; margin-top:10px;">
                    <thead>
                        <tr>
                            <th class="th_dflex">MARCA</th>
                            <th class="th_dflex">MODELO</th>
                            <th class="th_dflex">SLUG</th>
                            <th class="th_dflex">VERSIONES</th>
                            <th class="th_dflex">VERSIONES SIN DESCRIPCION</th>
                            <th class="th_dflex">COLORES</th>
                            <th class="th_dflex">GALERIA</th>
                            <th class="th_dflex">VIDEO</th>
                            <th class="th_dflex">FICHA</th>
                            <th class="th_dflex">CATALOGO</th>
                            <th class="th_dflex">MANUAL</th>

                            <th class="th_dflex"> OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?= $tr_versiones ?> -->
                    </tbody>
                </table>
                <div class="row" id="row-spinner">
                    <div class="col-md-12" style="display:flex; justify-content: center; align-items: center;">
                        <div style="display: grid;">
                            <center>
                                <p id="time_waiting" style="font-weight: bold; font-size: x-large;">Tiempo de espera maximo 1 min</p>
                            </center>
                            <br>
                            <center><img src="loader.gif" style="height: 70px; width: 70px;"></center>
                            <br>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>
    <hr>
    <section class="content">
        <div class="card bg-light" style="display: flex; align-items:center; justify-content:center; margin-bottom: 0px;">
            <div class="card-header">
                <h4>PROMOCIONES</h4>
            </div>
        </div>

        <!-- <div style="display: flex; align-items:center; justify-content: center">
            <center><h3>PROMOCIONES</h3></center>
        </div> -->
        <div class="container-fluid card bg-light" style="display: flex; justify-content: center; align-items: center; margin-top: 10px; padding: 20px;">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="card" style="padding:0!important">
                    <div class="body" style="padding:0!important">
                        <div class="header">
                            <h2 style="text-align:center">Promociones Autos Activas</h2>
                        </div>
                        <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel" style="background: black;">
                            <!-- Indicators -->
                            <?= $promoAutos ?>

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
                            <?= $promoAccesorios ?>

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
                            <?= $promoTaller ?>

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
        .tr_body_versions:hover {
            cursor: pointer;
            background-color: rgb(41, 129, 196) !important;
        }

        .th_dflex {
            text-align: center;
        }

        .flag-red {
            background: red;
            border-radius: 100%;
            height: 25px;
            width: 25px;
            border: transparent;
        }

        .flag-green {
            background: rgb(21, 156, 120);
            border-radius: 100%;
            height: 25px;
            width: 25px;
            border: transparent;
        }

        .flag-gray {
            background: white;
            border-radius: 100%;
            height: 25px;
            width: 25px;
            border: black solid 1px;
        }
    </style>
    <script>
        let catalogo_autos_incompletos = [];
        $(document).ready(async function() {
            $('#row-spinner').show();

            let remainingTime = 60;
            let countdown = setInterval(() => {
                let minutes = Math.floor(remainingTime / 60);
                let seconds = remainingTime % 60;
                $('#time_waiting').html(`${minutes}:${seconds < 10 ? '0' + seconds : seconds}`);
                remainingTime--;
                if (remainingTime < 0) {
                    clearInterval(countdown);
                    $('#time_waiting').html('Tiempo agotado');
                }
            }, 1000);

            catalogo_autos_incompletos_All = await call_api();
            catalogo_autos_incompletos = catalogo_autos_incompletos_All

            await func_fill_table();
            $('#row-spinner').hide();
        });


        function go_to_unidades_nuevos(id) {
            let host = '/produccion/panel-administrativo/pages/detalles-nuevos/index.php?id=' + id;
            // console.log(host);
            // location.replace(host);
            location.href = host;
            // window.location = host + '/produccion/panel-administrativo/pages/detalles-nuevos/index.php?id=' + id;
            return false;
        }

        function disable_from_catalogo(slug) {
            console.log(slug);
            let data = {
                slug: slug
            }
            $.ajax({
                type: "POST",
                url: "disable_from_catalogo.php",
                data: data,
                dataType: "json",
                success: function(res) {
                    alert(res)
                    call_api();
                }
            });

        }

        async function call_api() {
            console.log('CALL API');
            let response = await $.ajax({
                type: "POST",
                url: "catalogo_list_faltantes.php",
                data: [],
                dataType: "json",
                success: function(res) {}
            });

            return response;
        }

        async function func_fill_table() {
            console.log(catalogo_autos_incompletos);

            $tr_versiones = '';
            $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg>';
            $view_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/></svg>';
            for (let i = 0; i < catalogo_autos_incompletos.length; i++) {
                const value = catalogo_autos_incompletos[i];
                $flag_con_versiones = value['has_versions'] == 0 ? 'flag-red' : 'flag-green';
                $flag_con_colores = value['has_colors'] == 0 ? 'flag-red' : 'flag-green';
                $flag_has_gallery = value['has_gallery'] == 0 ? 'flag-red' : 'flag-green';
                $flag_has_video = value['has_video'] == 0 ? 'flag-red' : 'flag-green';
                $flag_has_ficha_tecnica = value['has_ficha_tecnica'] == 'N/A' ? 'flag-gray' : (value['has_ficha_tecnica'] == 0 ? 'flag-red' : 'flag-green');
                $flag_has_catalogo = value['has_catalogo'] == 0 ? 'flag-red' : 'flag-green';
                $flag_has_manual = value['has_manual'] == 'N/A' ? 'flag-gray' : (value['has_manual'] == 0 ? 'flag-red' : 'flag-green');

                $tr_versiones += '<tr class="tr_body_versions">';
                $tr_versiones += '<td>' + value['marca'] + '</td>';
                $tr_versiones += '<td>' + value['modelo'] + '</td>';
                $tr_versiones += '<td>' + value['slug'] + '</td>';
                $tr_versiones += '<td> <button class="' + $flag_con_versiones + '"></button>' + '' + '</td>';
                $str_versiones_sin_caracteristicas = '';
                if (value['has_versions_without_characteristics']) {
                    if (value['has_versions_without_characteristics'].length > 0) {
                        let arr_has_versions_without_characteristics = value['has_versions_without_characteristics'].split(',');
                        for (let j = 0; j < arr_has_versions_without_characteristics.length; j++) {
                            const val3 = arr_has_versions_without_characteristics[j];
                            $separa = j == 0 ? '' : ', ';
                            $str_versiones_sin_caracteristicas += $separa + val3;
                        }
                    } else {
                        $str_versiones_sin_caracteristicas = '- - -';
                    }
                } else {
                    $str_versiones_sin_caracteristicas = '- - -';
                }
                $btn_disabled = '';
                <?php if ($_SESSION['usuario'] == 'DESARROLLO') { ?>
                    $btn_disabled = '<button  class="btn btn-danger" onclick=disable_from_catalogo(\'' + value["slug"] + '\')>' + $delete_icon + '</button>';
                <?php } ?>
                $tr_versiones += '<td>' + $str_versiones_sin_caracteristicas + '</td>';
                $tr_versiones += '<td> <button class="' + $flag_con_colores + '"></button></td>';
                $tr_versiones += '<td> <button class="' + $flag_has_gallery + '"></button></td>';
                $tr_versiones += '<td> <button class="' + $flag_has_video + '"></button></td>';
                $tr_versiones += '<td> <button class="' + $flag_has_ficha_tecnica + '"></button></td>';
                $tr_versiones += '<td> <button class="' + $flag_has_catalogo + '"></button></td>';
                $tr_versiones += '<td> <button class="' + $flag_has_manual + '"></button></td>';
                $tr_versiones += '<td> <div><button class="btn btn-success" onclick=go_to_unidades_nuevos(' + value['id'] + ')>' + $view_icon + '</button>  ' + $btn_disabled + '</div></td>';
                $tr_versiones += '</tr>';
            }
            $('#tabla_versiones_incompletos tbody').html($tr_versiones);
            $('#title_versiones_incompletas').text(`VERSIONES INCOMPLETAS (${catalogo_autos_incompletos.length})`);

        }


        async function func_search() {
            let input_search = $('#input-search').val();
            let regExp = new RegExp(input_search, 'gi');
            catalogo_autos_incompletos = catalogo_autos_incompletos_All.filter((inf) => {
                if (inf.marca.match(regExp) || inf.modelo.match(regExp) || inf.slug.match(regExp)) {
                    return true;
                }
            })
            await func_fill_table();

        }
    </script>



    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>




</body>

</html>
</body>

</html>