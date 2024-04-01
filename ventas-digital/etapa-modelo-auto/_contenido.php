<?php
switch ($_GET["tipoAuto"]) {
	case '1':
		$tipoCarro='Autos';
		break;
	case '2':
		$tipoCarro="SUV's";
		break;
	case '3':
		$tipoCarro='PickUp y Van';
		break;
		case '4':
		$tipoCarro='Deportivo y Eléctrico';
		break;
	default:
		$tipoCarro='';
		break;
}
?>
<div class="container">
	<div class="row mt-4">
	 	<div class="col-12">		 	
         <h2>
        	<span class="rounded-circle back-arrow-title pl-2 mr-2">
        		<i class="fa fa-chevron-left"></i>
        	</span> Catálogo de <?=$tipoCarro?></h2>
         <p class="pl-4">¿Qué modelo prefieres estrenar?</p>
     	</div>    
	</div>

	<div class="row mt-4">
		<div class="col-12" id="respModelos"> 
				
		</div>
	</div>

	<div class="row mt-5" hidden>
		<div class="col-12"> 
			<div class="btnNext mr-5" onclick="selec()">
				<div class="btn-azul py-2 text-center">
					<strong>Siguiente </strong>
					<img class="img-sig" src="<?=URL?>/images/icons/btn_siguiente.svg">
				</div>
				<div class="text-danger" id="mensaje">Es necesario seleccionar un modelo.</div>
			</div>		
		</div>
	</div>
</div>


<script>
	var id = null;
	getModelos(<?= $_GET["tipoAuto"]?>);
	function getModelos(tipo){
	
		var param = {
			tipo: tipo
		}

		$.ajax({
			url:"../_classes/get_catalogo_modelos.php",
			data: param,
			type: "post",
			success: function(res){
				$("#respModelos").html(res);			
				$("#respModelos").show();

			}
		});
	}

	function abrirOp(modelo,anio,tipo,slug,carId, image){
		$(".card-catalogo").removeClass("active");
		$('#'+carId).addClass("active");
		id = carId;
		updateSession("carId",carId);
		updateSession("modelo",modelo);
		updateSession("anio",anio);
		updateSession("tipo",tipo);
		updateSession("slug",slug);
		updateSession("modelImage",image);

		setTimeout(function() {selec();}, 1200);
	}

	function selec(){
		if (id != null) {
			updateSession("etapa",3);
			window.location.href='<?=URL?>etapa-3';
		} else {
			$("#mensaje").fadeIn();
			setTimeout(function() {$("#mensaje").fadeOut();}, 1200);
		}
		
	}

</script>