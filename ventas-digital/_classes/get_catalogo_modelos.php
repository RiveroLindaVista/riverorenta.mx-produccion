<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once("../_config.php");
include("_conexion.php");
include("classes.php");

$cone=new Conexion();
$modelos=$cone->getCatalogoModelos($_POST["tipo"]);


		
$cadena_modelos = '
			
		<div class="respModelos">
		<div class="row">';

		for ($i=0; $i < count($modelos) ; $i++) { 
		$cadena_modelos.='
			<div class="col-md-4 col-sm-6 mb-3" onclick="abrirOp(\''.$modelos[$i]["modelo"].'\', \''.$modelos[$i]["ano"].'\', \''.$modelos[$i]["tipo"].'\', \''.$modelos[$i]["urldestino"].'\', \''.$modelos[$i]["id"].'\', \''.$modelos[$i]["url"].'\')">
				<div class="card-catalogo text-center m-0" id="'.$modelos[$i]["id"].'">
				<h5 class="pt-2">'.$modelos[$i]["modelo"].'</h5>
					<img class="img-fluid" src="'.$modelos[$i]["url"].'" alt="'.$modelos[$i]["modelo"].'"/>
					
				</div>
			</div>';

		}
		$cadena_modelos.= '</div></div>';

echo $cadena_modelos;
?>