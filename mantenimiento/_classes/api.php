<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
require_once("_conne.php");
require_once("classes.php");
require_once("../commun/_config.php");

    if ( $_GET["funcion"]== "validar_login"){

        $user = $_GET["usuario"];
        $pass = $_GET["contra"];

        $consultas= new Consultas();
        $query = "SELECT * FROM mantenimiento_usuarios WHERE usuario ='".$user."' AND password ='".$pass."'";
        $result = $consultas->post_query($query);
        echo json_encode($result[0]);
    } else  if ( $_GET["funcion"]== "num_solicitudes"){

        $user = $_GET["usuario"];

        $consultas= new Consultas();
        $query = "SELECT trabajador, status, COUNT(*) AS total FROM mantenimiento WHERE trabajador='".$user."' AND status <> 'FINALIZADA' AND status <> 'RECHAZADA' GROUP BY status";
        $result = $consultas->post_query($query);
        echo json_encode($result);
    } else  if ( $_GET["funcion"]== "get_solicitudes"){

        $user = $_GET["usuario"];

        $consultas= new Consultas();
        $query = "SELECT * FROM mantenimiento WHERE trabajador='".$user."' AND status <> 'FINALIZADA' AND status <> 'RECHAZADA' ORDER BY id desc";
        $result = $consultas->post_query($query);
        echo json_encode($result);
    } else  if ( $_GET["funcion"]== "ver_solicitud"){

        $id = $_GET["id"];

        $consultas= new Consultas();
        $query = "SELECT * FROM mantenimiento WHERE id='".$id."' ";
        $result = $consultas->post_query($query);
        echo json_encode($result[0]);
    } else if ($_GET["funcion"] == "enviar_observacion") {

        $consultas= new Consultas();

        $query = "SELECT observaciones FROM mantenimiento WHERE id ='".$_GET["id"]."'";
        $result = $consultas->post_query($query);

        if($result == null || $result == ""){
            $mensaje = $_GET["observacion"]." |";
        } else {
            $mensaje = $result[0]["observaciones"]." ".$_GET["observacion"]." |";
        }

        echo json_encode($mensaje);

        $query2 = "UPDATE mantenimiento set observaciones='".utf8_decode($mensaje)."' WHERE id='".$_GET["id"]."'";
        $result2 = $consultas->insert($query2);
    
    }

?>