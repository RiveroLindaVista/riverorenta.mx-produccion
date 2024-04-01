<?php
require_once("../_config.php");
session_start();
$sessionId="";
if(!isset($_SESSION["token"])){

    $urlQuery=APIURL.'oauth/token';
    $licencing=[
        "grant_type"=>"password",
        "client_id"=>APICLIENTID,
        "client_secret"=>APICLIENTSECRET,
        "username"=>APIUSER,
        "password"=>APIPASS
    ];
        $ch = curl_init();
        $http_header = ['Content-Type' => 'application/json'];
        //dd($licencing);
        curl_setopt($ch, CURLOPT_URL, $urlQuery);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, strlen($licencing));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $licencing); 
       
        $result = curl_exec($ch);
        $respuesta=json_decode($result);
        $_SESSION["token"]=$respuesta->access_token;
        $sessionId=$respuesta->access_token;
        curl_close($ch);
        
}else{
	 $sessionId=$_SESSION["token"];
}

 $headers=[
        'Accept: application/json',
    	'Authorization: Bearer '.$sessionId,
    	'Content-Type: application/json'
    ];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/dh',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS =>'{
    "id":'.$_GET["id"].'
}',
  CURLOPT_HTTPHEADER => $headers,
));

$response = json_decode(curl_exec($curl));
 $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
if($code==200&&$response->data[0]!=null){
	print(json_encode([codigo=>200,respuesta=>$response->data[0]]));
}else{
	print(json_encode([codigo=>400 ]));
}
?>



