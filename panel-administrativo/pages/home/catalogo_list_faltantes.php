<?php  
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$catalogo_autos_incompletos = $conne->catalogo_autos_incompletos();

// echo json_encode($catalogo_autos_incompletos);
// return true;
$arr_catalogo = array();
foreach ($catalogo_autos_incompletos as $key => $val) {
    if ($val['has_versions'] == false  ||  $val['has_versions_without_characteristics'] != '' || $val['has_colors'] == false) {
        array_push($arr_catalogo, $val);
    }
}



echo json_encode($arr_catalogo);
return true;


?>