 <div id="imgBack">
 	 <a href="<?=URL?>/"><img src="<?=URL?>/iconos/SVG/logo_primo_3d.png" 
 	  alt="Responsive image" width="60%" class="logo"/> </a>     
 	  <div class="cambiarCarro">
 	  	 <a href="<?=URL?>/etapa1/" style="color:#fff;"><?=$_SESSION['modelo']?> <?=$_SESSION['anio']?>&nbsp;&nbsp;<img src="<?=URL?>/iconos/SVG/icon_refresh.svg" width="40px"/></a>
 	  </div> 
          <div class="menuTop" onclick="abrirMenu()">
       <img src="<?=URL?>/iconos/SVG/icon_menu.svg" width="40px"/></div> 

<div id="Menu">
  Menu
  <hr>
  <ul class="subMenu">
    <a href="<?=URL?>/datos-facturacion/"><li>Datos de Facturación</li></a>
    <a href="<?=URL?>/pedido/" target="_blank"><li>Pedido separar</li></a>
    <a href="<?=URL?>/solicitud-en-linea/"><li>Solicitud de Crédito</li></a>
    <a href="https://www.rightlink.mx/" target="_blank"><li>RightLink GMF</li></a>
    <a href="<?=URL?>/guardar-y-salir/"><li>Guardar y Salir</li></a>
  </ul>
</div>

 </div>

 <script>
  var menu=0;
  function abrirMenu(){
    if(menu==0){
      $("#Menu").fadeIn();
      menu=1;
    }else{
      $("#Menu").fadeOut();
      menu=0;
    }
  }
 </script>



