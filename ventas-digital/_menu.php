 <div class="mt-5">  
    <div class="menutitulo text-center">
        <img src="<?=URL?>images/icons/elige-blanco.png" width="100%"/><br/>Elige
    </div>
    <a data-toggle="tooltip" data-placement="top" title="Tipo de auto" href="<?=URL?>etapa-tipo-auto/">
        <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=1){echo "bg-light";}?> <?php if($valMenu==1){echo "bg-primary";}?>">&nbsp</div>
    </a>
    <div class="text-center"><strong>l</strong></div>
    <a data-toggle="tooltip" data-placement="top" title="Modelo de auto" href="<?=URL?>etapa-modelo-auto/?tipoAuto=<?=$_SESSION["tipo-auto"]?>">
        <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=2){echo "bg-light";}?> <?php if($valMenu==2){echo "bg-primary";}?>">&nbsp</div>
    </a>  
    <div class="text-center">l</div>
  <!--a data-toggle="tooltip" data-placement="top" title="Prueba de manejo" href="<?=URL?>etapa-5/">
        <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php //if($valMenu!=5){echo "bg-light";}?> <?php //if($valMenu==5){echo "bg-primary";}?>">&nbsp</div>
    </a-->
</div>

<div class="mt-2 pr-1">
   <div class="menutitulo text-center">
      <img src="<?URL?>/images/icons/cotiza-blanco.png" width="100%"/><br/>Cotiza
   </div>
    <a data-toggle="tooltip" data-placement="top" title="Valúa tu auto" href="<?=URL?>etapa-3/">
        <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=3){echo "bg-light";}?> <?php if($valMenu==3){echo "bg-primary";}?>">&nbsp</div>
    </a>
    <div class="text-center">l</div>
    <a data-toggle="tooltip" data-placement="top" title="Versión de auto" href="<?=URL?>etapa-4/">
        <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=4){echo "bg-light";}?> <?php if($valMenu==4){echo "bg-primary";}?>">&nbsp</div>
    </a>
    <div class="text-center">l</div>
   <a data-toggle="tooltip" data-placement="top" title="Cotiza" href="<?=URL?>etapa-pago/">
      <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=6){echo "bg-light";}?> <?php if($valMenu==6){echo "bg-primary";}?>">&nbsp</div>
    </a>
    <div class="text-center"><strong>l</strong></div>
               
   <a data-toggle="tooltip" data-placement="top" title="Garantía" href="<?=URL?>etapa-7/">
      <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=7){echo "bg-light";}?> <?php if($valMenu==7){echo "bg-primary";}?>">&nbsp</div>
    </a>
    <div class="text-center"><strong>l</strong></div>

    <a data-toggle="tooltip" data-placement="top" title="Seguro" href="<?=URL?>etapa-8/">
      <div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=8){echo "bg-light";}?> <?php if($valMenu==8){echo "bg-primary";}?>">&nbsp</div>
    </a>
    <div class="text-center"><strong>l</strong></div>
       
</div>
    <div class="mt-2 pr-1">
        <div class="menutitulo text-center">
         <img src="<?URL?>/images/icons/estrena-blanco.png" width="80px" style="max-width: 80px;"/><br/>Estrena
      </div>
        

      <a data-toggle="tooltip" data-placement="top" title="Solicitud" href="#"><div style="width: 15px; height: 15px;" class="rounded-circle mx-auto <?php if($valMenu!=9){echo "bg-light";}?> <?php if($valMenu==9){echo "bg-primary";}?>">&nbsp</div></a>
   
    </div>
