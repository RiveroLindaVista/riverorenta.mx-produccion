<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once("../_config.php");
include("_conexion.php");
include("classes.php");


$cone=new Conexion();
$accesorios=$cone->get_accesorios($_POST["modelo"]);
$cadena = '';
if ($accesorios) {
	
	for ($i=0; $i < count($accesorios) ; $i++) { 
		$hora = floatval($accesorios[$i]["tiempo_instalacion"]);
		if ($hora >= 1.0) {
			$horaformat = $hora." hrs";
		} else {
			$horaformat = $hora * 60 ." minutos";
		}
		
		$cadena.='
		<div class="col-6">
			<div class="p-2 m-2" style="border: 1px solid #656D78;">
     			<div class="row">
     				<div class="col-4 text-center">
     					<img width="100px" src="https://d3s2hob8w3xwk8.cloudfront.net/accesorios/'.$accesorios[$i]["num_inventario"].'.jpg" alt="accesorio-'.$accesorios[$i]["num_inventario"].'"/>
     				</div>
     				<div class="col-8">
     					<p class="texto-gris font-weight-bold" style="font-size: 21px;">'.utf8_encode($accesorios[$i]["descripcion"]).'</p>
     					<p class="texto-gris font-weight-bold mb-0"><span class="texto-azul">$'.number_format($accesorios[$i]["precio"]).'</span> contado</p>
     					<p class="texto-gris font-weight-bold mb-0"><img width="25px" src="../iconos/SVG/ico_reloj.svg" alt="icono-reloj"/><span class="texto-azul"> '.$horaformat.'</span> instalación</p>
     				</div>
     			</div>
     		</div>
	     </div>';
		     		   
	}



	echo $cadena;
}else{
	$cadena.='
		<div class="col-12">
			<div class="p-2 m-2">
     			<div class="row">
     				<h3 class="texto-gri">Sin Resultados</h3>
     				
     			</div>
     		</div
	     </div>';
	echo $cadena;
}

?>