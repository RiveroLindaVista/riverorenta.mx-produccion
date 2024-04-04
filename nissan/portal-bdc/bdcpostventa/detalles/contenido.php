<?php
include('../../api/_classes.php');
$var = new ExeCon();

 //$test2 = $var->buscarOrdenes('3N6AD35AXMK834686');
 //var_dump( $test2);

 $test = $var->buscarUnidad($_GET['carid']);
$correo=$test[0]["MAIL"];
$telefono=$test[0]["TELEFONO"];
$telefono2=$test[0]["TELEFONOOFICINA"];

if($test[0]["CALC_COL14"]<=3.99){
	$tipoBase='Reciente';
}
if($test[0]["CALC_COL14"]>=4&&$test[0]["CALC_COL14"]<=12.99){
	$tipoBase='Primera Visita';
}
if($test[0]["CALC_COL14"]>=13&&$test[0]["CALC_COL14"]<=24.99){
	$tipoBase='1 Año';
}
if($test[0]["CALC_COL14"]>=25&&$test[0]["CALC_COL14"]<=36.99){
	$tipoBase='2 Años';
}
if($test[0]["CALC_COL14"]>=37&&$test[0]["CALC_COL14"]<=48.99){
	$tipoBase='3 Años';
}
if($test[0]["CALC_COL14"]>=49&&$test[0]["CALC_COL14"]<=60.99){
	$tipoBase='4 Años';
}
if($test[0]["CALC_COL14"]>=61&&$test[0]["CALC_COL14"]<=72.99){
	$tipoBase='5 Años';
}
if($test[0]["CALC_COL14"]>=73&&$test[0]["CALC_COL14"]<=84.99){
	$tipoBase='6 Años';
}
if($test[0]["CALC_COL14"]>=85&&$test[0]["CALC_COL14"]<=96.99){
	$tipoBase='7 Años';
}
if($test[0]["CALC_COL14"]>=97){
	$tipoBase='Más de 7 Años';
}
$fechaVenta="";
if($test[0]["FECVENTA"]){
$fechaVenta=strtotime($test[0]["FECVENTA"]);
$fechaVenta=date('d/m/Y',$fechaVenta);
}
$fechaUVisita="";
if($test[0]["FECULTVIS"]){
$fechaUVisita=strtotime($test[0]["FECULTVIS"]);
$fechaUVisita=date('d/m/Y',$fechaUVisita);
}
$fechaSVisita="";
if($test[0]["FECSIGVIS"]){
$fechaSVisita=strtotime($test[0]["FECSIGVIS"]);
$fechaSVisita=date('d/m/Y',$fechaSVisita);
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/design-system/2.22.0/styles/salesforce-lightning-design-system.min.css" integrity="sha512-R29Br+fSgWWdKZf/rrEY/bciMESXy1J1I0m4jQ6eDJDSaF1Jj4TE4uoyiIqcM4dkNihG3tKuYAh1JMCcBphpvA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row p-2">
	

<div class="row">
	
	<div class="col-12 col-md-9">

<div class="row">
		<div class="col-12 col-md-12">
			<div lwc-3mmmrd7j9v4="" class="highlights slds-clearfix slds-page-header slds-page-header_record-home" style="height: 67.5px; left: 13px; right: 13px; padding-left: 16px; padding-right: 16px; border-radius: 4px;">
				
				<div lwc-3mmmrd7j9v4="" class="slds-grid primaryFieldRow">

					<lightning-button variant="neutral">
						<a href='../../bdcpostventa?tb=2'><img src="<?=URL?>images/back.png" width='30px'/></a>
					</lightning-button>

					<div lwc-3mmmrd7j9v4="" class="slds-grid slds-col slds-has-flexi-truncate"><div lwc-3mmmrd7j9v4="" class="slds-media slds-no-space"><slot lwc-3mmmrd7j9v4="" name="icon"><records-highlights-icon slot="icon"><div class="highlights-icon-container slds-avatar slds-m-right_small icon" style="background-color: #107CAD"><img src="https://gruporivero.my.salesforce.com/img/icon/t4v35/standard/asset_object_120.png" title="Inventario de vehículo" alt=""></div></records-highlights-icon></slot></div><div lwc-3mmmrd7j9v4="" class="slds-media__body"><h1 lwc-3mmmrd7j9v4=""><div lwc-3mmmrd7j9v4="" class="entityNameTitle slds-line-height--reset">Inventario de vehículo</div><slot lwc-3mmmrd7j9v4="" class="slds-page-header__title slds-m-right--small slds-align-middle clip-text slds-line-clamp" name="primaryField"><lightning-formatted-text slot="primaryField"><?=$test[0]["MARCA"]?>&nbsp;<?=$test[0]["MODELO"]?>&nbsp;<?=$test[0]["ANO"]?>&nbsp;<?=$test[0]["COLOR"]?></lightning-formatted-text></slot></h1></div></div><div class="slds-col slds-no-flex slds-grid slds-grid_vertical-align-center horizontal slds-m-right--xx-small chatterActionContainer" lwc-3mmmrd7j9v4=""><!-- workaround for W-2413659, remove once that bug is fixed --><!--render facet: 20337:0--><!--render facet: 20338:0--></div><div lwc-3mmmrd7j9v4="" class="slds-col slds-no-flex slds-grid slds-grid_vertical-align-center horizontal actionsContainer"><div lwc-3mmmrd7j9v4=""><runtime_platform_actions-actions-ribbon lwc-3mmmrd7j9v4="" lwc-g2k8j8m3h7-host=""><slot lwc-g2k8j8m3h7="" name="actionsProvider"><runtime_platform_actions-provider-record-detail lwc-3mmmrd7j9v4="" slot="actionsProvider"></runtime_platform_actions-provider-record-detail></slot><ul lwc-g2k8j8m3h7="" class="slds-button-group-list">



			<!--<li lwc-g2k8j8m3h7="" class="visible" data-target-selection-name="sfdc:QuickAction.Asset.Subir_Captura"><runtime_platform_actions-action-renderer lwc-g2k8j8m3h7="" apiname="Asset.Subir_Captura" title="Reg WhatsApp"><runtime_platform_actions-executor-page-reference><slot><slot><lightning-button variant="neutral"><button class="slds-button slds-button_neutral" aria-disabled="false" name="Asset.Subir_Captura" type="button" part="button">Reg WhatsApp</button></lightning-button></slot></slot></runtime_platform_actions-executor-page-reference></runtime_platform_actions-action-renderer></li>

				<li lwc-g2k8j8m3h7="" class="visible" data-target-selection-name="sfdc:CustomButton.Asset.Paquetes_de_Servicio"><runtime_platform_actions-action-renderer lwc-g2k8j8m3h7="" apiname="Paquetes_de_Servicio" title="Nueva Tarea"><runtime_platform_actions-executor-page-reference><slot><slot><lightning-button variant="neutral"><button class="slds-button slds-button_neutral" aria-disabled="false" type="button" part="button">Nueva Tarea</button></lightning-button></slot></slot></runtime_platform_actions-executor-page-reference></runtime_platform_actions-action-renderer></li>

				<li lwc-g2k8j8m3h7="" class="visible" data-target-selection-name="sfdc:QuickAction.Asset.Subir_Captura"><runtime_platform_actions-action-renderer lwc-g2k8j8m3h7="" apiname="Asset.Subir_Captura" title="Nueva Nota"><runtime_platform_actions-executor-page-reference><slot><slot><lightning-button variant="neutral"><button class="slds-button slds-button_neutral" aria-disabled="false" name="Asset.Subir_Captura" type="button" part="button">Nueva Nota</button></lightning-button></slot></slot></runtime_platform_actions-executor-page-reference></runtime_platform_actions-action-renderer></li>-->

			</ul></runtime_platform_actions-actions-ribbon></div></div></div></div>

			
		
	
</div>
</div>
<div class="row pt-3">

<div class="col-12 col-md-4">

	<div class="card">
	 <div class="slds-card__header slds-grid"><header class="slds-media slds-media_center slds-has-flexi-truncate" part="header"><div class="slds-media__figure" part="icon"><lightning-icon icon-name="standard:avatar" class="slds-icon-standard-avatar slds-icon_container"><span style="--sds-c-icon-color-background: var(--slds-c-icon-color-background, rgb(27, 150, 255))" part="boundary"><lightning-primitive-icon size="small" variant="inverse"><svg class="slds-icon slds-icon_small" focusable="false" data-key="avatar" aria-hidden="true" viewBox="0 0 100 100" part="icon"><g><path d="M80 71.2V74c0 3.3-2.7 6-6 6H26c-3.3 0-6-2.7-6-6v-2.8c0-7.3 8.5-11.7 16.5-15.2.3-.1.5-.2.8-.4.6-.3 1.3-.3 1.9.1C42.4 57.8 46.1 59 50 59c3.9 0 7.6-1.2 10.8-3.2.6-.4 1.3-.4 1.9-.1.3.1.5.2.8.4 8 3.4 16.5 7.8 16.5 15.1z"></path><ellipse cx="50" cy="36.5" rx="14.9" ry="16.5"></ellipse></g></svg></lightning-primitive-icon></span></lightning-icon></div><div class="slds-media__body" part="title"><h2 class="slds-card__header-title"><span class="slds-text-heading_small slds-truncate"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cliente</font></font></span></h2></div><div class="slds-no-flex" part="actions"><slot name="actions"><lightning-button-icon class="slds-m-left_xx-small" slot="actions"><button class="slds-button slds-button_icon slds-button_icon-border" title="Para editar" type="button" part="button button-icon"><lightning-primitive-icon variant="bare"><svg class="slds-button__icon" focusable="false" data-key="edit" aria-hidden="true" viewBox="0 0 52 52" part="icon"><g><g><path d="M9.5 33.4l8.9 8.9c.4.4 1 .4 1.4 0L42 20c.4-.4.4-1 0-1.4l-8.8-8.8c-.4-.4-1-.4-1.4 0L9.5 32.1c-.4.4-.4 1 0 1.3zM36.1 5.7c-.4.4-.4 1 0 1.4l8.8 8.8c.4.4 1 .4 1.4 0l2.5-2.5c1.6-1.5 1.6-3.9 0-5.5l-4.7-4.7c-1.6-1.6-4.1-1.6-5.7 0l-2.3 2.5zM2.1 48.2c-.2 1 .7 1.9 1.7 1.7l10.9-2.6c.4-.1.7-.3.9-.5l.2-.2c.2-.2.3-.9-.1-1.3l-9-9c-.4-.4-1.1-.3-1.3-.1l-.2.2c-.3.3-.4.6-.5.9L2.1 48.2z"></path></g></g></svg></lightning-primitive-icon><span class="slds-assistive-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Para editar</font></font></span></button></lightning-button-icon></slot></div></header></div>
	  <div class="card-body">
	  
		     <table width="100%" style="font-size: 13px;">
		 		<tr>
		 			<td colspan="2">Cliente<br/><?=$test[0]["CF1"]?>&nbsp;<?=$test[0]["APELLIDO1"]?></td>
		 			
		 		</tr>
		 		<tr>
		 			<td>Correo<br/><a href="mailto:<?=$correo?>" target="_blank"><?=$correo?></a>&nbsp;</td>
		 			<td>WhatsApp<br/><a href="https://web.whatsapp.com/send?phone=521<?=$telefono?>" target="_blank"><?=$telefono?></a>&nbsp;</td>
		 		</tr>
		 		<tr>
		 			<td>Celular<br/><a href="tel:<?=$telefono?>"><?=$telefono?></a>&nbsp;</td>
		 			<td>Tel. Casa<br/><a href="tel:<?=$telefono2?>"><?=$telefono2?></a>&nbsp;</td>
		 		</tr>
		 	</table>
	
	

	  </div>
	</div>
<br>
		<div class="card">
	  
	    <div class="slds-card__header slds-grid"><header class="slds-media slds-media_center slds-has-flexi-truncate" part="header"><div class="slds-media__figure" part="icon"><lightning-icon icon-name="custom:custom31" class="slds-icon-custom-custom31 slds-icon_container"><span style="--sds-c-icon-color-background: var(--slds-c-icon-color-background, rgb(235, 104, 127))" part="boundary"><lightning-primitive-icon size="small" variant="inverse"><svg class="slds-icon slds-icon_small" focusable="false" data-key="custom31" aria-hidden="true" viewBox="0 0 100 100" part="icon"><g><path d="M75.5 43.2l-4.9-15.4C69.7 24.9 67 23 64 23H36c-3 0-5.7 1.9-6.7 4.8l-4.8 15.4c-2.6.7-4.5 3-4.5 5.8v12c0 2.6 1.7 4.8 4 5.7V75c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2v-8h28v8c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2v-8.3c2.3-.8 4-3 4-5.7V49c0-2.8-1.9-5.1-4.5-5.8zM30 60c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm22-17H32.2c-.7 0-1.2-.7-1-1.3l3.8-12c.1-.4.5-.7.9-.7h28c.399 0 .8.3.899.6l3.8 12.1c.2.6-.3 1.3-1 1.3H52zm17 17c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5z"></path></g></svg></lightning-primitive-icon></span></lightning-icon></div><div class="slds-media__body" part="title"><h2 class="slds-card__header-title"><span class="slds-text-heading_small slds-truncate">Unidad del Cliente</span></h2></div><div class="slds-no-flex" part="actions"><slot name="actions"></slot></div></header></div>
	
	  <div class="card-body">
	  
		     <table width="100%" style="font-size: 13px;">
		 		<tr>
		 			<td>Modelo<br/><?=$test[0]["MODELO"]?>&nbsp;</td>
		 			<td>Año<br/><?=$test[0]["ANO"]?>&nbsp;</td>
		 		</tr>
		 		<tr>
		 			<td>Color<br/><?=$test[0]["COLOR"]?>&nbsp;</td>
		 			<td>Sucursal<br/><?=$test[0]["MINEMPRESAS"]?>&nbsp;</td>
		 		</tr>
		 		<tr>
		 			<td>Placas<br/><?=$test[0]["PLACASAUTO"]?>&nbsp;</td>
		 			<td>Número de bastidor<br/><?=$test[0]["BASTIDOR"]?>&nbsp;</td>
		 		</tr>
		 		
		 		<tr>
		 			<td>Marca<br/><?=$test[0]["MARCA"]?>&nbsp;</td>
		 			<td>idInvetarioMM<br/><?=$test[0]["CARID"]?>&nbsp;</td>
		 		</tr>

		 	</table>
	
	

	  </div>
	</div>

	
</div>

<div class="col-12 col-md-8">
<div class="card" hidden>
	
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Actividades</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Cita de Servicio</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Historial de Ordenes</button>
  </div>
</nav>
<div class="tab-content p-2" id="nav-tabContent">
  <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<?php include('actividades.php');?>

  </div>
  <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><?php include('cita_servicio.php');?></div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><?php include('historial_ordenes.php');?></div>
</div>


</div>
</div>


</div>
</div>

<div class="col-12 col-md-3">

	<div class="card">
		  
			<div class="slds-card__header slds-grid"><header class="slds-media slds-media_center slds-has-flexi-truncate" part="header"><div class="slds-media__figure" part="icon"><lightning-icon icon-name="custom:custom13" class="slds-icon-custom-custom13 slds-icon_container"><span style="--sds-c-icon-color-background: var(--slds-c-icon-color-background, rgb(223, 97, 132))" part="boundary"><lightning-primitive-icon size="small" variant="inverse"><svg class="slds-icon slds-icon_small" focusable="false" data-key="custom13" aria-hidden="true" viewBox="0 0 100 100" part="icon"><g><g><path d="M74 22H26c-3.3 0-6 2.7-6 6v6c0 1.1.9 2 2 2h56c1.1 0 2-.9 2-2v-6c0-3.3-2.7-6-6-6zM74 42H26c-1.1 0-2 .9-2 2v28c0 3.3 2.7 6 6 6h40c3.3 0 6-2.7 6-6V44c0-1.1-.9-2-2-2zm-13 9c0 1.6-1.3 3-3 3H42c-1.6 0-3-1.3-3-3 0-1.6 1.3-3 3-3h16c1.7 0 3 1.3 3 3z"></path></g></g></svg></lightning-primitive-icon></span></lightning-icon></div><div class="slds-media__body" part="title"><h2 class="slds-card__header-title"><span class="slds-text-heading_small slds-truncate">Tipo de Base</span></h2></div><div class="slds-no-flex" part="actions"><slot name="actions"></slot></div></header></div>
		
		 <div class="card-body">
		 	<table width="100%" style="font-size: 13px;">
		 		<tr>
		 			<td>Tipo de base<br/><?=$tipoBase?>&nbsp;</td>
		 			<td>Fecha de venta<br><?=$fechaVenta?>&nbsp;</td>
		 		</tr>
		 		<tr>
		 			<td>Estado Serie<br/>NOLOTENGO&nbsp;</td>
		 			<td>Fecha última visita<br><?=$fechaUVisita?>&nbsp;</td>
		 		</tr>
		 		<tr>
		 			<td>Meses desde la venta<br/><?=round($test[0]["CALC_COL14"],2)?>&nbsp;</td>
		 			<td>Fecha próximo servicio<br><?=$fechaSVisita?>&nbsp;</td>
		 		</tr>
		 		<tr>
		 			<td>Tipificación<br/>NOLOTENGO&nbsp;</td>
		 			<td>Km próximo servicio<br><?=$test[0]["KMPROXVISITA"]?>&nbsp;</td>
		 		</tr>
		 	</table>
		 	
		 </div>
	</div>

</div>

</div>


<style type="text/css">
	td{
		padding-bottom: 10px;
		width: 50%;
		max-width: 150px;
		white-space: nowrap;
	  overflow: hidden;
	  text-overflow: ellipsis;
	}
	#footer{
		position: relative;
	}
	#contenido_area{
		position: absolute;
		background: gray;
		height:100%;
		top: 100px;
		width: 100%;
	}
</style>