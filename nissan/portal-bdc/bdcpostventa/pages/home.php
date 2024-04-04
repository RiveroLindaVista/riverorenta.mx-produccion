<?php
if(isset($_GET["tb"])){
$_GET["tb"]=$_GET["tb"];
}else{
	$_GET["tb"]=10;
}

?>
<div class="row p-2">

<div class="col-12 col-md-4">

	<div class="card">
	  <div class="card-header">
	    Asesor: Enrique Casas
	  </div>
	  <div class="card-body">
	    <div class="input-group mb-3">
	      
		  <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar Cliente" aria-describedby="basic-addon2" id="buscar" value="KN714784">

		  <div class="input-group-prepend">
		    <button class="btn btn-outline-secondary" id="btnBuscar" type="button" onclick="buscarCliente()">Buscar</button>

		</div>
		     
		</div>
		<small id="emailHelp" class="form-text text-muted">Buscar cliente por Correo o Whatsapp o bien por el Vin (Ultimos 8 Digitos)</small>

	  </div>
	</div>
<br>

	<div class="card">
	  <div class="card-header">
	   Buscar por tipo de Base
	  </div>
	  <div class="card-body">
	    
		  <select class="form-select" aria-label="Default select example" id="selectBase">
		  	<option disabled value selected>Tipo de Base</option>
		  	<option value="0" <?php if($_GET["tb"]==0){echo 'selected';}?>>Primera Visita</option>
		  	<option value="1" <?php if($_GET["tb"]==1){echo 'selected';}?>>1 Año</option>
		  	<option value="2" <?php if($_GET["tb"]==2){echo 'selected';}?>>2 Años</option>
		  	<option value="3" <?php if($_GET["tb"]==3){echo 'selected';}?>>3 Años</option>
		  	<option value="4" <?php if($_GET["tb"]==4){echo 'selected';}?>>4 Años</option>
		  	<option value="5" <?php if($_GET["tb"]==5){echo 'selected';}?>>5 Años</option>
		  	<option value="6" <?php if($_GET["tb"]==6){echo 'selected';}?>>6 Años</option>
		  	<option value="7" <?php if($_GET["tb"]==7){echo 'selected';}?>>7 Años</option>
		  	<option value="8" <?php if($_GET["tb"]==8){echo 'selected';}?>>Mas de 7 Años</option>
		  </select>   
		</div>
		
	 
	</div>

</div>

<div class="col-12 col-md-8">
	<div class="card">
	  <div class="card-header">
		Clientes
	</div>
	<div style="display:none;" id="areaSpinner">
		 <div class="d-flex justify-content-center p-2" id="spinner" style="display:none;">
		  <div class="spinner-border" role="status">
		    <span class="sr-only"></span>
		  </div>
		</div>
	</div>
<div style="display:none;" id="areaResultados" class="p-2">
	 	<table id="example" class="table table-striped" style="width:100%;font-size: 13px;">
		  <thead>
		    <tr>
		      <th scope="col">Nombre</th>
		      <th scope="col">Unidad</th>
		      <th scope="col">Año</th>
		      <th scope="col">VIN</th>
		      <th scope="col">U.Visita</th>
		      <th scope="col">U.Tarea</th>
		    </tr>
		  </thead>
		  <tbody id="respCliente">
		  </tbody>
		</table>
	</div>
	 </div>
</div>
</div>

</div>

<script>
	$("#areaResultados").show();
		$('#example').DataTable({
                cache: false,
                search:false,
                striped: true,
                lengthMenu: [1000],
                 paging: false,
			    scrollCollapse: true,
			    scrollY: 430
	});

	var tb=<?=$_GET["tb"]?>;
	if(tb!=10){
		buscarTipoBase(tb);
	}
	function buscarCliente(){
		$("#areaSpinner").fadeIn();
		 $("#example").DataTable().destroy();
		document.getElementById("respCliente").innerHTML="";
		var input=$("#buscar").val();
		if(input!=""){
			var settings = {
			  "url": "<?=URLAPI?>/portal/nissan/api/routes.php?evt=search_clientes&contacto="+input,
			  "method": "GET",
			  "timeout": 0,
			};
			var cadena="";
			$.ajax(settings).done(function (response) {
				var resp=JSON.parse(response);
		
			  for(var i=0;i<resp.length;i++){
			  		var fecUV=resp[i]["FECULTVIS"];
			  	cadena+='<tr>';
			  	if(resp[i]["NOMBRE_VISIBLE"]){
			  	cadena+='<td><a href="detalles?carid='+resp[i]["CARID"]+'">'+resp[i]["NOMBRE_VISIBLE"]+'</a></td>';
				  }else{
				  	cadena+='<td><a href="detalles?carid='+resp[i]["CARID"]+'">'+resp[i]["CF1"]+' '+resp[i]["APELLIDO1"]+'</a></td>';
				  }
			  	cadena+='<td>'+resp[i]["MARCA"]+' '+resp[i]["MODELO"]+'</td>';
			  	cadena+='<td>'+resp[i]["ANO"]+'</td>';
			  	cadena+='<td>'+resp[i]["MATRICULA"]+'</td>';
			  	cadena+='<td>'+fecUV.substring(8,10)+'/'+fecUV.substring(5,7)+'/'+fecUV.substring(0,4)+'</td>';
			  	cadena+='<td></td>';
			  	cadena+='</tr>';
			  }
			  document.getElementById("respCliente").innerHTML=cadena;
			    $("#areaResultados").show();
			  $("#areaSpinner").hide();
			  $("#example").DataTable();
			});

			$("#buscar").css("border-color","gray");
		}else{
			$("#buscar").css("border-color","red");

		}
	}

$("#selectBase").on("change",function(){
	buscarTipoBase($(this).val());
});
	function buscarTipoBase($tipoBase){
		$("#areaSpinner").fadeIn();
		 $("#example").DataTable().destroy();
		 document.getElementById("respCliente").innerHTML="";
			var settings = {
			  "url": "<?=URLAPI?>/portal/nissan/api/routes.php?evt=tipoBase&base="+$tipoBase,
			  "method": "GET",
			  "timeout": 0,
			};
			var cadena="";
			$.ajax(settings).done(function (response) {
				var resp=JSON.parse(response);
			  
			  for(var i=0;i<resp.length;i++){
			  	var fecUV=resp[i]["FECULTVIS"];

			  	cadena+='<tr>';
			  	if(resp[i]["NOMBRE_VISIBLE"]){
			  	cadena+='<td><a href="detalles?carid='+resp[i]["CARID"]+'&tb='+$tipoBase+'">'+resp[i]["NOMBRE_VISIBLE"]+'</a></td>';
			  }else{
			  	cadena+='<td><a href="detalles?carid='+resp[i]["CARID"]+'&tb='+$tipoBase+'">'+resp[i]["CF1"]+' '+resp[i]["APELLIDO1"]+'</a></td>';
			  }
			  	cadena+='<td>'+resp[i]["MODELO"]+'</td>';
			  	cadena+='<td>'+resp[i]["ANO"]+'</td>';
			  	cadena+='<td>'+resp[i]["MATRICULA"]+'</td>';
			  	cadena+='<td>'+fecUV.substring(8,10)+'/'+fecUV.substring(5,7)+'/'+fecUV.substring(0,4)+'</td>';
			  	cadena+='<td></td>';
			  	cadena+='</tr>';
			  }
			  
			 
			  document.getElementById("respCliente").innerHTML=cadena;
			  $("#areaResultados").show();
			  	 $("#areaSpinner").hide();
			  	 $("#example").DataTable();
			});

	
	}

</script>