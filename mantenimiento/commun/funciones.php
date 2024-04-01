<?php
session_start();
require_once("../_classes/_conne.php");
require_once("../_classes/classes.php");
require_once("_config.php");
echo json_encode('entro');
$func = $_POST["func"];

if ($func == "ciclo_notificaciones") {
    
    
   
    $consultas= new Consultas();
    $query = "SELECT count(*) as total FROM mantenimiento WHERE gerente ='".$_POST["gerente"]."' AND (notificacion_usuario is not NULL AND notificacion_usuario > '0') group by gerente";
    $result = $consultas->insert($query);
    echo json_encode($ticket[0]["total"]);

}

?>