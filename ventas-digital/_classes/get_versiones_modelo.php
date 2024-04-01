<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once("../_config.php");
include("_conexion.php");
include("classes.php");


$cone=new Conexion();
$versiones=$cone->get_versiones_modelo($_POST["slug"]);

if ($versiones) {
	//var_dump($versiones);
	$arrayVersiones=[];
	$versionesUnicos=[];
	for ($i=0; $i < count($versiones) ; $i++) { 
		if(!in_array($versiones[$i]["version"], $versionesUnicos)){
			$versionesUnicos[]=$versiones[$i]["version"];
			$versionesPrecio[] = $versiones[$i]["precio"];
			$versionesId[] = $versiones[$i]["id"];
			$versionesSlug[] = $versiones[$i]["slug"];
			$versionesTipo[] = $versiones[$i]["tipo"];
			$versionesAno[] = $versiones[$i]["ano"];

		}
		$arrayVersiones[$versiones[$i]["version"]]["url"][]=$versiones[$i]["url"];
		$arrayVersiones[$versiones[$i]["version"]]["metavalue"][]=utf8_encode($versiones[$i]["metavalue"]);
		     		   
	}
$caracteristicas="";
	for($i=0;$i<count($versionesUnicos);$i++){
		$cadena.='
		<div style="display: inline-block;">
			<div class="card-versiones m-3 p-3" onclick="seleccionar(\''.$versionesUnicos[$i].'\', \''.$versionesId[$i].'\', \''.$versionesPrecio[$i].'\', \''.$versionesSlug[$i].'\', \''.$versionesTipo[$i].'\', \''.$versionesAno[$i].'\')" data-id="'.$versionesId[$i].'">           
                <p class="mb-2"><h5 class="m-0">'.$versionesUnicos[$i].'</h5><span><br>Precio: $'.number_format($versionesPrecio[$i]).'</span></p>
                <div class="col-12 mb-1">Características principales</div>
                <div class="row" style="overflow-y: auto;height: 360px;">                   	
                	
                	<div class="col-12">
                		';
				      for($t=0;$t<count($arrayVersiones[$versionesUnicos[$i]]["url"]);$t++){

				         $cadena.='<p><img width="20px" src="'.$arrayVersiones[$versionesUnicos[$i]]["url"][$t].'"/> '.$arrayVersiones[$versionesUnicos[$i]]["metavalue"][$t].'</p>';
				      	
				       }
        	$cadena.='
        			</div>
	            </div>                                    
		    </div>	     
		</div>';	
	}


	echo $cadena;
}
//print(json_encode($out));
/*

		$versionActual = $versiones[$i]["version"];
		if ($versionActual != $version) {
			
		        $cadena.='
			<div class="col-4"><div class="card" style="width: 100%; border: 1px solid #656D78;">
                <div class="card-body texto-gris">
                    <h5 class="card-title mb-2">'.$versiones[$i]["version"].' <span class="texto-azul">$269,100</span><span style="font-size: 10px;"> Precio de lista</span></h5>
                    <div class="row">
                    	<div class="col-4 px-2"><div class="barra-gris"></div></div>
                    	<div class="col-8 mb-3"><span class="text-muted">Características principales</span></div>
                    	<div class="col-12">
                    		<p><img width="30px" src="'.$versiones[$i]["url"].'"/> '.utf8_encode($versiones[$i]["metavalue"]).'</p>';	
              $version = $versiones[$i]["version"];	
		}else{
		
            $cadenaVersion ='<p><img width="30px" src="'.$versiones[$i]["url"].'"/> '.utf8_encode($versiones[$i]["metavalue"]).'</p>';
		    $cadena.= $cadenaVersion;

	     }

	     if ($version != $versionCierre) { 
	     $versionCierre= $version;        		
		    $cadena.='</div>
		                <div class="col-12 mt-3">
		                <div id="ls" style="margin-left:25%; width:50%; font-size: 1.1vw; border-radius: 35px; padding: 2.5% 22%;" class="btn btn-primary" onclick="seleccionar(\''.$versiones[$i]["version"].'\')">'.$versiones[$i]["version"].'</div>    
		                </div>
		            </div>  
	            </div>	              
		    </div>';
		     
	     } 	
	     */
?>