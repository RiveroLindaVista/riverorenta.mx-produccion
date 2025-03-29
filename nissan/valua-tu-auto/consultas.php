<?php
include_once("conexion.php");

class Conexion extends Database{
    public function query_autometrica(){
        $conn= Database::connect();
        $sql = "SELECT * FROM valuacion_autometrica limit 10";
        $result=$conn->query($sql);
        if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=$row;
                    }
                } 
        return $out;
        $conn=Database::close();
    }
}