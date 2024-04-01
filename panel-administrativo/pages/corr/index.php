<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");


$this_page = "firmas";
$this_subpage = "firmas";
if ($this_page=="firmas") { $firmas="active"; } else{ $firmas="active"; }

$conne = new Construir();
//$blogs = $conne->get_table_blogs();
$mail = $conne->get_mail();
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
                <h2>ADVANCED FORM ELEMENTS</h2>
            </div>
                        <!-- Tabs With Icon Title -->
            <div class="row clearfix" hidden="">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AGREGAR NUEVO BLOG
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">home</i> HOME
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">developer_mode</i> CONTENIDO
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">camera_roll</i> IMAGEN
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                    <div class="row clearfix">
                               <div class="col-md-12"><br>
                                    <b>TÍTULO DEL BLOG</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"  id="titulo"class="form-control text-uppercase" name="name" required="" aria-required="true" placeholder="Esquibe aquí...">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <b>TÍTULO DEL ENCABEZADO</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"  id="title"class="form-control text-uppercase" name="name" required="" aria-required="true" placeholder="Esquibe aquí...">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <b>PALABRAS CLAVE</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"  id="metakeys" class="form-control text-capitalize" name="name" required="" aria-required="true" placeholder="Esquibe aquí...">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <b>DESCRIPCION DE ARTÍCULO</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"  id="descripcion"class="form-control" name="name" required="" aria-required="true" placeholder="Esquibe aquí...">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                                    <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save();">GUARDAR CAMBIOS</button>
                                </div>
                            </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                                                        <!-- CKEditor -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card" id="card-editor">
                                                <div class="header">
                                                    <h2>
                                                        EDITOR DE CONTENIDO
                                                        <small>Puedes usar codigo HTML para mayor facilidad, puedes crear el contenido desde aquí.</small>
                                                    </h2>
                                                </div>                       
                                                <div class="body">
                                                    <form id="form-ckeditor">
                                                        <textarea id="ckeditor" id="ckeditor" name="ckeditor" rows="10" cols="80" style="width: 100%;">

                                                        </textarea>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            <!-- #END# CKEditor -->
            <!--
            <div class="row clearfix" hidden="">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card" id="card-editor">
            <div class="header">
            <h2>
            EDITOR DE CONTENIDO
            <small>Puedes usar codigo HTML para mayor facilidad, puedes crear el contenido desde aquí.</small>
            </h2>
            </div>
            <div class="body">
            <form id="form-ckeditor">
            <textarea name="ckeditor" id="ckeditor" rows="10" cols="80" style="width: 100%;"></textarea>
            </form>
            </div>
            </div>
            </div>
        </div>-->
                                    <div id="return_id" hidden=""></div>
                                     <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                                            <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save_editor();">GUARDAR CAMBIOS</button>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2>
                                                        BLOG
                                                    </h2>
                                                   
                                                </div>
                                                <div class="body" onclick="clickImg('_file')">
                                                    <form action="/"  class="dropzone" method="post" enctype="multipart/form-data" id="dropzone">
                                                        <div class="dz-message" align="center">
                                                            <div class="drag-icon-cph">
                                                                <i class="material-icons">touch_app</i>
                                                            </div>
                                                            <h3>Selecciona la imagen de portada del Blog.</h3>
                                                            <em>(Recuerda utilizar el formato  <strong>WEB</strong> para crear el Blog.)</em>
                                                        </div>
                                                        <div class="fallback">
                                                           <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg('_file')"/>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="body" id="contresp" style="display:none;">
                                                <div class="row clearfix">
                                                        <div class="col-md-12">
                                                            <b>URL DE LA IMAGEN</b>
                                                            <div class="form-group form-float">
                                                            <div class="form-line" id="return_file">
                                                                <input type="text" id="url_img" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MAILS
                            </h2>
                        </div>
                        <div class="body">
                           
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nombre</th>
                                            <th>Agencia</th>
                                            <th>Departamento</th>
                                            <th>Extension</th>
                                            <th>Correo</th>
                                            <th>#Celular</th>
                                            <th>#Directo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $mail;?>
                                    </tbody>
                                </table>
                                                     
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->

        </div>
    </section>
<script>

	function location_mail(ob){
		location.href="detalle.php?i="+ob;
	}

    $(document).ready(function(){
        $('#myTable').DataTable();
    });
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
