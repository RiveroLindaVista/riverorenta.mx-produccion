
<div class="container">
	<input type="text" id="carid" value="<?=$_SESSION["carId"]?>" hidden/>
	<input type="text" id="eng" value="<?=$_SESSION["porEng"]?>" hidden/>
	<input type="text" id="meses" value="<?=$_SESSION["meses"]?>" hidden/>
	<input type="text" id="cp" value="<?=$_SESSION["cp"]?>" hidden/>

	<div class="row mt-4">
	 	<div class="col-12">		 	
         	<p>
        		<span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;">
        			<i class="fa fa-chevron-left"></i>
        		</span> <?= ucfirst($_SESSION['Nombre'])?>, tu seguridad y tranqulidad es lo más importante.</p>
        		<h5 class="pl-4"><strong>¿Cuál seguro quieres agregar?</strong></h5>      	
     	</div>    
	</div>

	<div class="row mt-1">
		<div class="col-md-7 col-12 ml-md-5">			   
	      <div class="row">         	
	      	<div class="col-12">

	      		<div id="loading" class="spinner-border text-primary" role="status" style="display: block;">
					  <span class="sr-only">Loading...</span>
					</div>

		     		<table id="segurosTabla" class="table table-striped" style="display: none;">
		     			<thead>
					      <tr class="bg-light text-center text-primary">
					      	<th >Seguro</th>
					         <th >Anual</th>
					         <th >Mensual</th>      
					      </tr>
					   </thead>
    					<tbody id="segurosArea"></tbody>
		     		</table>			     		     	
		      </div>    			     		
			</div>		
			<p style="margin-top:10px;">*Precios sujetos a cambios sin previo aviso, aplican restricciones. *Cotización por GM Financial.</p>
			<p>*Los seguros gratuitos son válidos por un año.</p>  		
					
				<div class="btnNext">
					<div class="btn-azul py-2 text-center w-auto" onclick="seleccionar()">
						<strong>Siguiente </strong>
						<img width="20px" src="<?=URL?>/images/icons/btn_siguiente.svg">
					</div>		
					<div class="text-danger" id="mensaje">Es necesario seleccionar un seguro</div>
				</div>			
								
				
	   </div>	
	</div>

	
</div>


<script>
	var seguro = '';var anual='';var mensual='';
	getSeguros();
	function seleccionar_seguro(id, empresa,anual1,mensual1){
		seguro = empresa;
		anual = anual1;
		mensual = mensual1;		
		$(".seguro-op").removeClass("active");
		$(id).addClass("active");
	}	

	function seleccionar(){
		if(seguro!=""){
			updateSession("seguro",seguro);
			updateSession("seguroAnual",anual);	
			updateSession("seguroMensual",mensual);	
			updateSession("etapa",9);		
			setTimeout(function() {window.location.href='<?=URL?>etapa-9';}, 300);
		}else{
			//$("#mensaje").fadeIn();
			//setTimeout(function() {$("#mensaje").fadeOut();}, 1200);
			updateSession("etapa",9);		
			setTimeout(function() {window.location.href='<?=URL?>etapa-9';}, 300);
		}			
	}

	function getSeguros(){

		var carid = $("#carid").val();
		//var enganche = $("#eng").val();
		//var meses = $("#meses").val();
		//var cp = $("#cp").val();

		if (carid != "") {
			/*var params={
			  "car_id": carid,
		      "percentage": enganche,
		      "months": meses,
		      "postal_code": cp,
			}*/
			var cadena="";

			$.ajax({
				url:'https://api.gruporivero.com/v1/cars/'+carid+'/insurance',
				method:'GET',
				//data:params,
				success:function(resp){
					
					if (resp != "") {
						for(i=0;i<resp["data"].length;i++){
							if(resp["data"][i]["monthlyPrice"] == 0){
								resp["data"][i]["monthlyPrice"] = "Seguro gratuito";
								cadena+='<tr id="'+resp["data"][i]["insuranceCompany"]+'" class="seguro-op" onclick="seleccionar_seguro(this, \''+resp["data"][i]["insuranceCompany"]+'\',\''+resp["data"][i]["annualPrice"]+'\',\''+0.00+'\')"><td>'+resp["data"][i]["insuranceCompany"]+'</td><td>$'+formatNumber(resp["data"][i]["annualPrice"])+'</td><td>'+resp["data"][i]["monthlyPrice"]+'</td></tr>';
							}else{
								cadena+='<tr id="'+resp["data"][i]["insuranceCompany"]+'" class="seguro-op" onclick="seleccionar_seguro(this, \''+resp["data"][i]["insuranceCompany"]+'\',\''+resp["data"][i]["annualPrice"]+'\',\''+resp["data"][i]["monthlyPrice"]+'\')"><td>'+resp["data"][i]["insuranceCompany"]+'</td><td>$'+formatNumber(resp["data"][i]["annualPrice"])+'</td><td>$'+formatNumber(resp["data"][i]["monthlyPrice"])+'</td></tr>';
							}

						
					}
						$("#segurosArea").html(cadena);
						$("#segurosTabla").show();
						$("#loading").hide();
					} else {
						$("#segurosArea").html("<tr><td colspan='3'>Sin resultados</td></tr>");
						$("#segurosTabla").show();
						$("#loading").hide();
					}
					
					
				}
			})
		} else {
			$("#segurosArea").html("<tr><td colspan='3'>Sin resultados</td></tr>");
			$("#segurosTabla").show();
			$("#loading").hide();
		}

		
	}


	
</script>