<?php
require_once('../recepcion/_config.php');
include('../recepcion/header.php');
include('_sucursal.php');

$horaActual=date('H:i:s');
?>
<div class="position-fixed" style="width: 140px;z-index: 9;top:20px;right:20px;">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnNuevo">Crear Cita</button>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nueva Visita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
      	 <p class="text-secondary" style="font-size: 12px;">* Campos obligatorios</p>
     <div class="mb-3">
		  <label class="form-label"><span class="text-danger">*</span> Nombre</label>
		  <input type="text" class="form-control" id="nombre" placeholder="Nombre del Cliente"/>
		</div>

     <div class="mb-3">
		  <label class="form-label"><span class="text-danger">*</span> Número de Serie</label>
		  <input type="text" class="form-control" id="vin" placeholder="Últimos 8 dígitos VIN" maxlength="8">
		</div>

        <hr/>
		¿Quiere esperar a un Asesor especifico?
		<div class="row">
				<div class="col-4">
					<div class="mb-3">
					  <br/><input type="checkbox" class="form-control" id="esperar" /></label>
					  
					</div>
				</div>
				<div class="col-8">
			        <div class="mb-3" id="areaAsesor" style="display:none;">
					  <label class="form-label">Asesor</label>
					  <select id="asesor" class="form-control"></select>
					</div>
				</div>

		</div>
      </div>
      <div class="modal-footer" id="botones">
        <button type="button" class="btn btn-secondary" id="btnClose" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="crearCita()">Enviar</button>
      </div>
      <div class="modal-footer" id="success" style="display: none;">
	      <div class="alert alert-success" role="alert">
				  Guardado Correctamente.
				</div>
			</div>
    </div>
  </div>
</div>

<script>
	$("#esperar").on("change",function(){
		if($(this).is(':checked')){
			$("#areaAsesor").show();
		}else{
			$("#areaAsesor").hide();
			$("#asesor").val("Asesor a Esperar...");
		}
	});
$("#btnNuevo").on("click",function(){
	var settings = {
	  "url": "https://multimarca.gruporivero.com/api/v1/servicio/orders/asesores/<?=$sucursalId?>",
	  "method": "GET",
	  "timeout": 0,
	  "headers": {
	    "Accept": "application/json",
	    "Authorization": "Bearer <?=$tokenId?>"
	  },
	};

	$.ajax(settings).done(function (response) {
		var cadenaAse="";
	  if(response.length>0){
	  	cadenaAse='<option>Asesor a Esperar...</option>';
	  	for(var i=0;i<response.length;i++){
	  		cadenaAse+='<option>'+response[i]["asesor"]+'</option>';
	  	}
	  }
	  $("#asesor").html(cadenaAse);
	});
});
function crearCita(){
	if($("#nombre").val()!=""&&$("#vin").val().length==8){
		$("#botones").hide();

		if($("#asesor").val()!='Asesor a Esperar...'){
				var params=JSON.stringify({
			    "tipo": "sin_cita",
			    "sucursal": <?=$sucursalId?>,
			    "vin":$("#vin").val(),
			    "nombre":$("#nombre").val(),
			    "asesor":$("#asesor").val(),
			  });
		}else{
			var params=JSON.stringify({
			    "tipo": "sin_cita",
			    "sucursal": <?=$sucursalId?>,
			    "vin":$("#vin").val(),
			    "nombre":$("#nombre").val(),
			  });
		}
		var settings = {
		  "url": "https://multimarca.gruporivero.com/api/v1/servicio/sendhoraplanning",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Accept": "application/json",
		    "Authorization": "Bearer <?=$tokenId?>",
		    "Content-Type": "application/json"
		  },
		  "data": params,
		};

		$.ajax(settings).done(function (response) {
		  console.log(response);
		  $("#success").show();
		  setTimeout(function() {
	      location.reload();
	    }, 1000);
		  
		});
	}else{
	alert("Campos vacios");
	}

};
</script>
<style type="text/css">
	#hDips{
		 overflow: auto;
  	white-space: nowrap;
  	height: 70px;
	}
	#vin{
		text-transform:uppercase;
	}
</style>

<?php
include('../recepcion/_contenido.php');


include('../recepcion/footer.php');
?>

<!--232812511	GUADALUPE
382179229	HUMBERTO LOBO
402145072	SANTA CATARINA
115281495	GOMEZ MORIN
141341484	HUMBERTO LOBO ALIANZA-->