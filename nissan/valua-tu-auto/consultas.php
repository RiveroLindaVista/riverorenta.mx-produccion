<?php
include_once("conexion.php");

class Conexion extends Database{
    public function query_marcas($ano){
        
        $conn= Database::connect();
        $sql = "SELECT marca FROM valuacion_autometrica WHERE year =".$ano." group by marca";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
        } 
        return $out;
        $conn=Database::close();
    }

    public function query_modelos($ano, $marca){
        try {
            $conn= Database::connect();
            $sql = "SELECT modelo FROM valuacion_autometrica WHERE year =2025 and marca ='Chevrolet' and modelo='Aveo'";
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
            } 
            return $out;
            $conn=Database::close();
        } catch (Exception $th) {
            return $th.getMessage();
        }

    }
}