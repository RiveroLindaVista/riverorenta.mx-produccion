<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

require '../../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$conne = new Construir();
$catalogo_autos_incompletos = $conne->catalogo_autos_incompletos();

// echo json_encode($catalogo_autos_incompletos);
// return true;
$arr_catalogo = array();
foreach ($catalogo_autos_incompletos as $key => $val) {

    $model_year = $val['modelo'] . '-' . $val['ano'];
    $model_year = str_replace(' ', '-', $model_year);
    $slug = strtolower($val['marca'] . '-' . str_replace(' ', '-', $val['modelo']) . '-' . $val['ano']);

    if ($val['marca'] == 'NISSAN') {
        $urls = [
            'url_video' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/videos/video_modelo.mp4'),
            // 'url_ficha' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/ficha-tecnica.pdf'),
            'url_catalogo' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/catalogo.pdf'),
            // 'url_manual' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/manual.pdf'),
        ];
    } else {
        $urls = [
            'url_video' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/videos/video_modelo.mp4'),
            'url_ficha' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/ficha-tecnica.pdf'),
            'url_catalogo' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/catalogo.pdf'),
            'url_manual' => strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/' . $val['marca'] . '/' . $model_year . '/pdf/manual.pdf'),
        ];
    }
    

    $arr_checkurl = check_urls_parallel($urls);
    
    $folderPath = strtolower('autos-landing/'.$val['marca'].'/'.str_replace(' ', '-', ($val['modelo'].'-'.$val['ano'] )).'/galeria/');
    $val['has_gallery'] = check_galery_s3($folderPath);
    
    $val['has_video'] = $arr_checkurl['url_video'];
    $val['has_ficha_tecnica'] = ($val['marca'] == 'NISSAN' ? 'N/A' : $arr_checkurl['url_ficha']);
    $val['has_catalogo'] = $arr_checkurl['url_catalogo'];
    $val['has_manual'] = ($val['marca'] == 'NISSAN' ? 'N/A' : $arr_checkurl['url_manual']);


    if ($val['has_versions'] == false  ||  $val['has_versions_without_characteristics'] != '' || $val['has_colors'] == false || $val['has_gallery'] == false || $val['has_video'] == false || $val['has_ficha_tecnica'] == false || $val['has_catalogo'] == false || $val['has_manual'] == false) {
        array_push($arr_catalogo, $val);
    }
}

function check_urls_parallel($urls)
{
    $multiHandle = curl_multi_init();
    $curlHandles = [];
    $results = [];

    // Iniciar las solicitudes
    foreach ($urls as $key => $url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_multi_add_handle($multiHandle, $ch);
        $curlHandles[$key] = $ch;
    }

    // Ejecutar las solicitudes en paralelo
    $running = null;
    do {
        curl_multi_exec($multiHandle, $running);
        curl_multi_select($multiHandle);
    } while ($running > 0);

    // Procesar los resultados
    foreach ($curlHandles as $name_url => $ch) {
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $results[$name_url] = ($statusCode == 200);
        curl_multi_remove_handle($multiHandle, $ch);
    }

    curl_multi_close($multiHandle);
    return $results;
}



function check_galery_s3($folderPath) {

    // require_once("../../_inc/config.php");
    
    //Create a S3Client
    $s3 = new S3Client([
        'version' => 'latest',
        'region' => 'us-east-2',
        'credentials' => [
            'key' => S3_KEY,
            'secret' => S3_SECRET
        ]
    ]);
    
    try {
        // Verificar si el archivo existe en el bucket
        $result = $s3->listObjectsV2([
            'Bucket' => 'rivero-static',
            'Prefix'    => $folderPath,
            'MaxKeys' => 1
        ]);
        if (isset($result['Contents']) && count($result['Contents']) > 0) {
            return true;
        } else {
            return false;
        }
    
    
    } catch (AwsException $e) {
        return false;
    }
}

echo json_encode($arr_catalogo);
return true;
