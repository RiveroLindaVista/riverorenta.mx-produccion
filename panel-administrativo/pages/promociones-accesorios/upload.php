<?php
include ('../../../../admin/blogs/composer/vendor/autoload.php');
require_once("../../_inc/_config.php");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");


use Aws\S3\S3Client;

// Instantiate an Amazon S3 client.
$s3Client = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-2',
    'credentials' => [
        'key'    => 'AKIATH65UL54I6XXYMUJ',
        'secret' => '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'
    ]
]);

// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if file was uploaded without errors
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        //$allowed = array("mp4" => "video/mp4");

        $filename = $_FILES["file"]["name"];
        $filetype = $_FILES["file"]["type"];
        $filesize = $_FILES["file"]["size"];

        // Validate file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Validate file size - 10MB maximum
        $maxsize = 50 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Validate type of the file
        if(in_array($filetype, $allowed)){       


            $filename = $_FILES['file']['name'];
            $keyName = 'prueba-futbol/'. $filename;         

            $bucket = 'rivero-static';
            $file_Path = __DIR__ . '/upload/'. $filename;
            $key = basename($file_Path);
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucket,
                    'Key'    => $keyName,
                    'SourceFile' => $_FILES["file"]['tmp_name'],
                    'ContentType' => 'image/jpg',
                    'ACL'    => 'public-read', // make file 'public'
                ]);
                //echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
                $ruta = $result->get('ObjectURL');
                 //echo "Your file was uploaded successfully.";
              
                //$ruta = $_POST['ruta_video'];
               
            } catch (Aws\S3\Exception\S3Exception $e) {
                echo "There was an error uploading the file.\n";
                echo $e->getMessage();
            }
           
                
            
        } else{
            echo "Hubo un problemna al subir el video, intenta más tarde."; 
        }
    } else{
        echo "no sirvio este pex";
    }
}

/*
use Aws\S3\S3Client;
// Instantiate an Amazon S3 client.
$s3Client = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-2',
    'credentials' => [
        'key'    => 'AKIATH65UL54I6XXYMUJ',
        'secret' => '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'
    ]
]);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_FILES["anyfile"]) && $_FILES["anyfile"]["error"] == 0){

        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["anyfile"]["name"];
        $filetype = $_FILES["anyfile"]["type"];
        $filesize = $_FILES["anyfile"]["size"];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        $maxsize = 50 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        if(in_array($filetype, $allowed)){ 

            $filename = $_FILES['anyfile']['name'];
            $keyName = 'prueba-futbol/'. $filename;         

            $bucket = 'rivero-static';
            $file_Path = __DIR__ . '/upload/'. $filename;
            $key = basename($file_Path);
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucket,
                    'Key'    => $keyName,
                    'SourceFile' => $_FILES["anyfile"]['tmp_name'],
                    'ACL'    => 'public-read', // make file 'public'
                ]);
                //echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
                $ruta = $result->get('ObjectURL');
               
                //$ruta = $_POST['ruta_video'];
                
                
            } catch (Aws\S3\Exception\S3Exception $e) {
                echo "There was an error uploading the file.\n";
                echo $e->getMessage();
            }
           
                
        }else{
            echo "ha ocurrido un error";
        }

    }
    
}
*/


/*$str = '"'.$_FILES['file']['name'];
$resultado = str_replace (",",".", $str);
$resultadof = explode(".", $resultado);
$name_original=$_POST['name'];
$name_post=str_replace(" ", "_",$name_original);

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

$location = "../../../assets/img/promociones/ofertas/accesorios/".$name;
//$urlActual= URLP.$name;
$uploadOk = 1;
$imageFileType = $_FILES['file']['type']

// Check image format
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
 && $imageFileType != "pdf" ) {
 $uploadOk = 0;
}
*/
/*if($uploadOk == 0){
 echo 0;
}else{
 // Upload file
 if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    echo '<input type="text" id="url_img" class="form-control disabled" disabled="" value="'.$ruta.'">';
 }
}*/



?>