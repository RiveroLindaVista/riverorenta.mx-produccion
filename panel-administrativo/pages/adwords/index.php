<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$get_publicidad = $conne->get_table_adwords();


$this_page = "adwords";
if ($this_page=="adwords") { $adwords="active"; } else{ $adwords="active"; }
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
                        <div class="body" >
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
                                        <input type="text"  id="imagen_titulo"class="form-control" name="name" required="" aria-required="true" placeholder="Escribe aquí...">
                                    </div>
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
                            <form action="/"  class="dropzone" method="post" enctype="multipart/form-data">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Selecciona una imagen.</h3>
                                </div>
                                <div class="fallback">
                                   <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg('_file')"/>
                                </div>
                            </form>hidden=""
                            <input id="imagen" type="text" multiple  />
                        </div>
                        <div class="body" id="contresp" >
                        <div class="row clearfix">
                                <div class="col-md-12">
                                    <b>URL DE LA PAGINA</b>
                                    <div class="form-group form-float">
                                    <div class="form-line" id="return_file">
                                        <input type="text" id="copia_" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
                                        <input type="text" id="copia_reporte" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
                                    </div>
                                </div>
                                </div>
                            </div>
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
                                        <?= $get_publicidad;?>
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
    function save(){
    var pagina_titulo=document.getElementById('pagina_titulo').value;
    var imagen_titulo=document.getElementById('imagen_titulo').value;
    var imagen=document.getElementById('copia_reporte').value;
    error('#pagina_titulo');
    error('#imagen_titulo');

    if (pagina_titulo!="" && imagen_titulo!="") {
        if (imagen=="") {
            alert('Es necesario seleccionar una imagen.');
            $('.dropzone').css({'cssText': 'border: 2px solid red !important; '});
        } else {
           var param={
                pagina_titulo:pagina_titulo,
                imagen_titulo:imagen_titulo,
                imagen:imagen
            }
            $.ajax({
                data:param,
                type:'POST',
                url:'save.php',
                success:function(){
                    alert("Hecho.");
                    location.reload();
                }

            })
        }
    } else {
        alert('Campos vacíos!');
       
    }
}
  function clickImg(obj){
    error('#imagen_titulo');
    var imagen_titulo=document.getElementById('imagen_titulo').value;
    if(imagen_titulo!=""){
    document.getElementById(obj).click();
}else{
    alert('Nombre  de imagen requerido.');
}
  }

  function updateImg(obj){
    cambiarImagen(obj);
  }

  function cambiarImagen(obj){
    var imagen_titulo=document.getElementById('imagen_titulo').value;
    error('#imagen_titulo');
    if(imagen_titulo!=""){
    var fd = new FormData();
    var imagen_titulo=document.getElementById('imagen_titulo').value;
    var files = $('#'+obj)[0].files[0];
    fd.append('file',files);
    fd.append('name',imagen_titulo);
      
    $.ajax({
      url: 'upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
       document.getElementById('return_file').innerHTML=response;
       $('.dropzone').css({'cssText': 'border: none !important;'});
       $('#contresp').css({'cssText': 'display: block !important;'});
        }else{
          alert('Error,intenta de nuevo.');
         document.getElementById('return_file').innerHTML='<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
        }
      }
    });
    }else{
        alert('Nombre  de imagen requerido.');
    }
  }
  function error(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border-bottom: 1px solid red !important; '});
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
