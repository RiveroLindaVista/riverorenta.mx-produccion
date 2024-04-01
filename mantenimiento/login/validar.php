<?php
  session_start();
  require_once("../commun/_config.php");
  require_once("../_classes/_conne.php");
  require_once("../_classes/classes.php");
  require_once("../commun/_config.php");
  $consultas=new Consultas();

  $resp=$consultas->check_user($_POST["user"],$_POST["pass"]);

  if(isset($resp[0]["usuario"])){
    echo $resp[0]["nombre"];
    $_SESSION["login"]= 1;
    $_SESSION["nombre"]=$resp[0]["nombre"];
    $_SESSION["rol"]=$resp[0]["rol"];
    $_SESSION["agencia"]=$resp[0]["agencia"];
    ?>
    <script>
      console.log('ENTRA')
      window.location.href="https://mantenimiento.gruporivero.com/home/";
    </script>
    <?php
  } else {
    ?>
    <script>
      window.location.href="<?=URL?>/login";
    </script>
    <?php
  }

?>
