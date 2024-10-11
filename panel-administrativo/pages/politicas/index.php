<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

echo json_encode('politicas module')

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
                            POLITICAS
                        </div>
                        <div class="body">
                            <div class="card-title">
                                <p class="card-text">Politicas rivero</p>
                            </div>
                            <div class="row row-form-politica" style="display: flex;">
                                <div class="col-md-4 col-12" style="width:100%;">
                                    <label for="">Nombre de la politica</label>
                                    <input id="nombre_politica" type="text" class="form-control">
                                </div>
                                <div class="col-md-4 col-12" style="width:100%;">
                                    <label for="">Archivo PDF</label>
                                    <input id="input-file-id" type="file" accept="application/pdf" class="form-control">
                                </div>
                                <div class="col-md-4 col-12" style="width:100%; display: flex; flex-direction: column; justify-content: end; align-items: center;">
                                    <!-- <label for="">Archivo PDF</label> -->
                                    <button onclick="guardar_politica()" class="form-control btn btn-success" style="width: 70%;">GUARDAR</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group" id="ul-modal-status">
                                        <!-- <li style="border: transparent;" class="list-group-item list-group-item-warning">This is a warning list group item</li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">

                                    <table id="table-politicas" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NOMBRE DE POLITICA</th>
                                                <th>FECHA</th>
                                                <th style="text-align: center">OPCIONES</th>
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

    <!-- MODALS  -->
    <div class="modal fade" id="EditNameModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Nombre de Politica</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- <form> -->
                <!-- <div class="form-group"> -->
                  <label for="nombre_politica_modal_hide" class="col-form-label">Nombre actual</label>
                  <input type="text" class="form-control" id="nombre_politica_modal_hide" disabled>
                  <label for="nombre_politica_modal" class="col-form-label">Nuevo nombre de la politica</label>
                  <input type="text" class="form-control" id="nombre_politica_modal">
                <!-- </div> -->
              <!-- </form> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="update_name_politica()">Actualizar</button>
            </div>
          </div>
        </div>
      </div>

      <!--Modal actualizar politica-->

    <div class="modal fade" id="EditPolitica" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Politica</h5>
              <h6 style="color: rgb(209, 96, 20);">(Al actualizar es necesario que los empleados vuelvan a aceptar las politicas)</h6>
              </button>
            </div>
            <div class="modal-body">
              <!-- <form> -->
                <!-- <div class="form-group"> -->
                  <label for="nombre_politica_modal_hide_pol" class="col-form-label">Nombre actual</label>
                  <input type="text" class="form-control" id="nombre_politica_modal_hide_pol" disabled>

                  <label for="nombre_politica_modal_pol" class="col-form-label">Nuevo nombre de la politica</label>
                  <input type="text" class="form-control" id="nombre_politica_modal_pol">
                  <label for="input-file-id-pol" class="col-form-label">Archivo pdf</label>
                  <input id="input-file-id-pol" type="file" accept="application/pdf" class="form-control">

                <!-- </div> -->
              <!-- </form> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="update_politica()">Actualizar</button>
            </div>
          </div>
        </div>
      </div>




    <script src="script.js"></script>



    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.all.min.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>





</body>

</html>