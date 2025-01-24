<?php  
	require_once("../../_inc/_config.php");
	include("../../_inc/constructor.php");

	$this_page = "unidades";
	$this_subpage = "nuevos";
	if ($this_page=="unidades") { $unidades="active"; } else{ $unidades="active"; }
	if ($this_subpage=="nuevos") { $nuevos="active"; } else{ $nuevos="active"; }

	$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
	$sql = 'SELECT * FROM catalogo WHERE ano IN("2019","2020","2021","2022","2023","2024","2025") GROUP BY modelo,ano ORDER BY modelo';
	$resultQuery = $conn->query($sql);
	if ($resultQuery->num_rows > 0) {
	   while($row = $resultQuery->fetch_assoc()) {
        if ($row["marca"]=="CHEVROLET") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-chevy.png";
        }else if ($row["marca"]=="BUICK") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-buick.png";
        }else if ($row["marca"]=="CADILLAC") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-cadillac.png";
        }else if ($row["marca"]=="GMC") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-gmc.png";
        }else if ($row["marca"]=="NISSAN") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-nissan.png";
        }
	   	if($row["ano"]=="2018"){
	   		$nuevosCadena.='
	   		<tr onclick="abrirAuto(\''.$row["id"].'\')" style="background-color:#d8d8d8;">
	   		<td>'.$row["modelo"].'</td>
            <td>'.$row["ano"].'</td>
            </tr>';
	   	}else{
	   		$nuevosCadena.='<tr onclick="gopage(\''.$row["id"].'\')">';
            $nuevosCadena.='<td><img src="'.$img_marca.'" width="50" height="50"/></td>';
            $nuevosCadena.='<td>'.$row["modelo"].'</td>';
            $nuevosCadena.='<td>'.$row["ano"].'</td>';
            $nuevosCadena.='<td><form method="GET" action="'.URLP.'pages/detalles-nuevos/index.php"><input type="text" hidden="" name="id" value="'.$row["id"].'"/><input type="submit" class="btn btn-primary" style="border-radius: 7px;" value="Ver Automóvil"></form></td>';
            $nuevosCadena.='</tr>';
	   	}
	   }

	}
/*
$sql = 'SELECT marca FROM inventario_nuevos GROUP BY marca ORDER BY marca';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
        if ($row["marca"]=="CHEVROLET") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-chevy.png";
        }else if ($row["marca"]=="BUICK") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-buick.png";
        }else if ($row["marca"]=="CADILLAC") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-cadillac.png";
        }else if ($row["marca"]=="GMC") {
            $img_marca="https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/icon-gmc.png";
        }
        $marcas.='<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="../../images/image-gallery/3.jpg" data-sub-html="Demo Description">
                                        <div class="card profile-card">
                        <div class="profile-header" style="background-color:#fff;">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="'.$img_marca.'" alt="AdminBSB - Profile Image" style="border:none;">
                            </div>
                            <div class="content-area">
                                <p>'.$row["marca"].'</p>
                            </div>
                        </div>
                        <div class="profile-footer">
                            <button class="btn btn-primary btn-lg waves-effect btn-block">ENTRAR</button>
                        </div>
                    </div>
                    </a>
                    </div>';
       }

    }
*/



$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
   <?php include('../../_inc/_header.php');?>
    <link rel='icon' type='image/png' href='https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://d3s2hob8w3xwk8.cloudfront.net/assets/img/commun/gporiv.png' />

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
                                REPORTE
                                
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr> 
                                            <th>MARCA</th>
                                            <th>MODELO</th>
                                            <th>AÑO</th>
                                            <th>VER</th>
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
        function gopage($i){
            location.href="<?=URLP?>pages/detalles-nuevos/index.php?id="+$i;
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