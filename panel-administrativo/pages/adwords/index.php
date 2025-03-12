<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$get_publicidad = $conne->get_table_adwords();


$this_page = "adwords";
if ($this_page == "adwords") {
    $adwords = "active";
} else {
    $adwords = "active";
}
?>
<!DOCTYPE html>
<html>

<head>
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

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

    <link rel="stylesheet" href="stylemodule.css">
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
            <div class="block-header">
                <h2></h2>
            </div>
            <!-- Color Pickers -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADWORDS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <b>TÍTULO DE LA PÁGINA</b>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pagina_titulo" class="form-control" name="name" required="" aria-required="true" placeholder="Escribe aquí...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>NOMBRE DE LA IMAGEN</b>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="imagen_titulo" class="form-control" name="name" required="" aria-required="true" placeholder="Escribe aquí...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <b>SELECT DE AUTOS</b>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" id="ctrl_input_sel_autos" type="text" onkeydown="if(event.keyCode == 13) add_sel_autos()">
                                    <p class="fs-6 text-secondary">Presiona Enter para Agregar</p>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success" onclick="add_sel_autos()">Agregar</button>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <!-- <textarea class="form-control" name="" id="text-area-select-autos" placeholder="ejemplo: Cavalier 2024; Aveo 2024"></textarea> -->
                                    <div style="border: gray solid 2px; display: block; padding: 5px;" class="div-group-chips">


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Color Pickers -->
            <!-- File Upload | Drag & Drop OR With Click & Choose -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" style="text-align: center;">
                        <div class="header">
                            <h2>
                                IMAGEN PUBLICITARIA
                            </h2>
                        </div>
                        <div class="body" onclick="clickImg('_file')">
                            <form action="/" class="dropzone" method="post" enctype="multipart/form-data">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Selecciona una imagen.</h3>
                                </div>
                                <div class="fallback">
                                    <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg('_file')" />
                                </div>
                            </form>
                            <!-- <input id="imagen" type="text" multiple /> -->
                        </div>
                        <div class="body" id="contresp">
                            <!-- <div class="row clearfix">
                                <div class="col-md-12">
                                    <b>URL DE LA PAGINA</b>
                                    <div class="form-group form-float">
                                        <div class="form-line" id="return_file">
                                            <input type="text" id="copia_" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
                                            <input type="text" id="copia_reporte" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                                <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save();">GUARDAR CAMBIOS</button>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADWORDS

                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Titulo</th>
                                            <th>Publicidad</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $get_publicidad; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function save() {
            let pagina_titulo = document.getElementById('pagina_titulo').value;
            let imagen_titulo = document.getElementById('imagen_titulo').value;
            let imagen = document.getElementById('_file').value;
            // let carros_select = document.getElementById('carros_select').value;
            let carros_select = '';
            arr_list_sel_autos.forEach(element => {
                carros_select += element + ';';
            });
            //this code will move to separate function
            let params = {
                function: 'validate_image_name',
                imagen_titulo: imagen_titulo + '.png'
            };
            $.ajax({
                data: params,
                type: 'POST',
                dataType: 'json',
                url: 'func_for_ajax.php',
                success: function(res) {
                    console.log(res['count']);
                    if (res['count'] > 0) {
                        alert("El nombre de la imagen ya existe");
                        return true;
                    } else {
                        error('#pagina_titulo');
                        // console.log(imagen);
                        // return true;
                        error('#imagen_titulo');

                        if (pagina_titulo != "" && imagen_titulo != "") {
                            if (imagen == "") {
                                alert('Es necesario seleccionar una imagen.');
                                $('.dropzone').css({
                                    'cssText': 'border: 2px solid red !important; '
                                });
                            } else {
                                var param = {
                                    pagina_titulo: pagina_titulo,
                                    imagen_titulo: imagen_titulo,
                                    carros_select: carros_select
                                }
                                $.ajax({
                                    data: param,
                                    type: 'POST',
                                    url: 'save.php',
                                    success: function(res) {
                                        console.log(res);
                                        alert("Guardado");
                                        location.reload();
                                    }

                                })
                            }
                        } else {
                            alert('Campos vacíos!');

                        }
                    }
                }

            });


        }

        function clickImg(obj) {
            error('#imagen_titulo');
            var imagen_titulo = document.getElementById('imagen_titulo').value;
            if (imagen_titulo != "") {
                document.getElementById(obj).click();
            } else {
                alert('Nombre  de imagen requerido.');
            }
        }

        function updateImg(obj) {
            cambiarImagen(obj);
        }

        function cambiarImagen(obj) {
            var imagen_titulo = document.getElementById('imagen_titulo').value;
            // error('#imagen_titulo');
            if (imagen_titulo != "") {
                var files = $('#' + obj)[0].files[0];

                var fd = new FormData();
                fd.append('file', files);
                fd.append('nombre', imagen_titulo);

                $.ajax({
                    url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/upload_img_adwords.php',
                    type: 'post',
                    data: fd,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == 'ok') {
                            // document.getElementById('return_file').innerHTML = response;
                            $('.dropzone').css({
                                'cssText': 'border: none !important;'
                            });
                            $('#contresp').css({
                                'cssText': 'display: block !important;'
                            });
                        } else {
                            alert('Error,intenta de nuevo.');
                            // document.getElementById('return_file').innerHTML = '<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('Error, verifique la imagen.');
                        // document.getElementById('return_file').innerHTML = '<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
                    }
                });
            } else {
                alert('Nombre  de imagen requerido.');
            }
        }

        var arr_list_sel_autos = new Set();

        function add_sel_autos() {
            let ctrl_input_sel_autos = $('#ctrl_input_sel_autos').val();
            // let arr_list_sel_autos = {};
            if (ctrl_input_sel_autos !== '') {
                arr_list_sel_autos.add(ctrl_input_sel_autos);
            }
            $('#ctrl_input_sel_autos').val('');

            // console.log(arr_list_sel_autos);
            // return true;

            let var_divs_group_chips = '';

            arr_list_sel_autos.forEach(element => {
                var_divs_group_chips += '' +
                    '<div class="chip">' +
                    element +
                    // '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>'+
                    '<span class="closebtn" onclick="delete_sel_autos(\'' + element + '\')">&times;</span>' +
                    '</div>';
            });
            // for (let i = 0; i < arr_list_sel_autos.length; i++) {
            //     const element = array[i];                        
            // }
            // console.log(var_divs_group_chips);
            // return true;
            $('.div-group-chips').html(var_divs_group_chips);
        }

        function delete_sel_autos(item) {
            console.log(item);
            arr_list_sel_autos.delete(item);
            add_sel_autos();
        }



        function error(obj) {
            if ($(obj).val() == "") {
                $(obj).css({
                    'cssText': 'border-bottom: 1px solid red !important; '
                });
            }
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