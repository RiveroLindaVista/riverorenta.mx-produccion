<?php 
include("../../_inc/conexion.php");
include("../../_inc/consultas.php"); 
include("../../_inc/constructor.php");

$conne = new Conexion(); 


date_default_timezone_set("America/Monterrey");
$start_date = date('d-m-Y');
$unixDate = strtotime($start_date. "-1 days");

$messages = get_messages($start_date);
$clients = get_client_info($unix_date);
//$tags = get_tags();

foreach ($messages->data as $message) {
	foreach ($clients->data as $client) {
		if ($message->client_id == $client->id) {
			$request_chat = $conne->query_request_chat(fecha_local($message->created), $message->id);	
			if($request_chat == 0 || $request_chat == NULL){
				$param["id_mensaje"] = $message->id;
				$param["id_cliente"] = $client->id;
				$param["nombre"] = $client->name;
				$param["correo"] = '';
				$param["telefono"] = $client->phone;
				$param["mensaje"] = utf8_decode($message->text);
				$param["mensaje_create"] = fecha_local($message->created);
				$insert_chat = $conne->query_insertar_request_chat($param);
				$cadena.= '<tr>
				<td>'.$message->id.'</td>
				<td>'.$client->id.'</td>
				<td>'.$client->name.'</td>			
				<td>'.$client->phone.'</td>
				<td>'.utf8_decode($message->text).'</td>
				<td>'.fecha_local($message->created).'</td>
				</tr>';	
			}		
		}
	}
}

/*foreach ($messages->data as $message) {
	foreach ($clients->data as $client) {
		$request_chat = $conne->query_request_chat(fecha_local($message->created), $message->id);

		if ($request_chat != null || $request_chat != "") {
			$param["id_mensaje"] = $message->id;
			$param["id_cliente"] = $client->id;
			$param["nombre"] = $client->name;
			$param["correo"] = '';
			$param["telefono"] = $client->phone;
			$param["mensaje"] = utf8_decode($message->text);
			$param["mensaje_create"] = fecha_local($message->created);
			$insert_chat = $conne->query_insertar_request_chat($param);
			$cadena.= '<tr>
			<td>'.$message->id.'</td>
			<td>'.$client->id.'</td>
			<td>'.$client->name.'</td>			
			<td>'.$client->phone.'</td>
			<td>'.utf8_decode($message->text).'</td>
			<td>'.fecha_local($message->created).'</td>
			</tr>';	
		} 
	}
}*/

function get_messages($start_date){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.emg-social.com/v1/messages",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_POSTFIELDS => "order=desc&type=from_client&read=false&limit=200&start_date=".$start_date,
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/x-www-form-urlencoded",
	    "Accept: application/json",
	    "Authorization: b63add66b0bd6eadacc855926273c1"
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return json_decode($response);
}

function get_client_info($unixDate){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.emg-social.com/v1/clients",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_POSTFIELDS => "limit=200&order=desc&created_after=1583625600",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/x-www-form-urlencoded",
	    "Accept: application/json",
	    "Authorization: b63add66b0bd6eadacc855926273c1"
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return json_decode($response);
}

function get_tags(){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.emg-social.com/v1/tags",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_POSTFIELDS => "limit=100",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/x-www-form-urlencoded",
	    "Accept: application/json",
	    "Authorization: b63add66b0bd6eadacc855926273c1"
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;
}


function fecha_local( $string, $format = 'Y-m-d H:i:s' ) {
$tz = 'UTC';
$datetime = date_create( $string, new DateTimeZone( $tz ) );
if ( ! $datetime ) {
return gmdate( $format, 0 );
}
//Cambiar America/Mexico_City por la zona horaria (local)
$datetime->setTimezone( new DateTimeZone( 'America/Monterrey' ) );
$string_gmt = $datetime->format( $format );

return $string_gmt;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr> 
                <th>#</th>
                <th>ID CLIENTE</th>
                <th>NOMBRE CLIENTE</th>
                <th>TELEFONO</th>
                <th>MENSAJE</th>
                <th>FECHA</th>
            </tr>
        </thead>
        <tbody>
            <?= $cadena?>
        </tbody>
    </table>
</body>
</html>
