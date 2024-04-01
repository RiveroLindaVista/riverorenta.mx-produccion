<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once("../_config.php");
include("_conexion.php");
include("classes.php");
include('phpmailer/PHPMailerAutoload.php');
$cone=new Conexion();
$randomCode=randomNumber(4); 

$cone->insert_codigo_validacion($randomCode,$_POST["correo"]);
$correo=$_POST["correo"]."@gruporivero.com";
//$correo="ecasas@gruporivero.com";
$CadenaCorreo="
            <h1>Código de Acceso</h1>
            <p>".$randomCode."</p>
           ";

$message=utf8_decode($CadenaCorreo);


$mail = new PHPMailer();
try {
    $mail->isSMTP();
    $mail->Host = HOST;
    $mail->SMTPDebug = 2;
    $mail->Port = PORT;
        $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
        $mail->Username = USERNAME;
        $mail->Password = PASSWORD;
    $mail->setFrom('correo@gruporivero.com', 'Grupo Rivero');
    $mail->From = ("correo@gruporivero.com");
    $mail->addAddress($correo);
    $mail->Subject = $subject;
    $mail->msgHTML($message);
    $mail->AltBody = 'Para ver este Mensaje, porfavor utiliza un visualizador de correo HTML compatible!';
    $mail->send();
    echo "Mensaje Enviado";
} catch (phpmailerException $e) {
    echo $e->errorMessage(); 
} catch (Exception $e) {
    echo $e->getMessage(); 
}

function randomNumber($length) {
        $min = str_repeat(1, $length-1) . 1;
        $max = str_repeat(9, $length);
        return mt_rand($min,  $max);   
    }
?>