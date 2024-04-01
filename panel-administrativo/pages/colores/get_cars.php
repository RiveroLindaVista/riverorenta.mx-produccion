<?php
include_once("../../_inc/consultas.php");
session_start();
$color = $_POST['color'];

getCarsByColor($color);
//invocar funcion que trae carros query_select_cars_by_color
function getCarsByColor($color) {
  $conn=new Conexion();
  $qry= $conn->query_select_cars_by_color($color);
  echo json_encode($qry);
}



?>