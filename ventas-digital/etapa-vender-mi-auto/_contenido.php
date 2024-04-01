<div class="container">
	<div class="row mt-4">
	 	<div class="col-12 bg-dark">
	 		<iframe src="https://riverorenta.mx/api/salesforce/valuacion-express-sf/year/?ownerid=<?=$_SESSION["OwnerId"]?>&opid=<?=$_SESSION["Id"]?>" width="100%" style="height:60vh" frameborder="none"></iframe>		 
	 		
     	</div>    
	</div>

</div>

<div class="row mt-5 pl-5">
	<div class="col-12"> 
	<p>*Precios sujetos a cambios sin previo aviso, aplican restricciones.<br/>*Cotización válida solo mes de <?= strftime("%B de %Y")?> .</p>
		<div class="btn btn-danger py-2 text-center" onclick="sig()">
			<strong> Terminar </strong>
		</div>			
	</div>
</div>

<script>

	function sig(){

		window.location.href='<?=URL?>etapa-4/';
		
	}


</script>
