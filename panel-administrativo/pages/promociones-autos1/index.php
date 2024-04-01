<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$conne = new Construir();
$autos = $conne->get_table_promociones('nuevos');
$autos_promo= $conne->get_autos_promociones();
//$autos_color= $conne->get_autos_promociones_color();

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
                                <div class="col-md-4"><br>
                                    <b>AUTO ASIGNADO</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <select id="asignado"  class="form-control" name="name" required="" aria-required="true" required>
                                            <option value="" selected  disabled></option>
                                            <?php echo $autos_promo;?>
                                        </select>
                                        <input style="display: none;" id="marca" placeholder="..." value="">
                                        <input style="display: none;" id="anio" placeholder="..." value="">
                                        <input style="display: none;" id="modelo" placeholder="..." value="">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4"><br>
                                    <b>COLOR</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                    	<div id="get_resp">
                                    		<select id="color"  class="form-control" name="name" required="" aria-required="true" required>
                                    			<option value="" selected  disabled></option>
                                    		</select>
                                    	</div>
                                    </div>
                                </div>
                                </div>

                                <div class="col-md-4"><br>
                                    <b>DESCRIPCIÓN</b>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text"  id="titulo_uno"class="form-control" name="name" required="" aria-required="true" placeholder="Esquibe aquí..." required="">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="text-center" style="max-width: 60%; margin: auto;"> <button class="btn btn-primary btn-block" onclick="save();">Guardar</button></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- #END# Color Pickers -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PROMOCIONES AUTOS NUEVOS
                            </h2>
                        </div>
                        <div class="body">
                           <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Auto</th>
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
        </div>
    </section>

<script>

	$(document).ready(function(){
	$(".text").click(function(){
	 var str = $(this).text();
	 
	 var $marca = str.split(",",1);
	 document.getElementById('marca').value = $marca;

	 var $modelo = str.split(",",2)[1];	 
     document.getElementById('modelo').value = $modelo;

	 var $anio = str.split(",",3)[2];
	 document.getElementById('anio').value = $anio;

    get_color($modelo,$anio);

	});

});

 function get_color(ob1,ob2){
 	console.log(ob1,ob2);
param={
obj1:ob1,
obj2:ob2
}
$.ajax({
	url:'change_color.php',
	type:'POST',
	data:param,
	success: function(resp){
		document.getElementById('get_resp').innerHTML='<select id="color"  class="form-control" name="name" required="" aria-required="true" >'+resp+'</select>';
	}
});
 }

  function save(){
  	var marca = document.getElementById('marca').value;
 	var modelo = document.getElementById('modelo').value;
 	var ano = document.getElementById('anio').value;
 	var imagen = document.getElementById('color').value;
 	var titulo_uno = document.getElementById('titulo_uno').value;
 	var tipo ='NUEVOS';
 	var status = 1;
 	if ( marca!="" && modelo!="" && ano!="" && imagen!="" && titulo_uno!="") {
param={
marca:marca,
modelo:modelo,
ano:ano,
imagen:imagen,
titulo_uno:titulo_uno,
tipo:tipo,
status:status
}
$.ajax({
	url:'save_auto.php',
	type:'POST',
	data:param,
	success: function(resp){

	}
});
}else{
	alert('Campos vacios!');
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
