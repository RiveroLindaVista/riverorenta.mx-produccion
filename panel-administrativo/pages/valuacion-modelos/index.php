<?php  
	require_once("../../_inc/_config.php");
	include("../../_inc/constructor.php");

	$this_page = "unidades";
	$this_subpage = "nuevos";
	if ($this_page=="unidades") { $unidades="active"; } else{ $unidades="active"; }
	if ($this_subpage=="nuevos") { $nuevos="active"; } else{ $nuevos="active"; }

	$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
	$sql = 'SELECT * FROM autometrica_modelos GROUP BY marca,modelo,ano ORDER BY marca asc';
	$resultQuery = $conn->query($sql);
	if ($resultQuery->num_rows > 0) {
	   while($row = $resultQuery->fetch_assoc()) {
	   		$nuevosCadena.='<tr onclick="gopage(\''.$row["marca"].'\', \''.$row["modelo"].'\')">';
            $nuevosCadena.='<td>'.$row["marca"].'</td>';
            $nuevosCadena.='<td>'.$row["modelo"].'</td>';
            $nuevosCadena.='<td><input class="btn bg-primary" type="button" style="border-radius: 7px;color:white;" value="Ver Años"></td>';
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
                        <div class="header">
                            <h2>
                                MODELOS VALUACIÓN
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example-asc tablaSuper">
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
    	</div>
    </section>
    <script>
        $(document).ready(function () {
            $('#tablaSuper').DataTable({

                order: [[0, 'asc']],
                aLengthMenu: [
                    [10,25, 50, 100, -1],
                    [10,25, 50, 100, "Todas"]
                ],
                iDisplayLength: -1,  language: {
                    lengthMenu: "Mostrar: _MENU_",
                    entries: {
                        _: 'Solicitudes',
                        1: 'solicitud'
                    },
                    info: 'Mostrando _PAGE_ de _PAGES_',
                }
            });
        });

        function gopage($i){
            location.href="<?=URLP?>pages/detalles-planes-nissan/index.php?id="+$i;
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