<?php
session_start();
include("../_config.php");
include("_conexion.php");
include("classes.php");

$conn=new Conexion();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$tipoSend='Prod';
$urlDest='get-OportunityById';
	
$param='OpId='.$_POST["id"];
//$param='OpId=0062S00000zGz5NQAS';

	//$param=str_replace('@', '%40', $param);

define("Secret_TOKEN",crearToken($tipoSend));
$respuesta=sendSf($tipoSend,$urlDest,$param);
$resp=json_decode($respuesta);
//var_dump($resp);
for($i=0;$i<count($resp);$i++){
	//oportunidad
		$_SESSION["Id"]=$resp[$i]->Id;
		$_SESSION["fecha"]=$resp[$i]->CreatedDate;
		$_SESSION["para-quien-es"]=$resp[$i]->Para_quien_es__c;
		$_SESSION["uso"]=$resp[$i]->Para_qu_va_a_utilizar_el_veh_culo__c;
		$_SESSION["que-valoras"]=$resp[$i]->Qu_valora_en_un_veh_culo__c;

	//Carro
		$_SESSION["marca"]=$resp[$i]->Auto_de_Interes__r->Label_Marca__c;
		$_SESSION["modelo"]=$resp[$i]->Auto_de_Interes__r->Label_Modelo__c;
		$_SESSION["anio"]=$resp[$i]->Auto_de_Interes__r->A_o__c;
		$tipo=explode(' ',$resp[$i]->Auto_de_Interes__r->Tipo__c);
		$_SESSION["tipo"]=$tipo[1];
		$_SESSION["precio"]=$resp[$i]->Auto_de_Interes__r->Precio__c;
		$_SESSION["carId"]=0;
		$slug=strtolower($resp[$i]->Auto_de_Interes__r->Label_Marca__c.'-'.str_replace(' ','-',$resp[$i]->Auto_de_Interes__r->Label_Modelo__c).'-'.$resp[$i]->Auto_de_Interes__r->A_o__c);
		$_SESSION["slug"]=$slug;

	//Owner
		$_SESSION["vendedor"]=utf8_encode($resp[$i]->Owner->Name);
		$_SESSION["OwnerId"]=$resp[$i]->Owner->Id;

	//cuenta
		$_SESSION["cuenta"]=$resp[$i]->Account->Id;
		$NombreCompleto=utf8_encode($resp[$i]->Account->FirstName.' '.$resp[$i]->Account->LastName);
		$_SESSION["NombreCompleto"]=$NombreCompleto;
		
		$nombre=explode(' ', $NombreCompleto);
		$_SESSION["Nombre"]=$nombre[0];
		$_SESSION["correo"]=$resp[$i]->Account->PersonEmail;
		$_SESSION["whatsapp"]=$resp[$i]->Account->WhatsApp__c;

		$_SESSION["idMM"]=$resp[$i]->Account->idClienteMM__c;

		$_SESSION["cp"]=$resp[$i]->Account->BillingPostalCode;
		$_SESSION["ciudad"]=$resp[$i]->Account->BillingCity;
		$_SESSION["estado"]=$resp[$i]->Account->BillingState;
		$_SESSION["calleynum"]=$resp[$i]->Account->BillingStreet;
		$_SESSION["colonia"]=$resp[$i]->Account->Colonia__c;
$carid="";


	
	
	
	$id=$resp[$i]->Id;
	$conn->insert_etapa($id, "Id", utf8_encode($resp[$i]->Id));
	$conn->insert_etapa($id, "fecha", utf8_encode($resp[$i]->CreatedDate));
	$conn->insert_etapa($id, "para-quien-es", utf8_encode($resp[$i]->Para_quien_es__c));
	$conn->insert_etapa($id, "uso", utf8_encode($resp[$i]->Para_qu_va_a_utilizar_el_veh_culo__c));
	$conn->insert_etapa($id, "que-valoras", utf8_encode($resp[$i]->Qu_valora_en_un_veh_culo__c));

$conn->insert_etapa($id, "marca",$resp[$i]->Auto_de_Interes__r->Label_Marca__c);
$conn->insert_etapa($id, "modelo",$resp[$i]->Auto_de_Interes__r->Label_Modelo__c);
$conn->insert_etapa($id, "anio",$resp[$i]->Auto_de_Interes__r->A_o__c);
$conn->insert_etapa($id, "tipo",$tipo[1]);
$conn->insert_etapa($id, "precio",$resp[$i]->Auto_de_Interes__r->Precio__c);
$conn->insert_etapa($id, "slug",$slug);

$conn->insert_etapa($id, "vendedor",utf8_encode($resp[$i]->Owner->Name));
$conn->insert_etapa($id, "OwnerId",$resp[$i]->Owner->Id);

	$conn->insert_etapa($id, "NombreCompleto", $NombreCompleto);
	$conn->insert_etapa($id, "cuenta", $resp[$i]->Account->Id);
	$conn->insert_etapa($id, "idMM", $resp[$i]->Account->idClienteMM__c);
	$conn->insert_etapa($id, "Nombre", $nombre[0]);
	$conn->insert_etapa($id, "correo", $resp[$i]->Account->PersonEmail);
	$conn->insert_etapa($id, "whatsapp", $resp[$i]->Account->WhatsApp__c);
	$conn->insert_etapa($id, "cp", $resp[$i]->Account->BillingPostalCode);
	$conn->insert_etapa($id, "ciudad", $resp[$i]->Account->BillingCity);
	$conn->insert_etapa($id, "estado", $resp[$i]->Account->BillingState);
	$conn->insert_etapa($id, "calleynum", $resp[$i]->Account->BillingStreet);
	$conn->insert_etapa($id, "colonia", $resp[$i]->Account->Colonia__c);
	
	if($resp[$i]->Auto_de_Interes__r->Label_Modelo__c!=""&&$resp[$i]->Auto_de_Interes__r->A_o__c!=""&&$tipo[1]!=""){
		
		$carId=$conn->get_carid($resp[$i]->Auto_de_Interes__r->Label_Modelo__c,$resp[$i]->Auto_de_Interes__r->A_o__c,$tipo[1]);
		$_SESSION["carId"]=$carId;
		$conn->insert_etapa($id, "carId", $carId);
	}	
	
}

print($resp);


function crearToken($tipo){
	if($tipo=='test'){
		$params =  'username=ecasas@gruporivero.com.uat&'.
         'password=casas.e.2019&'.
         'grant_type=password&'.
         'client_id=3MVG9jBOyAOWY5bW2ldeqQWvO4BWpbn6cIPzPvnOIdSVLgyTb0tbe9m43Gm9Ko1gUBmiYposRP6FKHTpLZFL3&'.
         'client_secret=70DE8500D981E223A2251B046342DF229CFDEA06268B3CCE1F5480F6B306808D';
         $curl = curl_init('https://test.salesforce.com/services/oauth2/token');
       }else{
		
  		$params ='username=ecasas@gruporivero.com&'.
         'password=casas.e.2019&'.
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
