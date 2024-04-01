<div class="container">
	<input type="text" id="carid" value="<?=$_SESSION["carId"]?>" hidden/>
	<div class="row mt-4">
	 	<div class="col-12">		 	
         	<p>
        		<span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;">
        			<i class="fa fa-chevron-left"></i>
        		</span> <?= ucfirst($_SESSION["Nombre"])?>, tu tranquilidad no tiene precio.<br>Extiende la garantía de tu <?= $_SESSION['modelo']?> <?= $_SESSION['ano']?>, la cual protege tu carro y tu patrimonio.</p>      	
     	</div>    
	</div>

	<div class="row mt-1">
		<div class="col-md-7 col-12 ml-md-5">			   
	      <div class="row">         	
	      	<div class="col-12">     
	      		<h5><strong>Elige tu extensión de Garantía</strong></h5>
		     		<div class="btn-garantia active p-3 my-3" onclick="seleccionar_categoria(this, 'Gratis')">
		     			<div class="row">
		     				<div class="col-10 text-left">
		     					<span>Incluido por GM (3 años o hasta 60,000 km)</span>
		     				</div>
		     				<div class="col-2 text-right">
		     					<span>$0</span>
		     				</div>
		     			</div>		     			
		     		</div>			     			
	     		</div>		
	     		<div class="col-12">     
		     		<div class="btn-garantia p-3 mb-3" onclick="seleccionar_categoria(this, 'Plata')">
		     			<div class="row">
		     				<div class="col-6 text-left">
		     					<span>Plata (4 años o hasta 80,000 km)</span>
		     				</div>
		     				<div class="col-6 text-right">
		     					<span>$7,280</span>
		     				</div>
		     			</div>		     			
		     		</div>			     			
	     		</div>	   
	     		<div class="col-12">     
		     		<div class="btn-garantia p-3" onclick="seleccionar_categoria(this, 'Oro')">
		     			<div class="row">
		     				<div class="col-6 text-left">
		     					<span>Oro (5 años o hasta 100,000 km)</span>
		     				</div>
		     				<div class="col-6 text-right">
		     					<span>$14,540</span>
		     				</div>
		     			</div>			     			
		     		</div>			     			
	     		</div>     
			</div>		
			<p style="margin-top:10px;">*Aplican restricciones. Precios sujetos a cambios sin previo aviso. Cotización GM Financial.</p>  		
			<div class="row mt-5">
				<div class="col-6 mt-1">
					<a class="btn btn-outline-light p-2" href="../pdf/folleto_garantia.pdf" target="_blank" style="text-decoration: none; font-size: 18px; font-weight: 900;">
				     		¿Qué es la garantía extendida?
			    	</a>
				</div>
				<div class="col-6" align="right"> 					
					<div class="btn-azul py-2 text-center" onclick="seleccionar()" style="width: 180px;">
						<strong>Siguiente </strong>
						<img width="20px" src="<?=URL?>/images/icons/btn_siguiente.svg">
					</div>					
				</div>
			</div>
	   </div>	
	</div>

	
</div>


<script>
	var garantia = 'Gratis';

	function seleccionar_categoria(id, valor){
		garantia = valor;	
		$(".btn-garantia").removeClass("active");
		$(id).addClass("active");
	}	

	function seleccionar(){
		
		updateSession("garantia",garantia);		
		updateSession("etapa",8);		
		
		setTimeout(function() {window.location.href='<?=URL?>etapa-8/';}, 300);
		
					
	}
	
</script>