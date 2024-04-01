<?php
session_start();

class Consultas extends Database{

    public function insert($sql){
        $conn= Database::connect();
        $result=$conn->query($sql);
        $conn=Database::close();
        return 1;
    }

    public function post_query($query){
        $out=[];
        $conn= Database::connect();
         $sql = $query;
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
        return $out;
    }

    public function get_tickets(){
        $conn= Database::connect();
            $sql = "SELECT * FROM mantenimiento";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
            return $out;
    }

    public function check_user($user,$pass){
        $conn= Database::connect();
            $sql = "SELECT * FROM mantenimiento_usuarios WHERE usuario ='".$user."' AND password ='".$pass."'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
            return $out;
    }

    public function get_user($user){
        $conn= Database::connect();
            $sql = "SELECT * FROM mantenimiento_usuarios WHERE nombre ='".$user."' ";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
            return $out;
    }

    public function get_user_notificaciones($user){
        $conn= Database::connect();
            $sql = "SELECT count(*) as notificaciones FROM mantenimiento WHERE gerente ='".$user."' AND (notificacion_usuario is not NULL AND notificacion_usuario > '0') group by gerente ";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
            return $out;
    }

    public function get_admin_notificaciones(){
        $conn= Database::connect();
            $sql = "SELECT count(*) as notificaciones FROM mantenimiento WHERE notificacion_sistema >= '1'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
            return $out;
    }

    public function get_solicitudes_by_user($user){
        $conn= Database::connect();
            $sql = "SELECT * FROM mantenimiento WHERE gerente ='".$user."' order by id desc ";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
            return $out;
    }

    public function get_solicitudes_admin($filtro){
        $conn= Database::connect();

        if ($filtro == 'todo'){
            $sql = "SELECT * FROM mantenimiento WHERE status <> 'FINALIZADA' order by id desc";
        } else if($filtro == 'prioridad'){
            $sql = "SELECT * FROM mantenimiento WHERE status <> 'FINALIZADA' order by prioridad, id desc";
        }  else if($filtro == 'prioridad-alta'){
            $sql = "SELECT * FROM mantenimiento WHERE status <> 'FINALIZADA' and prioridad='1' order by prioridad, id desc";
        }  else if($filtro == 'prioridad-media'){
            $sql = "SELECT * FROM mantenimiento WHERE status <> 'FINALIZADA' and prioridad='2' order by prioridad, id desc";
        }   else if($filtro == 'prioridad-baja'){
            $sql = "SELECT * FROM mantenimiento WHERE status <> 'FINALIZADA' and prioridad='3' order by prioridad, id desc";
        }  else if($filtro == 'fecha-estimada'){
            $sql = "SELECT * FROM mantenimiento WHERE status <> 'FINALIZADA' order by fecha_estimada, id asc";
        }

        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_encode", $row);
            }
        } 
        $conn=Database::close();
        return $out;
    }

    public function get_solicitud_by_id($id,$gerente){
        $conn= Database::connect();
            $sql = "SELECT * FROM mantenimiento WHERE id ='".$id."' AND gerente ='".$gerente."'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
        return $out;
    }

    public function get_chat_by_id($id,$gerente){
        $conn= Database::connect();
            $sql = "SELECT comentarios FROM mantenimiento WHERE id ='".$id."' AND gerente ='".$gerente."'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
        return $out;
    }

    public function get_trabajadores(){
        $conn= Database::connect();
            $sql = "SELECT * FROM mantenimiento_usuarios WHERE rol = 'TRABAJADOR'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                }
        $conn=Database::close();
        return $out;
    }

    public function get_trabajadores_join(){
        $conn= Database::connect();
            $sql = "SELECT t1.*,t2.*, COUNT(t1.trabajador) AS solicitudes FROM mantenimiento t1 left join mantenimiento_usuarios t2 on t1.trabajador=t2.nombre WHERE trabajador IS NOT NULL GROUP BY t1.trabajador ";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                }
        $conn=Database::close();
        return $out;
    }

    public function get_solicitud_admin_by_id($id){
        $conn= Database::connect();
            $sql = "SELECT * FROM mantenimiento WHERE id ='".$id."'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
        return $out;
    }

    public function get_chat_admin_by_id($id){
        $conn= Database::connect();
            $sql = "SELECT comentarios FROM mantenimiento WHERE id ='".$id."'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                } 
        $conn=Database::close();
        return $out;
    }

}
?>