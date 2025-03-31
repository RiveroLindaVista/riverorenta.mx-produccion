<?php
include_once("consultas.php");

session_start();
class Construir extends Conexion{
   public function get_marcas($ano){

      $conn=new Conexion();
      $consulta= $conn->query_marcas($ano);
      return $consulta;
   }

   public function get_modelos($ano,$marca){

      $conn=new Conexion();
      $consulta= $conn->query_modelos($ano,$marca);
      return $consulta;
   }

   public function get_versiones($modelo,$ano,$marca){

      $conn=new Conexion();
      $consulta= $conn->query_versiones($modelo,$ano,$marca);
      return $consulta;
   }
}