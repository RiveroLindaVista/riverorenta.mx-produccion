<?php
require_once("_config.php");
mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
mysql_select_db(DB_DB);


$uploaddir = 'documentos/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);

$urlImagen='https://riverorenta.mx/mejora-continua/documentos/'.$_FILES['file']['name'];
$tipo_archivo = $_FILES['file']['type'];


/*$to='ecasas@gruporivero.com,jrivero@gruporivero.com,lcampos@gruporivero.com,scastillo@gruporivero.com,luisacosta@gruporivero.com,egber@gruporivero.com';*/
$to='ecasas@gruporivero.com';

//$to='ecasas@gruporivero.com,lcampos@gruporivero.com';
$subject="Mejora Continua";

$header = "From: noreply@gruporivero.com\r\n"; 
$header.= "MIME-Version: 1.0\r\n"; 
$header.= "Content-Type: text/html; charset=UTF-8\r\n"; 
$header.= "X-Priority: 1\r\n"; 

$mensaje='<h1>Nueva sugerencia de mejora continua</h1>
	#Nomina: <strong>'.$_POST["nomina"].'</strong><br>
	Situación: <strong>'.$_POST["situacion"].'</strong><br>
	Objetivo: <strong>'.$_POST["objetivo"].'</strong><br>
	Propuesta: <strong>'.$_POST["propuesta"].'</strong><br>
	<hr>
	Documento Adjunto: <strong><a href="'.$urlImagen.'">Abrir Documento aqui</a></strong><br><br>';
	if(mail($to,$subject,$mensaje,$header)){
		mysql_query('INSERT INTO mejora_continua_form (nomina,situacion,objetivo,propuesta,documentos) VALUES(
			"'.$_POST["nomina"].'",
			"'.$_POST["situacion"].'",
			"'.$_POST["objetivo"].'",
			"'.$_POST["propuesta"].'",
			"'.$urlImagen.'")');
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

		    echo "File is valid, and was successfully uploaded.\n";
		} else {
		    echo "Possible file upload attack!\n";
		}

		?>
			<script>window.location.href="gracias";</script>
		<?php
	}else{
		?>
			<script>window.location.href="error";</script>
		<?php
	};

?>