<?php
require_once("../../_inc/_config.php");

use Aws\S3\S3Client;
use Aws\Exception\S3Exception;

require_once("../../_inc/config_aws.php");

require '../../vendor/autoload.php';

var_dump($_FILES);

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

$location = "../../../assets/img/promociones/ofertas/nuevos/".$name;
//$urlActual= URLP.$name;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    

      if (empty($_FILES['file'])) die("no file");

      $tmpFile = $_FILES['file']['tmp_name'];
      $filename = "promociones/ofertas/nuevos/{$name}.jpg";

      $s3 = new S3Client([
          'version' => 'latest',
          'region' => 'us-east-2',
          'credentials' => [
              'key' => AWS_KEY,
              'secret' => AWS_SECRET
          ]
      ]);     
      print_r('SUBIDA'.$_FILES);
      $uploadResult = $s3->putObject([
          'Bucket' => 'rivero-static',
          'Key' => $filename,
          'Body' => fopen($tmpFile, 'r'),
      ]);
      
      //echo 'Se ha subido la imagen correctamente a la direccion https://d3s2hob8w3xwk8.cloudfront.net/'.$filename;



?>