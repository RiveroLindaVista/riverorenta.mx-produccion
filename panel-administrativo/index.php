<?php
session_start();
include("_inc/_config.php");
var_dump($_SESSION["usuario"]["user"]);
/*include("multimarcaWS.php");

$ws = new multimarca_ws();
if ($_SESSION["user"]["ws_key"] == "") {
    
    $login = $ws->login(multimarca_ws::$ws_key, multimarca_ws::$public_key, multimarca_ws::$ip_server);

    $_SESSION["user"]["ws_key"] = $login["result"]->data->ws_key;
    $_SESSION["user"]["ip_server"] = $login["result"]->data->endpoint[0]->url;

    $ws_key = $_SESSION["user"]["ws_key"];
    $ip_server = $_SESSION["user"]["ip_server"];
}

$select = 'select clientes';
$where = 'where clientes.id>0';
$clientes = $ws->get_clientes($ip_server, $select, $where, $ws_key);

var_dump($_SESSION["user"]);
var_dump($clientes);*/


$this_page = "home";
if ($this_page=="home") { $home="active"; } else{ $home="active"; }

    $conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);
    $slide = -1;

$hoy = date("Y-m-d");
$HOY=$hoy;
$AYER= date("Y-m-d",strtotime($hoy."- 1 days")); 
$MES=date("Y-m");

    $sql = 'SELECT marca, count(marca) as tt from inventario_nuevos where marca="BUICK" group by marca';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       $row = $resultQuery->fetch_assoc();
       $n_buick=$row['tt'];
       $m_buick=$row['marca'];
    }
    $sql = 'SELECT marca, count(marca) as tt from inventario_nuevos where marca="CADILLAC" group by marca';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       $row = $resultQuery->fetch_assoc();
       $n_cadillac=$row['tt'];
       $m_cadillac=$row['marca'];
    }
    $sql = 'SELECT marca, count(marca) as tt from inventario_nuevos where marca="CHEVROLET" group by marca';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       $row = $resultQuery->fetch_assoc();
       $n_chevrolet=$row['tt'];
       $m_chevrolet=$row['marca'];
    }
    $sql = 'SELECT marca, count(marca) as tt from inventario_nuevos where marca="GMC" group by marca';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       $row = $resultQuery->fetch_assoc();
       $n_gmc=$row['tt'];
       $m_gmc=$row['marca'];
    }

    $sql =  'SELECT  ip, count(ip) as count FROM historial WHERE ip !=""  and IP  NOT LIKE "%.local" GROUP BY ip  ORDER BY count DESC LIMIT 7 ';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
            $cadenaAcceso.='<li><span style="width:60%;overflow: hidden;text-overflow: ellipsis;">'.$row['ip'].'</span><span class="pull-right"><b>'.$row['count'].'</b> <small>ACCESOS</small></span></li>';
       }
    }

    $sql = 'SELECT  fecha,IP,meta_value, count(meta_value) as count FROM historial WHERE meta_value !="" and meta_value !="https://www.google.com/" and meta_value !="https://google.com" and meta_value!="clic-siguiente-sem" and IP !="" and IP NOT LIKE"%local" and fecha LIKE "2020-03%" GROUP BY meta_value  ORDER BY count desc LIMIT  7';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
             $cadenaIPs.='<li><span style="width:60%;overflow: hidden;text-overflow: ellipsis;">'.$row['meta_value'].'</span><span class="pull-right"><b>'.$row['count'].'</b> <small>VISTAS</small></span></li>';
       }
    }

     $sql = 'SELECT meta_value, count(meta_value) as count FROM historial WHERE meta_value !="" and meta_value!="https://google.com" GROUP BY meta_value  ORDER BY fecha DESC LIMIT 30';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
             $cadenaIPs2.=$row['count'].',';
       }
    }
     $sql = 'SELECT meta_value, count(meta_value) as count FROM historial WHERE meta_value !="" and meta_value!="https://google.com" GROUP BY meta_value  ORDER BY fecha DESC';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
             $cadenaIPs3.=$row['count'].',';
       }
    }

    $sql = 'SELECT CURDATE() as fecha';
    $resultQuery = $conn->query($sql);
    $row = $resultQuery->fetch_row();
   $FECHA=$row[0];

    $sql = 'SELECT IP, meta_value, count(IP) as cont FROM historial WHERE meta_value != "" and fecha  LIKE "'.$FECHA.'%" group by IP order by fecha DESC';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       $row = $resultQuery->fetch_assoc();
       $fechaHoyTotlal=$row['cont'];
       $urlhoy=$row['meta_value'];
    }
    $sql = 'SELECT meta_value, count(meta_value) as cont FROM historial WHERE meta_value != "https://google.com" and fecha = CURDATE()-1 group by meta_value order by fecha;';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       $row = $resultQuery->fetch_assoc();
       $fechaayerTotlal=$row['cont'];
       $urlayer=$row['meta_value'];
    }
    $fecha2 = substr($FECHA,0,7);
    $sql = 'SELECT meta_value, count(meta_value) as cont FROM historial WHERE meta_value != "https://google.com" and fecha LIKE "'.$fecha2.'%" group by meta_value order by fecha;';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       $row = $resultQuery->fetch_assoc();
       $fechamesTotlal=$row['cont'];
       $urlmes=$row['meta_value'];
    }

    $sql = 'SELECT  fecha,IP,meta_value, count(meta_value) as count FROM historial WHERE meta_value !="" and meta_value !="https://www.google.com/" and meta_value !="cotizador-catalogo-nuevos-flecha-mas" and meta_value !="cotizador-catalogo-nuevos-flecha-menos" and meta_value !="top-menu-seminuevos" and meta_value !="clic-top-menu-SEMINUEVOS" and meta_value !="clic-top-menu-NUEVOS" and meta_value !="clic-siguiente-banner" and meta_value !="galeria-flecha-siguiente" and meta_value !="abrio-menu" and meta_value !="https://google.com" and meta_value!="clic-siguiente-sem" and IP !="" and IP NOT LIKE"%local" and fecha LIKE "'.$MES.'%" GROUP BY meta_value  ORDER BY fecha desc LIMIT 20';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
             //$cad.=$row['count'].',';
             $dato1.=$row['count'].',';
             $dato2.="'".$row['IP']."'".",";
       }
    }

    $sql = 'SELECT  fecha,IP,meta_value, count(meta_value) as count FROM historial WHERE meta_value !="" and meta_value !="https://www.google.com/" and meta_value !="cotizador-catalogo-nuevos-flecha-mas" and meta_value !="cotizador-catalogo-nuevos-flecha-menos" and meta_value !="top-menu-seminuevos" and meta_value !="clic-top-menu-SEMINUEVOS" and meta_value !="clic-top-menu-NUEVOS" and meta_value !="clic-siguiente-banner" and meta_value !="galeria-flecha-siguiente" and meta_value !="abrio-menu" and meta_value !="https://google.com" and meta_value!="clic-siguiente-sem" and IP !="" and IP NOT LIKE"%local" and fecha LIKE "'.$MES.'%" GROUP BY meta_value  ORDER BY count desc LIMIT 20';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
             $cad2.="['".$row['meta_value']."', ".$row['count']."],";
             
       }
    }
$varlocal="%.local";
     $sql = 'SELECT COUNT(DISTINCT(IP)) as count FROM historial WHERE IP != "" and IP  NOT LIKE "'.$varlocal.'" and fecha  LIKE "'.$HOY.'%"';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
              $totalHoy=$row['count'];
       }
    }

    $sql = 'SELECT COUNT(DISTINCT(IP)) as count FROM historial WHERE IP != "" and IP  NOT LIKE "'.$varlocal.'" and fecha LIKE "'.$AYER.'%" ';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
              $totalAyer=$row['count'];
       }
    }

$sql = 'SELECT COUNT(DISTINCT(IP)) as count FROM historial WHERE IP != "" and IP  NOT LIKE "'.$varlocal.'" and fecha LIKE "'.$MES.'%" ';
    $resultQuery = $conn->query($sql);
    if ($resultQuery->num_rows > 0) {
       while($row = $resultQuery->fetch_assoc()) {
              $totalMes=$row['count'];
       }
    }


//echo "fecha:".$FECHA;
//echo "hoy".$fechaHoyTotlal."-";
//echo "ayer".$fechamesTotlal."-";
//echo "mes".$fechamesTotlal;
$resdato1= substr($dato1, 0, -1);
$resdato2= substr($dato2, 0, -1);

   $cadenaTt = substr($cadenaIPs2, 0, -1);
   $cadenaTt2 = substr($cad, 0, -1);
   $cadenaTt3 = substr($cad2, 0, -1);
   //echo 'SELECT COUNT(DISTINCT(IP)) as count FROM historial WHERE IP != "" and IP  NOT LIKE "'.$varlocal.'" and fecha  LIKE "'.$HOY.'%"';
   //echo $resdato1;
   //echo $resdato2;


?>

<!DOCTYPE html>
<html>
     
<head>
   <?php include('_inc/_header.php');?>
</head>

<body class="theme-blue">
  <!-- #Top Bar -->
   <?php include('_inc/_search-bar.php');?>
<!-- #Menu -->
    <section>
    <?php include('_inc/_menu.php');?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
    <?//include('_inc/_gadgets.php');?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD <?= $usuario;?></h2>
            </div>

            <!-- Widgets -->
        <h5 >
            Numero de autos en inventario 
        </h5>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text"><?=$m_buick?></div>
                            <div class="number count-to" data-from="0" data-to="<?=$n_buick?>" data-speed="15" data-fresh-interval="20"><?=$n_buick?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text"><?=$m_cadillac?></div>
                            <div class="number count-to" data-from="0" data-to="<?=$n_cadillac?>" data-speed="1000" data-fresh-interval="20"><?=$n_cadillac?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text"><?=$m_chevrolet?></div>
                            <div class="number count-to" data-from="0" data-to="<?=$n_chevrolet?>" data-speed="1000" data-fresh-interval="20"><?=$n_chevrolet?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text"><?=$m_gmc?></div>
                            <div class="number count-to" data-from="0" data-to="<?=$n_gmc?>" data-speed="1000" data-fresh-interval="20"><?=$n_gmc?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix" hidden="">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>CPU USAGE (%)</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="min-height:280px;">
                    <div class="card">
                        <div class="body bg-pink" style="min-height:280px;">
                           
                                <?//=$cadenaTt2?>
                                <div id="chart_div1" style="width: 100%; max-height: 150px;"></div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    VISITAS HOY
                                    <span class="pull-right"><b><?php echo $totalHoy;?></b> <small>VISTAS</small></span>
                                </li>
                                <li>
                                    AYER
                                    <span class="pull-right"><b><? echo $totalAyer;?></b> <small>VISTAS</small></span>
                                </li>
                                <li>
                                    ESTE MES
                                    <span class="pull-right"><b><?php echo $totalMes;?></b> <small>VISTAS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" style="min-height:280px;">
                    <div class="card">
                        <div class="body bg-cyan" style="min-height:280px;">
                            <div class="font-bold m-b--35">IP QUE MAS ACCESA</div>
                            <ul class="dashboard-stat-list">
                               <?=$cadenaAcceso;?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" style="min-height:280px;">
                    <div class="card">
                        <div class="body bg-teal" style="min-height:280px;">
                            <div class="font-bold m-b--35">URL QUE MAS VISITAN</div>
                            <ul class="dashboard-stat-list">
                                <?=$cadenaIPs;?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>
            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" hidden="">
                    <div class="card">
                        <div class="header">
                            <h2>INTERACCIONES DEL MES</h2>
                        </div>
                        <div class="body">
                            <div class="sparkline" data-type="bar" data-width="100%" data-height="150px" data-bar-Width="16" data-bar-Spacing="7" data-bar-Color="rgb(0, 188, 212)" style="overflow-x:scroll; ">
                               <?=$cadenaTt;?>
                            </div>
                            <textarea id="barras" hidden=""><?=$cadenaTt3?></textarea>
                        </div>
                    </div>
                </div>

                 <!-- Bar Chart -->
                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                    <div class="card">
                        <div class="header">
                            <h2>INTERACCIOONES DEL MES</h2>
                        </div>
                        <div class="body">
                            <div >
                                  <div id="chart_div"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>
        </div>
    </section>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <?include('_inc/_scripts.php');?>
     <script>

        google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['URL', 'Visitas'],
        <?=$cadenaTt3;?>
      ]);

      var options = {
        title: '',
        chartArea: {width: '30%', height:'400px'},
        hAxis: {
          title: 'Total de visitas',
          minValue: 0
        },
        vAxis: {
          title: ''
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

// LINE CHART
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
           ['IP', <?=$resdato2;?>],
          ['Cantidad', <?=$resdato1;?>]
        ]);

        var options = {
          title : 'Accesos por del utlimo mes(20)',
          vAxis: {title: 'Acceos'},
          hAxis: {title: 'Accesos'},
          seriesType: 'bars'       };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }


    </script>
</body>

</html>
