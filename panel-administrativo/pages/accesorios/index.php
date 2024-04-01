<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
include("../../_inc/.php");

$this_page = "accesorios";
if ($this_page=="accesorios") { $accesorios="active"; } else{ $accesorios="active"; }

$conne = new Construir();
//$get_banners = $conne->get_table_banners();
$autos_banner= $conne->get_autos_accesorios();
$autos_accesorios = $conne->get_all_accesorios();
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

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

</head>

<body class="theme-blue">
  <!-- #Top Bar -->
       <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand">ADMINISTRACION  &nbsp; | &nbsp; G. RIVERO</a>
            </div>
        </div>
    </nav><!-- #Menu -->
    <section class="container-fluid">
        <div class="">
            <div class="block-header">
                <h2>ADVANCED FORM ELEMENTS</h2>
            </div>
            <!-- Color Pickers -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ACCESORIOS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form>
                                <div class="col-md-8">
                                    <div class="col-md-6">
                                    <b>Auto asignado</b>
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
                                <div class="col-md-6">
                                    <div id="div_anios">
                                         <b>Años para los que este articulo esta disponible</b>
                                         <div class="form-group form-float">
                                             <div class="form-line">
                                                 <input type="number" placeholder="Este vehículo no se encuentra en inventario."  class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <b>Número de inventario</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="inventario" class="form-control" required="" aria-required="true">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <b>Tiempo de instalación</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="instalacion" class="form-control" required="" aria-required="true">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <b>Precio</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="precio" class="form-control" required="" aria-required="true">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <b>Costo de instalación</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="costo_inst" class="form-control" required="" aria-required="true">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <b>Categoría</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <select id="categoria" class="form-control" required="" aria-required="true">
                                            <option selected="" disabled="">Elige una opción</option>
                                            <option value="DEPORTIVO">DEPORTIVO</option>
                                            <option value="EXTERIOR">EXTERIOR</option>
                                            <option value="INTERIOR">INTERIOR</option>
                                            <option value="SEGURIDAD">SEGURIDAD</option>
                                            <option value="TECNOLOGIA">TECNOLOGIA</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                    <b>Descripción </b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="number" id="descripcion" placeholder="Describe aquí el producto" class="form-control" rows="1"></textarea>
                                    </div>
                                </div>
                                </div>
                                    <div class="col-md-12">
                                        <b> Imagen del Producto </b>
                                        <div class="form-group form-float">
                                        <div class="form-line">
                                          <div class="body" onclick="clickImg('_file')">
                                            <form action="/"  class="dropzone" method="post" enctype="multipart/form-data">
                                                <div class="btn-block btn btn-default waves-effect" style="color:#555;">
                                                    <div class="drag-icon-cph">
                                                        <i class="material-icons">touch_app</i>
                                                    </div>
                                                    <h3>Seleccionar imagen.</h3>    
                                                </div>
                                                <div class="fallback">
                                                   <input style="display: none;" type="file" id="_file" name="file" onchange="updateImg('_file')"/>
                                                </div>
                                            </form>
                                          </div>
                                            <div class="body" id="contresp" style="display:none;">
                                            <div class="row clearfix">
                                                    <div class="col-md-12">
                                                        <b>URL DEL BANNER</b>
                                                        <div class="form-group form-float">
                                                        <div class="form-line" id="return_file">
                                                             <input id="imagen" type="text" hidden="" />
                                                            <input type="text" id="copia_" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:none;" disabled="" value="">
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
                                         <button type="submit" class="btn btn-primary m-t-15 waves-effect" onclick="save();">GUARDAR CAMBIOS</button>
                                         <br>
                                     </div>
                                    </div>
                                    </form>
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
                                            <th>Auto</th>
                                            <th># inventario</th>
                                            <th>Descripción</th>
                                            <th>Tiempo instalación</th>
                                            <th>Precio</th>
                                            <th>Categoria</th>
                                            <th>Años</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?= $autos_accesorios?>
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
    var anio = "";
    var asignado=document.getElementById('asignado').value;
    var inventario=document.getElementById('inventario').value;
    var instalacion=document.getElementById('instalacion').value;
    var precio=document.getElementById('precio').value;
    var costo_inst=document.getElementById('costo_inst').value;
    var categoria=document.getElementById('categoria').value;
    var descripcion=document.getElementById('descripcion').value;
    //var imagen=document.getElementById('copia_reporte').value;

    if (asignado!="" && inventario!=""&& instalacion!="" && precio!=""&& costo_inst!="" && categoria!=""&& descripcion!="") {
        if (imagen=="") {
            alert('Es necesario seleccionar una imagen.');
            $('.dropzone').css({'cssText': 'border: 2px solid red !important; '});
        } else {
           var param={
	           	asignado:asignado,
                inventario:inventario,
                instalacion:instalacion,
                precio:precio,
                costo_inst:costo_inst,
                categoria:categoria,
                descripcion:descripcion,
                insert: "accesorio"
            }
            $.ajax({
                data:param,
                type:'POST',
                url:'save.php',
                success: function(response){
                    $(".checkAnio:checked").each(function(){
                        anio += $(this).data("anio") + ",";
                    })
                    var res = anio.split(",");
                    var param = {
                        id_accesorio: inventario,
                        anios: res,
                        insert: "anio"
                    };

                    $.ajax({
                        data:param,
                        type:'POST',
                        url:'save.php',
                         success: function(response){
                            location.reload();
                        }
                    });
                    	
                }
            });

        }
            
    } else {
        alert('Campos vacíos!');
    error('#asignado');
    error('#inventario');
    error('#instalación');
    error('#precio');
    error('#costo_inst');
    error('#categoria');
    error('#descripcion');

       
    }
}
  function clickImg(obj){
    var asignado=document.getElementById('asignado').value;
    var inventario=document.getElementById('inventario').value;
    var instalación=document.getElementById('instalación').value;
    var precio=document.getElementById('precio').value;
    var costo_inst=document.getElementById('costo_inst').value;
    var categoria=document.getElementById('categoria').value;
    var descripcion=document.getElementById('descripcion').value;
    if(asignado!="" && inventario!=""&& instalación!="" && precio!=""&& costo_inst!="" && categoria!=""&& descripcion!=""){
    //if(inventario!=""){
    document.getElementById(obj).click();
}else{
    alert('Todos los campos debes esta llenos.');
     error('#inventario');
}
  }

  function updateImg(obj){
    cambiarImagen(obj);
  }

  function cambiarImagen(obj){
    var inventario=document.getElementById('inventario').value;
    
    var fd = new FormData();
    var files = $('#'+obj)[0].files[0];
    fd.append('file',files);
    fd.append('inventario',inventario);
    $.ajax({
      url: 'upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
      	//alert(response);
        if(response != 'ERROR'){
       document.getElementById('return_file').innerHTML=response;
       $('.dropzone').css({'cssText': 'border: none !important;'});
       $('#contresp').css({'cssText': 'display: block !important;'});
        }else{
          alert('Error,intenta de nuevo.');
         document.getElementById('return_file').innerHTML='<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
        }
      }
    });
  }
  function error(obj){
    if($(obj).val()==""){
         $(".bootstrap-select").css({'cssText': 'border-bottom: 1px solid red !important; '});
    }
  }

function cambiarStatus(obj,status){
        obj=obj;
        status=status;
        var param={
                obj:obj,
                status:status
            }
            $.ajax({
                data:param,
                type:'POST',
                url:'status.php',
                 success: function(response){
                    alert(response);
                    location.reload();
                }
            });
    }  
    
   $("#asignado").change(function(){
       var param={
                auto:$('#asignado').val(),
            }
            $.ajax({
                data:param,
                type:'POST',
                url:'getanios.php',
                 success: function(response){
                   //console.log(response);
                   $('#div_anios').html(response)
                }
            });
        });
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

    <!-- Demo Js 
    <script src="../../js/demo.js"></script>-->

</body>

</html>
