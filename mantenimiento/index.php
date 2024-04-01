<?php
include("commun/header.php");
    require_once("_classes/_conne.php");
    require_once("_classes/classes.php");
    require_once("commun/_config.php");
    $consultas=new Consultas();
?>
  <!-- Begin Page Content -->
                <div class="container-fluid">
                  <?php
include("home/_contenido.php");
?>
</div>
<?php
include("commun/footer.php");
?>