<?php
require_once("../../_inc/_config.php");

$str = '"'.$_FILES['file']['name'];
$resultado = str_replace (",",".", $str);
$resultadof = explode(".", $resultado);
$name_post=$_POST['name'];

$titulo1=str_replace('ó', 'o', $name_post);
$titulo2=str_replace('Ó', 'o', $titulo1);
$titulo3=str_replace('á', 'a', $titulo2);
$titulo4=str_replace('í', 'i', $titulo3);
$titulo5=str_replace('ú', 'u', $titulo4);
$titulo6=str_replace('?', '', $titulo5);
$titulo7=str_replace('¿', '', $titulo6);
$titulo8=str_replace('!', '', $titulo7);
$titulo9=str_replace('¡', '', $titulo8);
$titulo10=str_replace(' ', '-', $titulo9);


$name=strtolower($titulo10).".".$resultadof[1];
$_FILES['file']['name']=$name;

$location = "../../../assets/img/promociones/ofertas/taller/".$name;
//$urlActual= URLP.$name;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

// Check image format
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
 && $imageFileType != "pdf" ) {
 $uploadOk = 0;
}

if($uploadOk == 0){
 echo 0;
}else{
 // Upload file
 if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    echo '<input type="text" id="copia_reporte" class="form-control disabled" disabled="" value="https://www.dev.gruporivero.com.mx/assets/img/promociones/ofertas/taller/'.$name.'">';
 }
}

?>