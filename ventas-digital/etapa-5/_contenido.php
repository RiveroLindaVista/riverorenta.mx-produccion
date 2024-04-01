<div class="container">
	<div class="row mt-4">
	 	<div class="col-12">		 	
         <h5><span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;"><i class="fa fa-chevron-left"></i>
			</span><strong>¡Primo, es tiempo de manejar tu <?=$_SESSION["modelo"]?>!</strong>
		</h5>
         <p class="pl-5">Conoce las rutas de manejo. Escanea el código.</p>
     	</div>    
	</div>

	<div class="row">
		<img class="img-fluid pl-4" src="<?=URL?>images/qr-manejo.png">
	</div>

	<div class="row justify-content-center mt-5">
		<div class="mt-2">
			<div class="btn-opcion active py-2 px-3 mx-2 text-center w-auto" style="float: left;" onclick="seleccionar()"> 
				<p class="m-0">Haz tu prueba de manejo</p>
			</div>
			<div class="btn-opcion py-2 px-3 mx-2 text-center" style="width: 170px; float: left;" onclick="omitir()"> 
				<span><strong>Después</strong></span>
			</div>
		</div>
	</div>

	
</div>


<script>
	function seleccionar($valor){
		updateSession("prueba","Si");
		updateSession("etapa",9);
		setTimeout(function() {window.location.href='<?=URL?>/';}, 300);	
	}

	function omitir(){
		updateSession("prueba","No");
		updateSession("etapa","-pago");
		setTimeout(function() {window.location.href='<?=URL?>/etapa-pago';}, 300);
	}
	
</script>