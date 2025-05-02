<?php
// https://localhost/produccion/panel-administrativo/api/report_missing_mkt.php
// DESCRIPTION: 'Reporta por correo las unidades que no tienen material para su publicacion en la pagina web.',
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://www.riverorenta.mx/produccion/panel-administrativo/pages/home/catalogo_list_faltantes.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=t723c365ic0n1n27r8f6s7odgs'
    ),
));

$response = curl_exec($curl);

curl_close($curl);


// Decodificar el JSON como un array asociativo
$data = json_decode($response, true);
$resp = '<h3 style=\'margin: 0px; color: white\'>Se encontratron unidades con material pendiente</h3>';
$resp .= '<h4 style=\'margin: 0px; color: white\'>Completar el material lo mas pronto para su publicacion y notificar al equipo de desarrollo</h4>';


$resp .= constructByAgency($data, 'CHEVROLET', 'https://chevroletrivero.com/');
$resp .= constructByAgency($data, 'NISSAN', 'https://nissanrivero.com/');
$resp .= constructByAgency($data, 'BUICK', 'https://chevroletrivero.com/buick/catalogo/nuevos/');
$resp .= constructByAgency($data, 'CADILLAC', 'https://chevroletrivero.com/cadillac/catalogo/nuevos/');
$resp .= constructByAgency($data, 'GMC', 'https://chevroletrivero.com/gmc/catalogo/nuevos/');



function constructByAgency($data, $agency, $link)
{
    $tx_without_colors = '';
    $tx_without_gallery = '';
    $tx_without_video = '';
    $tx_without_ficha_tecnica = '';
    $tx_without_catalogo = '';
    $tx_without_manual = '';
    foreach ($data as $key => $value) {
        // $tx = 'Unidades sin mockups';
        if ($value['marca'] == $agency) {

            if ($value['has_colors'] == false) {
                $tx_without_colors .= '<li style=\'color: white;\'>' . $value['marca'] . ' ' . $value['modelo'] .' '. $value['ano'] . '</li>';
            }
            if ($value['has_gallery'] == false) {
                $tx_without_gallery .= '<li style=\'color: white;\'>' . $value['marca'] . ' ' . $value['modelo'] .' '. $value['ano'] . '</li>';
            }
            if ($value['has_video'] == false) {
                $tx_without_video .= '<li style=\'color: white;\'>' . $value['marca'] . ' ' . $value['modelo'] .' '. $value['ano'] . '</li>';
            }
            if ($agency != 'NISSAN') {
                if ($value['has_ficha_tecnica'] == false) {
                    $tx_without_ficha_tecnica .= '<li style=\'color: white;\'>' . $value['marca'] . ' ' . $value['modelo'] .' '. $value['ano'] . '</li>';
                }
                if ($value['has_manual'] == false) {
                    $tx_without_manual .= '<li style=\'color: white;\'>' . $value['marca'] . ' ' . $value['modelo'] .' '. $value['ano'] . '</li>';
                }
            }
            if ($value['has_catalogo'] == false) {
                $tx_without_catalogo .= '<li style=\'color: white;\'>' . $value['marca'] . ' ' . $value['modelo'] .' '. $value['ano'] . '</li>';
            }
        }
    }
    $tx = '<h2 style=\'color: white\'>' . $agency . ' ('.$link.')</h2>';
    $tx .= '<h5  style=\'margin: 0px; color: white;\'>UNIDADES FALTANTES DE MOCKUPS</h5> <ul style=\'margin: 0px; color: white;\'>' . ($tx_without_colors == '' ? '---': $tx_without_colors) . '</ul>';
    $tx .= '<h5  style=\'margin: 0px; color: white;\'>UNIDADES SIN GALERIA</h5> <ul style=\'margin: 0px; color: white;\'>' . ($tx_without_gallery == '' ? '---': $tx_without_gallery) . '</ul>';
    $tx .= '<h5  style=\'margin: 0px; color: white;\'>UNIDADES SIN VIDEO</h5> <ul style=\'margin: 0px; color: white;\'>' . ($tx_without_video == '' ? '---': $tx_without_video) . '</ul>';
    $tx .= '<h5  style=\'margin: 0px; color: white;\'>UNIDADES SIN CATALOGO</h5> <ul style=\'margin: 0px; color: white;\'>' . ($tx_without_catalogo == '' ? '---': $tx_without_catalogo) . '</ul>';
    if ($agency != 'NISSAN') {
        $tx .= '<h5 style=\'margin: 0px; color: white;\'>UNIDADES SIN FICHA TECNICA</h5> <ul style=\'margin: 0px; color: white;\'>' . ($tx_without_ficha_tecnica == '' ? '---': $tx_without_ficha_tecnica) . '</ul>';
        $tx .= '<h5 style=\'margin: 0px; color: white;\'>UNIDADES SIN MANUAL</h5> <ul style=\'margin: 0px; color: white;\'>' . ($tx_without_manual == '' ? '---': $tx_without_manual) . '</ul>';

    }
    return $tx;

}
//Login for get token api


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

$response = curl_exec($curl);

curl_close($curl);
$response_decoded_token = json_decode($response, true);

// Call api to send email


$resp = mb_convert_encoding($resp, 'ISO-8859-1', 'UTF-8');

$curl = curl_init();
// marketing@gruporivero.com, mkt@gruporivero.com
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/send/email',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "to":"jcruz@gruporivero.com,jvalles@gruporivero.com,marketing@gruporivero.com,mkt@gruporivero.com",
    "clientName":"Equipo de Marketing",
    "subject":"Falta de material para paginas web",
    "body":"'.$resp.'",
    "footer":"<h4>Saludos</h4>",
    "bcc":"jcruz@gruporivero.com"
}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/javascript',
    'Authorization: Bearer '.$response_decoded_token['access_token'],
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;







// echo $resp;
return true;
