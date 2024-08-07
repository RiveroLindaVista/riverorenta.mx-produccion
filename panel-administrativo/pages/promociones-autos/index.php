<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$autos = $conne->get_table_promociones('nuevos');
$autos_promo= $conne->get_autos_promociones();
$marcas= $conne->get_lista_marcas();

$this_page = "promociones";
$this_subpage = "promociones_autos";
if ($this_page=="promociones") { $promociones="active"; } else{ $promociones="active"; }
if ($this_subpage=="promociones_autos") { $promociones_autos="active"; } else{ $promociones_autos="active"; }

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
    <!-- <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"> -->
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
    <h1> PROMOCIONES AUTOS</h2>
        <div class="container-fluid">
            <!-- Color Pickers -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                <!--            <div class="header">
                            <small>Para "Título de la Imágen" Recuerda no usar (ñ) ni caracteres especiales, asi como acentos ( ´ ) o signos de puntuación ( , . ; ! ). Ej.: <strong>aveo-48-meses-2028.jpg</strong></small>
                        </div> -->
                        <div class="body">
                            <div class="row clearfix">
                            <div id="tituloMarca" style="display:flex; margin: 10px"></div>
                                <div class="col-md-3" style="margin-top:20px;">
                                    <b> MARCA: </b>
                                    <select id="marca" class="form-control" name="marca" required="" aria-required="true" onchange="updateMarca()">
                                        <?php echo $marcas;?>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:20px;">
                                    <b> MODELO: </b>
                                    <select id="modelo_unidad" class="form-control" name="modelo_unidad" onchange="SelectModeloUnidad()">
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:20px;">
                                    <b> AÑO: </b>
                                    <select id="ano" class="form-control" name="ano" required="" aria-required="true">
                                        <option value="">Seleccione...</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:20px;">
                                    <b> TIPO DE PROMOCION: </b>
                                    <select id="tipo_promo" class="form-control" name="tipo_promo" required="" aria-required="true">
                                        <option value="">Seleccione...</option>
                                        <option value="plan">Plan</option>
                                        <option value="bono">Bono</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:20px;">
                                    <b> CANTIDAD: </b>
                                    <input id="cantidad" name="cantidad" class="form-control" type="text">
                                </div>

                                <div class="col-md-3"><br>
                                    <b>TÍTULO DE LA IMAGEN</b>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text"  id="imagen_titulo" class="form-control" name="imagen_titulo" required="" aria-required="true" placeholder="Ej: aveo-48-meses-oct-2024">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"><br>
                                    <b>DESCRIPCIÓN</b>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text"  id="descripcion"class="form-control" name="descripcion" required="" aria-required="true" placeholder="Escribe aquí...">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                    <em>(Recuerda utilizar el formato  <strong>JPG</strong> para cargar la imagen.)</em>
                                </div>
                                <div class="fallback">
                                   <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg(this)"/>
                                </div>
                            </form>
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
                            <h2>
                                HISTORIAL PROMOCIONES
                            </h2>
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
                                        <?= $autos;?>
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

        //var imagen=document.getElementById('url_img').value;
        var files = document.getElementById('_file').files[0];
        var marca = document.getElementById('marca').value;
        marca = marca.toUpperCase();
        var descripcion =document.getElementById('descripcion').value;
        var modelo_unidad = document.getElementById('modelo_unidad').value;
        var ano = document.getElementById('ano').value;
        var cantidad = document.getElementById('cantidad').value;
        var tipo_promo = document.getElementById('tipo_promo').value;

        error('#imagen_titulo');
        error('#descripcion');
        error('#marca');
        error('#descripcion');
        error('#modelo_unidad');
        error('#ano');
        error('#cantidad');
        error('#tipo_promo');

        var tipo = "nuevos";
        var tipoUpper = "NUEVOS";

        if (imagen_titulo!="" && descripcion!="" && modelo_unidad != "" && ano != "" && cantidad != "" && tipo_promo != "") {
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
                fd.append('slug', "nuevos");

                $.ajax({
                    url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/upload_img.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log(response)

                        if(response == 'ok'){

                            var param={
                                descripcion:descripcion,
                                marca:marca,
                                imagen_titulo:imagen_titulo,
                                tipo:tipo,
                                tipoUpper:tipoUpper,
                                modelo_unidad,
                                ano,
                                cantidad,
                                tipo_promo
                            }
                            $.ajax({
                                url:'save_auto.php',
                                type:'POST',
                                data:param,
                                success: function(resp){
                                    alert('Promoción dada de alta correctamente.')
                                    location.reload();                        
                                }
                            })
                            
                        }else{
                            alert('Error,intenta de nuevo.');
                        }
                    }, error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('Error en la carga del archivo, intente de nuevo.');
                    }
                });
            }

            }
        } else {
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

        return new Blob([ab], {type: 'image/jpeg'});
  }

  function updateMarca(){
    
    var titulo = document.getElementById('marca').value;

    titulo = titulo.toLowerCase();
    console.log(titulo)
    document.getElementById('tituloMarca').innerHTML='<h2 style="margin-right: 10px">Estás creando una promoción de </h2> <img src = "https://d3s2hob8w3xwk8.cloudfront.net/makes/'+titulo+'.png" style="max-width: 80px">';

    //get models;
    let data = {
        function: 'modelos_by_marca',
        marca: titulo
    }
    let select = '<option value="">Seleccione...</option>';
    $.ajax({
        type: "POST",
        url: "funcForAjax.php",
        data: data,
        dataType: "json",
        success: function (resp) {
            resp.forEach(modelo => {
                select += '<option value="' + modelo.modelo + '">' + modelo.modelo + '</option>';
            });
            $('#modelo_unidad').html(select);
            // console.log(select);
            
        }
    });

  }

  function SelectModeloUnidad(){

    var modelo = document.getElementById('modelo_unidad').value;
//     console.log(modelo);
// return modelo;
    //get models;
    let data = {
        function: 'anos_by_model',
        modelo: modelo
    }
    let select = '<option value="">Seleccione...</option>';
    $.ajax({
        type: "POST",
        url: "funcForAjax.php",
        data: data,
        dataType: "json",
        success: function (resp) {
            resp.forEach(anos => {
                select += '<option value="' + anos.ano + '">' + anos.ano + '</option>';
            });
            $('#ano').html(select);
            // console.log(resp);
            
        }
    });
    

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
    nombre = nombre.replace("nuevos/", '');
    nombre = nombre.replace(".jpg", '');
    $("#nameImg").val(nombre+'_1');
    $("#idImg").val(id);
    $("#modal-edit-img").modal('show');
    document.getElementById('imgArea').innerHTML='<label for="">Imagen Actual de la Promocion</label><br/><img src = "https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/nuevos/'+nombre+'.jpg" style="max-width: 300px;">';
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
            fd.append('slug', "nuevos");

            $.ajax({
                url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/upload_img.php',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){

                    if (response == 'ok'){
                        var param={id:id,nombre_nuevo: 'nuevos/'+name+'.jpg'}
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
    <!-- <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

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
