<?php
include_once("consultas.php");

session_start();
class Construir extends Conexion{
   public function get_marcas($ano){

      $conn=new Conexion();
      $consulta= $conn->query_marcas($ano);
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
            $cadena.='<option selected value="'.$consulta[$i].'">'.$consulta[$i].'</option>';
        }
      }
      return  $cadena;
   }
}