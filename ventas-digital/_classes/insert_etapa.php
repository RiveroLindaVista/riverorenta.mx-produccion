<?php
session_start();
require_once("../_config.php");
include("_conexion.php");
include("classes.php");


$cone=new Conexion();
$versiones=$cone->insert_etapa($_SESSION["Id"], $_POST["etapa"], $_POST["seccion"], $_POST["seccionValue"]);


?>