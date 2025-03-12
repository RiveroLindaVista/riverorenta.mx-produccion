<?php

date_default_timezone_set('America/Monterrey');

class QueriesPolicy extends Conexion {

    public function get_politicas() {
        $conn = Database::connect();

        $sql = "SELECT * FROM politicas_empleados WHERE status = 1";
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[] = array_map("utf8_encode", $row);
            }
        }
        $conn = Database::close();
        return $out;
    }

}

?>