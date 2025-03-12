<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");

$this_page = "blog";
$this_subpage = "promociones_accesorios";
if ($this_page=="blog") { $blog="active"; } else{ $blog="active"; }

$conne = new Construir();
$conn=new Conexion();
$blogs = $conne->get_table_blogs();
$infoBlogs = $conne->query_todo_blogs();
$last_blog = $conn->get_last_blog();
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

                        <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        <div id="tituloMarca" style="display:flex;justify-content: center;align-items:center;"><h2 style="margin-right: 10px">Estás creando un blog para </h2> <img src = "https://d3s2hob8w3xwk8.cloudfront.net/makes/chevrolet.png" style="max-width: 40px"></div>
                        </div>
                        <div class="body">

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                    <div class="row clearfix">
                                    <div class="col-md-6"><br>
                                        <b>TÍTULO DEL BLOG</b>
                                        <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text"  id="titulo" class="form-control" name="name" required="" aria-required="true" placeholder="Escribe el titulo del blog...">
                                            <input type="text"  id="id_blog" value="<?= $last_blog[0]["id"] + 1 ?>" name="id_blog" aria-required="true" hidden>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-top:20px;">
                                    <b>AGENCIA</b>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select id="make" class="form-control" name="make" onchange="updateMarca()">
                                                <option value="chevrolet">CHEVROLET</option>
                                                <option value="nissan">NISSAN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"><br>
                                    <b>DESCRIPCION </b><i class="material-icons" style="font-size: 15px;cursor:pointer;" onclick="dudaDesc()">help_outline</i>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text"  id="descripcion"class="form-control" name="name" required="" aria-required="true" placeholder="Escribe una descripción del blog">
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
                                                        <textarea id="ckeditor" name="ckeditor" rows="10" cols="80" style="width: 100%;">

                                                        </textarea>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                    <!-- #END# CKEditor -->

                                    <div id="return_id" hidden=""></div>
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2>
                                                        PORTADA DEL BLOG
                                                    </h2>
                                                </div>
                                                <div class="body" onclick="clickImg('_file')">
                                                    <div style="text-align: center;">
                                                        <img id="imagen_previa" class="imagen_previa" style="width: 300px; margin:10px;" src="https://d3s2hob8w3xwk8.cloudfront.net/blogs/preview_portada.png" />
                                                    </div>
                                                    <form action="upload.php"  class="dropzone" method="post" enctype="multipart/form-data" id="dropzone">
                                                        <div class="dz-message" align="center" style="cursor:pointer;">
                                                            <div class="drag-icon-cph">
                                                                <i class="material-icons">touch_app</i>
                                                            </div>
                                                            <h3>Selecciona la imagen de portada del Blog.</h3>
                                                            <em>(Recuerda utilizar el formato  <strong>PNG</strong> para crear el Blog.)</em>
                                                        </div>
                                                        <div class="fallback">
                                                           <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg(this)"/>
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

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                        <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save();">SUBIR BLOG</button>
                        <button type="button" class="btn btn-success m-t-15 waves-effect" onclick="previewBlog()">PREVISUALIZAR</button>
                    </div>
                </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BLOGS
                            </h2>
                        </div>
                        <div class="body">

                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Portada</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= $blogs;?>
                                </tbody>
                            </table>
                
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->

        </div>
    </section>

    <!-- Modal Previsualización Blog -->
    <div class="modal fade bs-example-modal-lg" id="modal-preview" name="modal-preview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Previsualización del Blog</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <div id="titulo-preview" style="color: black;"></div>
                        <img id="img-preview" style="width: 700px; margin:10px;" />
                        <div id="contenido-preview" style="color:black;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Previsualización Blog -->

    <!-- Modal Info Descripcion -->
    <div class="modal fade bs-example-modal-lg" id="modal-duda" name="modal-duda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">¿Para qué sirve la descripción?</h4>
                </div>
                <div class="modal-body">
                    <b>La descripción se mostrará en el listado de Blogs displonibles en la página, esta ayudará a atraer al cliente a visualizarlo. Como ejemplo, a continuación se muestra representado de manera grafica como el sector enmarcado en verde.</b>
                    <div style="text-align: center;">
                        <img id="desc_previa" class="desc_previa" style="margin:10px;" src="https://d3s2hob8w3xwk8.cloudfront.net/blogs/preview_descripcion.png" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Info Descripcion -->

<script>

    //CKEDITOR.replace ("ckeditor");
    $(document).ready(function(){
        $('#myTable').DataTable();
    });

    function save(){

    var titulo=  document.getElementById('titulo').value;
    var slug = titulo.toLowerCase();
    var descripcion=document.getElementById('descripcion').value;
    var contenido = CKEDITOR.instances['ckeditor'].getData();
    var files = document.getElementById('_file').files[0];
    var make=  document.getElementById('make').value;

    error('#titulo');
    error('#slug');
    error('#descripcion');
    error('#contenido');
    error('#make');
    var id_blog = document.getElementById('id_blog').value;
    var base ='';

    if (files && titulo && contenido && descripcion) {

        var filereader = new FileReader();
        filereader.readAsDataURL(files);
        filereader.onload = function (evt) {
            var base64 = evt.target.result;
            base = base64;
            var file = b64toBlob(base64);

            var fd = new FormData();
            fd.append('file',file);
            fd.append('name', "portada");
            fd.append('tmp_name', "tmp_name");
            fd.append('serie', "1235456");
            fd.append('vin', "ABCDFFFF");
            fd.append('numero', "1");
            fd.append('slug', "nuevos");
            fd.append('id_blog', id_blog);

            $.ajax({
                url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/upload_img_blog.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    console.log('Subido');
                }
            });
            
        }

        var param={
            titulo:titulo,
            slug:slug,
            descripcion:descripcion,
            contenido:contenido,
            id_blog:id_blog,
            make: make
        }

        $.ajax({
            url:'save.php',
            type:'POST',
            data:param,
            success: function(resp){
                document.getElementById('return_id').innerHTML='<input type="text" id="num_id" value="'+resp+'">';
                alert("Datos guardados correctamente.");
                $("#titulo").val("");
                $("#descripcion").val("");
                $("#ckeditor").val("");
                $(".form-line").removeClass("focused");
                location.reload();
            }
        })

    } else {
        alert('Debes llenar todos los campos incluyendo la elección de la imagen del blog.');
    }

    }

    function b64toBlob(base64){
        var byteString = atob(base64.split(',')[1]);
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);

        for (var i=0; i < byteString.length; i++){
            ia[i] = byteString.charCodeAt(i);
        }

        return new Blob([ab], {type: 'image/jpg'});
    }

    function previewBlog(){
        $("#modal-preview").modal('show');
        var titulo = $("#titulo").val();
        var contenido =
        console.log(titulo);
        document.getElementById('titulo-preview').innerHTML='<h1>'+titulo+'</h1>';
        var contenido = CKEDITOR.instances['ckeditor'].getData();
        document.getElementById('contenido-preview').innerHTML= contenido;
    }


// SAVE EDITOR HTML //
   function save_editor(obj){
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

  $('#_file').change(function() { 

    var reader = new FileReader();
    reader.onload = function (e) {
        $('#imagen_previa').attr('src', e.target.result);
        $('#img-preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);

  })

  function updateImg(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imagen_previa').attr('src', e.target.result);
            $('#img-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  function cambiarImagen(obj){

    //var carpeta = end($blogs);
    var fd = new FormData();
    var files = $('#'+obj)[0].files[0];
    fd.append('file',files);
    //fd.append('carpeta',carpeta);         
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
            alert(response);
        //location.reload();
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

  function dudaDesc(){
    $("#modal-duda").modal('show');
  }

  function updateMarca(){
    
    var make = document.getElementById('make').value;

    make = make.toLowerCase();
    document.getElementById('tituloMarca').innerHTML='<h2 style="margin-right: 10px">Estás creando un blog para </h2> <img src = "https://d3s2hob8w3xwk8.cloudfront.net/makes/'+make+'.png" style="max-width: 40px">';

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
