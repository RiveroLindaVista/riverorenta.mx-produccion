<?php
date_default_timezone_set('America/Monterrey');
session_start();
require_once("../_classes/_conne.php");
require_once("../_classes/classes.php");
require_once("../commun/_config.php");
    
$func = $_POST["func"];


if ($func == "nueva_solicitud") {
   
    $consultas= new Consultas();
    $query = 'INSERT INTO mantenimiento (gerente, sucursal, zona, titulo, descripcion, fecha_solicitud, status, notificacion_sistema, log_sistema) VALUES( "'.utf8_decode($_POST['gerente']).'","'.utf8_decode($_POST['sucursal']).'", "'.utf8_decode($_POST['zona']).'", "'.utf8_decode($_POST['titulo']).'","'.utf8_decode($_POST['descripcion']).'","'.$_POST['fecha'].'", "PENDIENTE", "1","'.utf8_decode($_POST['gerente']).' ha creado una nueva solicitud.")';
    $result = $consultas->insert($query);

    $query2 = 'SELECT id FROM mantenimiento ORDER BY id desc limit 1';

    $ticket = $consultas->post_query($query2);
    echo json_encode($ticket[0]["id"]);

} else if ($func == "ciclo_notificaciones") {
    
    $consultas= new Consultas();
    $query = "SELECT count(*) as total FROM mantenimiento WHERE gerente ='".$_POST["gerente"]."' AND (notificacion_usuario is not NULL AND notificacion_usuario > '0') group by gerente";
    $result = $consultas->post_query($query);
    echo json_encode($result[0]["total"]);

} else if ($func == "ver_notificaciones") {
    
    $consultas= new Consultas();
    $query = "SELECT id, log_usuario FROM mantenimiento WHERE gerente ='".$_POST["gerente"]."' AND (notificacion_usuario is not NULL AND notificacion_usuario > '0') order by id desc";
    $result = $consultas->post_query($query);
    echo json_encode($result);

} else if ($func == "limpiar_notificacion") {
    
    $consultas= new Consultas();
    $query = "UPDATE mantenimiento set notificacion_usuario = '0' WHERE id='".$_POST["id"]."'";
    $result = $consultas->insert($query);
    echo json_encode($_POST["id"]);

} else if ($func == "ciclo_notificaciones_admin") {
    
    $consultas= new Consultas();
    $query = "SELECT count(*) as total FROM mantenimiento WHERE notificacion_sistema >= '1'";
    $result = $consultas->post_query($query);
    echo json_encode($result[0]["total"]);

} else if ($func == "ver_notificaciones_admin") {
    
    $consultas= new Consultas();
    $query = "SELECT id, log_sistema FROM mantenimiento WHERE notificacion_sistema >= '1' order by id desc";
    $result = $consultas->post_query($query);
    echo json_encode($result);

} else if ($func == "limpiar_notificacion_admin") {
    
    $consultas= new Consultas();
    $query = "UPDATE mantenimiento set notificacion_sistema = '0' WHERE id='".$_POST["id"]."'";
    $result = $consultas->insert($query);
    echo json_encode($_POST["id"]);

} else if ($func == "ver_ultimo_mensaje") {
    
    $consultas= new Consultas();
    $query = "SELECT comentarios FROM mantenimiento WHERE id='".$_POST["id"]."'";
    $result = $consultas->post_query($query);
    echo json_encode($result[0]["comentarios"]);

} else if ($func == "enviar_mensaje") {

    $consultas= new Consultas();

    $query = "SELECT comentarios FROM mantenimiento WHERE id ='".$_POST["id"]."'";
    $result = $consultas->post_query($query);
    $mensaje = $result[0]["comentarios"]." ".$_POST["mensaje"]." yo|";
    echo json_encode($mensaje);
    $query = "UPDATE mantenimiento set comentarios='".utf8_decode($mensaje)."' , notificacion_sistema = '1', log_sistema = '".$_POST["gerente"]." ha enviado un mensaje.' WHERE id='".$_POST["id"]."'";
    $result2 = $consultas->insert($query);

} else if ($func == "enviar_mensaje_admin") {

    $consultas= new Consultas();

    $query = "SELECT comentarios FROM mantenimiento WHERE id ='".$_POST["id"]."'";
    $result = $consultas->post_query($query);
    $mensaje = $result[0]["comentarios"]." ".$_POST["mensaje"]." ad|";
    echo json_encode($mensaje);
    $query = "UPDATE mantenimiento set comentarios='".utf8_decode($mensaje)."' , notificacion_usuario = '1', log_usuario = 'Mantenimiento ha enviado un mensaje.' WHERE id='".$_POST["id"]."'";
    $result2 = $consultas->insert($query);
    //echo json_encode($query);
    //echo json_encode($result2[0]["comentarios"]);

} else if ($func == "ver_chat") {

    $consultas= new Consultas();
    $query = "SELECT comentarios FROM mantenimiento WHERE id='".$_POST["id"]."'";
    $result = $consultas->post_query($query);
    echo json_encode($result[0]["comentarios"]);
 
} else if ($func == "change_password") {

    $consultas= new Consultas();
    $query = "UPDATE mantenimiento_usuarios set password = '".$_POST["password"]."' WHERE id='".$_POST["id"]."'";
    $result = $consultas->insert($query);
    echo json_encode($query);

} else if ($func == "crear_usuario") {

    $consultas= new Consultas();
    $query = "SELECT usuario FROM mantenimiento_usuarios WHERE usuario = '".$_POST["usuario"]."'";
    $repetido = $consultas->post_query($query);

    if ($repetido[0] == null){
        $query2 = 'INSERT INTO mantenimiento_usuarios (nombre, usuario, password, rol , sucursal, departamento) VALUES("'.$_POST['nombre'].'","'.$_POST['usuario'].'", "'.$_POST['password'].'", "'.$_POST['rol'].'","'.$_POST['sucursal'].'","'.$_POST['departamento'].'")';
        $result = $consultas->insert($query2);
        echo json_encode('1');
    } else {
        echo json_encode('Ya existe un usuario con este correo.');
    }

} else if ($func == "eliminar_usuario") {

    $consultas= new Consultas();
    $query = 'DELETE from mantenimiento_usuarios WHERE id="'.$_POST['id'].'"';
    $result = $consultas->insert($query);
    echo json_encode('1');

} else if ($func == "change_trabajador") {

    $consultas= new Consultas();
    $query = "UPDATE mantenimiento set trabajador = '".$_POST["trabajador"]."' WHERE id='".$_POST["id"]."'";
    $result = $consultas->insert($query);
    echo json_encode($query);

} else if ($func == "change_status") {

    $consultas= new Consultas();
    $fecha = date('Y-m-d H:i');
    $query1 = "SELECT comentarios FROM mantenimiento WHERE id ='".$_POST["id"]."'";
    $result = $consultas->post_query($query1);
    $mensaje = $result[0]["comentarios"]." ".$_POST["mensaje"]." - ".$fecha." ad|";

    $query = "UPDATE mantenimiento set status = '".$_POST["status"]."' , comentarios='".utf8_decode($mensaje)."', notificacion_usuario = '1', log_usuario='El status de tu solicitud ha cambiado.'  WHERE id='".$_POST["id"]."'";
    $result = $consultas->insert($query);
    echo json_encode($query);

} else if ($func == "change_prioridad") {

    $consultas= new Consultas();
    $query = "UPDATE mantenimiento set prioridad = '".$_POST["prioridad"]."' WHERE id='".$_POST["id"]."'";
    $result = $consultas->insert($query);
    echo json_encode($query);

} else if ($func == "change_fecha_estimada") {

    $consultas= new Consultas();
    $query = "UPDATE mantenimiento set fecha_estimada = '".$_POST["fecha_estimada"]."' WHERE id='".$_POST["id"]."'";
    $result = $consultas->insert($query);
    echo json_encode($query);

}

?>