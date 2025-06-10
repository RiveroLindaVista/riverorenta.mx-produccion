<?php  
	require_once("../../_inc/_config.php");
	include("../../_inc/constructor.php");

	$this_page = "valuacion_modelos";
	if ($this_page=="valuacion_modelos") { $valuacion_modelos="active"; } else{ $valuacion_modelos="active"; }

	$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
	$sql = 'SELECT * FROM autometrica_modelos GROUP BY marca,modelo ORDER BY marca asc';
	$resultQuery = $conn->query($sql);
	if ($resultQuery->num_rows > 0) {
	   while($row = $resultQuery->fetch_assoc()) {
	   		$nuevosCadena.='<tr onclick="verModelos(\''.$row["id"].'\',\''.$row["marca"].'\', \''.utf8_encode($row["modelo"]).'\')">';
            $nuevosCadena.='<td>'.$row["marca"].'</td>';
            $nuevosCadena.='<td>'.utf8_encode($row["modelo"]).'</td>';
            $nuevosCadena.='<td><input class="btn bg-primary" type="button" style="border-radius: 7px;color:white;" value="Ver Años" onclick="verModelos(\''.$row["id"].'\',\''.$row["marca"].'\', \''.utf8_encode($row["modelo"]).'\')"></td>';
            $nuevosCadena.='</tr>';
	   }

	}

$conn->close();

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
 
    </section>
    <section class="content">
    	<div class="container-fluid">
    		 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header d-flex">
                            <h2>
                                MODELOS VALUACIÓN
                            </h2>
                            <button type="button" class="btn bg-success mt-3" onclick="openModalFaltantes()"><i class="material-icons">add</i>Agregar Auto</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example-asc tablaSuper no-footer">
                                    <thead>
                                        <tr> 
                                            <th>MARCA</th>
                                            <th>MODELO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $nuevosCadena;?>
                                    </tbody>
                                </table>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            
            
                <!-- Modal de edicion Imagen -->
                <div class="modal fade bs-example-modal-lg" id="modal-edit-modelo" name="modal-edit-modelo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modelos</h4>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div id="tablaArea" style="text-align:center">
                                    </div>
                                </div>
                                <hr/>
                                <div>
                                    <div id="tablaAreaNuevo" style="text-align:center">
                                        <p>Agregar nuevo año</p>
                                        <input type="text" id="marca1" hidden />
                                        <input type="text" id="modelo1" hidden />
                                        <table class="table table-bordered table-striped table-hover no-footer">
                                            <thead><th>AÑO</th><th>TIPO</th><th>OPCIÓN</th></thead>
                                            <tbody><tr><td><input type="number" id="newAno" /></td><td><select id="tipoModeloNuevo"><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option></select></td><td><input class="btn bg-success" type="button" style="border-radius: 7px;background-color:green;color:white;" value="GUARDAR" onclick="saveNuevoModelo()" /></td></tr>
                                                    <tr id="logModal" hidden><td id="mensajeModal" colspan="3">Prueba</td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal de edicion de inventarios versiones -->

                <!-- Modal de nuevo modelo -->
                <div class="modal fade bs-example-modal-lg" id="modal-nuevo-modelo" name="modal-nuevo-modelo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modelos</h4>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div id="tabla_nuevo_auto" style="text-align:center">
                                        <p>Agregar nuevo modelo</p>
                                        <table class="table table-bordered table-striped table-hover no-footer">
                                            <thead><th></th><th></th></thead>
                                            <tbody><tr><td>MARCA</td><td><input type="text" id="marca_nuevo" /></td></tr>
                                                    <tr><td>MODELO</td><td><input type="text" id="modelo_nuevo" /></td></tr>
                                                    <tr><td>AÑO</td><td><input type="number" id="ano_nuevo" /></td></tr>
                                                    <tr><td>TIPO</td><td><select id="tipo_nuevo"><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option></select></td></tr>
                                                    <tr><td colspan="2"><input class="btn bg-success" type="button" style="border-radius: 7px;background-color:green;color:white;" value="GUARDAR" onclick="saveNuevoAuto()" /></td></tr>
                                                    <tr id="log_nuevo_Modal" hidden><td id="mensaje_nuevo_Modal" colspan="3">Prueba</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal de nuevo modelo -->

                <!-- Modal de nuevo modelo -->
                <div class="modal fade bs-example-modal-lg" id="modal-faltantes" name="modal-faltantes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modelos Faltantes</h4>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <div id="tabla_faltantes" style="text-align:center">
                                        <p class="text-faltantes">Revisando modelos faltantes</p>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal de nuevo modelo -->

    	</div>
    </section>
    <script>
        $(document).ready(function() {
            $.ajax({
                url:'get_faltantes.php',
                type:'POST',
                success: function(resp){
                    let info = JSON.parse(resp);
                    console.log(info);
                    let $tabla_modelos = '<table class="table table-bordered table-striped table-hover no-footer"><thead><th>MARCA</th><th>MODELO</th><th>AÑO</th><th>TIPO</th></thead><tbody>';
                    for (let i = 0; i < info.length; i++) {

                        $tabla_modelos+='<tr><td>'+info[i].marca+'</td><td>'+info[i].modelo+'</td><td>'+info[i].year+'</td><td><select id="tipoModelo" onchange="changeTipoFaltante(this.value,';
                        $tabla_modelos+="'"+info[i].marca+"','"+info[i].modelo+"','"+info[i].year+"'";
                        $tabla_modelos+=')"><option value="0" selected></option><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option></select></td></tr>';

                    }
                    $tabla_modelos+='</tbody></table>';

                    $("#tabla_faltantes").html($tabla_modelos);

                }
            })
        });

        function gopage($i){
            location.href="<?=URLP?>pages/detalles-planes-nissan/index.php?id="+$i;
        }

        function verModelos(id,marca,modelo){

            $("#modal-edit-modelo").modal('show');
            $("#marca1").val(marca);
            $("#modelo1").val(modelo);
            var param={id:id, marca:marca, modelo:modelo};

            $.ajax({
                url:'get_modelos.php',
                type:'POST',
                data:param,
                success: function(resp){
                    console.log(resp);
                    document.getElementById('tablaArea').innerHTML= resp;
/*                     idElement = 'desc'+id; 
                    document.getElementById(idElement).innerHTML= '<i onclick="editDesc(\''+descripcion+'\','+id+')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i>'+descripcion;
                    $("#modal-edit-desc").modal('hide'); */
                }
            })

/*             document.getElementById('imgArea').innerHTML='<label for="">Imagen Actual de la Promocion</label><br/><img src = "https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/nuevos/'+nombre+'.jpg" style="max-width: 300px;">';
            console.log(nombre+'_1'); */
        }

        function saveNuevoModelo(){
            let yearNew = $("#newAno").val();
            let tipoModeloNuevo = $("#tipoModeloNuevo").val();
            let marca = $("#marca1").val();
            let modelo = $("#modelo1").val();

            if(yearNew.length != 4){
                alert('Año no válido.');
                return 0;
            }

            var param={ano:yearNew, tipo:tipoModeloNuevo, marca:marca, modelo:modelo};
            console.log(param);

            $.ajax({
                url:'check_modelos.php',
                type:'POST',
                data:param,
                success: function(resp){
                    console.log(resp);

                    if(resp== 1){
                        $("#logModal").attr('hidden', false);
                        document.getElementById('mensajeModal').innerHTML= '<p style="background-color:#f3abab;color:#850000;">Ya existe el modelo.</p>';
                        setTimeout(() => {
                            $("#logModal").attr('hidden', true);
                        }, 2000);
                    } else {
                        $("#logModal").attr('hidden', false);
                        document.getElementById('mensajeModal').innerHTML= '<p style="background-color:#acdcbc;color:#276d40;">Guardando...</p>';
                        setTimeout(() => {
                            $("#logModal").attr('hidden', true);
                            location.reload();
                        }, 2000);
                    }
                    
                }
            });
        }

        function saveNuevoAuto(){
            let year = $("#ano_nuevo").val();
            let tipoModeloNuevo = $("#tipo_nuevo").val();
            let marca = $("#marca_nuevo").val();
            let modelo = $("#modelo_nuevo").val();

            marca= marca.trimEnd();
            marca= marca.trimStart();

            modelo= modelo.trimEnd();
            modelo= modelo.trimStart();

            var param={ano:year, tipo:tipoModeloNuevo, marca:marca.toUpperCase(), modelo:modelo.toUpperCase()};

            console.log(param);
            $.ajax({
                url:'nuevo_modelo.php',
                type:'POST',
                data:param,
                success: function(resp){
                    //location.reload();

                    if(resp== 1){
                        $("#log_nuevo_Modal").attr('hidden', false);
                        document.getElementById('mensaje_nuevo_Modal').innerHTML= '<p style="background-color:#f3abab;color:#850000;">Ya existe el modelo.</p>';
                        setTimeout(() => {
                            $("#log_nuevo_Modal").attr('hidden', true);
                        }, 2000);
                    } else {
                        $("#log_nuevo_Modal").attr('hidden', false);
                        document.getElementById('mensaje_nuevo_Modal').innerHTML= '<p style="background-color:#acdcbc;color:#276d40;">Guardando...</p>';
                        setTimeout(() => {
                            $("#log_nuevo_Modal").attr('hidden', true);
                            location.reload();
                        }, 1500);
                    }
                }
            });
        }

        function changeTipo(tipo,id){
            console.log(tipo);
            var param={id:id, tipo:tipo};
            $.ajax({
                url:'change_tipo.php',
                type:'POST',
                data:param,
                success: function(resp){
                    //location.reload();
                }
            });
        }

        function changeTipoFaltante(tipo,marca, modelo, ano){

            if(tipo != 0 || tipo != "0"){
                console.log(tipo);
                var param={tipo:tipo, marca:marca, modelo:modelo, ano:ano};
                $.ajax({
                    url:'change_tipo_faltante.php',
                    type:'POST',
                    data:param,
                    success: function(resp){
                        //location.reload();
                    }
                });
            }

        }

        function borrarModelo(id){
            var param={id:id};
            $.ajax({
                url:'delete_modelo.php',
                type:'POST',
                data:param,
                success: function(resp){
                    location.reload();
                }
            });
        }

        function openModalNuevoModelo(){
            $("#modal-nuevo-modelo").modal('show');
        }

        function openModalFaltantes(){
            $("#modal-faltantes").modal('show');
        }

    </script>

    <style>
        .text-faltantes{
            animation: slidein-p 2s infinite ease-out;
        }

        @keyframes slidein-p {
            0% {
            transform: translateY(0px) translateX(0px);
            }
            50% {
            transform: translateX(0px);
            }
            75% {
            transform: translateX(10px);
            }
            100% {
            transform: translateX(0px) translateY(0px);
            }
        }

    </style>

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