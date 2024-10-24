<?php

date_default_timezone_set('America/Monterrey');
$utf8 = $conn->set_charset("utf8");
class QueriesPolicy extends Conexion {

    public function get_politicas() {
        $conn = Database::connect();

        // return 'echo desde clase';
        $sql = "SELECT * FROM politicas";
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[] = array_map("utf8_encode", $row);
            }
        }
        $conn = Database::close();
        return $out;
    }

    public function insert_politica($request) {
       $conn = Database::connect();
       $nombre = $request["nombre"];
       $url_document = $request["url_document"];
       $url_image = $request["url_image"];
       
       $fecha = date('Y-m-d H:i:s');

       $sql = "INSERT INTO politicas(id, nombre, url_document, fecha, url_image) VALUES(null, '$nombre', '$url_document', '$fecha', '$url_image')"; 
       $result = $conn->query($sql);
       $conn = Database::close();
       return $result;

    }

    public function update_name_policy($request) {
        $conn = Database::connect();
        $nombre_anterior = $request["nombre_politica_modal_hide"];
        $nuevo_nombre = $request["nombre"];
        $fecha = date('Y-m-d H:i:s');

        $sql = "UPDATE politicas SET nombre = '$nuevo_nombre', fecha = '$fecha' WHERE nombre = '$nombre_anterior'";
        $result = $conn->query($sql);
        $conn = Database::close();

        return $result;
    }
    public function update_name_policies_employee($request) {
        $conn = Database::connect();
        $nombre_anterior = $request["nombre_politica_modal_hide"];
        $nuevo_nombre = $request["nombre"];
        

        $sql = "UPDATE politicas_empleados SET politica = '$nuevo_nombre' WHERE politica = '$nombre_anterior'";
        $result = $conn->query($sql);
        $conn = Database::close();

        return $result;
    }

    public function update_policy($request) {
        $conn = Database::connect();
        $nombre_anterior = $request["nombre_politica_modal_hide_pol"];
        $nuevo_nombre = $request["nombre"];
        $url_document = $request["url_document"];
        $fecha = date('Y-m-d H:i:s');


        $sql = "UPDATE politicas SET nombre='$nuevo_nombre', url_document='$url_document', fecha='$fecha' WHERE nombre = '$nombre_anterior'";
        $result = $conn->query($sql);
        $conn = Database::close();

        return $result;
    }

    public function set_disabled_politicas_empleados($request) {
        $conn = Database::connect();
        $nombre_anterior = $request["nombre_politica_modal_hide_pol"];
        
        $sql = "UPDATE politicas_empleados SET status='2' WHERE politica = '$nombre_anterior'";
        $result = $conn->query($sql);
        $conn = Database::close();

        return $result;
    }

}

?>