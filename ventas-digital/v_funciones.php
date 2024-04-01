<?php
session_start();
include("_config.php");
include("_classes/_conexion.php");
include("_classes/classes.php");


$id=$_SESSION["Id"];
$columna=$_POST["columna"];
$valor=$_POST["valor"];
$_SESSION[$_POST["columna"]]=utf8_encode($_POST["valor"]);
//var_dump($id, $_POST);
//$param['Id']=$id;
//$param['columna']=$columna;
//$param['valor']=$valor;

$conn=new Conexion();
//$param['editor']=$editor;


//var_dump($param);
$registro=$conn->insert_etapa($id, $columna, $valor);
/*if($columna!='etapa'){
executeQuery($id, $columna, $valor);
}
 function executeQuery($id,$columna,$valor){
 	$columna=str_replace('-', '', utf8_encode($columna));
 	$valor=utf8_encode($valor);
$id="0062S00000zHAepQAG";
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, "https://hventas.gruporivero.com/_classes/update_sf.php?id=".$id."&columna=".$columna.'&valor='.$valor);
	        curl_setopt($ch, CURLOPT_HEADER, 0); 
	         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
	        
	        $output = curl_exec($ch);
	        var_dump($output); 
	        curl_close($ch);   
        }  
*/
//$conn=new Conexion();
/*
print(json_encode($id));
print(json_encode($_POST));*/

?>