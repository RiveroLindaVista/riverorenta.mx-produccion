<?php
include_once("conexion.php");

class Conexion extends Database{

    public function query_anos(){
        
        $conn= Database::connect();
        $sql = "SELECT year FROM valuacion_autometrica group by year order by year desc";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
        } 
        return $out;
        $conn=Database::close();
    }

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

        $conn= Database::connect();
        $sql = "SELECT modelo FROM valuacion_autometrica WHERE year =".$ano." and marca ='".$marca."' group by modelo";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
        } 
        return $out;
        $conn=Database::close();

    }

    public function query_versiones($modelo, $ano, $marca){

        $conn= Database::connect();
        $sql = "SELECT version FROM valuacion_autometrica WHERE year =".$ano." and marca ='".$marca."' and modelo ='".$modelo."'";
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