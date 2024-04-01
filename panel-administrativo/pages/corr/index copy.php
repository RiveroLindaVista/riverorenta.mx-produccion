<?php
require_once("../../_inc/_config.php");

$this_page = "blog";
$this_subpage = "promociones_accesorios";
if ($this_page=="blog") { $blog="active"; } else{ $blog="active"; }


?>
<!DOCTYPE html>
<html>
<head>
   <?php include('../../_inc/_header.php');?>
    <link rel='icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
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
                                BLOG
                            </h2>
                           
                        </div>
                        <div class="body" onclick="clickImg('_file')">
                            <form action="/"  class="dropzone" method="post" enctype="multipart/form-data" id="dropzone">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Selecciona la imagen de portada, arrastra y suelta o da click y selecciona.</h3>
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
            <textarea name="ckeditor" id="ckeditor" rows="10" cols="80" style="width: 100%;"></textarea>
            
        </form>
     			</div>
                    </div>
                </div>
            </div>
            <!-- #END# CKEditor -->

            <!-- File Upload | Drag & Drop OR With Click & Choose -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <!-- CKEditor -->
            <div class="card" style="">
                <div class="body">
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
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                             <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save();">GUARDAR CAMBIOS</button>
                             <br><br>
                         </div>
                     </div>
            </div>
                </div>
            </div>
            <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
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

    <!-- Ckeditor -->
    <script src="../../plugins/ckeditor/ckeditor.js"></script>

    <!-- TinyMCE -->
    <script src="../../plugins/tinymce/tinymce.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/editors.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
<script>
    function save(){
        var tituloL=  document.getElementById('titulo').value;
    var titulo =tituloL.toLowerCase();
        var titleL=  document.getElementById('title').value;
    var title =titleL.toLowerCase();
    var metakeys=document.getElementById('metakeys').value;
    var descripcion=document.getElementById('descripcion').value;
    var imagen=document.getElementById('url_img').value;
    var contenido = CKEDITOR.instances.ckeditor.getData();
   
    error('#titulo');
    error('#title');
    error('#metakeys');
    error('#descripcion');

    if (titulo!="" && title!="" && metakeys!="" && descripcion!="") {
        if (imagen=="") {
            alert("Aún no has agregado la imágen de portada!");
            errorImg('#dropzone');
        } else {
                if (contenido!="") {
            var param={
                titulo:titulo,
                title:title,
                metakeys:metakeys,
                descripcion:descripcion,
                imagen:imagen,
                contenido:contenido
            }
            $.ajax({
                url:'save.php',
                type:'POST',
                data:param,
                success: function(resp){
                	 alert(resp);
                	   //if(resp!="Error al guardar los datos."){
                	location.reload();
                		//}
                 }
            })
        }
        else{
            alert("Debes agregar descripción para el contenido de el Blog!");
            errorTextArea('#cke_1_contents');
        }
            }
    } else {
        alert('Campos vacíos!');
    }
}
  function clickImg(obj){
    document.getElementById(obj).click();
  }
  function updateImg(obj){
    cambiarImagen(obj);
  }
  function cambiarImagen(obj){
    var fd = new FormData();
    var files = $('#'+obj)[0].files[0];
    fd.append('file',files);      
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

</body>

</html>
