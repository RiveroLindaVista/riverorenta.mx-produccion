<div class="container">
	<input type="text" id="carid" value="<?=$_SESSION["carId"]?>" hidden/>
	<div class="row mt-4">
	 	<div class="col-12">		 	
         	<h2>
        		<span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;">
        			<i class="fa fa-chevron-left"></i>
        		</span> Muy buena elección <?= ucfirst($_SESSION["Nombre"])?>, es momento de revisar tu plan de financiamiento.</h2>   
     	</div>    
	</div>

	<div class="row mt-1">
		<div class="col-md-7 col-12 ml-md-5">
			<h5><strong>¿Tienes en mente algún enganche?</strong></h5>
	      
	   
	      <div class="row">   
	      	
	      	<div class="col-12">
	      		<p>El enganche mínimo para el <span class="carro"></span> es <span id="enganche10"></span> </p>
	      	</div>
			<div class="col-md-5 col-12">
	           
	            <input type="text" class="form-control text-white" id="enganche" placeholder="Escribe tú enganche">
	           
	       	</div>
	         <div class="col-md-7 col-12 p-0">
	         	<div class="row">
	         		<div class="col-2 m-1 eng" data-valor="10">10%</div>
			         <div class="col-2 m-1 eng" data-valor="20">20%</div>
			         <div class="col-2 m-1 eng" data-valor="25">25%</div>
			         <div class="col-2 m-1 eng" data-valor="30">30%</div>
			         <div class="col-2 m-1 eng" data-valor="35">35%</div>
	         	</div>         	
	         </div>        
			</div>
			<hr class="border-white">

			<div class="row">
				<div class="col-12 mb-2">
					<h5><strong>¿Cuántos meses?</strong></h5>
				</div>
							
				<div class="col-2 m-1 plazo" data-valor="12">12 meses</div>
	         <div class="col-2 m-1 plazo" data-valor="24">24 meses</div>
	         <div class="col-2 m-1 plazo" data-valor="36">36 meses </div>
	         <div class="col-2 m-1 plazo" data-valor="48">48 meses</div>
	         <div class="col-2 m-1 plazo active" data-valor="60">60 meses</div>
						
			</div>
			<hr class="border-white">
			<div class="row">
				<div class="col-12">
					<p>Con un enganche de <span id="engancheFinal" style="font-size: 18px; font-weight: 900;"></span>, te queda una mensualidad de <span id="mensualidadFinal" style="font-size: 18px; font-weight: 900;"></span> a un plazo de <span id="meses" style="font-size: 18px; font-weight: 900;">60</span> meses</p>
					<p class="text-white">*Precios sujetos a cambios sin previo aviso, aplican restricciones. *Cotización por GM Financial.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-6">
					<div class="btn btn-info py-2 w-100" style="font-size: 20px;border-radius: 10px;" onclick="calcular()">Calcular</div>
				</div>
				<div class="col-6"> 
					<div class="d-flex flex-row-reverse">
						<div class="btn-azul py-2 text-center" onclick="seleccionar()" style="width:230px;">
							<strong>Siguiente </strong>
							<img width="20px" src="<?=URL?>/images/icons/btn_siguiente.svg">
						</div>
					</div>		
				</div>
			</div>
	   </div>
		
	</div>
</div>


<script>

	var idGMF="",engancheF="",mensualidadF=60,porce=25,engancheI="",precio="",mensualidad=""; 
			var param = {
				id: $("#carid").val()
			}

			$.ajax({
				url: "../_classes/get_catalogo_byid.php",
				type: "post",
				data: param,
				success: function(res){
					$resp=JSON.parse(res);
					$precio=$resp.precio;
					$(".carro").html($resp.modelo+' '+$resp.tipo)
					$("#enganche25").html('$'+formatNumber($precio*0.25));
					engancheI=$precio*0.10;
					engancheF=$precio*0.25;
					precio=$precio;
					mensualidadF=60;
					$("#engancheFinal").html('$'+formatNumber($precio*0.25));

					$("#enganche10").html('$'+formatNumber($precio*0.10));
				}
			});
	calculoInicial();
	function calculoInicial(){
		$("[data-valor='25']").addClass("active");
		$("#enganche").val("Calculando enganche inicial");
		$("#mensualidadFinal").html("******");
		var param={
			car_id:$("#carid").val(),
			entry_percentage:porce,
			months:mensualidadF,
			warraty_id:1
		}
			$.ajax({
				url: "../_classes/cotizacion_inicial.php",
				type: "POST",
				data: param,
				success: function(res){
					var res=JSON.parse(res);
					idGMF=res["data"]["id"];
					$("#mensualidadFinal").html("$"+formatNumber(res["data"]["payment"]["monthly_payment"]));
					$("#enganche").val(res["data"]["payment"]["entry_payment"]);
					mensualidad=res["data"]["payment"]["monthly_payment"];
					
				}
			});
	}

	function calcular(){
		var eng="";
		if($("#enganche").val()!=""){
			eng=$("#enganche").val();
		}else{
			eng=engancheF;
		}

		if (isNaN(eng)) {
			alert("Ingrese un valor correcto.");
		} else {

			if(eng>=engancheI){
				$("#engancheFinal").html("*******");
				$("#mensualidadFinal").html("******");
				$("#meses").html("**");
				porce=(eng/precio)*100;
				//console.log(precio);
				//console.log(eng);
				//console.log(porce);
				porce=Math.round(porce);
				engancheF=eng;
				var param={
					car_id:$("#carid").val(),
					entry_percentage:porce,
					months:mensualidadF,
					warraty_id:1,
					id:idGMF
				}
				$.ajax({
					url: "../_classes/cotizacion_update.php",
					type: "POST",
					data: param,
					success: function(res){
						var res=JSON.parse(res);
						idGMF=res["data"]["id"];
						$("#mensualidadFinal").html("$"+formatNumber(res["data"]["payment"]["monthly_payment"]));
						mensualidad=res["data"]["payment"]["monthly_payment"];
						$("#meses").html(mensualidadF);
						$("#engancheFinal").html("$"+formatNumber(engancheF));
						
					}
				});
			}else{
				alert("El enganche debe de ser mayor a "+engancheI);
			}
		}
		
	}
	function seleccionar(){
		updateSession("enganche",engancheF);
		updateSession("porEng",porce);
		updateSession("meses",mensualidadF);
		updateSession("mensualidad",mensualidad);
		updateSession("precio",precio);
		updateSession("etapa",7);
		setTimeout(function() {window.location.href='<?=URL?>etapa-7/';}, 300);
		
	}
	$(".plazo").on("click",function(){
		$(".plazo").removeClass("active");
		mensualidadF=$(this).data("valor");
		$(this).addClass("active");
	});
	$(".eng").on("click",function(){
		$(".eng").removeClass("active");
		porce =$(this).data("valor");
		var total=Math.round(precio*(porce/100));
		$("#enganche").val(total);
		//$("#engancheFinal").html("$"+formatNumber(total));
		$(this).addClass("active");
	});

</script>