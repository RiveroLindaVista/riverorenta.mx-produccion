<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$this_page = "unidades";
$this_subpage = "nuevos";
if ($this_page == "unidades") {
    $unidades = "active";
} else {
    $unidades = "active";
}
if ($this_subpage == "nuevos") {
    $nuevos = "active";
} else {
    $nuevos = "active";
}
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);

$conne = new Construir();
// $marcas = $conne->get_lista_marcas();
$colores = $conne->get_lista_colores();

$sql = 'SELECT * FROM catalogo WHERE id="' . $_GET["id"] . '"';
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while ($row = $resultQuery->fetch_assoc()) {
        $auto = $row;
    }
}

$queryColores = $conne->query_tabla_colores($auto["slug"]);
foreach ($queryColores as $key => $value) {
    $params = base64_encode(json_encode($value));
    $hiColores .= '<tr><td>' . $value["Orden"] . '</td><td>' . $value["Modelo"] . '</td><td>' . $value["Anio"] . '</td><td style=" display: flex;">' . $value["Color"] . '<div style=" margin-left:10px; width:20px; heigth: 20px; ; color: ' . $value["Hexa"] . ';background-color: ' . $value["Hexa"] . ';">__</div></td><td><center>  <div class="btn btn-success" onclick="openaModalImagen(\'' . $params . '\')">AÑADIR IMAGEN</div>  <div class="btn btn-danger" onclick="deleteButton(\'' . $params . '\')">ELIMINAR</div></center></td></tr>';
}


$slide = 0;



$auto["nombre"] = $auto["modelo"];
$auto["url"] = str_replace(' ', '-', strtolower($auto["modelo"]) . '-' . $auto["ano"]);
$auto["path"] = $auto["marca"] . '/' . $auto["url"];


/**ya no se tomara ni cargara imagen a la carpeta perfomance if (strstr($auto["modelo"], "CAMARO") || strstr($auto["modelo"], "CORVETTE")) {
    $auto["marca"] = "performance";
} **/

/*if($auto["modelo"]=="C-35"){
      $auto["nombre"]="SILVERADO 3500";
      $auto["url"]='c-35-'.$auto["ano"];
      $auto["path"]=$auto["marca"].'/'.$auto["url"];
    }
    if($auto["modelo"]=="C-20"){
      $auto["nombre"]="SILVERADO 2500";
      $auto["url"]='c-20-'.$auto["ano"];
      $auto["path"]=$auto["marca"].'/'.$auto["url"];
    }


    if($auto["modelo"]=="C-20 CREW"){
      $auto["nombre"]="CHEYENNE";
      $auto["url"]='c-20-crew-'.$auto["ano"];
      $auto["path"]=$auto["marca"].'/'.$auto["url"];
    }*/

$sqlColores = 'SELECT t1.id,t1.ano,t1.color as nombre ,t2.color FROM inventario_colores t1 left join colores_hex_inventario t2 on t1.color=t2.nombre WHERE t1.modelo="' . $auto["modelo"] . '" and t1.ano="' . $auto["ano"] . '"';
$resultQueryColores = $conn->query($sqlColores);
if ($resultQueryColores->num_rows > 0) {
    while ($row = $resultQueryColores->fetch_assoc()) {
        $nombre = str_replace(' ', '-', strtolower($auto["modelo"]) . '-' . $auto["ano"]);
        

        // $autoColoresDelete .= '<tr><td>' . $row["nombre"] . '</td><td>' . $row["color"] . '</td><td><div class="colorP" style="background-color:' . $row["color"] . ';"></div></td><td><label class="btnEliminar" onclick="eliminarColor(' . $row['id'] . ')">ELIMINAR</label></td></tr>';
        $param_color['Color']=$row['nombre'];
        if ($slide == 1) {
            $autoColoresIndicators .= '<li data-target="#carousel-example-generic_2" data-slide-to="' . $slide . '" style=" height: 20px; width: 20px; background-color:' . $row["color"] . '"></li>';
            $autoColores .= '
	                <div class="item active">
	                    <img class="imgautos" onerror="funconerror(this)" src="https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . strtolower($auto["marca"]) . '/' . $auto["url"] . '/colores/' . str_replace(' ', '-', $row["nombre"]) . '.png" />
	                    <div class="carousel-caption">
	                        <h3>' . $row["nombre"] . ' ' . $row["color"] . '</h3>
	                        <div class="btn btn-success" style="border-radius: 7px;" onclick="openaModalImagen(\'' . base64_encode(json_encode( $param_color)) . '\')">AGREGAR
	                        </div>
	                    </div>
	                </div>';
        } else {
            $autoColoresIndicators .= '<li data-target="#carousel-example-generic_2" data-slide-to="' . $slide . '" style=" height: 20px; width: 20px; background-color:' . $row["color"] . '"></li>';

            $autoColores .= '
                <div class="item">
                    <img class="imgautos" onerror="funconerror(this)" src="https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . strtolower($auto["marca"]) . '/' . $auto["url"] . '/colores/' . str_replace(' ', '-', $row["nombre"]) . '.png" />
                    <div class="carousel-caption">
                        <h3>' . $row["nombre"] . ' ' . $row["color"] . '</h3>
                        <div class="btn btn-success" style="border-radius: 7px;" onclick="openaModalImagen(\'' . base64_encode(json_encode( $param_color)) . '\')">AGREGAR IMAGEN
                        </div>
                    </div>
                </div>';
        }

        //$autoColores.='<tr><td>'.$row["nombre"].'</td><td>'.$row["color"].'</td><td><div class="colorP" style="background-color:'.$row["color"].';"></div></td><td><label class="btnEliminar" onclick="eliminarColor('.$row['id'].')">ELIMINAR</label></td></tr>';
        $slide++;
    }
}

//$sqlVersiones = 'SELECT t1.id,t3.marca,t3.modelo,3.ano,t3.tipo,t3.precio,t1.transmision,t1.tipo_vehiculo,t2.version,t2.id as version_id FROM inventario_nuevos t1 left join versiones t2 on t1.modelo=t2.modelo and t1.ano=t2.ano left join catalogo t3 on t2.tipo= t3.tipo and t2.modelo=t3.modelo and t2.ano=t3.ano  WHERE t3.modelo="'.$auto["modelo"].'" and t3.ano="'.$auto["ano"].'" GROUP BY t3.tipo';
/** $sqlVersiones = 'SELECT t1.id,t1.marca,t1.modelo,t1.ano,t1.tipo,t1.precio, t2.version, t2.id as version_id,ti.transmision FROM catalogo t1 left join versiones t2 on t1.modelo=t2.modelo and t1.ano=t2.ano and t1.tipo=t2.tipo left join inventario_nuevos ti on t1.modelo=ti.modelo and t1.ano=ti.ano WHERE t1.modelo="'.$auto["modelo"].'" and t1.ano="'.$auto["ano"].'"  GROUP BY t1.tipo';
	$resultQueryV = $conn->query($sqlVersiones);
		if ($resultQueryV->num_rows > 0) {
		   while($row = $resultQueryV->fetch_assoc()) {
		   		$autoV.='<tr><td>'.$row["marca"].'</td>
		   		<td>'.$row["modelo"].'</td><td>'.$row["ano"].'</td><td>'.$row["tipo"].'</td><td>'.$row["version"].'</td><td>'.$row["transmision"].'</td>';
		   		$autoV.='<td>';
		   		$arrayTipo=["","Autos","Suv","PickUp","Vans","Deportivos","Eléctricos"];
		   		$autoV.=$arrayTipo[$row["tipo_vehiculo"]].'</td>';
		   		$autoV.='<td>$ <input value="'.$row["precio"].'" class="inputText" style="width:100px" onkeydown="return runScriptPrecio(event,'.$row['id'].',this)"/></td><td><label class="btn btn-danger" style="border-radius: 7px;" onclick="eliminarVersion('.$row['id'].')">ELIMINAR</label></td></tr>';
		   		$versiones[]=$row["version_id"];
		   		$versionesNom[]=$row["version"];
		 
		   }

		}
 */

$sqlCom = 'SELECT * FROM versiones_comparativa WHERE modelo="' . $auto["modelo"] . ' ' . $auto["ano"] . '" ORDER BY orden';
$resultQueryCom = $conn->query($sqlCom);
if ($resultQueryCom->num_rows > 0) {
    while ($row = $resultQueryCom->fetch_assoc()) {
        $orden = $row["orden"];
        $autoCom .= '<tr>
		   		<td width="300">' . utf8_encode($row["nombre"]) . '</td><td><input type="TEXT" value="' . $row["orden"] . '" class="form-control" onkeydown="return runScriptOrden(event,' . $row['id'] . ',this)"/></td>';
        for ($i = 0; $i < count($versiones); $i++) {
            $sqlComVersiones = 'SELECT valor FROM versiones_relacion WHERE version_id="' . $versiones[$i] . '" and comparativa_id="' . $row['id'] . '"';
            $resultQueryComVersiones = $conn->query($sqlComVersiones);
            $resultQueryComVersiones = $resultQueryComVersiones->fetch_assoc();

            $autoCom .= '<td><input type="TEXT" class="form-control" onkeydown="return runScript(event,this,' . $versiones[$i] . ',' . $row['id'] . ')" value="' . utf8_encode($resultQueryComVersiones['valor']) . '"/></td>';
        }

        $autoCom .= '<td ><div class="btn btn-danger" onclick="eliminarComparativa(' . $row['id'] . ')">ELIMINAR</div></td></tr>';
    }
}
//TECNOLOGIA
$sqlCom = 'SELECT * FROM inventario_tecnologia WHERE modelo="' . $auto["modelo"] . '" ';
$resultQueryCom = $conn->query($sqlCom);
if ($resultQueryCom->num_rows > 0) {
    while ($row = $resultQueryCom->fetch_assoc()) {
        $autoTecnologia .= '<tr>';
        $autoTecnologia .= '<td>' . $row["ano"] . '</td>';
        $autoTecnologia .= '<td>' . $row["tecnologia"] . '</td>';
        $autoTecnologia .= '<td>' . $row["tipo"] . '</td>';
        $autoTecnologia .= '<td><button id="btn" class="btn btn-danger" onclick="borrarElemento(' . $row["id"] . ')">BORRAR</button></td>';
        $autoTecnologia .= '</tr>';
    }
}
//ACCESORIOS
$sqlCom = 'SELECT * FROM accesorios WHERE auto="' . $auto["modelo"] . '" ';
$resultQueryCom = $conn->query($sqlCom);
if ($resultQueryCom->num_rows > 0) {
    while ($row = $resultQueryCom->fetch_assoc()) {
        $autoAccesorios .= '<tr>';
        $autoAccesorios .= '<td>' . $row["descripcion"] . '</td>';
        $autoAccesorios .= '<td>' . $row["categoria"] . '</td>';
        $autoAccesorios .= '<td>' . $row["num_inventario"] . '</td>';
        $autoAccesorios .= '<td>' . $row["tiempo_instalacion"] . '</td>';
        $autoAccesorios .= '<td>' . $row["precio"] . '</td>';
        $autoAccesorios .= '<td>' . $row["status"] . '</td>';
        $autoAccesorios .= '<td><button id="btn" class="btn btn-danger" onclick="borrarAccesorio(' . $row["id"] . ')">BORRAR</button></td>';
        $autoAccesorios .= '</tr>';
    }
}





$conn->close();
$orden = $orden + 10;

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <?php include('../../_inc/_header.php'); ?>
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

    <!-- Sweetalert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!-- <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"> -->


</head>

<body class="theme-blue">
    <!-- #Top Bar -->
    <?php include('../../_inc/_search-bar.php'); ?>
    <!-- #Menu -->
    <section>
        <?php include('../../_inc/_menu.php'); ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <? //include('../../_inc/_gadgets.php');
        ?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <!-- With Captions -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active" onmousedown="mouse_modulo_colores(1)" onclick="modulo_colores();">
                        <a id="li_modulo_colores" href="#tab_imagenes" data-toggle="tab">
                            <i class="material-icons">palette</i> IMAGENES
                        </a>
                    </li>
                    <li  role="presentation" onmousedown="mouse_modulo_asignar_color(1)" onclick="modulo_asignar_color();">
                        <a id="li_modulo_asignar_color" href="#tab_asignar_color" data-toggle="tab">
                            <i class="material-icons">palette</i> ASIGNAR COLOR
                        </a>
                    </li>
                    <li role="presentation" onclick="modulo_invver();">
                        <a id="li_modulo_invver" href="#tab_invver" data-toggle="tab">
                            <i class="material-icons">home</i> VERSIONES
                        </a>
                    </li>
                    <li role="presentation" onclick="modulo_imagenes_versiones();">
                        <a id="li_modulo_imagenes_versiones" href="#tab_imagenes_versiones" data-toggle="tab">
                            <i class="material-icons">web</i> IMAGENES DE VERSIONES
                        </a>
                    </li>
                    <li role="presentation" onclick="modulo_portadas_web();">
                        <a id="li_modulo_portadas_web" href="#tab_portadas_web" data-toggle="tab">
                            <i class="material-icons">web</i> PORTADA WEB
                        </a>
                    </li>
                    <li role="presentation" onclick="modulo_portadas_mobile();">
                        <a id="li_modulo_portadas_mobile" href="#tab_portadas_mobile" data-toggle="tab">
                            <i class="material-icons">phone_android</i> PORTADA MOBILE
                        </a>
                    </li>



                </ul>

                <!-- ASIGNAR PORTADAS WEB -->
                <div role="tabpanel" class="tab-pane fade" id="tab_portadas_web">
                    <!-- CKEditor -->
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <small>Portadas para el ambiente web</small>
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="row" id="row_btns_portada_web">
                                        <!-- by jquery -->
                                    </div>
                                    <div class="row" >
                                        <div class="container-fluid" id="div_row_portada_web">
                                            <!-- by jquery -->
                                        </div>
                                    </div>                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ASIGNAR PORTADAS MOBILE -->
                <div role="tabpanel" class="tab-pane fade" id="tab_portadas_mobile">
                    <!-- CKEditor -->
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h5>Portadas para el ambiente mobile</h5>
                                </div>
                                <div class="body">
                                    <h4>Portadas</h4>
                                    <div class="row" id="row_btns_portada_mobile">
                                        <!-- by jquery -->
                                    </div>
                                    <div id="div_cargar_fondo">
                                        <!-- by jquery -->
                                    </div>
                                    <hr style="border-bottom:solid 1px rgb(176, 187, 195);">
                                    <div class="row" >
                                        <div class="container-fluid" id="div_row_portada_mobile">
                                            <!-- by jquery -->
                                        </div>
                                    </div>                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div role="tabpanel" class="tab-pane fade in active" id="tab_imagenes">
                    <div class=" card row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2> <?= strtoupper($auto["marca"]) ?> <strong>
                                            <?= $auto["nombre"] . ' ' . $auto["ano"] ?>
                                        </strong></h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="javascript:void(0);">Action</a></li>
                                                <li><a href="javascript:void(0);">Another action</a></li>
                                                <li><a href="javascript:void(0);">Something else here</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel" style="background: black;">
                                        <!-- Indicators -->
                                        

                                        <center>
                                        <div class="carousel-inner" role="listbox">
                                            <?= $autoColores ?>
                                        </div>
                                        
                                        </center>
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>

                                    </div>
                                    <ol class="carousel-indicators" style="z-index: 10;">
                                        <?= $autoColoresIndicators ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- #END# With Captions -->

                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab_invver">
                    <!-- CKEditor -->
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        VERSIONES
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="card-inside-title">
                                        <div class="row clearfix">
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" placeholder="SLUG" id="nn_slug" disabled />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" placeholder="Versión ej. LS, LTZ" id="nn_version" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" placeholder="Descripcion ej. Rines 18, cargador" id="nn_metavalue" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12" style="display: flex;">
                                                <div class="form-line" style="width: 70%;">
                                                    <select id="nn_icono" onchange="select_nn_icono()" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="form-line" style="width: 30%; display: flex; align-items: center; justify-content: center; border: 1px rgb(243, 243, 243) solid;">
                                                    <!-- <button class="" style="width: 100%; border: 0px transparent;"> -->
                                                        <img id="nn_img_icon" src="" style="width: 25px; height: 25px; margin-right: 17px; margin-left: 14px;">
                                                    <!-- </button> -->
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-line" align="center">
                                                    <div class="btn btn-primary" style="border-radius: 7px;" onclick="save_inv_versions()">AGREGAR</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="tbl-inv-versiones" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>VERSION</th>
                                                    <th>DESCRIPCION</th> <!--metavalue -->
                                                    <th>ICONO</th>
                                                    <th>ORDEN</th>
                                                    <th>FECHA</th>
                                                    <th>ACCIÓN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- result -->


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Comparativa-->
                        <!-- Modal de edicion de inventarios versiones -->
                        <div class="modal fade bs-example-modal-lg" id="modal-edit-invver" name="modal-edit-invver" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Versiones</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <div>
                                                <input id="ctrl-id" type="hidden">
                                            </div>
                                            <div>
                                                <label for="">Descripcion</label>
                                                <input id="ctrl-metavalue" class="form-control" type="text">
                                            </div>
                                            <div>
                                                <label for="">Icono</label>
                                                <select id="ctrl_icono" class="form-control" name="ctrl_icono">

                                                </select>

                                            </div>
                                            <div>
                                                <label for="">Orden</label>
                                                <input id="ctrl-orden" class="form-control" type="text">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" onclick="update_invver()">Guardar cambios</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- ASIGNAR COLOR -->
                <div role="tabpanel" class="tab-pane fade" id="tab_asignar_color">
                    <!-- CKEditor -->
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <small>Puedes crear un color para despues agregarlo a un auto.</small>
                                    </h2>
                                </div>
                                <div class="body">
                                <div class="card-inside-title">
                                    <div class="col-3" style="margin-top:20px;">

                                        <b> SELECCIONA LA MARCA: </b>
                                        <input id="asignado" name="modelo" class="form-control" type="text" disabled>
                                        <!-- <select id="asignado" class="form-control" name="name" required="" aria-required="true">
                                            <?php echo $marcas; ?>
                                        </select> -->
                                    </div>

                                    <div id="divmodelos" class="col-3" style="margin-top:20px;">

                                        <b> SELECCIONA EL MODELO: </b>
                                        <!-- <select  class="form-control" name="name" required="" aria-required="true">
                                            <option value="" selected disabled></option>
                                        </select> -->
                                        <input id="modelo" name="modelo" class="form-control" type="text" disabled>
                                    </div>

                                    <div class="col-3" style="margin-top:20px;">
                                        <b>AÑO</b>
                                        <input type="text" id="ano" class="form-control" disabled>
                                        <div class="form-group form-float">
                                            <!-- <div class="form-line">
                                                <select id="ano" class="form-control">
                                                    <option value="2024">2024</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11" style="">

                                        <b> SELECCIONA EL COLOR: </b>
                                        <select id="color" class="form-control" name="name" required="" aria-required="true">
                                            <?php echo $colores; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" >
                                    <br>
                                        <label type="color" id="input-color" class="form-control">
                                    </div>
                                    </div>
                                    

                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                                        <button type="button" class="btn btn-primary m-t-5 waves-effect" onclick="save_asignacion();">GUARDAR ASIGNACION</button>
                                    </div>
                                </div>


                                
                                <div class="row clearfix">
                                        <div id="table-colores" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2>
                                                        COLORES ASIGNADOS
                                                    </h2>
                                                </div>
                                                <div class="body">

                                                    <table id="tbl_colores_asignados" class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                                                            <?= $hiColores; ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- IMAGENES DE VERSIONES -->
                <div role="tabpanel" class="tab-pane fade" id="tab_imagenes_versiones">
                    <!-- CKEditor -->
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h4>IMAGENES DE VERSIONES</h4>
                                </div>
                                <div class="body">

                                    <!-- <div id="div_cargar_fondo">
                                            by jquery
                                    </div> -->
                                    <hr style="border-bottom:solid 1px rgb(176, 187, 195);">
                                    <div class="row" >
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Elige una version</h4>
                                                    <div class="row"  style="background: rgb(224, 224, 224); padding: 15px; display: flex; align-items: center; justify-content: center;">
                                                        <div id="row_btns_list-versions" style="display: block; width: auto;">

                                                        </div>
                                                        <!-- by jquery -->
                                                    </div>

                                                    <div class="" style="display: flex; align-items: center; justify-content: center;">
                                                        <h4>Imagen de version especifico</h4>
                                                    </div>
                                                    <div class="card">
                                                        <div id="div_img_versiones" style="display: flex; align-items: center; justify-content: center; padding-bottom: 15px; padding-top: 15px;">
                                                            <!-- imgage by jquery -->
                                                        </div>
                                                        <div id="div_img_versiones_input_img" style="display: flex; align-items: center; justify-content: center;">
                                                            <!-- <input type="file" onchange="fun_listener_change(this, 'img_versions')" class="form-control"> -->
                                                        </div>
                                                        <div id="div_img_version_buton_guardar" style="display: flex; align-items: center; justify-content: center; padding-bottom: 10px;">
                                                            
                                                        </div>
                                                        <div id="div_img_version_message" style="display: flex; align-items: center; justify-content: center; padding-bottom: 10px;">
                                                            <!-- <ul style="position:absolute;" class="list-group" id="ul-modal-status2'+id_file_input+'">   </ul> -->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-2" >

                                                </div> -->
                                                <div class="col-md-6">
                                                    <div class="" style="display: flex; align-items: center; justify-content: center;">
                                                        <h4>Lateral general</h4>
                                                    </div>
                                                    <div class="card">
                                                        <div id="div_img_lateral_versiones" style="display: flex; align-items: center; justify-content: center; padding-bottom: 15px; padding-top: 15px;">
                                                            <!-- <img style="width: 100%; height: auto;" src="https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/AVEO-HB_2024/Version_lateral_AVEO-HB_2024.png" alt=""> -->
                                                            <!-- https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/competencia/subir_imagen_icon_19.png -->
                                                            <!-- <img id="id_img_laterales_versions" style="width: 100%; height: auto;" src="" alt=""> -->
                                                        </div>
                                                        
                                                        <div id="div_img_lateral_versiones_input_img" style="display: flex; align-items: center; justify-content: center;">
                                                            <!-- <input type="file" class="form-control"> -->
                                                            <input id="id_input_laterales" type="file" onchange="fun_listener_change(this, 'id_img_laterales')" class="form-control">
                                                        </div>
                                                        <div id="div_img_lateral_button_guardar" style="display: flex; align-items: center; justify-content: center; padding-bottom: 10px;">
                                                            
                                                        </div>
                                                        <div id="div_img_lateral_message" style="display: flex; align-items: center; justify-content: center; padding-bottom: 10px;">
                                                            <!-- <ul style="position:absolute;" class="list-group" id="ul-modal-status2'+id_file_input+'">   </ul> -->
                                                            
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
                        <h5 style="padding-right: 5px; font-size: 2em;" class="modal-title" id="Mmodelo"></h5>
                        <h5 style="padding-left: 5px; font-size: 2em;" class="modal-title" id="Mano"></h5>
                        <h5 style="padding-left: 5px; font-size: 2em;" class="modal-title" id="Mkey" hidden></h5>
                        <input type="text" id="Valmodelo" value="" hidden>
                        <input type="text" id="Valano" value="" hidden>
                        <input type="text" id="Valcolor" value="" hidden>
                        <input type="text" id="Valkey" value="" hidden>
                    </div>
                    <hr>
                </div>


                <form action="delete_color.php" method="POST" id="formulario">
                    <div class="modal-body">

                        <div style="display:flex; justify-content: center;">
                            <p style="padding-right: 5px; font-size: 2em;"> ¿Estas seguro de eliminar el color:</p>
                            <p style="padding-left: 5px; font-size: 2em;" id="Mcolor"></p>
                            <p style="font-size: 2em;">?</p>
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

    <!-- MODAL CARGAR IMAGENES -->

    <div class="modal fade bs-example-modal-lg" id="modal-add-image" name="modal-add-image" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Versiones</h4>
                </div>
                <div class="modal-body">
                    <div>

                        <!-- #AGREGAR Y ELIMINAR COLORES -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <div id="color-ctrl-modal"> </div>
                                    </h2>
                                </div>
                                <div class="body" onclick="clickImg('_file')">
                                    <form action="/" class="dropzone" method="post" enctype="multipart/form-data">
                                        <div class="dz-message">
                                            <div class="drag-icon-cph" style="text-align: center;">
                                                <i class="material-icons">touch_app</i>
                                            </div>
                                            <p id="_label_name_image_png"></p>
                                            <br>
                                            <h3>Agregue una imagen png</h3>

                                        </div>
                                        <div class="fallback">
                                            <input accept="image/png" style="display: none;" type="file" id="_file" size="2048" name="file" />
                                        </div>
                                    </form>
                                    <input id="imagen_color" type="text" multiple hidden="" />
                                </div>

                                <div class="body" onclick="clickImg('_file_web')">
                                    <form action="/" class="dropzone" method="post" enctype="multipart/form-data">
                                        <div class="dz-message">
                                            <div class="drag-icon-cph" style="text-align: center;">
                                                <i class="material-icons">touch_app</i>
                                            </div>
                                            <p id="_label_name_image_webp"></p>
                                            <h3>Agregue una imagen webp</h3>

                                        </div>
                                        <div class="fallback">
                                            <input accept="image/webp" style="display: none;" type="file" id="_file_web" size="2048" name="file_web" />
                                        </div>
                                    </form>
                                    <input id="imagen_color" type="text" multiple hidden="" />
                                </div>
                                <div class="body">
                                    <ul class="list-group" id="ul-modal-status">
                                        <!-- <li style="border: 2px solid black;" class="list-group-item list-group-item-warning">This is a warning list group item</li> -->
                                    </ul>
                                </div>
                                <!-- <div class="body">
                                   <center> <button type="button" class="btn btn-primary" onclick="ir_imagenes()">ver imagenes</button></center>
                                </div> -->
                                

                                <!-- <div class="body" id="contresp" style="display:none;">
                        <div class="row clearfix">
                                <div class="col-md-12">
                                    <b>URL DEL COLOR</b>
                                    <div class="form-group form-float">
                                    <div class="form-line" id="return_file">             
                                        <input type="text" id="copia_" class="form-control" name="name" required="" aria-required="true" placeholder="" style="display:block;" disabled="" value="">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div> -->
                                <div class="body">
                                    <div class="card-inside-title">
                                        <div class="row clearfix">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-line" align="center">
                                                    <!-- <input type="text" class="form-control" placeholder="Color ej. BLANCO" id="color"/><br> -->
                                                    <!-- <div class="btn btn-primary" style="border-radius: 7px;" onclick="agregarColor()">AGREGAR</div> -->
                                                    <!-- <div class="btn btn-primary" style="border-radius: 7px;" onclick="updateImg('_file')">Cargar</div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="ir_imagenes()">Cerrar</button>
                    <button type="button" id="btn_cargar_img" class="btn btn-primary" onclick="updateImg('_file')">Cargar</button>
                </div>
            </div>
        </div>
    </div>


    <style>
        .colorP {
            width: 30px;
            height: 30px;
            border-radius: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .select-editado {
            border: 1px solid #ccc !important;
            border-radius: 5px !important;
        }

        .btns-versions {
            width: 100%;
            border: 0px transparent !important;
        }
        .div-btns-versions{
            padding: 1px;

        }
    </style>
    <script>
        function runScriptOrden(e, id, valor) {
            if (e.keyCode == 9 && valor.value != "") {
                var param = {
                    "id": id,
                    "valor": valor.value
                }
                $.ajax({
                    url: 'save_comparativa_orden.php',
                    type: "POST",
                    data: param
                });
            }
        }

        function runScriptPrecio(e, id, valor) {
            if (e.keyCode == 9 && valor.value != "") {
                var param = {
                    "id": id,
                    "valor": valor.value
                }
                $.ajax({
                    url: 'save_comparativa_precio.php',
                    type: "POST",
                    data: param
                });
            }
        }

        function runScript(e, valor, version_id, comparativa_id) {
            if (e.keyCode == 9) {
                var param = {
                    "version_id": version_id,
                    "comparativa_id": comparativa_id,
                    "valor": valor.value
                }
                $.ajax({
                    url: 'save_comparativa_versiones.php',
                    type: "POST",
                    data: param,
                    success: function(resp) {
                        console.log(resp);
                    }
                });
            }
        }

        function agregarComparativa() {
            if ($("#comparativa").val() != "") {

                var param2 = {
                    modelo: '<?= $auto["modelo"] ?> <?= $auto["ano"] ?>',
                    nombre: $("#comparativa").val(),
                    orden: '<?= $orden ?>'
                }
                $('#areaAutos').html("");
                $.ajax({
                    url: 'save_new_comparativa.php',
                    type: "POST",
                    data: param2,
                    success: function() {
                        location.reload(true);
                    }
                });

            } else {
                alert("Campo vacío");
            }
        }

        function agregarAccesorio() {
            ç
            if ($("#numero_inventario").val() != "" && $("#categoria_accesorios").val() != "" && $("#tiempo_instalacion").val() != "" && $("#precio").val() != "") {
                var param3 = {
                    numero_inventario: $("#numero_inventario").val(),
                    categoria_accesorios: $("#categoria_accesorios").val(),
                    tiempo_instalacion: $("#tiempo_instalacion").val(),
                    precio: $("#precio").val(),
                    status: '1'
                }
                $.ajax({
                    url: 'guardar_accesorios.php',
                    type: "POST",
                    data: param3,
                    success: function() {
                        location.reload(true);
                    }
                });

            } else {
                alert("Campo vacío");
            }
        }

        function agregarColor() {

            var param1 = {
                autoUrl: '<?= $auto["url"] ?>',
                color: '<?= $auto["color"] ?>',
                marca: '<?= $auto["marca"] ?>'
            };

            if ($("#color").val() != "") {
                $.ajax({
                    url: 'check_color.php',
                    type: "POST",
                    data: param1,
                    success: function(res) {
                        if (res == 0) {
                            alert("El archivo del color no existe");
                        } else if (res == 1) {
                            if ($("#imagen_color").val() == "") {
                                alert('Es necesario seleccionar una imagen.');
                                $('.dropzone').css({
                                    'cssText': 'border: 2px solid red !important; '
                                });
                            } else {

                                var param2 = {
                                    modelo: '<?= $auto["modelo"] ?>',
                                    ano: ' <?= $auto["ano"] ?>',
                                    valor: $("#color").val()
                                }
                                $.ajax({
                                    url: 'save_new_color.php',
                                    type: "POST",
                                    data: param2,
                                    success: function() {
                                        location.reload(true);
                                    }
                                });
                            }
                        }
                    }
                });




            } else {
                alert('Campos vacíos.');
                $('#color').css({
                    'cssText': 'border: 2px solid red !important; '
                });
            }
        }

        function eliminarColor($id) {
            var param2 = {
                id: $id
            }
            $.ajax({
                url: 'delete_colores.php',
                type: "POST",
                data: param2,
                success: function() {
                    location.reload(true);
                }
            });


        }

        function eliminarComparativa($id) {

            if (confirm("Seguro que quieres eliminar este elemento?")) {
                var param2 = {
                    id: $id
                }
                $.ajax({
                    url: 'delete_comparativa.php',
                    type: "POST",
                    data: param2,
                    success: function() {
                        location.reload(true);
                    }
                });
            }

        }

        function eliminarVersion($id) {

            if (confirm("Seguro que quieres eliminar este elemento?")) {
                var param2 = {
                    id: $id
                }
                $.ajax({
                    url: 'delete_version.php',
                    type: "POST",
                    data: param2,
                    success: function() {
                        location.reload(true);
                    }
                });
            }

        }

        function agregarVersion() {

            if ($("#n_tipo").val() != "" && $("#n_version").val() != "" && $("#n_trans").val() != "" && $("#n_vehiculo").val() != "" && $("#n_precio").val() != "" && $("#n_color").val() != "") {

                var param2 = {
                    n_tipo: $("#n_tipo").val(),
                    n_version: $("#n_version").val(),
                    n_trans: $("#n_trans").val(),
                    n_vehiculo: $("#n_vehiculo").val(),
                    n_precio: $("#n_precio").val(),
                    n_color: $("#n_color").val(),
                    modelo: '<?= $auto["modelo"] ?>',
                    marca: '<?= $auto["marca"] ?>',
                    ano: '<?= $auto["ano"] ?>'
                }

                $.ajax({
                    url: 'add_version.php',
                    type: "POST",
                    data: param2,
                    success: function(e) {
                        location.reload(true);
                    }
                });
            } else {
                //swal("Oops!", "Campos vacíos o incompletos!", "error");
                validar_campos("#n_tipo");
                validar_campos("#n_version");
                validar_campos("#n_color");
                validar_campos("#n_precio");
                alert('Campos vacíos');
            }


        }

        function clickImg(obj) {
            // var color=$('#color').val();   
            // if(color!=""){
            document.getElementById(obj).click();
            // }else{
            //     alert('Campo color vacío.');
            // }
        }

        function ir_imagenes(){
            $("#modal-add-image").modal("hide");
            $("#li_modulo_colores").click();
            location.reload(true);
        }
        
        $('#_file').change(function() { //VALIDACION DE PESO DE IMAGEN
            let size_kb = this.files[0].size / 1024;

            if (size_kb > this.size) {
                alert('Imagen muy grande, tamaño maximo permitido, '+ this.size +'KB');
                this.value = "";
                $("#_label_name_image_png").html("");
            } else{
                $("#_label_name_image_png").html("Img: "+ $('#_file')[0].files[0].name);
            }
            
            console.log(size_kb +' || '+this.size);
            console.log($('#_file')[0].files[0].name );

        });

        $('#_file_web').change(function() { //VALIDACION DE PESO DE IMAGEN
            let size_kb = this.files[0].size / 1024;

            if (size_kb > this.size) {
                alert('Imagen muy grande, tamaño maximo permitido, '+ this.size +'KB');
                this.value = "";
                $("#_label_name_image_webp").html("");
            } else {
                $("#_label_name_image_webp").html("Img: "+ $('#_file_web')[0].files[0].name);
                $("#btn_cargar_img").attr("disabled", false);
            }
            
            
            console.log(size_kb +' || '+this.size);
            console.log($('#_file_web')[0].files[0].name );

        });


        let count_request_change_img = 0;
        function updateImg(obj) {
            // cambiarImagen(obj);//funcion por default traia
            let nameimg = '';
            let nameimg2 = '';
            let nameimg3 = '';
            $("#btn_cargar_img").attr("disabled", true);
            let _file = $('#_file')[0].files[0];
            let _file_web = $('#_file_web')[0].files[0];
            let color = $("#color-ctrl-modal").text();
            $("#ul-modal-status").html();

            if (!_file || !_file_web) {
                console.log(_file +' | '+ _file_web);
                alert('Agregue una imagen en cada seccion');
                return false;
            }

            if (_file) {
                nameimg = color+'.png';
                nameimg2 = color+'@300w.png';
                nameimg3 = color+'@600w.png';
                
                cambiarImagen_test(obj, nameimg);
                cambiarImagen_test(obj, nameimg2);
                cambiarImagen_test(obj, nameimg3);
            }
            if (_file_web) {
                nameimg = color+'.webp';
                nameimg2 = color+'@300w.webp';
                nameimg3 = color+'@600w.webp';

                cambiarImagen_test('_file_web', nameimg);
                cambiarImagen_test('_file_web', nameimg2);
                cambiarImagen_test('_file_web', nameimg3);
            }
        }

        function cambiarImagen_test(obj, nameimg) {
            // var color = document.getElementById('color').value;
            var fd = new FormData();
            var files = $('#' + obj)[0].files[0];
            if (files) {
                let filepath = (('autos-landing/<?= $auto["marca"] ?>'+'/'+'<?= $auto["modelo"] ?>'+'-'+'<?= $auto["ano"] ?>'+'/colores/').toLowerCase()).replaceAll(' ', '-');
                
                console.log(filepath);
                

                fd.append('file', files);
                // fd.append('color',color);
                // fd.append('marca', '<?= $auto["marca"] ?>');
                // fd.append('modelo', '<?= $auto["modelo"] ?>');
                // fd.append('ano', '<?= $auto["ano"] ?>');
                fd.append('name', nameimg);
                fd.append('filepath', filepath);

                $.ajax({
                    url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/update_img_colores.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        //alert(response);
                        console.log('File uploaded: ' + obj + '| ' + nameimg);
                        if (response != 0) {
                            count_request_change_img++;
                            console.log('response: '+response);
                            // document.getElementById('return_file').innerHTML = response;
                            $('.dropzone').css({
                                'cssText': 'border: none !important;'
                            });
                            $('#contresp').css({
                                'cssText': 'display: block !important;'
                            });

                            $("#ul-modal-status").append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-success">'+nameimg+' cargado correctamente <b>('+count_request_change_img+'</b> de 6)</li>');
                        } else {
                            $("#ul-modal-status").append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-danger">Error al subir imagen: '+nameimg+'</li>');
                            alert('El color ya existe o no se puedo subir,intenta de nuevo..');
                            // document.getElementById('return_file').innerHTML = '<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
                        }
                    },  error: function(XMLHttpRequest, textStatus, errorThrown) {
                        $("#ul-modal-status").append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-danger">Error al subir imagen: '+nameimg+'</li>');
                            // alert('El color ya existe o no se puedo subir,intenta de nuevo.');
                    }
                });
            } else {
                console.log('No file found in: ' + obj + '| ' + nameimg);
            }

        }

        function cambiarImagen(obj) {
            var color = document.getElementById('color').value;

            var fd = new FormData();
            var files = $('#' + obj)[0].files[0];
            fd.append('file', files);
            fd.append('color', color);
            fd.append('marca', '<?= $auto["marca"] ?>');
            fd.append('modelo', '<?= $auto["modelo"] ?>');
            fd.append('ano', '<?= $auto["ano"] ?>');

            $.ajax({
                url: 'upload_color.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    //alert(response);
                    if (response != 0) {
                        document.getElementById('return_file').innerHTML = response;
                        $('.dropzone').css({
                            'cssText': 'border: none !important;'
                        });
                        $('#contresp').css({
                            'cssText': 'display: block !important;'
                        });
                    } else {
                        alert('El color ya existe o no se puedo subir,intenta de nuevo.');
                        document.getElementById('return_file').innerHTML = '<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
                    }
                }
            });
        }

        //TECNOLOGIA
        function agregarTecnologia() {
            if ($("#selectDetalle").val() != "" && $("#descDetalle").val() != "" && $("#selectAno").val() != "") {
                var param = {
                    modelo: '<?= $auto["modelo"] ?>',
                    ano: $("#selectAno").val(),
                    tecnologia: $("#descDetalle").val(),
                    tituloDetalle: $("#tituloDetalle").val(),
                    tipo: $("#selectDetalle").val()
                }
                $.ajax({
                    url: 'save_tecnologia.php',
                    type: "POST",
                    data: param,
                    succes: function(res1) {
                        location.reload(true);
                    }
                });
                //loadingPa();
            } else {
                alert("Todos los campos son requeridos!.");
            }
        }

        function valDetalle() {
            var obj = document.getElementById('selectDetalle').value;
            if (obj == "detalle") {
                $('#tituloDetalle').show();
            } else {
                $('#tituloDetalle').hide();
            }
        }

        function borrarElemento(id) {
            var id = id;
            var r = confirm("Estas apunto de eliminar este campo, deseas continuar?");
            if (r == true) {
                var param = {
                    id: id
                };
                $.ajax({
                    type: 'POST',
                    url: 'borrarTecnologia.php',
                    data: param,
                    succes: function(res) {
                        if (res == "hecho") {
                            alert("Elemento Borrado");
                            location.reload(true);
                        }
                    }
                })
            }
        }

        function validar_campos(id) {
            if ($(id).val() == "") {
                $(id).css({
                    'cssText': 'border: 2px solid red !important; '
                });
            }
        }


        /**Inventario de versiones */
        change_tbl_inv_versiones();
        /**Carga marca modelo año en Asignar color */
        change_marcamodel_asignar_color();
        function change_marcamodel_asignar_color() {
            let slug = '<?php echo $auto["slug"] ?>';
            let modelo = '<?php echo $auto["modelo"] ?>';
            let ano = '<?php echo $auto["ano"] ?>';
            console.log(modelo);
            let var_marca = slug.split('-');
            
            let marca_splited = var_marca[0];
            let marca_concat = marca_splited[0].toUpperCase() + marca_splited.slice(1);
            $("#asignado").val(marca_concat);
            // change_select_marca('nn_icono');
            $("#modelo").val(modelo)
            $("#ano").val(ano);

        }
        function change_tbl_inv_versiones() {
            let slug = '<?php echo $auto["slug"] ?>';
            //cargando select de iconos
            change_select_icons('nn_icono');

            //asignando nombre a slug
            $("#nn_slug").val(slug);

            let str_tbody = null;
            let param = {
                func: 'get_inventario_versiones',
                slug: slug
            };

            $.ajax({
                data: param,
                type: 'POST',
                dataType: 'json',
                url: 'get_inventario_versiones.php',
                success: function(res) {
                    $.each(res, function(i, val) {
                        str_tbody += '<tr><td>' + val['version'] + '</td><td>' + val['metavalue'] + '</td><td>' + val['icono'] + '</td><td>' + val['orden'] + '</td><td>' + val['fecha'] + '</td><td>  <button type="button" class="form-control btn btn-danger" ondblclick=func_delete_invver(' + val['id'] + ')>eliminar</button>   <button type="button" class="form-control btn btn-info" onclick="open_modal_edit_invver(\'' + btoa(JSON.stringify(val)) + '\')">editar</button></td></tr>';
                        // str_tbody += `<tr><td>  ${val['version']}  </td><td>  ${val['metavalue']}  </td><td>  ${val['icono']}  </td><td>  ${val['orden']}  </td><td>  ${val['fecha']}  </td><td>  <button type="button" class="form-control btn btn-danger" ondblclick=func_delete_invver(  ${val['id']}  )>eliminar</button>   <button type="button" class="form-control btn btn-info" onclick="open_modal_edit_invver(${btoa(JSON.stringify(val)) })">editar</button></td></tr>`;
                    });
                    $("#tbl-inv-versiones tbody").html(str_tbody);
                    console.log('change_tbl_inv_versiones');
            
            console.log(str_tbody);
            return true;
                }
            });


        }
        async function change_select_icons(name_ctrl) {
            let params = {
                func: 'change_select_icons'
            }
            let option = '<option disabled selected value="">Seleccione Icono</option>';
            await $.ajax({
                data: params,
                type: 'POST',
                url: 'get_inventario_versiones.php',
                dataType: 'json',
                success: function(res) {
                    if (res) {
                        $.each(res, function(ii, val) {
                            let icono = val['icono'];
                            option += '<option value="' + icono + '">' + icono + '</option>';
                        });
                        let name_ctrl_final = '#' + name_ctrl;
                        // $(name_ctrl_final).html(option);
                        document.getElementById(name_ctrl).innerHTML = option;
                        console.log('param name_ctrl es: ' + name_ctrl);

                    }

                }
            });

        }

        function select_nn_icono() {
            let nn_icon = $("#nn_icono").val();
            let urlimage = `https://d3s2hob8w3xwk8.cloudfront.net/features/det-${nn_icon}.svg`;
            $("#nn_img_icon").attr('src', urlimage);
            console.log(urlimage);
            
        }


        function save_inv_versions() {
            let slug = $("#nn_slug").val();
            let version = $("#nn_version").val();
            let metavalue = $("#nn_metavalue").val();
            let icono = $("#nn_icono").val();

            let params = {
                func: 'save_inv_versions',
                slug: slug,
                version: version,
                metavalue: metavalue,
                icono: icono
            }

            $.ajax({
                data: params,
                type: 'POST',
                dataType: 'json',
                url: 'get_inventario_versiones.php',
                success: function(res) {
                    if (res['error']) {
                        alert('error');
                    } else {
                        alert('guardado');
                    }
                    change_tbl_inv_versiones();
                }

            });

        }

        function func_delete_invver(id) {
            console.log(id);
            //call function to delete
            let params = {
                func: 'delete_inv_versions',
                id: id
            }

            $.ajax({
                data: params,
                type: 'POST',
                dataType: 'json',
                url: 'get_inventario_versiones.php',
                success: function(res) {
                    let msg = 'error al eliminar';
                    if (res == 1) {
                        msg = 'eliminado';
                    }
                    alert(msg);
                    change_tbl_inv_versiones();
                }
            });
        }

        async function open_modal_edit_invver(paramobj) {
            let paramobjt1 = JSON.parse(atob(paramobj));

            await change_select_icons('ctrl_icono');
            console.log(paramobjt1['icono']);
            $("#modal-edit-invver").modal('show');

            $("#ctrl-id").val(paramobjt1['id']);
            $("#ctrl-metavalue").val(paramobjt1['metavalue']);
            // $("#ctrl_icono").find('option : selected');
            $("#ctrl_icono").val(paramobjt1['icono']).change();
            // $('#ctrl_icono option[text="volante"]').attr(selected, true);
            // let volante  = 'volante';
            // $('#ctrl_icono').val(volante);
            // $('#ctrl_icono option[value="volante"]').prop("selected", true);
            // console.log($('#ctrl_icono').find(':selected').val());
            // console.log($("#ctrl_icono").val());
            $("#ctrl-orden").val(paramobjt1['orden']);
        }

        function update_invver() {
            let ctrl_id = $("#ctrl-id").val();
            let ctrl_metavalue = $("#ctrl-metavalue").val();
            let ctrl_icono = $("#ctrl_icono").val();
            let ctrl_orden = $("#ctrl-orden").val();

            let params = {
                func: 'update_invver',
                id: ctrl_id,
                metavalue: ctrl_metavalue,
                icono: ctrl_icono,
                orden: ctrl_orden
            }

            $.ajax({
                data: params,
                type: 'POST',
                dataType: 'json',
                url: 'get_inventario_versiones.php',
                success: function(res) {
                    console.log(res);
                    if (res['error']) {
                        alert('error');
                    } else {
                        alert('guardado');
                    }
                    $("#modal-edit-invver").modal('hide');
                    change_tbl_inv_versiones();
                }

            });

        }


        function error(obj) {
            if ($(obj).val() == "") {
                $(obj).css({
                    'cssText': 'border-bottom: 1px solid red !important; '
                });
            }
        }

        let move_tab=0;
        function mouse_modulo_asignar_color(move) {
            if (move == 1) {
                move_tab = 1;
            }
        }
        let move_tab_color = 0;
        function mouse_modulo_colores(move) {
            if (move == 1) {
                move_tab_color = 1;
            }
        }
        function modulo_asignar_color(){
            $("#tab_asignar_color").show();
            $("#tab_portadas_mobile").hide();
            $("#tab_portadas_web").hide();
            $("#tab_invver").hide();
            $("#tab_imagenes").hide();
            console.log('now clicked move_tab = a: ' + move_tab)

            // let urlParams = new URLSearchParams(window.location.search);
            // urlParams.set('tab', '2');
            // history.pushState({tab: 2}, '', urlParams);
            // window.location.search = urlParams;
            const url = new URL(window.location);
            url.searchParams.set('tab', 'tab_asignar_color');
            window.history.pushState({}, '', url);

            if (move_tab == 1) {
                // window.location.href = window.location.href;
                //location.reload(true);
            }

        }
        function modulo_invver(){
            $("#tab_invver").show();
            $("#tab_portadas_mobile").hide();
            $("#tab_portadas_web").hide();
            $("#tab_asignar_color").hide();
            $("#tab_imagenes").hide();
            const url = new URL(window.location);
            url.searchParams.set('tab', 'tab_invver');
            window.history.pushState({}, '', url);
        }
        function modulo_portadas_web() {
            $("#tab_portadas_web").show();
            $("#tab_portadas_mobile").hide();
            $("#tab_invver").hide();
            $("#tab_asignar_color").hide();
            $("#tab_imagenes").hide();
            const url = new URL(window.location);
            url.searchParams.set('tab', 'tab_portadas_web');
            window.history.pushState({}, '', url);
        }
        function modulo_portadas_mobile() {
            $("#tab_portadas_mobile").show();
            $("#tab_portadas_web").hide();
            $("#tab_invver").hide();
            $("#tab_asignar_color").hide();
            $("#tab_imagenes").hide();
            const url = new URL(window.location);
            url.searchParams.set('tab', 'tab_portadas_mobile');
            window.history.pushState({}, '', url);
        }
        function modulo_imagenes_versiones() {
            $("#tab_imagenes_versiones").show();
            $("#tab_portadas_mobile").hide();
            $("#tab_portadas_web").hide();
            $("#tab_invver").hide();
            $("#tab_asignar_color").hide();
            $("#tab_imagenes").hide();
            const url = new URL(window.location);
            url.searchParams.set('tab', 'tab_imagenes_versiones');
            window.history.pushState({}, '', url);
            list_versions();
        }
        function modulo_colores(){
            $("#tab_imagenes").show();
            $("#tab_portadas_mobile").hide();
            $("#tab_portadas_web").hide();
            $("#tab_invver").hide();
            $("#tab_asignar_color").hide();

            const url = new URL(window.location);
            url.searchParams.set('tab', 'tab_imagenes');
            window.history.pushState({}, '', url);
            
            if (move_tab_color == 1) {
                //location.reload(true);
            }

        }

        //ASIGNAR COLOR 
        $("#asignado").change(function() {
            /**
            console.log('control asignado MARCA changed');
            var marca = document.getElementById('asignado').value;
            error('#asignado');
            var param = {
                marca: $('#asignado').val(),
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: 'getmodelos.php',
                success: function(response) {
                    document.getElementById('divmodelos').innerHTML = response;
                }
            });
            */
        });

        $("#color").change(()=>{
            let hex = $("#color").find(':selected').attr('data-hexa');
            console.log(hex);
            $("#input-color").css({'background-color': hex});
        });

        // SAVE ASIGNACION DE COLOR //
        function save_asignacion() {
            var marca = document.getElementById('asignado').value;
            var modelo = document.getElementById('modelo').value;
            var ano = document.getElementById('ano').value;
            var color = document.getElementById('color').value;
            error('#marca');
            error('#modelo');
            error('#ano');
            error('#color');

            if (marca != "" && modelo != "" && ano != "" && color != "") {

                var param = {
                    marca: marca,
                    modelo: modelo,
                    ano: ano,
                    color: color
                }
                $.ajax({
                    url: 'asignar_color.php',
                    type: 'POST',
                    data: param,
                    success: function(resp) {
                        alert(resp);
                        location.reload();   
                    }
                })
            } else {
                alert('Campos vacíos!');
            }
        }

        function deleteButton($param) {
            $parametros = window.atob($param);
            $parametros = JSON.parse($parametros);
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

        function deleteColor() {

            $("#id").val($parametros["id"]);
            var modeloE = document.getElementById('Valmodelo').value;
            var anoE = document.getElementById('Valano').value;
            var colorE = document.getElementById('Valcolor').value;
            var keyE = document.getElementById('Valkey').value;
            error('#Valmodelo');
            error('#Valano');
            error('#Valcolor');
            error('#Valkey');

            if (modeloE != "" && anoE != "" && colorE != "" && keyE != "") {

                var param = {
                    modeloE: modeloE,
                    anoE: anoE,
                    colorE: colorE,
                    keyE: keyE
                }
                $.ajax({
                    url: 'eliminar_color.php',
                    type: 'POST',
                    data: param,
                    success: function(resp) {
                        alert(resp);
                        location.reload();
                    }
                })

                $('#editModal').modal('hide');
            } else {
                alert('Campos vacíos!');
            }

        }

        function get_colores_asignados() {
            let param = {
                func : 'get_colores_asignados'
            }
            console.log('entrando');
            $.ajax({
                data: param,
                type: 'POST',
                url: 'get_inventario_versiones.php',
                dataType: 'json',
                success: function (res) {
                    // console.log( res);
                    $("#tbl_colores_asignados tbody").empty();
                    $("#tbl_colores_asignados tbody").append(res);
                    // $("#tbl_colores_asignados").find('tbody').html(res);

                }
            });
        }

        // get_colores_asignados();
        $(document).ready(function () {
            // change buttons Portada Web
            let slug = '<?php echo $auto["slug"] ?>';
            get_colors(slug, '00', 'web');
            get_colors(slug, '00', 'mobile');
            func_change_btn_portada_web(slug, 'row_btns_portada_web', 'web');
            func_change_btn_portada_web(slug, 'row_btns_portada_mobile', 'mobile');

            let urlParams = new URLSearchParams(window.location.search);
            let tab = urlParams.get('tab');
            console.log(tab);
            if (tab == 'tab_asignar_color') {
                console.log('cliecked');
                // modulo_asignar_color();
                // $("#li_modulo_asignar_color").addClass('active');
                $("#li_modulo_asignar_color").click();
            } else if(tab == 'tab_imagenes') {
                $("#li_modulo_colores").click();
            } else if(tab == 'tab_invver') {
                $("#li_modulo_invver").click();
            } else if(tab == 'tab_portadas_web') {
                $("#li_modulo_portadas_web").click();
            } else if(tab == 'tab_portadas_mobile') {
                $("#li_modulo_portadas_mobile").click();
            } else if(tab == 'tab_imagenes_versiones') {
                $("#li_modulo_imagenes_versiones").click();
            } else {
                $("#li_modulo_colores").click();
            }
        });
        
        async function func_change_btn_portada_web(slug, id_control_btns, ambiente) {
            let arr_rangos = [
                { name: 'Default', val: '00'},
                { name: '18-24 años (MDE)', val: '01'},
                { name: '25-34 años (MDI)', val: '02'},
                { name: '35-44 años (MDM)', val: '03'},
                { name: '45-54 años (MDQ)', val: '04'},
                { name: '55-64 años (MDU)', val: '05'}
            ];
            let str_html_for_btns='';
            for (let i = 0; i < arr_rangos.length; i++) {
                const elem = arr_rangos[i];

                // Validation image
                let resp_gca_validation = await get_colors_and_validation(slug, elem.val, ambiente);
                console.log('resp_gca_validation', resp_gca_validation);


                str_html_for_btns += ''+
                                        '<div class="col-md-2">'+
                                           ' <button class="'+resp_gca_validation+'" onclick="get_colors(\''+slug+'\', \''+elem.val+'\', \''+ ambiente +'\')" style="width: 95%; border-radius: 10px;">'+
                                                ''+elem.name+''+
                                            '</button>' +
                                        '</div>';
            }

            $('#'+id_control_btns).html(str_html_for_btns);


        }
        

        async function comprobarImagenes(urls) {
            const resultados = {
                exitosos: 0,
                errores: 0,
            };

            async function comprobarImagen(url) {
                return new Promise((resolve, reject) => {
                    const imagen = new Image();

                    imagen.onload = function () {
                        resultados.exitosos++;
                        resolve();
                    };

                    imagen.onerror = function () {
                        resultados.errores++;
                        resolve();
                    };

                    imagen.src = url;
                });
            }

            async function ejecutarComprobaciones() {
                const promesas = urls.map(url => comprobarImagen(url));

                try {
                    await Promise.all(promesas);
                    console.log('Comprobaciones completadas. Imágenes exitosas: '+resultados.exitosos +', Errores: '+ resultados.errores);
                    return resultados;
                } catch (error) {
                    console.error('Error al ejecutar las comprobaciones:', error);
                }
            }

            let response = await ejecutarComprobaciones();
            return response;
        }



        async function get_colors_and_validation($slug, rango_edad_num, ambiente) {

           let response = await $.ajax({
                type: "GET",
                url: "https://api.gruporivero.com/v1/cars/"+$slug,
                data: null,
                dataType: "json",
                success: async function (response) {                    
                }
            });

            let arr_urls_color = [];
            for (let i = 0; i < (response.data.colors).length; i++) {
                const color_obj = response.data.colors[i];
                let color_formated = color_obj.name.replaceAll(' ', '-');
                let model_formated = response.data.model.replaceAll(' ', '-');
                let src = '';
                if (ambiente == 'web') {
                    src = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/' + model_formated + '_' + response.data.year + '/Colores/' + rango_edad_num + '/' + model_formated + '_' + color_formated + '_' + response.data.year + '_' + rango_edad_num + '.webp';
                } else if (ambiente == 'mobile') {
                    src = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/' + model_formated + '_' + response.data.year + '/Movil/' + rango_edad_num + '/' + model_formated + '_' + response.data.year + '_' + color_formated + '_movil.webp';
                }
                
                arr_urls_color[i] = src;
            }
            console.log('arr de urls', arr_urls_color);

            let comprobar_imagenes = await comprobarImagenes(arr_urls_color);
            console.log('COMPROBAR IMAGES: ', comprobar_imagenes);
            if (comprobar_imagenes.exitosos > 0 && comprobar_imagenes.exitosos == (comprobar_imagenes.exitosos + comprobar_imagenes.errores) ) {
                return 'btn btn-success';
            } else if (comprobar_imagenes.exitosos > 0 && comprobar_imagenes.exitosos != (comprobar_imagenes.exitosos + comprobar_imagenes.errores) ) {
                return 'btn btn-warning';
            } else if (comprobar_imagenes.exitosos == 0) {
                return 'btn btn-secondary';
            }
            
            



        }







        function openaModalImagen(param){
            $parametros = window.atob(param);
            $parametros = JSON.parse($parametros);
            let color = $parametros['Color'];
            $("#color-ctrl-modal").text(color);

            console.log(color);
            $("#modal-add-image").modal('show');
        }
        function funconerror(ee){
            console.log('error imagen: '+$(ee).attr("src") );
            $(ee).css({"height": "300px"});
        }
        // TODO: continuar con los demas ajustes ver archivo compare.php, ultimo cambio: slides ordenados

        function get_colors($slug, rango_edad_num, ambiente) {

            let html_row_portada = '';
            $.ajax({
                type: "GET",
                url: "https://api.gruporivero.com/v1/cars/"+$slug,
                data: null,
                dataType: "json",
                success: function (response) {
                    console.log('Api colors');
                    console.log(response);
                    let img_on_error = 'https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/competencia/subir_imagen_icon_19.png';
                    let model_formated = response.data.model.replaceAll(' ', '-');
                    let url_background = '';
                    let file_path = '';
                    let class_imagen_portada = '';

                    if (ambiente == 'web') {
                        file_path = 'nueva-landing-autos/'+model_formated+'_'+ response.data.year +'/Colores/'+rango_edad_num+'/';
                        class_imagen_portada = 'class_imagen_portada_web' + rango_edad_num;
                    } else if (ambiente == 'mobile') {
                        class_imagen_portada = 'class_imagen_portada_mobile' + rango_edad_num;
                        url_background = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/' + model_formated + '_' + response.data.year + '/Movil/' + rango_edad_num + '/' + model_formated + '_' + response.data.year + '_movil_'+rango_edad_num+'.jpg';
                        file_path = 'nueva-landing-autos/'+model_formated+'_'+ response.data.year +'/Movil/'+rango_edad_num+'/';
                        let name_img = model_formated + '_' + response.data.year + '_movil_'+rango_edad_num+'.jpg';
                        let id_file_portada = 'id_file_portada_mobile';
                        let html_div_cargar_fondo = 
                                        '<h4>Cargar fondo </h4>'+
                                        '<div class="custom-file-upload">'+
                                            '<label for="id_file_portada">Seleccionar Archivo</label>'+
                                            '<input onchange="fun_listener_change_background(this, \''+ class_imagen_portada+'\')" type="file"  id="'+id_file_portada+'">'+
                                        '</div>&nbsp;'+
                                        '<ul style="position:absolute;" class="list-group" id="ul-modal-status2'+id_file_portada+'">   </ul> ' +
                                        '<button class="btn btn-primary" onclick="guardar_fondo(\''+ id_file_portada +'\', \''+name_img+'\', \''+file_path+'\' )" >Guardar portada</button>';
                        $('#div_cargar_fondo').html(html_div_cargar_fondo);
                    }


                    for (let i = 0; i < (response.data.colors).length; i++) {
                        const color_obj = response.data.colors[i];
                        let color_formated = color_obj.name.replaceAll(' ', '-');
                        let src = '';
                        if (ambiente == 'web') {
                            src = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/'+model_formated+'_'+ response.data.year +'/Colores/'+rango_edad_num+'/' + model_formated + '_' + color_formated + '_' +response.data.year + '_'+rango_edad_num+'.webp';
                        } else if (ambiente == 'mobile') {
                            src = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/' + model_formated + '_' + response.data.year + '/Movil/' + rango_edad_num + '/' + model_formated + '_' + response.data.year + '_' + color_formated + '_movil.webp';
                        }


                        let id_file_input = '';
                        let name_img = '';
                        let imagen_portada_id = '';
                        
                        //componiendo ruta y nombre de imagen
                        if (ambiente == 'web') {
                            id_file_input = 'input_file_img_portada_web'+rango_edad_num+(color_obj.name).replaceAll(' ', '-');
                            name_img = model_formated +'_'+ color_formated+'_'+ response.data.year +'_' + rango_edad_num+'.webp';
                            imagen_portada_id = 'id_imagen_portada_web' + rango_edad_num+(color_obj.name).replaceAll(' ', '-');
                        } else if (ambiente == 'mobile') {
                            id_file_input = 'input_file_img_portada_mobile'+rango_edad_num+(color_obj.name).replaceAll(' ', '-');
                            name_img = model_formated +'_'+ response.data.year +'_' + color_formated +'_' + 'movil.webp';
                            imagen_portada_id = 'id_imagen_portada_mobile' + rango_edad_num+(color_obj.name).replaceAll(' ', '-');

                        } else {
                            alert('parametros web o mobile incorrectos');
                            return false;
                        }

                        if ($.inArray(i+1, [1, 4, 7, 10, 13, 16, 19, 22, 25]) != -1) {
                            html_row_portada += '<div class="row">';
                        }
                        html_row_portada += '<div class="col-md-4 col-4">' +
                        '<div class="card" >' +
                            '<img class="'+class_imagen_portada+'" id="'+imagen_portada_id+'" style="background-size: cover; background-position: center; cursor: pointer; background-image: url(\'' + url_background + '\');" onclick="fun_charge_img(\''+id_file_input+'\')" width="100%"  src="'+`${src}`+'" onerror="this.onerror=null; this.src=\''+img_on_error+'\'" class="card-img-top" alt="...">' +
                            '<div class="card-body" >' +
                                '<input class="form-control" style="width: 100%" onchange="fun_listener_change(this, \''+ imagen_portada_id+'\')" type="file" id="'+id_file_input+'">'+
                                '<h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">'+color_obj.name+'</h5>' +
                                '<ul style="position:absolute;" class="list-group" id="ul-modal-status2'+id_file_input+'">   </ul> ' +
                                '<a onclick="func_enviar_imagen_pw(\''+id_file_input+'\', \''+name_img+'\', \''+file_path+'\' )" style="display: flex; align-items: center; justify-content: center;" class="btn btn-primary" >Guardar imagen</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                    if ($.inArray(i+1, [3, 6, 9, 12, 15, 18, 21, 24, 27]) != -1) {
                            html_row_portada += '</div>';
                        }

                    }
                    if (ambiente == 'web') {
                        $('#div_row_portada_web').html(html_row_portada);
                    } else if (ambiente == 'mobile') {
                        $('#div_row_portada_mobile').html(html_row_portada);
                    }
                    
                }
            });

        }

        function  fun_listener_change(thiss, imagen_portada_id) {
            let id_file_input = '';
            
            if (thiss.files && thiss.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#'+imagen_portada_id).attr('src', e.target.result);
                }
                reader.readAsDataURL(thiss.files[0]);
            }
        }
        function fun_listener_change_background(thiss, class_imagen_portada) {
            
            
            if (thiss.files && thiss.files[0]) {
                console.log(thiss.files[0], class_imagen_portada);
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('.'+class_imagen_portada).css('background-image', 'url('+ e.target.result + ')');
                    // $('.'+class_imagen_portada).css('background-image', 'background-size: cover; background-position: center; cursor: pointer; background-image: url('+ e.target.result + ');');
                    // $('.'+class_imagen_portada).css('background', 'transparent url('+e.target.result +') left top no-repeat');
                }
                reader.readAsDataURL(thiss.files[0]);
            }
        }

        function guardar_fondo(id_obj, nameimg, filepath) {

            func_enviar_imagen_pw(id_obj, nameimg, filepath);

        }
        function enviar_imagen_version(id_obj, nameimg, filepath) {
            func_enviar_imagen_pw(id_obj, nameimg, filepath);
        }

        function enviar_imagen_lateral(id_file_input, nameimg, filepath) {

            func_enviar_imagen_pw(id_file_input, nameimg, filepath);
            
        }
        

        function func_enviar_imagen_pw(obj, nameimg, filepath) {
            console.log(obj, nameimg, filepath);
            
            // var color = document.getElementById('color').value;
            var fd = new FormData();
            var files = $('#' + obj)[0].files[0];
            if (files) {
                

                fd.append('file', files);
                fd.append('name', nameimg);
                fd.append('filepath', filepath);

                $.ajax({
                    url: 'https://www.riverorenta.mx/seminuevos/images/vista-360/update_img_colores.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        //alert(response);
                        console.log('File uploaded: ' + obj + '| ' + nameimg);
                        if (response != 0) {
                            count_request_change_img++;
                            console.log('response: '+response);


                            $("#ul-modal-status2"+obj ).append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-success">'+nameimg+' cargado correctamente <b>('+count_request_change_img+'</b> de 1)</li>');
                            setTimeout(() => {
                                $("#ul-modal-status2"+obj ).html('');
                            }, 2000);
                        } else {
                            $("#ul-modal-status2").append('<li style="border: 2px solid gray;" class="list-group-item list-group-item-danger">Error al subir imagen: '+nameimg+'</li>');
                            alert('El color ya existe o no se puedo subir,intenta de nuevo.');
                        }
                    }
                });
            } else {
                alert('Debe seleccionar una imagen');
            }

        }



        function fun_charge_img(id_file_input) {

            console.log('FUNC CHARGE IMG: '+id_file_input);
            $('#'+id_file_input).click();
        }

        //Imagenes de versiones
        function clcVersions(version) {
            let slug = '<?php echo $auto["slug"] ?>';
            $.ajax({
                type: "GET",
                url: "https://api.gruporivero.com/v1/cars/"+slug,
                data: null,
                dataType: "json",
                success: function (res) {
                    let model = res.data.model.replaceAll(' ', '-');
                    let year = res.data.year;
                    let  model_year = model+'_'+year;
                    console.log(model_year);

                    version = version.replaceAll(' ', '-');
                    let nameimg = 'Version_'+version+'_'+model_year+'.png';
                    let img_on_error = 'https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/competencia/subir_imagen_icon_19.png';
                    let url_image = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/'+model_year+'/'+nameimg;
                    let id_img_versions = 'id_img_versions_'+version;
                    let img_image =  '<img id="'+id_img_versions+'" style="width: 35%; height: auto;" src="'+url_image+'" onerror="this.onerror=null; this.src=\''+img_on_error+'\'" alt="">';
                    // <img class="img_versions" style="width: 260px; height: auto;" src="https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/competencia/subir_imagen_icon_19.png" alt="">
                    // <img style="width: 260px; height: auto;" src="https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/AVEO-HB_2024/Version_LT_AVEO-HB_2024.png" alt="">
                    $('#div_img_versiones').html(img_image);
        
                    let id_input_versions = 'id_input_versions_'+version;
                    let input_file = '<input id="'+id_input_versions+'" type="file" onchange="fun_listener_change(this, \''+id_img_versions+'\')" class="form-control">';
                    $('#div_img_versiones_input_img').html(input_file);
                    console.log(version);

                    //button to save image
                    let path_image_to_save = 'nueva-landing-autos/'+model_year+'/';

                    let button_save_img_version = '<button onclick="enviar_imagen_version(\''+id_input_versions+'\', \''+nameimg+'\', \''+path_image_to_save+'\' )" style="width: 100%;" class="btn btn-primary">Guardar imagen de version</button>';

                    $('#div_img_version_buton_guardar').html(button_save_img_version);
                    //message control
                    let div_img_version_message = '<ul style="width: 100%;" class="list-group" id="ul-modal-status2'+id_input_versions+'">';
                    $('#div_img_version_message').html(div_img_version_message);
                    
                }
            });

        }

        async function list_versions() {
            let slug = '<?php echo $auto["slug"] ?>';
            let res = await $.ajax({
                type: "GET",
                url: "https://api.gruporivero.com/v1/cars/"+slug,
                data: null,
                dataType: "json",
                success: async function (res) {
                }
            });

            let html = '';
                    let arr_versions = res.data.versions;
                    for (let ii = 0; ii < arr_versions.length; ii++) {
                        const version = arr_versions[ii];
                        if (version.name == null) {
                            continue;
                        }
                        
                        
                    // res.data.versions.forEach(async version => {

                        let model = res.data.model.replaceAll(' ', '-');
                        let year = res.data.year;
                        let  model_year = model+'_'+year;

                        let name_version = version.name.replaceAll(' ', '-');
                        let nameimg = 'Version_'+name_version+'_'+model_year+'.png';
                        let url_image = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/'+model_year+'/'+nameimg;

                        let arr_urls_color = [];
                        arr_urls_color[0] = url_image;                       
                        
                        //validar imagenes y plasmar el color del boton
                        let comprobar_imagenes = await comprobarImagenes(arr_urls_color);
                        console.log('COMPROBAR IMAGES: ', comprobar_imagenes);
                        let class_btn_versions = '';
                        if (comprobar_imagenes.exitosos > 0 && comprobar_imagenes.exitosos == (comprobar_imagenes.exitosos + comprobar_imagenes.errores) ) {
                            class_btn_versions = 'btn btn-success';
                        } else if (comprobar_imagenes.exitosos > 0 && comprobar_imagenes.exitosos != (comprobar_imagenes.exitosos + comprobar_imagenes.errores) ) {
                            class_btn_versions = 'btn btn-warning';
                        } else if (comprobar_imagenes.exitosos == 0) {
                            class_btn_versions = 'btn btn-secondary';
                        }

                        html += '<div class="col-md-3 div-btns-versions" style="width: auto; padding: 2px;">'+
                            '<button class="'+class_btn_versions+' btns-versions" onclick="clcVersions(\''+version.name+'\')">'+version.name+'</button>'+
                            '</div>';

                    // });//foreach
                        }//for


                    $('#row_btns_list-versions').html(html);

                    // imagen lateral
                    let model = res.data.model.replaceAll(' ', '-');
                    let year = res.data.year;
                    let  model_year = model+'_'+year;
                    let nameimg_lateral = `Version_lateral_${model_year}.png`;
                    let path_image_to_save_lateral = 'nueva-landing-autos/'+model_year+'/';

                    let img_on_error = 'https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/competencia/subir_imagen_icon_19.png';
                    let url_img_lateral = 'https://d3s2hob8w3xwk8.cloudfront.net/nueva-landing-autos/'+model_year+'/'+nameimg_lateral;
                    

                    let id_img_laterales = 'id_img_laterales';

                    let html_img_laterales = '<img id="'+id_img_laterales+'" style="width: 57%; height: auto;" src="'+url_img_lateral+'" onerror="this.onerror=null; this.src=\''+img_on_error+'\'" alt="">';
                    $('#div_img_lateral_versiones').html(html_img_laterales);

                    let id_input_laterales = 'id_input_laterales';
                    let html_lateral_button_guardar = `<button onclick="enviar_imagen_lateral('${id_input_laterales}', '${nameimg_lateral}', '${path_image_to_save_lateral}')" style="width: 100%;" class="btn btn-primary">Guardar imagen lateral</button>`;

                    $('#div_img_lateral_button_guardar').html(html_lateral_button_guardar);

                    //message control
                    let div_img_lateral_message = '<ul style="width: 100%;" class="list-group" id="ul-modal-status2'+id_input_laterales+'">';
                    $('#div_img_lateral_message').html(div_img_lateral_message);


        }
        


    </script>
    <style>
        .custom-file-upload {
            display: inline-block;
            position: relative;
            font-family: Arial, sans-serif;
        }

        .custom-file-upload label {
            background-color: green;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }

        .custom-file-upload input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
        }
    </style>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Dropzone Plugin Js 
    <script src="../../plugins/dropzone/dropzone.js"></script>
-->
    <!-- Jquery Spinner Plugin Js -->
    <script src="../../plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js 
    <script src="../../plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
-->
    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>

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
    <!-- <script src="../../js/admin.js"></script> -->
    <script src="../../js/pages/tables/jquery-datatable.js"></script>

</body>

</html>