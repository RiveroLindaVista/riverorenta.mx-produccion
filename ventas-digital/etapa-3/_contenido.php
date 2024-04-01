<div class="container">
	<div class="row mt-4">
		
	 	<div class="col-12">		 	
         <h2><span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;"><i class="fa fa-chevron-left"></i>
			</span> <?= ucfirst($_SESSION["Nombre"])?>, ¿Cuentas con un carro que quieras vender o dejar a cuenta?
		</h2>
         <h4><strong>¿Quieres saber su valor actual?</strong></h4>
     	</div>    
	</div>

	<div class="mt-2">
		<div class="btn-opcion active py-2 px-3 mx-2 text-center" style="width: 170px; float: left;" data-valua="Si" onclick="selec('Si')"> 
			<span><strong>Si quiero</strong></span>
		</div>
		<div class="btn-opcion py-2 px-3 mx-2 text-center" style="width: 170px; float: left;" data-valua="No" onclick="selec('No')"> 
			<span><strong>Después</strong></span>
		</div>
	</div>

	<!--div class="row mt-5">
		<div class="col-12"> 
			<div class="btnNext mr-5" onClick="selec()">
				<div class="btn-azul py-2 text-center">
					<strong>Siguiente </strong>
					<img class="img-sig" src="<?=URL?>/images/icons/btn_siguiente.svg">
				</div>
			</div>		
		</div>
	</div-->
</div>


<script>
	
	function selec($opcion){

		updateSession("vender-tu-carro",$opcion);
		updateSession("etapa",4);

		if ($opcion == "Si") {
			window.location.href='<?=URL?>etapa-vender-mi-auto/';
		} else if($opcion == "No"){
			window.location.href='<?=URL?>etapa-4';
		}	
			
	}

</script>