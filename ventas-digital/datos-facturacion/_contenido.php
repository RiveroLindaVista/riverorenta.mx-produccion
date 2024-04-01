<div class="row">
	<div class="titulo-uno">Datos de Facturación</div>
	<div class="col-11 ml-4">
	       <div class="row">
			  <div class="form-group col-6">
			    <label>Nombre de la oportundiad</label>
			    <input type="text" class="form-control" id="Nombre" placeholder="Nombre" value="<?=$_SESSION['Nombre']?>">
			  </div>

			  <div class="form-group col-6">
			    <label>Facturar a:</label>
			    <input type="text" class="form-control" id="facturara" placeholder="Facturar a:" value="<?=$_SESSION['facturara']?>">
			  </div>
</div>
 <div class="row">
			   <div class="form-group col-6">
			    <label>Domicilio:</label>
			    <input type="text" class="form-control" id="calleynum" placeholder="Calle y Número:" value="<?=$_SESSION['calleynum']?>">
			  </div>

			   <div class="form-group col-6">
			    <label>Colonia:</label>
			    <input type="text" class="form-control" id="colonia" placeholder="Colonia:" value="<?=$_SESSION['colonia']?>">
			  </div>
			</div>
			  <div class="row">
			  <div class="form-group col-6">
			    <label>Ciudad:</label>
			    <input type="text" class="form-control" id="ciudad" placeholder="Ciudad:" value="<?=$_SESSION['ciudad']?>">
			  </div>

			  <div class="form-group col-6">
			    <label>Estado:</label>
			    <input type="text" class="form-control" id="estado" placeholder="Estado:" value="<?=$_SESSION['estado']?>">
			  </div>
			</div>

			


		 <div class="row">
			  <div class="form-group col-6">
			    <label>Código Postal:</label>
			    <input type="text" class="form-control" id="cp" placeholder="Código Postal:" value="<?=$_SESSION['cp']?>">
			  </div>

			  <div class="form-group col-6">
			    <label>RFC:</label>
			    <input type="text" class="form-control" id="rfc" placeholder="RFC:" value="<?=$_SESSION['rfc']?>">
			  </div>
			</div>

		<div class="row">
			  <div class="form-group col-6">
			    <label>WhatsApp:</label>
			    <input type="text" class="form-control" id="whatsapp" placeholder="WhatsApp:" value="<?=$_SESSION['whatsapp']?>">
			  </div>

			  <div class="form-group col-6">
			    <label>Correo:</label>
			    <input type="text" class="form-control" id="correo" placeholder="Correo: correo@ejemplo.com" value="<?=$_SESSION['correo']?>">
			  </div>
			</div>



	</div>

		 <div class="col-12 ml-4">
	        <div class="row col-12">
	        	<div class="col-6">
	        		<button class="btn btn-secondary mt-5" onclick="goBack()">Canelar</button>
	        	</div>
	        	<div class="col-6">
	        		<button class="btn btn-primary mt-5" onclick="guardar()" style="float:right">Guardar</button>
	        	</div>
	        </div>
	      </div>
	     
</div>

<script>
	function guardar() {
	  	updateSession("Nombre",$("#Nombre").val());
		updateSession("facturara",$("#facturara").val());
		updateSession("calleynum",$("#calleynum").val());
		updateSession("colonia",$("#colonia").val());
		updateSession("ciudad",$("#ciudad").val());
		updateSession("estado",$("#estado").val());
		updateSession("cp",$("#cp").val());
		updateSession("rfc",$("#rfc").val());
		updateSession("whatsapp",$("#whatsapp").val());
		updateSession("correo",$("#correo").val());
		setTimeout(function() { window.close()}, 300);
	}
	function goBack() {
	  window.close();
	}
	</script>