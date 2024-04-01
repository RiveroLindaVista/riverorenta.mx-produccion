<?php

require_once("../../_inc/configuration.php");
include("../../_inc/constructor.php");

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

$conne = new Construir();
$blogs = $conne->get_table_blogs();

$carpeta = end($blogs);
echo $carpeta;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if file was uploaded without errors
    if(isset($_FILES["archivo"])){

        $filename = $_FILES["archivo"]["name"];

        // Validate type of the file
        if(in_array($filetype, $allowed)){       

            $filename = $_FILES['archivo']['name'];
            $keyName = 'blog/'. $filename;         

            $bucket = 'blog';
            $file_Path = __DIR__ . '/upload/'. $filename;
            $key = basename($file_Path);
            try {
                $result = $s3Client->putObject([
                    'Bucket' => $bucket,
                    'Key'    => $keyName,
                    'SourceFile' => $_FILES["archivo"]['tmp_name'],
                    'ContentType' => 'portada/png',
                    'ACL'    => 'public-read', // make file 'public'
                ]);
            }
            catch (Aws\S3\Exception\S3Exception $e) {
                echo "There was an error uploading the file.\n";
                echo $e->getMessage();
            }
        }
                if(!file_exists("https://s3.amazonaws.com/rivero-static/blog/".$carpeta)){
                    mkdir("https://s3.amazonaws.com/rivero-static/blog/".$carpeta,true);
                    if(file_exists("https://s3.amazonaws.com/rivero-static/blog/".$carpeta)){
                        if(move_uploaded_file($direccion, "https://s3.amazonaws.com/rivero-static/blog/".$carpeta.$nombre)){
                            alert("SE CREO");
                        }else{
                            alert("FALLO");
                        }
                    }
                }else{alert("NADA");}}}
?>