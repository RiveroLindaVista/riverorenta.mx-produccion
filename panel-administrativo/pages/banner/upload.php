<?php
require_once("../../_inc/_config.php");

$str = '"'.$_FILES['file']['name'];
$resultado = str_replace (",",".", $str);
$resultadof = explode(".", $resultado);

$asignado=$_POST['asignado'];
$mes_banner=$_POST['mes_banner'];
$tipo=$_POST['tipo'];
$descripcion=$_POST['descripcion'];
$desc= str_replace(" ","_",$descripcion);
 
if ($asignado!='NOASIGNADO') {
$op=strtolower($asignado);
$porciones = explode("-", $op);
$marca=$porciones[0];
$modelo=$porciones[1];
$ano=$porciones[2];
$auto= $marca."-".$modelo."-".$ano;
}else{
	//$auto=$asignado;
	$auto= $desc;
}
$nom_img= $tipo."-".$auto."-".$mes_banner.".".$resultadof[1];

$_FILES['file']['name']=$nom_img;

$location = "../../../assets/banners/img/".$nom_img;
//$urlActual= URLP.$name;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

// Check image format
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
 $uploadOk = 0;
}

if($uploadOk == 0){
 echo 0;
}else{
 // Upload file
 if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    echo '<input type="text" id="imagen" class="form-control disabled" disabled="" value="https://www.gruporivero.com/assets/banners/img/'.$nom_img.'">';
 }
}
?>