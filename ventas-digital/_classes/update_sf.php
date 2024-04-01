<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$tipoSend='Prod';
$urlDest='update-hv';
	
	$param='OpId='.$_SESSION["Id"];
	$param='OpId=0062S00000zHAepQAG';
	$param.='&marca='.$_SESSION["marca"];
	$param.='&modelo='.$_SESSION["modelo"];
	$param.='&ano='.$_SESSION["anio"];
	$param.='&tipo='.$_SESSION["tipo"];
	$param.='&enganche='.$_SESSION["enganche"];
	$param.='&mensualidad='.$_SESSION["mensualidad"];
	$param.='&meses='.$_SESSION["meses"];
	$param.='&porEng='.$_SESSION["porEng"];
	$param.='&salida=salir';
	//$param.='&formapago='.$_SESSION["forma-pago"];
	$param.='&formapago=Crédito';
	$param.='&prueba='.$_SESSION["porEng"];


	$param=str_replace(' ', '%20', $param);
echo $param.'<hr/>';
//print(json_encode($_SESSION));
define("Secret_TOKEN",crearToken($tipoSend)); 
$respuesta=sendSf($tipoSend,$urlDest,$param);



function crearToken($tipo){
	if($tipo=='test'){
		$params =  'username=ecasas@gruporivero.com.uat&'.
         'password=Casas.e.2020!&'.
         'grant_type=password&'.
         'client_id=3MVG9E8TNx7FN9y4YUwX8eaocyrwlAVBNEz_xAGAVDyygbDfHtfuywWttv6ykiGBZ.7hainng_sNOtIg0vdN0&'.
         'client_secret=38E8A4B78B1BF9DFCD3FF2A9010892DF6667AAD0183B57A68F6823107B6B13F1';
         $curl = curl_init('https://test.salesforce.com/services/oauth2/token');
       }else{
		
  		$params ='username=ecasas@gruporivero.com&'.
         'password=Casas.e.2020!&'.
         'grant_type=password&'.
         'client_id=3MVG9E8TNx7FN9y548eR9vUIDzyk.rz3Hdn9.iNN2XxJzW6ouVTKIA6DL5sv1Bh.YePhN8fuxn0pjJ.5AOqVH&'.
         'client_secret=1E3DBF07702779049F72351276687CEF9760D6DBB5FFEB015DE5FF93AC8FA4F3';
         $curl = curl_init('https://login.salesforce.com/services/oauth2/token');
       } 

curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

$json_response = curl_exec($curl);
//var_dump($json_response);
curl_close($curl);

$response = json_decode($json_response, true);

return $response['access_token'];
}

function sendSf($tipo,$destino,$param){
	if($tipo=='test'){
	$curlQuery = curl_init('https://gruporivero--uat.my.salesforce.com/services/apexrest/'.$destino.'/?'.$param);
	}else{
		$curlQuery = curl_init('https://gruporivero.my.salesforce.com/services/apexrest/'.$destino.'/?'.$param);
	}	

	$headers[] = 'Authorization: Bearer '.Secret_TOKEN;
	$headers[] = 'Content-Type: application/json';

    curl_setopt($curlQuery, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlQuery, CURLOPT_HTTPHEADER, $headers);
	 
	$json_response2 = curl_exec($curlQuery);
	curl_close($curlQuery);

    //$pos = strpos($json_response2, 'Id');
	var_dump($json_response2);
    return $json_response2;
	
}

?>
