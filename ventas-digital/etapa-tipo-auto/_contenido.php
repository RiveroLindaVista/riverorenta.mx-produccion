<div class="container">
	<div class="row mt-4">
	 	<div class="col-12">		 	
         <h2> Catálogo</h2>
         <p>Hola <?= ucfirst($_SESSION["Nombre"])?> elige el tipo de unidad que buscas.</p>
     	</div>    
	</div>
	<div class="row justify-content-center" id="tipoCarro">		
		<div class="col-sm-5">
			<div class="card-catalogo text-center mb-3 p-3 h-auto w-auto" data-tipo="1">
				<p class="m-0">Autos</p>
				<img class="mb-2" src="<?=URL?>/images/icons/icon-chevrolet-blanco.png" width="60px" alt="autos"><br>
				<img class="img-auto" src="<?=URL?>/images/botones/filtro-auto-azul.png" width="60%" alt="autos">
				
			</div>
		</div>
		<div class="col-sm-5">
			<div class="card-catalogo text-center mb-3 p-3 h-auto w-auto" data-tipo="2">
				<p class="m-0">Suvs</p>
				<img class="mb-2" src="<?=URL?>/images/icons/icon-chevrolet-blanco.png" width="60px" alt="autos"><br>
				<img class="img-auto" src="<?=URL?>/images/botones/filtro-suv-azul.png" width="60%" alt="suvs">
				
			</div>
		</div>
		<div class="col-sm-5">
			<div class="card-catalogo text-center mt-3 p-3 h-auto w-auto" data-tipo="3">
				<p class="m-0">PickUp y Van</p>
				<img class="mb-2" src="<?=URL?>/images/icons/icon-chevrolet-blanco.png" width="60px" alt="autos"><br>
				<img class="img-auto" src="<?=URL?>/images/botones/filtro-pickup-azul.png" width="60%" alt="PickUp y Van">
				
			</div>
		</div>
		<div class="col-sm-5">
			<div class="card-catalogo text-center mt-3 p-3 h-auto w-auto" data-tipo="4">
				<p class="m-0">Deportivos y Eléctricos</p>
				<img class="mb-2" src="<?=URL?>/images/icons/icon-performance-blanco.png" width="30px" alt="autos"><br>
				<img class="img-auto" src="<?=URL?>/images/botones/filtro-deportivo-azul.png" width="70%" alt="Deportivos y electricos">
				
			</div>
		</div>
	</div>

	<div class="row mt-5" hidden>
		<div class="col-12"> 
			<div class="btnNext mr-5" onclick="sig()">
				<div class="btn-azul py-2 text-center">
					<strong>Siguiente </strong>
					<img class="img-sig" src="<?=URL?>/images/icons/btn_siguiente.svg">
				</div>
				<div class="text-danger" id="mensaje">Es necesario seleccionar una categoria.</div>
			</div>		
		</div>
	</div>
</div>

<script>
	var tipo = null;
	$(".card-catalogo").on("click", function (){
		tipo = $(this).data("tipo");

		$(".card-catalogo").removeClass("active");
		$(this).addClass("active");

	$('[data-tipo=1]').find(".img-auto").attr("src","../images/botones/filtro-auto-azul.png");
	$('[data-tipo=2]').find(".img-auto").attr("src","../images/botones/filtro-suv-azul.png");
	$('[data-tipo=3]').find(".img-auto").attr("src","../images/botones/filtro-pickup-azul.png");
	$('[data-tipo=4]').find(".img-auto").attr("src","../images/botones/filtro-deportivo-azul.png");
	//$('[data-menucarrusel=5]').find("img").attr("src","assets/img/mobile/nuevos/menu_deportivos.png");
	
		switch(tipo){
			case 1:
				$('[data-tipo='+tipo+']').find(".img-auto").attr("src","../images/botones/filtro-auto-blanco.png");
			break;
			case 2:
				$('[data-tipo='+tipo+']').find(".img-auto").attr("src","../images/botones/filtro-suv-blanco.png");
			break;
			case 3:
				$('[data-tipo='+tipo+']').find(".img-auto").attr("src","../images/botones/filtro-pickup-blanco.png");
			break;
			case 4:
				$('[data-tipo='+tipo+']').find(".img-auto").attr("src","../images/botones/filtro-deportivo-blanco.png");
			break;	

		}
		sig();
	});

	function sig(){

		if (tipo != null) {
			window.location.href='<?=URL?>/etapa-modelo-auto?tipoAuto='+tipo;
		} else {
			$("#mensaje").fadeIn();
			setTimeout(function() {$("#mensaje").fadeOut();}, 1200);
		}
		
		/*updateSession("ofrecieron",$valor);
		if($valor=="Si"){
			updateSession("etapa",2);
			setTimeout(function() {window.location.href='<?=URL?>/etapa2/';}, 300);
			
		}else{
			updateSession("etapa",2);
			setTimeout(function() {window.location.href='<?=URL?>/etapa-que-quieres-de-tomar';},300);
		}*/
	}


</script>
