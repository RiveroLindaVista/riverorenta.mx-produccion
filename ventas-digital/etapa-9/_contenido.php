
<div class="container">
	<div class="row mt-4">
	 	<div class="col-12">		 	
         	<h5><span class="rounded-circle back-arrow-title pl-2 mr-2" style="padding: 5px;"><i class="fa fa-chevron-left"></i>
			</span>¡Listo <?= ucfirst($_SESSION["Nombre"])?>! Hemos terminado la cotización para tu:
		</h5>
		<h3 class="pl-5"><?=$_SESSION["modelo"]?> <?=$_SESSION["version-ideal"]?> <?=$_SESSION["ano"]?></h4>
         <h5 class="pl-5"><strong>Vamos a continuar:</strong></h5>
     	</div>    
	</div>

	<div class="row mt-3 pl-4">
		<div class="col-md-12 col-12">
			<div class="row">
				<div class="col-md-6 col-12">
					<p style="font-size: 13px;">* Este plan puede estar sujeto a cambios y/o aprobación, ya que depende de un estudio que realiza la financiera sobre tu historial crediticio y además es sin costo y sin compromiso.</p>
					<ul>
						<li>Contamos con diferentes instituciones financieras para apoyar a nuestros clientes.</li>
						<li>Si contaras con algún detalle en buró, te ofrecemos otras opciones de rescate.</li>
					</ul>
					<div class="row">
						<div class="col-md-12 col-12">
							<center><img
		                src="https://www.codigos-qr.com/qr/php/qr_img.php?d=https%3A%2F%2Fsolicitud.gruporivero.com&id=<?=$_SESSION["NombreCompleto"]?><?=$_SESSION["modelo"]?> <?=$_SESSION["version-ideal"]?> <?=$_SESSION["ano"]?>&s=12&e=h"
		                alt="Generador de Códigos QR Codes"
		                style="width:20vh"
		              /></center>
						</div>
					</div>
					<div class="row mt-4">				
						<div class="btn-secondary text-center col-6 p-2" onclick="guardar()" style="width: 80% !important; border-radius: 10px;">
							<strong>Próximo contacto</strong>				
						</div>			
						<div class="btn-azul text-center col-6 p-2" onclick="solicitud()" style="width: 280px;">
							<strong>Llenar pre-solicitud </strong>
							<img src="<?=URL?>/images/icons/btn_siguiente.svg" style="width: 20px">
						</div>								
					</div>	
				</div>
				
			</div>
				
								
		</div>		
	</div>
	<div class="col-md-6 col-12" style="position: absolute; top:0px;right: 0px;height: 73vh;">
					<iframe width="100%" height="100%" style="border: none;" src="https://riverorenta.mx/resumen-cotizacion?modelo=<?= $_SESSION['modelo']?>&version=<?= $_SESSION['version-ideal']?>&ano=<?= $_SESSION['ano']?>&modelImage=<?= $_SESSION['modelImage']?>&precio=<?= $_SESSION['precio']?>&forma-pago=<?= $_SESSION['forma-pago']?>&enganche=<?= $_SESSION['enganche']?>&meses=<?= $_SESSION['meses']?>&mensualidad=<?= $_SESSION['mensualidad']?>&garantia=<?= $_SESSION['garantia']?>&seguro=<?= $_SESSION['seguro']?>&seguroMensual=<?= $_SESSION['seguroMensual']?>&nombre=<?= $_SESSION['NombreCompleto']?>&correo=<?= $_SESSION['correo']?>?>"></iframe>		
				</div>
</div>


<script>
	function solicitud(){
		updateSession("solicitud","0");		
		let a= document.createElement('a');
		a.target= '_blank';
		a.href= '<?=URL?>solicitud-en-linea/';
		a.click();
				
	}
	function guardar(){
		updateSession("solicitud","0");		
		let a= document.createElement('a');
		a.href= '<?=URL?>guardar-y-salir/';
		a.click();
	}
	
</script>