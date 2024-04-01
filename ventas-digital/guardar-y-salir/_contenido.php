<?php
	$ownerId=$_SESSION["owner"];
	$ownerId=explode('@',$ownerId);
?>
  <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/es.js"></script>
<div class="row">
	<div class="col-12">
		<h1 class="titulo-uno">Próximo Contacto</h1>	
		<p>Nos aseguraremos que siempre recibas el mejor asesoramiento y resolver todas tus dudas.</p>
		<h4>¿Cuál es el mejor momento para contactarte?</h4>
	</div>

	<div class="col-12">
		<hr/>
		<h4>Crear Tarea</h4>

		<div class="form-row">
		   <div class="form-group col-md-6 col-12">
		    	<label>Título:</label>
		    	<input type="text" class="form-control text-white w-100" name="asunto" id="asunto"/>
			</div>

			<div class="form-group col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<label>Fecha y Hora de inicio:</label>
					</div>
					
			        <div class='input-group date col-md-6 col-12 px-4' id='datetimepicker1'>
		               <input type='text' class="form-control" id="fecha" value="<?=date('d-m-Y')?>"/>
		               <span class="input-group-addon">
		               <span class="glyphicon glyphicon-calendar"></span>
		               </span>
			        </div>	
			     
					<div class='input-group time col-md-6 col-12 px-4' id='datetimepicker2'>
			            <input type='text' class="form-control" id="hora"/>
			            <span class="input-group-addon">
			            	<span class="glyphicon glyphicon-time"></span>
			            </span>
			        </div>	    				      
				</div>		    	         			
			</div>			
		</div>
		<div class="form-row">
		    <div class="form-group col-md-6 col-12">
		  	 <label>Preferencia de Contacto:</label>
		  	 <select class="form-control text-white w-100" style="background-color: transparent;">
		  	 	<option>WhatsApp</option>
		  	 	<option>Llamada</option>
		  	 	<option>Correo</option>
		  	 </select>
		    </div>
		
			<div class="form-group col-md-6 col-12">
			    <label>Comentarios:</label>
			    <textarea class="form-control text-white" id="comentario" style="background-color: transparent;"></textarea>
			    
			</div>
		</div>
	</div>

	<div class="row mt-4 ml-5">
		<div class="col-md-6 col-12">
			<div style="width: 250px; float: left;" class="btn-opcion py-2 px-3 mx-2 text-center" onclick="goBack()" id="cancelar">Cancelar
				</div>
		</div>

     	<div class="col-md-6 col-12">
			<div style="width: 250px; float: left;" class="btn-opcion active py-2 px-3 mx-2 text-center" onclick="guardar()" id="guardar">Guardar
			</div>
		</div>
	</div>
</div>


 <script type="text/javascript">
	function guardar() {
		if($("#asunto").val()!=""&&$("#fecha").val()!=""&&$("#hora").val()!=""&&$("#comentario").val()!=""){
			$("#guardar").hide();
			$("#cancelar").hide();
		  var params={
		  	asunto:$("#asunto").val(),
		  	fecha:$("#fecha").val(),
		  	hora:$("#hora").val(),
		  	comentario:$("#comentario").val()
		  }

		  $.ajax({
			url:"guardar.php",
			data: params,
			type: "post",
			success: function(res){
				window.location.href="https://hventas.gruporivero.com/oportunidades/?email=<?=$ownerId[0]?>";

			}
		});

		  console.log(params);
		}else{
			alert("Favor de llenar todos los campos");
		} 
	}
	function goBack() {
	  window.history.back();
	}
	$(function () {

                $('#datetimepicker1').datetimepicker({
                	  format: 'DD-MM-YYYY', 
                	   locale: 'es'	   
						//daysOfWeekDisabled: [0],
                });
                 $('#datetimepicker2').datetimepicker({
                 	 format: 'HH:mm',
                 	 enabledHours: [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
                 	 stepping: 15
                 });
            });
</script>