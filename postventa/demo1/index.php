
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Servicio | Grupo Rivero</title>
	<link rel="icon" type="image/x-icon" href="https://transportesrivero.com.mx/assets/images/favicon-32x32.png"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-white">

		<div class="row" style="margin-right:0px">
			<div class="col-12 col-md-3 p-4">
				<center><img src="assets/header-logo.png" width="100%" style="max-width:280px"/><br>
					<img src="assets/marcas.jpg" width="100%" style="max-width:280px"/>
				</center>
				<hr/>
				<p style="font-size: 12px;">Consultar información de paquetes:</p>
				<div class="form-group">
					 <label>Modelo</label>
					<select class="form-control" id="modelo" onchange="validarCamposLlenos()"></select>
				</div>
				<div class="form-group">
					 <label>Kilometros</label>
					<select class="form-control" id="km" onchange="validarCamposLlenos()">
							<option disabled selected>Selecciona el kilometraje</option>
							<option value="12000">12,000km</option>
							<option value="24000">24,000km</option>
							<option value="36000">36,000km</option>
							<option value="48000">48,000km</option>
							<option value="60000">60,000km</option>
							<option value="6000">Cambio de Aceite</option>
					</select>
				</div>
				<div class="form-group">
					<center><div class="btn btn-primary btn-lg" id="btnConsultar" style="display: block;opacity:0;">Consultar</div></center>
				</div>
				<div id="areaPauetePoliza" style="display:none;"><section id="paquetePoliza"></section>
					<p style="font-size: 10px;">El Paquete básico de planta GM está diseñado para condiciones óptimas de manejo, temperatura, condiciones de calles, etc. Nosotros hemos diseñada estos 3 paquetes para las condiciones de nuestra ciudad, con el objetivo de conservar el buen estado y funcionamiento del vehículo a través del tiempo.</p>
				</div>
			</div>
			<div class="col-12 col-md-9">
				<h4 class="p-2">Paquetes de Servicio</h4>
				<h5 id="tituloModel"></h5>
				<div id="respuesta" class="row"></div>
		


	<div class="col-12" id="adicionales" style="display:none;">
		<!--<h4 class="p-2">Servicios Adicionales</h4>-->
		<div id="respAdd"></div>
	<div >
		<br/><br/><br/>


</div>



<script type="text/javascript">
	$( document ).ready(function() {
		$.ajax({
		  url: "getToken.php",
		  type: 'GET',
		});
		/*$.ajax({
		  url: "getAdd.php",
		  type: 'GET',
		  success:function(response){
		  	var datax = JSON.parse(response);
		  	if(datax.data){
		  		datax = datax.data.categorias;
			  	var cadena2="";
			  	$.each(datax , function(key1, value1) {
			  	cadena2+='<div class="row border border-primary tituloAdicional"><div class="col-12 col-sm-3 bg-primary text-white"><h5 class="p-4 text-center">'+key1+'</h5></div><div class="col-12 col-sm-9"><div class="row p-2">';
					$.each(value1.adicionales , function(key2, value2) {
						cadena2+='<div class="col text-center areaAdd"><h6 class="nombreAdd">'+value2.nombre+'</h6><h5>$'+numberWithCommas(value2.precio)+'</h5></div>';
					});
					cadena2+='</div></div></div>';
			  	});
			  	$("#respAdd").html(cadena2);
		  	}
		  }
		});*/
		$.ajax({
		  url: "getModelos.php",
		  type: 'GET',
		  success:function(response){
		  	var datax = JSON.parse(response);
		  	if(datax.data){
		  		var cadena="<option disabled selected>Selecciona un modelo</option>";
		  		$.each(datax.data , function(key1, value1) {
		  			cadena+='<option>'+value1.modelo+'</option>';
		  		});
		  		$("#modelo").html(cadena);
		  	}
		  }
		});
	});
	function validarCamposLlenos(){
		$("#respuesta").html("");
		$("#paquetePoliza").html("");
		$("#adicionales").hide();
		if($("#modelo").val()!=null&&$("#km").val()!=null){
			$("#btnConsultar").css("opacity",1);
		}else{
			$("#btnConsultar").css("opacity",0);

		};
	}
	function numberWithCommas(x) {
	    x = x.toString();
	    var pattern = /(-?\d+)(\d{3})/;
	    while (pattern.test(x))
	        x = x.replace(pattern, "$1,$2");
	    return x;
	}
	function limpiar(){
		$("#paquetePoliza").html("");
		$("#adicionales").hide();
		$("#areaPauetePoliza").hide();
		$cadena='<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div>';
		$("#respuesta").html($cadena);
	}
	$("#btnConsultar").on("click",function(){
		limpiar();
		var data={
			modelo:$("#modelo").val(),
			km:$("#km").val()
		}
		$.ajax({
		  url: "consultar_paquetes.php",
		  data: data,
		  type: 'GET',
		  success: function(response){
		  	var datax = JSON.parse(response);
		  	if(datax.data.code=="200"){
		  		
		  		$("#adicionales").show();
		  		$("#areaPauetePoliza").show();
			  	datax = datax.data;
			  	var cadena="";
			  	$("#tituloModel").html($("#modelo").val()+' '+$( "#km option:selected" ).text());
			  	$soloAceite=[];
			  	$.each(datax.paquetes , function(key1, value1) {
			  		$soloAceite.push(value1["clase"]);
			  		cadena+='<div class="col"><div class="interiorCont bg-white text-dark p-2">';
			  			if(value1["clase"]=="COMPLETO"){
			  				cadena+='<h5 class="bg-info text-white p-2"><center>'+value1["clase"]+'</center></h5><h3 class="text-primary active">$'+numberWithCommas(value1["total"])+'</h3>';
			  			}else{
			  				cadena+='<h5 class="bg-info text-white p-2"><center>'+value1["clase"]+'</center></h5><h3 class="text-primary">$'+numberWithCommas(value1["total"])+'</h3>';
			  			}
			  		
			  		cadena+='<br/><strong><center>25 PUNTOS DE SEGURIDAD</center></strong><ul>';
			  		$contador=0;
			  		$.each(value1["incluye"] , function(key2, value2) {
			  			if(value2["nombre"]!="INSPECCION 25 PUNTOS DE SEGURIDAD"){
					  		if($contador%2==0){
					  			if(value1["clase"]==value2["paqueteInicial"]&&value1["clase"]!="BASICO"){
				  					cadena+='<li class="bg-light text-primary"  style="font-weight:bold"><img src="'+value2["imagen"]+'" alt="icono" width="20px"/> '+value2["nombre"]+'</li>';
				  				}else{
				  					cadena+='<li class="bg-light"><img src="'+value2["imagen"]+'" alt="icono" width="20px"/> '+value2["nombre"]+'</li>';
				  				}
				  			}else{
				  				if(value1["clase"]==value2["paqueteInicial"]&&value1["clase"]!="BASICO"){
				  					cadena+='<li class="text-primary" style="font-weight:bold"><img src="'+value2["imagen"]+'" alt="icono" width="20px"/> '+value2["nombre"]+'</li>';
				  				}else{
				  					cadena+='<li><img src="'+value2["imagen"]+'" alt="icono" width="20px"/> '+value2["nombre"]+'</li>';
				  				}
				  			}
				  			$contador=$contador+1;
				  		}
			  		});
			  		
			  		cadena+='</ul>';
			  		cadena+='</div></div>';
			  		

				});
			  	var cadenaPoliza="";

			  	if($soloAceite.indexOf("ACEITE")!=0){
			  		if(datax.poliza){
			  		cadenaPoliza+='<div class="col"><div class="interiorCont bg-white text-dark p-2">';
				  		
				  			cadenaPoliza+='<h5 class="bg-danger text-white p-2"><center>'+datax.poliza.clase+' GM</center></h5><h3 class="text-primary">$'+numberWithCommas(datax.poliza.total)+'</h3>';
				  		
				  		cadenaPoliza+='<br/><h3><ul>';
				  		$contador=0;

						$.each(datax.poliza.incluye, function(key1, value1) {
					  		
						  		if($contador%2==0){
					  				cadenaPoliza+='<li class="bg-light"><img src="'+value1["imagen"]+'" alt="icono" width="20px"/> '+value1["nombre"]+'</li>';
					  			}else{
					  				cadenaPoliza+='<li><img src="'+value1["imagen"]+'" alt="icono" width="20px"/> '+value1["nombre"]+'</li>';
					  			}
					  			$contador=$contador+1;
					  		
						});
						cadenaPoliza+='</ul></h3>';
				  		cadenaPoliza+='</div></div>';
								$("#paquetePoliza").html(cadenaPoliza);
					}
				}

				$("#respuesta").html(cadena);

			}else{
				$("#respuesta").html("No hay paquetes disponibles");
			}
		  }
		});
	});

</script>
<style>
	.tituloAdicional{
		border-radius: 10px;
		overflow: hidden;
		margin-bottom: 10px;
	}
	.nombreAdd{
		height: 30px;
	}
	.areaAdd{
		border-left: 1px solid #fff;
	}
	.interiorCont{
		margin: 1px;
		border-radius: 8px;
	}
	#respuesta .conPaq h5{
		text-align: center;
	}
	ul{
		list-style: none;
		margin: 0px;
		padding: 0px;
	}
	li{
		font-size: 12px;
		padding: 5px;
	}
	h3{
		opacity: 0;
		text-align: center;
		height: 1px;
		transition-duration: 0.5s;
	}
	.interiorCont:hover{
		cursor: pointer;
	}
	.interiorCont:hover >h3{
		opacity: 1;
		height: auto;
		transition-duration: 2s;
	}
	.active{
		opacity: 1;
		height: auto;
		transition-duration: 2s;
	}
</style>
</body>
</html>