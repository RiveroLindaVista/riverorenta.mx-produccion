<?php
require_once("../../_inc/_config.php");
date_default_timezone_set('America/Mexico_City');
$date= date("m-d-Y");     
$str = '"'.$_FILES['file']['name'];

$carpeta=$_POST['carpeta'];
$destino = "../../../assets/img/blog/".$carpeta;
if(!is_dir($destino)){mkdir($destino);} 

$name="/portada.png";
$_FILES['file']['name']=$name;

$location = $destino.$name;
//$urlActual= URLP.$name;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

// Check image format
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
 $uploadOk = 0;
}

if($uploadOk == 0){
 echo 0;
}else{
 // Upload file
 if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    echo '<input type="text" id="url_img" class="form-control disabled" disabled="" value="https://www.dev.gruporivero.com.mx/assets/img/blog/'.$carpeta.'/portada.png">';
 }
}

?>