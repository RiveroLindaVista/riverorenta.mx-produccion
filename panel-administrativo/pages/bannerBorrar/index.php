<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$this_page = "banner";
if ($this_page=="banner") { $banner="active"; } else{ $banner="active"; }

$conne = new Construir();
$get_banners = $conne->get_table_banners();
$autos_banner= $conne->get_autos_banner();
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
                <h2>ADVANCED FORM ELEMENTS</h2>
            </div>
            <!-- Color Pickers -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BANNERS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <b>AUTO ASIGNADO</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <select id="asignado"  class="form-control" name="name" required="" aria-required="true" >
                                            <option value="" selected  disabled></option>
                                            <?php echo $autos_banner;?>
                                        </select>
                                        <input type="text"  id="imagen_titulo"class="form-control" name="name" required="" aria-required="true" placeholder="Esquibe aquí..." style="display: none;">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <b>ELIGE UN MES </b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <select id="mes_banner" class="form-control" name="name" required="" aria-required="true">
                                            <option value="" selected  disabled></option>
                                            <option value="ene">Enero</option>
                                            <option value="feb">Febrero</option>
                                            <option value="mar">Marzo</option>
                                            <option value="abr">Abril</option>
                                            <option value="may">Mayo</option>
                                            <option value="jun">Junio</option>
                                            <option value="jul">Julio</option>
                                            <option value="agos">Agosto</option>
                                            <option value="sept">Septiembre</option>
                                            <option value="oct">Octubre</option>
                                            <option value="nov">Noviembre</option>
                                            <option value="dic">Diciembre</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <b>DESTINO DEL BANNER </b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <select id="tipo" class="form-control" name="name" required="" aria-required="true">
                                            <option value="" selected  disabled></option>
                                            <option value="banner-mobile">Página Móvil</option>
                                            <option value="banner">Página Web</option>                                            
                                        </select>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
        </div>


        <!-- File Upload | Drag & Drop OR With Click & Choose -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" style="text-align: center;">
                        <div class="header">
                            <h2>
                                BANNER
                            </h2>
                        </div>
                        <div class="body" onclick="clickImg('_file')">
                            <form action="/"  class="dropzone" method="post" enctype="multipart/form-data">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Selecciona una imagen o arrastra y suelta.</h3>
                                    <em>(Recuerda utilizar el formato  <strong>WEB</strong> para crear el banner.)</em>
                                </div>
                                <div class="fallback">
                                   <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg('_file')"/>
                                </div>
                            </form>
                            <input id="imagen" type="text" multiple hidden="" />
                        </div>
                        <div class="body" id="contresp" style="display:none;">
                        <div class="row clearfix">
                                <div class="col-md-12">
                                    <b>URL DEL BANNER</b>
                                    <div class="form-group form-float">
                                    <div class="form-line" id="return_file">
                                        <input type="text" id="copia_" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
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

                    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                REPORTE
                                
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>meta_key</th>
                                            <th>Banner</th>
                                            <th>Status</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $get_banners;?>
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


<script>
    function save(){
        var tituloL=  document.getElementById('titulo').value;
    var titulo =tituloL.toUpperCase();
        var titleL=  document.getElementById('title').value;
    var title =titleL.toUpperCase();
    var metakeys=document.getElementById('metakeys').value;
    var descripcion=document.getElementById('descripcion').value;
    error('#titulo');
    error('#title');
    error('#metakeys');
    error('#descripcion');

    if (titulo!="" && title!="" && metakeys!="" && descripcion!="") {
            var param={
                titulo:titulo,
                title:title,
                metakeys:metakeys,
                descripcion:descripcion,
            }
            $.ajax({
                url:'save.php',
                type:'POST',
                data:param,
                success: function(resp){
                    //alert(resp);
                    document.getElementById('return_id').innerHTML='<input type="text" id="num_id" value="'+resp+'">';
                	alert("Datos guardados correctamente.");
                    $("#titulo").val("");
                    $("#title").val("");
                    $("#metakeys").val("");
                    $("#descripcion").val("");
                    $(".form-line").removeClass("focused");
                	//location.reload();
                 }
            })        
    } else {
        alert('Campos vacíos!');
    }
}
// SAVE EDITOR HTML //
   function save_editor(){
    var contenido = CKEDITOR.instances.ckeditor.getData();
    var num_id = document.getElementById('num_id').value;
    //errorTextArea('#form-ckeditor');

    if (contenido!="") {
            
            var param={
               contenido:contenido,     
               num_id:num_id
            }
            $.ajax({
                url:'editor_data.php',
                type:'POST',
                data:param,
                success: function(resp){
                    alert(resp);
                    alert("Datos guardados correctamente.");
                    document.getElementById('form-ckeditor').innerHTML='<textarea rows="15" style="width:100%;">'+resp+'</textarea>';                    
                 }
            })    
    } else {
        alert('Campos vacíos, necesitas agregar descripcion al contenido!');
    }
}

// SAVE IMG //
  function clickImg(obj){
    document.getElementById(obj).click();
  }
  function updateImg(obj){
    cambiarImagen(obj);
  }
  function cambiarImagen(obj){
    var carpeta = document.getElementById('num_id').value;
    var fd = new FormData();
    var files = $('#'+obj)[0].files[0];
    fd.append('file',files);
    fd.append('carpeta',carpeta);         
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
        $('.dropzone').hide();
        alert("Imagen de portada agregada.")
        location.reload();
        }else{
          alert('Error,intenta de nuevo.');
         document.getElementById('return_file').innerHTML='<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
        }
      }
    });
  }
  function error(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border-bottom: 1px solid red !important; '});
    }
  }
   function errorImg(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border: 1px solid red !important; '});
         location.href = obj;

    }
  }
   function errorTextArea(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border: 1px solid red !important; '});
          location.href = obj;
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

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html>
