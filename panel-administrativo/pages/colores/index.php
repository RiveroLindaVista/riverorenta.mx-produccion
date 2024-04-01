<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");

$this_page = "colores";
if ($this_page=="colores") { $colores_page="active"; } else{ $colores_page="active"; }

$conne = new Construir();

$tabla = $conne->getAllColors();

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
                                Colores
                            </h2>
                        </div>
                        <div class="body">

                        <!-- <div class="card-inside-title"> -->
                                        <!-- <div class="row clearfix"> -->
                                        <b> Nombre del color </b>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" style="text-transform:uppercase;" id="color_name" class="form-control" name="name" aria-required="true" placeholder="Escriba el nombre del color a crear.">
                                                    </div>
                                                </div>

                                                <div id="div-colorpicker">
                                                    <label for="favcolor">Selecciona el color adecuado:</label>
                                                    <input type="color" id="color_hex" name="favcolor" value="#ff0000"><br>
                                                </div>
                                        <!-- </div> -->
                                    <!-- </div> -->

                                    <div id="return_id" hidden=""></div>
                                     <!-- <div class="row clearfix"> -->
                                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;"> -->
                                            <button type="button" class="btn btn-primary" onclick="save_color();">Guardar</button>
                                        <!-- </div> -->
                                    <!-- </div> -->
                                    
                           <hr>
                           <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th hidden>Id</th>
                                            <th>Nombre</th>
                                            <th>Color</th>
                                            <th>opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $tabla;?>
                                    </tbody>
                                </table>
                           </div>          
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
            <label for="">Nombre</label>
            <input id="ctrl-nombre" class="form-control" type="text">
        </div>
        <div>
            <label for="">Color</label>
            <input id="ctrl-color" class="form-control" type="text">
        </div>
        <div>
            <br>
            <input id="ctrl-controlcambiacolor"  type="color" value="#ff0000" >
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

/**modal para lista de carros */
<div class="modal fade bs-example-modal-lg" id="modal-cars" name="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="tittle-list-cars" class="modal-title" id="myModalLabel">Autos</h4>
      </div>
      <div class="modal-body">
        <div>

        <table id= "tbl-cars" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Modelo</th>
                            <th>Año</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

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

        $("#ctrl-controlcambiacolor").change(function (e) { 
            e.preventDefault();
            $("#ctrl-color").val( $(this).val() );
        });
        $("#ctrl-color").change(function (e) { 
            e.preventDefault();
            $("#ctrl-controlcambiacolor").val( $(this).val() );
        });
        

        function fun_open_edit_modal(params) {
            let param1 = JSON.parse(window.atob(params));
            $("#ctrl-id").val(param1['id']);
            $("#ctrl-nombre").val(param1['nombre']);
            $("#ctrl-color").val(param1['color']);
            $("#ctrl-controlcambiacolor").val(param1['color']);

            $("#modal-edit").modal('show');
        }

        
        function update(){
            let id = $("#ctrl-id").val();
            let nombre = $("#ctrl-nombre").val();
            let color = $("#ctrl-color").val();

            // call function ajax for save changes            
            var param = {
                id: id,
                nombre: nombre,
                color: color
            }

            console.log(param);
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

        function fn_mdl_autos(color){
            $("#tbl-cars tbody").empty();
            $("#tittle-list-cars").text('Autos');

            var param = {
                color: color
            }
            let tbl_cars = null;
            $.ajax({
                 data: param,
                type: 'POST',
                url: 'get_cars.php',
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.length > 0) {
                        $("#tittle-list-cars").text(res[0]['color']);
                    }
                    res.forEach(car => {
                        let car_slug = car['slug'].split('-');
                        let car_splited = car_slug[0];

                        let car_concat = car_splited[0].toUpperCase() + car_splited.slice(1);

                        tbl_cars += '<tr><td>'+car_concat+'</td><td>'+car['modelo']+'</td><td>'+car['ano']+'</td></tr>';
                        $("#tbl-cars tbody").html(tbl_cars) ;
                    });


                }
            });
            $("#modal-cars").modal('show');
        }

                // SAVE COLOR HTML //
        function save_color() {
            var color_name = document.getElementById('color_name').value;
            var color_hex = document.getElementById('color_hex').value;
            error('#color_name');
            error('#color_hex');

            if (color_name != "") {

                var param = {
                    color_name: color_name,
                    color_hex: color_hex
                }
                $.ajax({
                    url: 'crear_color.php',
                    type: 'POST',
                    data: param,
                    success: function(resp) {
                        alert(resp);
                        $("#color_name").val("");
                        location.reload();
                    }
                })
            } else {
                alert('Campos vacíos!');
            }
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