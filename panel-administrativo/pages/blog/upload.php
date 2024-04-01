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
        //$allowed = array("mp4" => "file/mp4");

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


            $filename = 'portada.jpg';
            $keyName = 'prueba-futbol/'. $filename;         

            $bucket = 'rivero-static';
            $file_Path = _DIR_ . '/upload/'. $filename;
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
                 echo "Your file was uploaded successfully.";
              
                //$ruta = $_POST['ruta_file'];
               
            } catch (Aws\S3\Exception\S3Exception $e) {
                echo "There was an error uploading the file.\n";
                echo $e->getMessage();
            }
           
                
            
        } else{
            echo "Hubo un problemna al subir el video, intenta más tarde."; 
        }
    } else{
        echo 2;
    }
}