<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$conne = new Construir();
$taller = $conne->get_table_promociones('taller');

$this_page = "promociones";
$this_subpage = "promociones_taller";
if ($this_page=="promociones") { $promociones="active"; } else{ $promociones="active"; }
if ($this_subpage=="promociones_taller") { $promociones_taller="active"; } else{ $promociones_taller="active"; }
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
    </section>

    <section class="content">
    <h1> PROMOCIONES TALLER </h2>
        <div class="container-fluid">
            <!-- Color Pickers -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <b>NOMBRE DE LA IMAGEN</b>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text"  id="imagen_titulo"class="form-control" name="name" required="" aria-required="true" placeholder="Escribe aquí...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <b>DESCRIPCIÓN DE LA PROMOCIÓN</b>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="descripcion" class="form-control" name="name" required="" aria-required="true" placeholder="Escribe aquí...">
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

                        <div class="body" onclick="clickImg('_file')">
                            <form action="/"  class="dropzone" method="post" enctype="multipart/form-data">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Selecciona una imagen o arrastra y suelta.</h3>
                                    <em>(Recuerda utilizar el formato  <strong>JPG</strong> para crear la promocion.)</em>
                                </div>
                                <div class="fallback">
                                   <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg(this)"/>
                                </div>
                            </form>
                            <input id="imagen" type="text" multiple hidden="" />
                        </div>

                        <div class="body" id="contresp" style="display:none;">
                            <div class="row clearfix" style="margin-top: -45px">
                                <div class="col-md-12">
                                    <h2>La promoción se visualizará de esta manera en la página:</h2>
                                    <div class="form-group form-float" style="background-color:#33373a">
                                        <div class="row clearfix">
                                            <div class="form-line col-lg-12 col-xs-12">
                                                <img  style="max-width: 580px" src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/header-promos.png">
                                            </div>
                                            <div class="form-line col-lg-12 col-xs-12" id="return_file">
                                                <input type="text" id="url_img" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
                                                <img style="max-width: 280px" id="imagen_previa" class="imagen_previa" src="#" />
                                           </div>
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

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> HISTORIAL PROMOCIONES TALLER </h2>
                        </div>
                        <div class="body">
                           <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Descripción de la promoción</th>
                                            <th>Status</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $taller;?>
                                    </tbody>
                                </table>
                             </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->

            <!-- Modal de edicion de inventarios versiones -->
            <div class="modal fade bs-example-modal-lg" id="modal-edit-desc" name="modal-edit-desc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Editar Descripción</h4>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div>
                                        <input id="idVal" type="hidden">
                                    </div>
                                    <div>
                                        <label for="">Descripcion</label>
                                        <textarea id="textEdit" class="form-control" type="text"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="saveDesc()">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Modal de edicion de inventarios versiones -->

            <!-- Modal de edicion Imagen -->
            <div class="modal fade bs-example-modal-lg" id="modal-edit-img" name="modal-edit-img" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Editar Imagen Promoción</h4>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div>
                                        <input id="nameImg" type="hidden">
                                        <input id="idImg" type="hidden">
                                    </div>
                                    <div id="imgArea" style="text-align:center">
                                    </div>
                                    <hr/>
                                    <div class="fallback" style="text-align:center">
                                        <label>Selecciona la nueva imagen</lable><br/>
                                        <input type="file" id="img_file" name="img_file"/>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="saveNewImg()">Cambiar Imagen</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal de edicion de inventarios versiones -->
        </div>
    </section>

<script>
    function save(){
        
        var imagen_titulo = document.getElementById('imagen_titulo').value;
        //var imagen=document.getElementById('url_img').value;

        imagen_titulo= imagen_titulo.replace('ó', 'o');
        imagen_titulo= imagen_titulo.replace('Ó', 'o');
        imagen_titulo= imagen_titulo.replace('á', 'a');
        imagen_titulo= imagen_titulo.replace('í', 'i');
        imagen_titulo= imagen_titulo.replace('ú', 'u');
        imagen_titulo= imagen_titulo.replace('?', '');
        imagen_titulo= imagen_titulo.replace('¿', '');
        imagen_titulo= imagen_titulo.replace('!', '');
        imagen_titulo= imagen_titulo.replace('¡', '');
        imagen_titulo= imagen_titulo.replace(' ', '-');
        imagen_titulo= imagen_titulo.replace('ñ', 'n');
        imagen_titulo= imagen_titulo.replace('Ñ', 'N');
        imagen_titulo= imagen_titulo.replace('*', '');
        imagen_titulo= imagen_titulo.replace('+', '');

        var files = document.getElementById('_file').files[0];
        var marca = "CHEVROLET";
        var descripcion =document.getElementById('descripcion').value;
        error('#imagen_titulo');
        error('#imagen');
        error('#descripcion');
        
        var tipo = "taller";
        var tipoUpper = "TALLER";
        var tipo_promo = "taller";
        var modelo_unidad = "taller";

        if (imagen_titulo!="" && descripcion!="") {
            if (!files) {
                alert('Es necesario seleccionar una imagen.');
                $('.dropzone').css({'cssText': 'border: 3px solid red !important; '});
            } else {
                $('.dropzone').css({'cssText': 'display: none !important; '});

                var filereader = new FileReader();
                filereader.readAsDataURL(files);
                filereader.onload = function (evt) {
                    var base64 = evt.target.result;
                    base = base64;
                    var file = b64toBlob(base64);

                    var fd = new FormData();
                    fd.append('file',file);
                    fd.append('name',imagen_titulo);
                    fd.append('tmp_name', "tmp_name");
                    fd.append('serie', "1235456");
                    fd.append('vin', "ABCDFFFF");
                    fd.append('numero', "1");
                    fd.append('slug', "taller");

                    $.ajax({
                    url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/upload_img.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response == 'ok'){
                            var param={
                                descripcion:descripcion,
                                marca:marca,
                                imagen_titulo:imagen_titulo,
                                tipo:tipo,
                                tipoUpper:tipoUpper
                            }
                            $.ajax({
                                url:'save.php',
                                type:'POST',
                                data:param,
                                success: function(resp){
                                    console.log(resp, "QUERY");
                                    alert('Promoción dada de alta correctamente.');
                                    location.reload();
                                }
                            })
                        } else {
                            alert('Error,intenta de nuevo.');
                        }
                    }, error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('Error en la carga del archivo, intente de nuevo.');
                    }
                });
            }
            }
        }else {
            alert('Campos vacíos!');
        }
    }

  function clickImg(obj){

    var imagen_titulo=document.getElementById('imagen_titulo').value;
    document.getElementById(obj).click();

  }

    $('#_file').change(function() { 
        
        var reader = new FileReader();
        reader.onload = function (e) {
            
            $('.dropzone').css({'cssText': 'border: none !important;'});
            $('#contresp').css({'cssText': 'display: block !important;'});
            $('#imagen_previa').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    })

    function updateImg(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.dropzone').css({'cssText': 'border: none !important;'});
                $('#contresp').css({'cssText': 'display: block !important;'});
                $('#imagen_previa').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
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

  function changeStatus(status, id){
    if (status == 0){
        var param={id:id,status: '0'}
        $.ajax({
            url:'update_status.php',
            type:'POST',
            data:param,
            success: function(resp){
                document.getElementById(id).innerHTML='<img role="button" onclick="changeStatus(1, '+id+' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-off.png"/>';
            }
        })
    } else {
        var param={id:id,status: '1'}
        $.ajax({
            url:'update_status.php',
            type:'POST',
            data:param,
            success: function(resp){
                document.getElementById(id).innerHTML='<img role="button" onclick="changeStatus(0, '+id+' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-on.png"/>';
            }
        })
    }
  }

  function editDesc(desc, id){
    $("#modal-edit-desc").modal('show');
    $("#textEdit").val(desc);
    $("#idVal").val(id);
    console.log(id);
  }

  function editImg(nombre,id){
    nombre = nombre.replace("taller/", '');
    nombre = nombre.replace(".jpg", '');
    $("#nameImg").val(nombre+'_1');
    $("#idImg").val(id);
    $("#modal-edit-img").modal('show');
    document.getElementById('imgArea').innerHTML='<label for="">Imagen Actual de la Promocion</label><br/><img src = "https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/taller/'+nombre+'.jpg" style="max-width: 300px;">';
    console.log(nombre+'_1');
  }

  function saveNewImg(){
    var files = document.getElementById('img_file').files[0];
    var name = $("#nameImg").val();
    var id = $("#idImg").val();

    var base ='';

    if (files) {

        var filereader = new FileReader();
        filereader.readAsDataURL(files);
        filereader.onload = function (evt) {
            var base64 = evt.target.result;
            base = base64;
            var file = b64toBlob(base64);

            var fd = new FormData();
            fd.append('file',file);
            fd.append('name', name);
            fd.append('tmp_name', "tmp_name");
            fd.append('serie', "1235456");
            fd.append('vin', "ABCDFFFF");
            fd.append('numero', "1");
            fd.append('slug', "taller");

            $.ajax({
                url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/upload_img.php',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if (response == 'ok'){
                        var param={id:id,nombre_nuevo: 'taller/'+name+'.jpg'}
                        console.log(param, "Param");
                        $.ajax({
                            url:'update_img.php',
                            type:'POST',
                            data:param,
                            success: function(resp){
                                alert('Imagen cambiada correctamente.')
                                location.reload();
                            }
                        })
                    } else {
                        alert('Error en la carga del archivo, intentelo de nuevo.')
                    }
                }, error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('Error en la carga del archivo, intente de nuevo.');
                }
            });
        }
    } else {
        alert('No se encontró ningun archivo.')
    }
  }

  function saveDesc(){
    let descripcion = $("#textEdit").val();
    let id = $("#idVal").val();
    var param={id:id, descripcion:descripcion}
        $.ajax({
            url:'update_descripcion.php',
            type:'POST',
            data:param,
            success: function(resp){
                console.log(resp)
                idElement = 'desc'+id; 
                document.getElementById(idElement).innerHTML= '<i onclick="editDesc(\''+descripcion+'\','+id+')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i>'+descripcion;
                $("#modal-edit-desc").modal('hide');
            }
        })

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
