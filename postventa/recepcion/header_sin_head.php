<?php
	session_start();
	date_default_timezone_set('America/Monterrey');
	$tokenId=$_SESSION["token"];
	if($_SESSION["token"]==null){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://multimarca.gruporivero.com/oauth/token',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('grant_type' => 'password','client_id' => '95d42dee-0c62-4f0e-a116-5540682870bd','client_secret' => 'Tbbs4uff8OW2PodlQLcQlUwboTQcJQ7lcIFdHSob','username' => 'ecasas2@gruporivero.com','password' => 'Rivero2022!'),
		  CURLOPT_HTTPHEADER => array(
		    'Accept: application/json'
		  ),
		));

		$response = json_decode(curl_exec($curl));

		curl_close($curl);
		$_SESSION["token"]=$response->access_token;
		$tokenId=$response->access_token;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Grupo Rivero | Recepción</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"/>
	<link rel="icon" type="image/x-icon" href="../recepcion/images/favicon-32x32.png"/>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">  
      <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

	  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  

</head>
<body >

<div class="bg-dark p-2 position-fixed" style="width: 100%;z-index: 9;">
	<!-- <center>
		<img src="https://www.gruporivero.com/images/header-logo.png" alt="icon Rivero" width="100%" style="max-width: 250px;" />
	</center> -->
</div>
<div style="padding-top:40px; background-color: black; height:100%; min-height:100dvh;">
