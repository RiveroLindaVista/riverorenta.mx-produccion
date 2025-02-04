<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$catalogo_autos_incompletos = $conne->catalogo_autos_incompletos();

// echo json_encode($catalogo_autos_incompletos);
// return true;
$arr_catalogo = array();
foreach ($catalogo_autos_incompletos as $key => $val) {

    $model_year = $val['modelo'] . '-' . $val['ano'];
    $model_year = str_replace(' ', '-', $model_year);
    $slug = strtolower($val['marca'] . '-' . str_replace(' ', '-', $val['modelo']) . '-' . $val['ano']);


    $url = strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/ficha-tecnica.pdf');
    $url_catalogo = strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/catalogo.pdf');
    $url_manual = strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/manual.pdf');
    $url_video = strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/videos/video_modelo.mp4');


    $val['has_gallery'] = empty(check_galery($slug)['data']['gallery']) ? false : true;
    $val['has_video'] = check_url_exists($url_video);
    $val['has_ficha_tecnica'] = check_url_exists($url);
    $val['has_catalogo'] = check_url_exists($url_catalogo);
    $val['has_manual'] = check_url_exists($url_manual);

    if ($val['has_versions'] == false  ||  $val['has_versions_without_characteristics'] != '' || $val['has_colors'] == false || $val['has_gallery'] == false || $val['has_video'] == false || $val['has_ficha_tecnica'] == false || $val['has_catalogo'] == false || $val['has_manual'] == false) {
        array_push($arr_catalogo, $val);
    }
}

function check_url_exists($url)
{
    $headers = @get_headers($url);
    if (!$headers) {
        return false;
    }
    if (strpos($headers[0], '200') !== false) {
        return true;
    }
    return false;
}
function check_galery($slug)
{
    try {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.gruporivero.com/v1/cars/' . $slug . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        $ret = json_decode($response, true);
        return $ret;
    } catch (\Throwable $th) {
        false;
    }
}
echo json_encode($arr_catalogo);
return true;
