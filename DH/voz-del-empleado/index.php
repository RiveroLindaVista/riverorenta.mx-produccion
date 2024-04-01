<!DOCTYPE html>
<html>
<head>
	<title>Grupo Rivero | Mejora continua</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>

</head>
<body>
<section class="container p-3">
	<div class="row">
		<div class="col-12 col-md-4">
			<!--<img src="logo_rivero.png" width ="100%" style="max-width: 350px;"/><br/><br/>-->
			<div class="areaFondo">
				<img src="mejora-continua.jpg" width ="100%"/>
			</div>
			
		</div>
		<div class="col-12 col-md-8">
<h1><center>La Voz de Nuestra Gente</center></h1><p><center>Queremos escucharte escribir tu nombre es opcional, a menos que quieras que te actualicemos sobre el avance de tu solicitud.</center></p>
	<form action="https://webto.salesforce.com/servlet/servlet.WebToCase?encoding=UTF-8" method="POST">
<input type=hidden name="orgid" value="00Df4000004ls8N">
<input type=hidden name="retURL" value="https://voz-del-empleado.gruporivero.com/gracias/">
<input type="hidden" name="status" id="status" value="Nuevo">
<input type="hidden" name="recordType" id="recordType" value="0122S000000oWYN">

<input type="hidden" name="OwnerId" id="OwnerId" value="0052S00000A2naJQAR">

<input type="text" name="subject" id="subject" value="Mejora continua" hidden/>

<div class="bg-info text-white"><center>Datos personales</center></div>

<div class="row">
	<!--<div class="col-4 form-group">
		 <label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>Número de empleado (opcional)</center></label>
		 <input type="TEXT" name="00N2S000007YJl3" id="00N2S000007YJl3" placeholder="Número de Nomina" title="Número incorrrecto" />
	</div>-->
	<div class="col-12 col-md-6">
		<label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>Nombre (opcional)</center></label>
		<input type="TEXT" name="NombreAsesorTexto__c" id="NombreAsesorTexto__c" />
	</div>
	<div class="col-12 col-md-6 form-group">
		 <label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>Apellidos (opcional)</center></label>
		<input  id="DH_contacto__c" maxlength="255" name="DH_contacto__c" size="20" type="text" />
	</div>
	<!--<div class="col-4">
		<label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>Sucursal</center></label>
		<select id="00Nf400000UBiZY" name="00Nf400000UBiZY" required>
							<option value="1043193">Linda Vista</option>
							<option value="232812511">Guadalupe</option>
							<option value="402145072">Santa Catarina</option>
							<option value="382179229">Humberto Lobo</option>
							<option value="128553452">Transportes</option>		
		</select>
	</div>-->

	

	
</div>

<div class="row">
	<div class="col-12 col-md-6">
		<label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff">
			<center>Empresa</center>
		</label>
		<select id="00N8a00000H9214" name="00N8a00000H9214" required>
							<option value="Chevrolet">Chevrolet</option>
							<option value="Nissan">Nissan</option>
							<option value="Transportes">Transportes</option>
								
		</select>
	</div>
	
	<div class="col-12 col-md-6 form-group">
		<label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>Concepto</center></label>
		<input type="radio" name="00N8a00000EPmLz" value="Solicitud de mejora"/>Solicitud de mejora<br/>
		<input type="radio" name="00N8a00000EPmLz" value="Felicitación"/>Felicitación<br/>

	</div>

	<!--<div class="col-4 form-group">
		 <label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>¿A quién va dirigida?</center></label>
					<select name="00N8a00000EPmWu" id="00N8a00000EPmWu">
							<option>Accesorios</option>
							<option>BDC Call Center</option>
							<option>Body Shop</option>
							<option>Calidad</option>
							<option>Cobranza</option>
							<option>Compras</option>
							<option>Contabilidad</option>
							<option>Control Interno</option>
							<option>Credito y Cobranza</option>
							<option>Creditos</option>
							<option>Desarrollo Humano</option>
							<option>Direccion</option>
							<option>Experiencia al Cliente</option>
							<option>Externos</option>
							<option>F&I</option>
							<option>Finanzas</option>
							<option>Fleet Services</option>
							<option>Mantenimiento</option>
							<option>Mercadotecnia</option>
							<option>Refacciones</option>
							<option>Rentas</option>
							<option>Seminuevos</option>
							<option>Servicio</option>
							<option>Sistemas</option>
							<option>Ventas</option>
						</select>
	</div>-->
	

</div>

<!--<div class="bg-info text-white"><center>Elige el concepto</center></div>

<div class="row">
	<div class="col-6 form-group">
		<label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>Concepto</center></label>
		<select id="00N8a00000EPmLz" name="00N8a00000EPmLz" required>
							<option>¿Qué quieres que mejore?</option>
							<option>Felicitación</option>
						</select>
	</div>
	
	<div class="col-6">
		<label for="Numero" style="font-size: 12px;width: 100%;background: #092A7C;color:#fff"><center>Tipificación</center></label>
		<select  id="00N8a00000FObSK" name="00N8a00000FObSK" title="Tipificacion">
			<option value="">--Ninguno--</option>
			<option value="Acoso">Acoso</option>
			<option value="Acto inseguro">Acto inseguro</option>
			<option value="Capacitacion">Capacitacion</option>
			<option value="Condicion insegura">Condicion insegura</option>
			<option value="Hambiente laboral">Hambiente laboral</option>
			<option value="Sueldo">Sueldo</option>
			<option value="Tiempo">Tiempo</option>
		</select>
	</div>
</div>-->
			
		
		
		<div style="clear: both;"/>
		<center>Por favor cuéntanos ¿Cómo podemos apoyarte?</center>
		<label for="Numero" style="font-size: 12px;width: 100%;background: #94A3CA;color:#fff"><center>Escribe tu solicitud de mejora o una felicitación *</center></label>
		<textarea name="00N2S000007YJlD" required></textarea><br>
		<center>Escribe del 1 a 10 que tan importante es para ti,<br>donde 1 es la menos importante y la 10 es la más importante.</center>
		<table width="100%">
			<thead><tr>
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
				<th>9</th>
				<th>10</th>
			</tr></thead>
			<tbody><tr>
				<th><input type="radio" name="GRI_Solucion__c" value="1" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="2" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="3" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="4" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="5" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="6" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="7" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="8" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="9" /></th>
				<th><input type="radio" name="GRI_Solucion__c" value="10" /></th>
			</tr></tbody>
		</table>

		<div style="clear: both;"/>
		<br>
		<!--<label for="Numero" style="font-size: 12px;width: 100%;background: #94A3CA;color:#fff"><center>¿Cómo te gustaría que esto mejorara? *</center></label>
		<textarea name="00N2S000007YJlI" required></textarea>
		<div style="clear: both;"/>-->

		<label for="Numero" style="font-size: 12px;width: 100%;background: #94A3CA;color:#fff"><center>Ajunta un archivo o imagen:</center></label>
		<div class="btnEnviat">Subir imagen o documento (JPG,PNG,PDF)</div>
		<input type="file" name="file" id="imagen" hidden><br><br>

		<input  id="00N2S000007YJlS" maxlength="255" name="00N2S000007YJlS" size="20" placeholder="URL ADJUNTOS" hidden />

		<br>


		<input type="SUBMIT" value="Enviar" >
	</form>

</div>
<div style="clear: both;"/><br>
</div>
</div>
</section>
<script>
	/*function getUsuario(){
		if($("#00N2S000007YJl3").val()!=""){
			var param={
				id:$("#00N2S000007YJl3").val()
			}
			$.ajax({
			  url: "getUsuario.php",
			  type: 'GET',
			  data:param,
			  success:function(event){
			  	if(event){
			  		var resultado=JSON.parse(event);
			  		if(resultado["respuesta"].sucursal=="Linda Vista"){
			  			resultado["respuesta"].sucursal="1043193";
			  		}
			  		if(resultado["respuesta"].sucursal=="Guadalupe"){
			  			resultado["respuesta"].sucursal="232812511";
			  		}
			  		if(resultado["respuesta"].sucursal=="Santa Catarina"){
			  			resultado["respuesta"].sucursal="402145072";
			  		}
			  		if(resultado["respuesta"].sucursal=="Humberto Lobo"){
			  			resultado["respuesta"].sucursal="382179229";
			  		}
			  		if(resultado["respuesta"].sucursal=="Transportes"){
			  			resultado["respuesta"].sucursal="128553452";
			  		}
			  		$("#NombreAsesorTexto__c").val(resultado["respuesta"].nombre);
			  		$("#00Nf400000UBiZY").val(resultado["respuesta"].sucursal);
			  		$("#00N8a00000FObSF").val(resultado["respuesta"].puesto);
			  	}
			  }
			});
		}
	};
*/
	$(".btnEnviat").on("click",function(){
		$("#imagen").click();
	});
	$("#imagen").on("change",function(){
			  var fd = new FormData();
                var files = $('#imagen')[0].files[0];
                fd.append('file', files);
       
                $.ajax({
                    url: 'upload.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != 0){
                        	$("#00N2S000007YJlS").val('https://voz-del-empleado.gruporivero.com/'+response);
                           	$(".btnEnviat").toggleClass("active");
                        }
                        else{
                            alert('file not uploaded');
                        }
                    },
                });
		//console.log($("#imagen").val());
	});


</script>
<style type="text/css">
	th{
		text-align: center;
	}
</style>
</body>
</html>






