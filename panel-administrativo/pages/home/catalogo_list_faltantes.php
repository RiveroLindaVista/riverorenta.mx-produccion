<?php  
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$catalogo_autos_incompletos = $conne->catalogo_autos_incompletos();

// echo json_encode($catalogo_autos_incompletos);
// return true;
$arr_catalogo = array();
foreach ($catalogo_autos_incompletos as $key => $val) {
    // if ($val['has_versions'] == false  ||  $val['has_versions_without_characteristics'] != '' || $val['has_colors'] == false) {
        
        $model_year = $val['modelo'].'-'.$val['ano'];
        $model_year = str_replace(' ', '-', $model_year);

        $url = strtolower('https://d3s2hob8w3xwk8.cloudfront.net/autos-landing/'.$val['marca'].'/'.$model_year.'/pdf/ficha-tecnica.pdf');
        
        if (check_url_exists($url)) {
            $val['has_ficha_tecnica'] = true;
        } else {
            $val['has_ficha_tecnica'] = false;
        }
        
        array_push($arr_catalogo, $val);
    // }
}

function check_url_exists($url) {
    $headers = @get_headers($url);
    if(!$headers) {
        return false;
    }
    if(strpos($headers[0], '200') !== false) {
        return true;
    }
    return false;
}

echo json_encode($arr_catalogo);
return true;


?>