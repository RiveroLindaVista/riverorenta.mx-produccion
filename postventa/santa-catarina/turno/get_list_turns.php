<?php
$sucursalId = $_POST['sucursalId'];
$tokenId = $_POST['tokenId'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/servicio/orders/espera/'.$sucursalId,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer '.$tokenId
  ),
));

$response = curl_exec($curl);

// echo $response;

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/servicio/planning/turnos/'.$sucursalId,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/javascript'
  ),
));

$response = json_decode(curl_exec($curl));

curl_close($curl);
$asesores=[];
$asesoresX=[];
//var_dump($response->data);
foreach ($response->data as $key => $value) {
  $out[$value->turno_tipo][]=$value->turno;
  $out[$value->turno]=$value;
  if($value->turno_tipo=='A'){
    if(!in_array($value->asesor, $asesores)){
     $asesores[]=$value->asesor;
    }
    $asesor[$value->asesor][]=$value;
  }

  if($value->turno_tipo=='X'){
    if(!in_array($value->asesor, $asesoresX)){
     $asesoresX[]=$value->asesor;
    }
    $asesorX[$value->asesor][]=$value;
  }

}

echo json_encode($response);
return true;

?>