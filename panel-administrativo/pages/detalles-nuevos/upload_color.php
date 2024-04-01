<?php
require_once("../../_inc/_config.php");

$str = '"'.$_FILES['file']['name'];
$resultado = str_replace (",",".", $str);
$resultadof = explode(".", $resultado);

$color=$_POST['color'];
$modelo=str_replace(' ', '-',$_POST['modelo']);
$marca=$_POST['marca'];
$ano=$_POST['ano'];

$op=strtoupper($color);
$color_name = str_replace(" ","-", $op);
$nom_img= $color_name.".".$resultadof[1];

$_FILES['file']['name']=$nom_img;

$location = "https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/".strtolower($marca)."/".strtolower($modelo)."-".$ano."/colores/".$nom_img;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
$uploadOk = 1;

//$urlActual= URLP.$name;
if (file_exists($location)) {
 	$uploadOk = 0;
	echo 0;
} else {
	// Check image format
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
	 $uploadOk = 0;
	}

	if($uploadOk == 0){
	 echo 0;
	}else{
	 // Upload file
	 try {
		$res = move_uploaded_file($_FILES['file']['tmp_name'],$location);
		echo $location;
		echo $res;

	} catch (\Throwable $th) {
		echo $th;
	 }
	}
}

?>