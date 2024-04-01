<div class="row">
   <div class="col-12 bg-dark">
      <div id="imgBack" class="bg-dark p-4">
        <a href="<?=URL?>oportunidades/?email=<?=str_replace('@gruporivero.com','',$_SESSION["owner"])?>">
           <center>
            
               <img src="<?=URL?>/images/logo_primo_3d.png" alt="logo primo" width="180vw"/> 
               
            </center>
       

     
</a>
      

       </div>


<?php
$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if($actual_link!="https://hventas.gruporivero.com/index.php"&&$actual_link!="https://hventas.gruporivero.com/oportunidades/index.php"){
   ?>
      <div class="menuIcon">
        <div class="collapse" id="navbarToggleExternalContent">
          <div class="bg-dark p-4">
           <a href="<?=URL?>datos-facturacion/" target="_blank"><h4 class="text-white">Datos de Facturación</h4></a>
            <a href="<?=URL?>pedido/" target="_blank"><h4 class="text-white">Pedido separar</h4></a>
            <a href="<?=URL?>solicitud-en-linea/" target="_blank"><h4 class="text-white">Solicitud de Crédito</h4></a>
            <a href="https://www.rightlink.mx/" target="_blank"><h4 class="text-white">RightLink GMF</h4></a>
            
            
          </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </nav>
      </div>
      <?php
   }
?>


    </div>
</div>