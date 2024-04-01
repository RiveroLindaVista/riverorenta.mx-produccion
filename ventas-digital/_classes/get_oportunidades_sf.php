<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$tipoSend='Prod';
$urlDest='get-my-opportunities';
	
	$param='correo='.strtolower($_POST["correo"]);
	$param=str_replace('@', '%40', $param);

define("Secret_TOKEN",crearToken($tipoSend));
$respuesta=sendSf($tipoSend,$urlDest,$param);
print($respuesta);


function crearToken($tipo){
	if($tipo=='test'){
		$params =  'username=ecasas@gruporivero.com.uat&'.
         'password=Casas.e.2020!&'.
         'grant_type=password&'.
         'client_id=3MVG9jBOyAOWY5bW2ldeqQWvO4BWpbn6cIPzPvnOIdSVLgyTb0tbe9m43Gm9Ko1gUBmiYposRP6FKHTpLZFL3&'.
         'client_secret=70DE8500D981E223A2251B046342DF229CFDEA06268B3CCE1F5480F6B306808D';
         $curl = curl_init('https://test.salesforce.com/services/oauth2/token');
       }else{
		
  		$params ='username=ecasas@gruporivero.com&'.
         'password=Casas.e.2020!&'.
         'grant_type=password&'.
         'client_id=3MVG9zlTNB8o8BA2FTMyYO3gqhInuVsOL7nMTNEjXrnJP9jvHXKaH2150_lrhJj3LDaimtubkjgOZ7rjkN0m9&'.
         'client_secret=59982E7F5E799C2DE795AF44C6CAA2A151ACC8D41595C2C5A389426E17EFA50E';
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
	//var_dump($json_response2);
    return $json_response2;
	
}

?>
