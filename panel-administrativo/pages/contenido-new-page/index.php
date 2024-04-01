<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");


$this_page = "contenido";
$this_subpage = "contenido_new_page";
if ($this_page=="contenido") { $contenido="active"; } else{ $contenido="active"; }

$conne = new Construir();
$autos= $conne->get_autos_catalogo();
$cat= $conne->get_categoria_new_page();
$dato= $conne->get_meta_key_new_page();
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
<style>
    .d-none{
        display:none;
    }
    .d-block{
        display:block;
    }
</style>
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AGREGAR CONTENIDO VERSION
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Para Basicos</b>
                                    <p>(Motor, Transmision, Rendimiento)
                                    <br>Descripcion. Pej. 20.7(Km/L) </p>
                                </div>
                                <div class="col-md-4">
                                     <b>Para Caracteristicas</b>
                                         <p>(Seguridad, Exterior, Interior)
                                         <br>Descripcion (Código HTML)</p>
                                </div>
                                <div class="col-md-4">
                                      <b>Para Versiones</b>
                                         <p>Version del auto
                                         <br>Descripcion (Código HTML)</p>
                                </div>
                                <hr>
                                <div class="col-md-3">
                                    <b>Auto</b>
                                    <div class="form-group form-float">
                                    <div class="form-line" id="res_asignado">
                                        <select id="asignado"  class="form-control" name="name" required="" aria-required="true" >
                                            <option value="" selected  disabled></option>
                                            <?php echo $autos;?>
                                        </select>
                                        <input type="text"  id="imagen_titulo" class="form-control" name="name" required="" aria-required="true" placeholder="Esquibe aquí..." style="display: none;">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <div id="div_anios">
                                         <b>Año</b>
                                         <div class="form-group form-float">
                                             <div class="form-line" id="res_anio">
                                                <select id="anio" class="form-control">
                                                    <option value="" selected  disabled></option>
                                                    <option value="2021">2023</option>
                                                    <option value="2021">2022</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2020">2019</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div id="">
                                         <b>Categoria</b>
                                         <div class="form-group form-float">
                                             <div class="form-line" id="res_categoria">
                                                 <select id="categoria" class="form-control">
                                                    <option value="" selected  disabled></option>
                                                      <?php echo $cat;?>
                                                 </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div id="">
                                         <b>Key</b>
                                         <div class="form-group form-float">
                                             <div class="form-line" id="res_meta_key">
                                                <select id="meta_key" class="form-control">
                                                    <option value="" selected  disabled></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none" id="add_meta_key">
                                <div class="col-md-3">
                                    <div id="">
                                         <b>Agregar nueva opcion</b>
                                         <div class="form-group form-float">
                                             <div class="form-line" id="res_ott_meta_key">
                                                 <input type="text" id="ott_meta_key" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row d-none" id="add_meta_val_input">
                                <div class="col-md-3">
                                    <div id="">
                                         <b>Agregar dato a Basicos</b>
                                         <div class="form-group form-float">
                                             <div class="form-line" id="res_ott_meta_val">
                                                 <input type="text" id="meta_val" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="" id="profile_with_icon_title">
                                    <!-- CKEditor -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card d-none" id="card-editor">
                                                <div>
                                                    <div class="text-right">
                                                        <button class="btn btn-danger" onclick="traer_imagenes()" style="margin: 2em 0.5em 0em 0em;">Ver galeria de imagenes</button>
                                                    </div>
                                                    <div class="body d-none" id="cont_gall">
                                                        <button class="btn bg-cyan waves-effect m-b-15" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                                                           Mostrar / Ocultar
                                                        </button>
                                                        <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                                                            <div id="return_imagenes" class="body row justify-content-center" style=" text-align:center; "></div>
                                                        </div>
                                                    </div>
                                                    <div class="header">
                                                    <h2>Para agregar contenido elige el icono de lista simple &nbsp;&nbsp;<span class="demo-google-material-icon"> <i class="material-icons">view_list</i></span> &nbsp;&nbsp; Despues agrega cada una de las descripciones.
                                                    <br>
                                                    Una vez agregados los elemento  da click en el boton fuente html &nbsp;&nbsp;<span class="demo-google-material-icon"> <i class="material-icons">code</i></span> &nbsp;&nbsp; y elimina la etiqueta "< ul >".
                                                    </h2>
                                                    </div>
                                                </div>
                                                <div class="header">
                                                    <h2>
                                                        EDITOR DE CONTENIDO
                                                        <small>Puedes usar codigo HTML para mayor facilidad, o puedes crear el contenido desde aquí.</small>
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
                                     <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                                            <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save_new();">GUARDAR CAMBIOS</button>
                                        </div>
                                    </div>
                                </div>
                                
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 

        </div>
    </section>
<script>

$( "#categoria" ).change(function() {
   if($(this).val() != "basicos"){
        if($("#card-editor").hasClass("d-none")){
            $("#card-editor").removeClass("d-none");
        }
        if(!$("#add_meta_val_input").hasClass("d-none")){
              $("#add_meta_val_input").addClass("d-none");
        }
    }else{
         if(!$("#card-editor").hasClass("d-none")){
              $("#card-editor").addClass("d-none");
        }
        if($("#add_meta_val_input").hasClass("d-none")){
              $("#add_meta_val_input").removeClass("d-none");
        }
    }
    charge_meta_key( $(this).val() );
});

function val_metakey(){
    var MV= document.getElementById('meta_key').value;
    if(MV == "add_nuevo"){
        if($("#add_meta_key").hasClass("d-none")){
            $("#add_meta_key").removeClass("d-none");
        }
    }else{
         if(!$("#add_meta_key").hasClass("d-none")){
              $("#add_meta_key").addClass("d-none");
        }
    }
}

function traer_imagenes(){
var asignado=  document.getElementById('asignado').value;
var anio =document.getElementById('anio').value;
if(asignado!="" && anio!=""){
 var param={
                asignado:asignado,
                anio:anio,
            }
            $.ajax({
                url:'get_imagenes.php',
                type:'POST',
                data:param,
                success: function(resp){
                    if($("#cont_gall").hasClass("d-none")){
                            $("#cont_gall").removeClass("d-none");
                    }
                    document.getElementById('return_imagenes').innerHTML=resp;
                 }
            })
    } else {
        alert('El nombre del auto y el año son campos requeridos!');
    }
}

function copy(obj) {
  var obj=obj;
  var copyText = document.getElementById(obj);
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Imagen copiada" + copyText.value);
}

function charge_meta_key(obj){
    var categoria = obj;
    var param={
     categoria:categoria,
            }
            $.ajax({
                url:'charge_meta_key.php',
                type:'POST',
                data:param,
                success: function(resp){
                    document.getElementById('res_meta_key').innerHTML=resp;
                 }
            })
}

function save_new(){
var modelo=  document.getElementById('asignado').value;
var anio =document.getElementById('anio').value;
var categoria=document.getElementById('categoria').value;
    if(categoria=="basicos"){
        var meta_key =document.getElementById('meta_key').value;
        var meta_value =document.getElementById('meta_val').value
    }else if(categoria=="caracteristicas"){
        var meta_key =document.getElementById('meta_key').value;
        var meta_value =CKEDITOR.instances.ckeditor.getData(); 
    }else if(categoria=="version"){
        var meta_key =document.getElementById('meta_key').value;
        if(meta_key=="add_nuevo"){
            var meta_key = document.getElementById('ott_meta_key').value;
            var meta_value =CKEDITOR.instances.ckeditor.getData();
        }else{
            var meta_value =CKEDITOR.instances.ckeditor.getData();
            var meta_key =document.getElementById('meta_key').value;
        }
    }
    
if (modelo!=""  && anio!="" && categoria!="" && meta_key!="" && meta_value!="") {
            var param={
                modelo:modelo,
                anio:anio,
                categoria:categoria,
                meta_key:meta_key,
                meta_value:meta_value,
            }
            $.ajax({
                url:'save.php',
                type:'POST',
                data:param,
                success: function(resp){
                    alert("Datos guardados");
                    location.reload();
                 }
            })
    } else {
        alert('Campos vacíos!' + modelo + anio + categoria + meta_key + meta_value);
    }

}

  function error(obj){
    if($(obj).val()==""){
           $(obj).css({'cssText': 'border: 2px solid red !important; '});
    }
  }
   function errorTextArea(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border: 2px solid red !important; '});
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
