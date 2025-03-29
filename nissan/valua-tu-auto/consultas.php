<?php
include_once("conexion.php");

class Conexion extends Database{
    public function query_marcas($ano){
        return 'PIPI222';
        $conn= Database::connect();
        $sql = "SELECT marca FROM valuacion_autometrica WHERE year =".$ano." group by marca, order by marca asc ";
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