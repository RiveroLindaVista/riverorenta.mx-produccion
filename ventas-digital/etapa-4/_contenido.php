<div class="container">
	<div class="row mt-4">
	 	<div class="col-12">		 	
         	<h2>
        		<span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;">
        			<i class="fa fa-chevron-left"></i>
        		</span> <?= ucfirst($_SESSION["Nombre"])?>, elige una de las versiones que tenemos disponibles para tu carro.</h2>
         <p class="ml-4">*Aplican restricciones. Precios sujetos a cambios sin previo aviso.</p>
         <h5 class="text-primary pl-4"><strong><?=$_SESSION["modelo"]?> <?=$_SESSION["anio"]?></strong></h5>
     	</div>    
	</div>

	<div class="row mt-1">
		<div class="col-12" id="resp-versiones"> 
				
		</div>
		
		<div class="col-12 mt-5"> 		
			<div class="d-flex flex-row-reverse">
				<div class="btn-azul py-2 text-center" onclick="selec()" style="width:230px;">
					<strong>Siguiente </strong>
					<img width="20px" src="<?=URL?>/images/icons/btn_siguiente.svg">
				</div>
				<div class="text-danger" id="mensaje">Es necesario seleccionar una version.</div>
			</div>							
		</div>
	</div>

</div>


<script>
	var id = null;
	getVersiones();
	function getVersiones(){
		var param = {
			slug: "<?= $_SESSION["slug"]?>"
		}

		if(param.slug!=""){
			$.ajax({
				//url: "../_classes/get_versiones_modelo.php",
				url: 'https://api.gruporivero.com/v1/cars/<?=$_SESSION["slug"]?>',
				type: "get",
				success: function(res){
					var versiones = [];
					versiones = sortByKeyAsc(res["data"]["versions"], "price");				
					var cadena = "";
					if (versiones.length > 0) {
						for(i=0;i<versiones.length;i++){
						cadena+='<div style="display: inline-block;"><div class="card-versiones m-3 p-3" style="cursor: pointer;" onclick="seleccionar(\''+versiones[i]["name"]+'\',\''+versiones[i]["id"]+'\',\''+versiones[i]["price"]+'\',\''+res["data"]["slug"]+'\',\''+res["data"]["type"]+'\',\''+res["data"]["year"]+'\')" data-id="'+versiones[i]["id"]+'"><p class="mb-2"><h5 class="m-0">'+versiones[i]["name"]+'</h5><span><br>Precio: $'+formatNumber(versiones[i]["price"])+'</span></p><div class="col-12 mb-1">Características principales</div><div class="row" style="overflow-y:auto; height: 360px;"><div class="col-12">';

							for (var t = 0; t < versiones[i]["features"].length; t++) {
							cadena+= '<p><img width="20px" src="'+versiones[i]["features"][t]["icon"]+'" /> '+versiones[i]["features"][t]["name"]+'</p>';
							}

						cadena+='</div></div></div></div>';
						}
						$("#resp-versiones").html(cadena);
					}
				},
				error: function(){
					$("#resp-versiones").html("Versiones no disponibles para este modelo, elija otro.");
				}
			});
		}
	}
	function seleccionar($valor, $id, $precio, $slug, $tipo, $ano){
		id = $valor;
		$(".card-versiones").removeClass("active");
		$('[data-id='+$id+']').addClass("active");

		updateSession("version-ideal",$valor);
		updateSession("etapa","pago");	
		updateSession("carId",$id);
		updateSession("slug",$slug);
		updateSession("tipo",$tipo);
		updateSession("precio",$precio);
		updateSession("ano",$ano);		
		setTimeout(function() {selec();}, 1200);			
	}

	function selec(){

		if (id != null) {
			setTimeout(function() {window.location.href='<?=URL?>etapa-pago/';}, 300);
		} else {
			$("#mensaje").fadeIn();
			setTimeout(function() {$("#mensaje").fadeOut();}, 1200);
		}
		
	}

	function sortByKeyDesc(array, key) {
        return array.sort(function (a, b) {
            var x = a[key]; var y = b[key];
            return ((x > y) ? -1 : ((x < y) ? 1 : 0));
        });
    }

    function sortByKeyAsc(array, key) {
        return array.sort(function (a, b) {
            var x = a[key]; var y = b[key];
            return ((x < y) ? -1 : ((x > y) ? 1 : 0));
        });
    }

</script>