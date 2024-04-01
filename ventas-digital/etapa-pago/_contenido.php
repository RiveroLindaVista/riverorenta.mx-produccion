<div class="container">
	<div class="row mt-4">
	 	<div class="col-12">		 	
         <h2><span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;"><i class="fa fa-chevron-left"></i>
			</span>Cuidamos de ti y de tu familia, por eso mismo contamos con una gama extensa de planes y financieras en Monterrey. 
		</h2>
         <h5 class="m-0"><strong>¿Cómo quieres cotizar tu <?= $_SESSION['modelo']?> <?= $_SESSION['ano']?>?</strong></h5>
     	</div>    
	</div>

	<div class="mt-3">
		<div class="btn-opcion py-2 px-3 mx-2 text-center w-auto" style="float: left;" onclick="seleccionar('Credito')"> 
			<p class="m-0">Crédito</p>
		</div>
		<div class="btn-opcion py-2 px-3 mx-2 text-center w-auto" style="float: left;" onclick="seleccionar('Contado')"> 
			<p class="m-0">Contado</p>
		</div>
	</div>
</div>


<script>
	function seleccionar($valor){
		updateSession("forma-pago",$valor);
		if($valor=="Credito"){
			updateSession("etapa",6);
			setTimeout(function() {window.location.href='<?=URL?>etapa-6/';},300);
			
		}else{
			updateSession("etapa",7);
			setTimeout(function() {window.location.href='<?=URL?>etapa-7';},300);
		}	
	}

	
</script>