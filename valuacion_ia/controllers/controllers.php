<?php

$curl = curl_init();
$data = $_POST;
// echo "'".json_encode($data)."'" ;
// return true;
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.intelimotor.com/api/valuations?apiKey=58ddf99f8dc571619bcb9603b8eaa7467c2f0db3e78769c63dbc568d4f35507e&apiSecret=af004273051c09189c70be7a50768d85d6574b570cc999fe0577a9f9e6173551',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);


// $jsonResultado = convertirStringAJSON($response);
$decoded = json_decode($response);
echo json_encode($decoded);


// if ($jsonResultado !== null) {
//     echo $jsonResultado;
    
// } else {
//     echo "Hubo un error en la conversión.";
// }







function convertirStringAJSON($cadena) {

    $cadena = stripslashes($cadena);    
    $datos = json_decode($cadena, true);

    if ($datos === null && json_last_error() !== JSON_ERROR_NONE) {
        
        echo "Error al decodificar el JSON: " . json_last_error_msg();
        return null;
    }
    $jsonFormateado = json_encode($datos, JSON_PRETTY_PRINT);

    return $jsonFormateado;
}






