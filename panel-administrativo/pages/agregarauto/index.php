<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");

$this_page = "agregarauto";
if ($this_page=="agregarauto") { $agregarauto="active"; } else{ $agregarauto="active"; }

$conne = new Construir();
$tipos = $conne->get_tipos_autos();
$marcas= $conne->get_lista_marcas();
$modelos= $conne->get_modelos_by_marca($marca);
$colores= $conne->get_lista_colores();
$tabla_autos= $conne->get_tabla_autos();
// $tabla_colores= $conne->get_tabla_colores();
// $queryColores = $conne->query_tabla_colores($auto["slug"]);

// foreach ($queryColores as $key => $value) {
//     $params=base64_encode(json_encode($value));
//     $hiColores.='<tr><td>'.$value["Orden"].'</td><td>'.$value["Modelo"].'</td><td>'.$value["Anio"].'</td><td style=" display: flex;">'.$value["Color"].'<div style=" margin-left:10px; width:20px; heigth: 20px; ; color: '.$value["Hexa"].';background-color: '.$value["Hexa"].';">__</div></td><td><center><div class="btn btn-danger" onclick="deleteButton(\''.$params.'\')">ELIMINAR</div></center></td></tr>';
// }

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

    <!-- Tabs With Icon Title -->

    <section class="content">
        <div class="container-fluid">

                        <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active" onclick="modulo_autos();">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">home</i> NUEVO AUTO
                                    </a>
                                </li>
                                <li role="presentation" onclick="modulo_colores();">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">palette</i> COLORES
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                    <div class=" card row clearfix">
                                    <div class="header">
                                        <h2>
                                            AGREGA UN AUTOMOVIL
                                            <small>Puedes agregar un nuevo carro al catalogo.</small>
                                        </h2>
                                    </div>
                                    <div class="col-md-3"><br>
                                                <b>MARCA</b>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" style="text-transform:uppercase;" id="marca" class="form-control" name="name" required="" aria-required="true" placeholder="Ejemplo: CHEVROLET, GMC, etc ...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"><br>
                                                <b>NOMBRE DEL AUTO</b>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" style="text-transform:uppercase;" id="nombre" class="form-control" name="name" required="" aria-required="true" placeholder="Escribe el nombre del auto ...">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top:20px;">
                                                <b>Año</b>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select id="anio" class="form-control">
                                                            <option value="2024">2024</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2019">2019</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="col-md-3" style="margin-top:20px;">
                                                    <b> TIPO / VERSION </b>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" style="text-transform:uppercase;" id="version" class="form-control" name="name" maxlength="1" minlength="1" aria-required="true" placeholder="Ejemplo: 'A', 'B'...">
                                                    </div>
                                                </div>
                                                </div>
                                        </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                                    <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save();">SUBIR AUTO</button>
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
                                                        CREAR COLOR
                                                        <small>Puedes crear un color para despues agregarlo a un auto.</small>
                                                    </h2>
                                                </div>                       
                                                <div class="body">

                                                    <b> NOMBRE DEL COLOR </b>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" style="text-transform:uppercase;" id="color_name" class="form-control" name="name" aria-required="true" placeholder="Escriba el nombre del color a crear.">
                                                    </div>
                                                </div>

                                                <div id="div-colorpicker">
                                                    <label for="favcolor">Selecciona el color adecuado:</label>
                                                    <input type="color" id="color_hex" name="favcolor" value="#ff0000"><br>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="return_id" hidden=""></div>
                                     <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                                            <button type="button" class="btn btn-primary m-t-5 waves-effect" onclick="save_color();">GUARDAR CAMBIOS</button>
                                        </div>
                                    </div>

                    <div class="row clearfix">
                        <hr>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="card-editor">
                        <div class="header">
                            <h2>
                                ASIGNAR COLOR
                                <small>Puedes asignar un color ya creado al carro que desees.</small>
                            </h2>
                        </div>
                        
                        <div class="col-md-3" style="margin-top:20px;">

                            <b> SELECCIONA LA MARCA: </b>
                            <select id="asignado" class="form-control" name="name" required="" aria-required="true" >
                                <?php echo $marcas;?>
                            </select>
                        </div>

                        <div  id= "divmodelos" class="col-md-3" style="margin-top:20px;">

                            <b> SELECCIONA EL MODELO: </b>
                            <select id="modelo" class="form-control" name="name" required="" aria-required="true" >
                                <option value="" selected  disabled></option>
                            </select>
                        </div>

                        <div class="col-md-3" style="margin-top:20px;">
                            <b>Año</b>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select id="ano" class="form-control">
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="margin-top:20px;">

                            <b> SELECCIONA EL COLOR: </b>
                            <select id="color" class="form-control" name="name" required="" aria-required="true" >
                                <?php echo $colores;?>
                            </select>
                        </div>
                </div>
            </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                    <button type="button" class="btn btn-primary m-t-5 waves-effect" onclick="save_asignacion();">GUARDAR ASIGNACION</button>
                </div>
            </div>
</div>


                                
</div>
</div>
</div>
            <div class="row clearfix">
                <div id="table-autosnuevos" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                AUTOS NUEVOS
                            </h2>
                        </div>
                        <div class="body">
                           
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Año</th>
                                            <th>Version</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $tabla_autos;?>
                                    </tbody>
                                </table>
                                                     
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->

            <div class="row clearfix">
                <div id="table-colores" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" hidden>
                    <div class="card">
                        <div class="header">
                            <h2>
                                COLORES ASIGNADOS
                            </h2>
                        </div>
                        <div class="body">
                           
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Orden</th>
                                            <th>Modelo</th>
                                            <th>Año</th>
                                            <th>Color</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <?= $hiColores;?> -->
                                    </tbody>
                                </table>
                                                     
                        </div>
                    </div>
                </div>
            </div>

            <!-- #END# Tabs With Icon Title -->

        </div>
    </section>


            <!-- ELIMINAR COLOR -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div style="display:flex; justify-content: center;">
        <h5 style="padding-right: 5px; font-size: 2em;" class="modal-title" id="Mmodelo"></h5>  <h5 style="padding-left: 5px; font-size: 2em;" class="modal-title" id="Mano"></h5> <h5 style="padding-left: 5px; font-size: 2em;" class="modal-title" id="Mkey" hidden></h5>
        <input type="text" id="Valmodelo" value="" hidden>
        <input type="text" id="Valano" value="" hidden>
        <input type="text" id="Valcolor" value="" hidden>
        <input type="text" id="Valkey" value="" hidden>
        </div>
        <hr>
      </div>


    <form action="delete_color.php" method="POST" id="formulario" >
      <div class="modal-body">

         <div style="display:flex; justify-content: center;">
            <p style="padding-right: 5px; font-size: 2em;"> ¿Estas seguro de eliminar el color:</p> <p style="padding-left: 5px; font-size: 2em;" id="Mcolor"></p> <p style="font-size: 2em;">?</p>
         </div>
                                          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="deleteColor()" class="btn btn-primary">ELIMINAR</button>
      </div>
       </form>
    </div>
  </div>
</div>

            <!-- ELIMINAR COLOR -->

   
<script>

    //CKEDITOR.replace ("ckeditor");
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
    function save(){
    var marca=  document.getElementById('marca').value;
    var nombre=  document.getElementById('nombre').value;
    var anio=  document.getElementById('anio').value;
    var version=  document.getElementById('version').value;
    //var slug = marca.toLowerCase().'-'.$nombre.toLowerCase().'-'.$anio;
    //$slug = str_replace(' ', '-', $slug);
    //$slug = str_replace('.', '', $slug);
    error('#marca');
    //error('#slug');
    error('#nombre');
    error('#anio');
    error('#version');

    if (marca!="" && nombre!="" && version!="") {
            var param={
                marca:marca,
                nombre:nombre,
                anio:anio,
                version:version
            }

            $.ajax({
                url:'save.php',
                type:'POST',
                data:param,
                success: function(resp){
                    console.log(resp)
                    //alert(resp);
                    //document.getElementById('return_id').innerHTML='<input type="text" id="num_id" value="'+resp+'">';
                	alert("Datos guardados correctamente.");
                    $("#marca").val("");
                    $("#nombre").val("");
                    $("#version").val("");
                    $(".form-line").removeClass("focused");
                	location.reload();
                 }
            })                   
    } else {
        alert('Campos vacíos!');
        location.reload();
    }
}
// SAVE COLOR HTML //
   function save_color(){
    var color_name = document.getElementById('color_name').value;
    var color_hex = document.getElementById('color_hex').value;
    error('#color_name');
    error('#color_hex');

    if (color_name!="" ) {
            
            var param={
                color_name:color_name,     
                color_hex:color_hex
            }
            $.ajax({
                url:'crear_color.php',
                type:'POST',
                data:param,
                success: function(resp){
                    alert(resp);
                    $("#color_name").val("");
                    location.reload();   
                 }
            })    
    } else {
        alert('Campos vacíos!');
    }
}

// SAVE ASIGNACION DE COLOR //
function save_asignacion(){
    var marca = document.getElementById('asignado').value;
    var modelo = document.getElementById('modelo').value;
    var ano = document.getElementById('ano').value;
    var color = document.getElementById('color').value;
    error('#marca');
    error('#modelo');
    error('#ano');
    error('#color');

    if (marca!="" && modelo!="" && ano!="" && color!="" ) {
            
            var param={
                marca:marca,     
                modelo:modelo,
                ano:ano,
                color:color
            }
            $.ajax({
                url:'asignar_color.php',
                type:'POST',
                data:param,
                success: function(resp){
                    alert(resp);
                    //location.reload();   
                 }
            })    
    } else {
        alert('Campos vacíos!');
    }
}

function deleteButton($param){
    $parametros=window.atob($param);
    $parametros=JSON.parse($parametros);
    $("#Mmodelo").html($parametros["Modelo"]);
    $("#Mano").html($parametros["Anio"]);
    $("#Mcolor").html($parametros["Color"]);
    $("#Mkey").html($parametros["Id"]);
    $("#Valmodelo").val($parametros["Modelo"]);
    $("#Valano").val($parametros["Anio"]);
    $("#Valcolor").val($parametros["Color"]);
    $("#Valkey").val($parametros["Id"]);

    $('#editModal').modal('show');

}

function deleteColor(){

    $("#id").val($parametros["id"]);
    var modeloE = document.getElementById('Valmodelo').value;
    var anoE = document.getElementById('Valano').value;
    var colorE = document.getElementById('Valcolor').value;
    var keyE = document.getElementById('Valkey').value;
    error('#Valmodelo');
    error('#Valano');
    error('#Valcolor');
    error('#Valkey');

    if (modeloE!="" && anoE!="" && colorE!="" && keyE!="" ) {
            
            var param={
                modeloE:modeloE,     
                anoE:anoE,
                colorE:colorE,
                keyE:keyE
            }
            $.ajax({
                url:'eliminar_color.php',
                type:'POST',
                data:param,
                success: function(resp){
                    alert(resp);
                    location.reload();   
                 }
            })
            
            $('#editModal').modal('hide');
    } else {
        alert('Campos vacíos!');
    }

}

$("#asignado").change(function(){
    var marca = document.getElementById('asignado').value;
    error('#asignado');
       var param={
                marca:$('#asignado').val(),
            }
            $.ajax({
                data:param,
                type:'POST',
                url:'getmodelos.php',
                 success: function(response){
                   //console.log(response);
                   document.getElementById('divmodelos').innerHTML=response;
                   //$('#div_anios').html(response)
                }
            });
        });

   function modulo_colores(){
    $('#table-colores').show();
    $('#table-autosnuevos').hide();
   };

   function modulo_autos(){
    $('#table-colores').hide();
    $('#table-autosnuevos').show();
   };

// SAVE IMG //
  function clickImg(obj){
    document.getElementById(obj).click();
  }
  function updateImg(obj){
    cambiarImagen(obj);
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
