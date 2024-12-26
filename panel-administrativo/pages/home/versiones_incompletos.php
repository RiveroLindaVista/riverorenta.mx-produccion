<?php  
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$promoAutos = $conne->get_all_promos_autos();
$promoTaller = $conne->get_all_promos_taller();
$promoAccesorios = $conne->get_all_promos_accesorios();

$catalogo_autos = $conne->catalogo_autos_activos();
                // echo json_encode($catalogo_autos);
                // return true;
$arr_versions_null = array();
foreach ($catalogo_autos as $key => $val) {
    // if ($key == 7) {
    //     break;
    // }
    $auto_gral_id = $val['id'];
    $slug = $val['slug'];
    $marca = $val['marca'];
    $modelo = $val['modelo'];
    $ano = $val['ano'];

    $get_versiones = $conne->get_versiones_not_null($marca, $modelo, $ano);
    if (count($get_versiones) == 0) {
        $arr_versions_null[$key]['id'] = $auto_gral_id;
        $arr_versions_null[$key]['slug'] = $slug;
        $arr_versions_null[$key]['marca'] = $marca;
        $arr_versions_null[$key]['modelo'] = $modelo;
        $arr_versions_null[$key]['ano'] = $ano;
        $arr_versions_null[$key]['con_versiones'] = 'NO';
        $arr_versions_null[$key]['con_inventario_versiones'] = 'NO';

    } else {
        $arr_versions_null[$key]['id'] = $auto_gral_id;
        $arr_versions_null[$key]['slug'] = $slug;
        $arr_versions_null[$key]['marca'] = $marca;
        $arr_versions_null[$key]['modelo'] = $modelo;
        $arr_versions_null[$key]['ano'] = $ano;
        $arr_versions_null[$key]['con_versiones'] = 'SI';

        $count_inventario_versiones_sin = 0;
        $arr_versiones_sin_caracteristicas = array();
        foreach ($get_versiones as $key1 => $value1) {
                        
            $version = $value1['version'];
            $marca_v = str_replace(' ', '-', $value1['marca']);
            $modelo_v = str_replace(' ', '-',$value1['modelo']);
            $ano_v = $value1['ano'];
            $slug = strtolower($marca_v.'-'.$modelo_v.'-'.$ano_v);


            // $arr_versions_null[$key]['slug_validacion_JERO'] = $slug;

            $get_inventario_versiones = $conne->get_inventario_versiones($slug, $version);
            if (count($get_inventario_versiones) == 0 ) {
                // $arr_versions_null[$key]['con_inventario_versiones'] = false;
                $con_inventario_versiones = 'NO';
                $count_inventario_versiones_sin++;
                // $arr_versiones_sin_caracteristicas[$key1] = $version;
                array_push($arr_versiones_sin_caracteristicas, $version);
                // echo json_encode($arr_versiones_sin_caracteristicas);
                // return true;
            } else {
                $con_inventario_versiones = 'SI';
                // $arr_versions_null[$key]['con_inventario_versiones'] = true;
            }
            // echo json_encode($get_inventario_versiones);
            // return true;
        }
        // validate if exist color


        if ($count_inventario_versiones_sin > 0) {
            $arr_versions_null[$key]['con_inventario_versiones'] = 'NO';
        } else{
            $arr_versions_null[$key]['con_inventario_versiones'] = 'SI';
        }
        $arr_versions_null[$key]['arr_versiones_sin_caracteristicas'] = $arr_versiones_sin_caracteristicas;

    }
    
    $get_inventario_colores_by_slug = $conne->get_inventario_colores_by_slug($slug);
    $arr_versions_null[$key]['con_colores'] = count($get_inventario_colores_by_slug) > 0  ?'SI' : 'NO';

    // filter from unset from array
    if ($arr_versions_null[$key]['con_versiones'] == 'SI' &&  $arr_versions_null[$key]['con_inventario_versiones'] == 'SI' && $arr_versions_null[$key]['con_colores'] == 'SI') {
        unset($arr_versions_null[$key]);
    }

}
$tr_versiones = '';
$delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg>';
$view_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
</svg>';
foreach ($arr_versions_null as $key => $value) {
    $flag_con_versiones = $value['con_versiones'] == 'NO' ? 'flag-red' : 'flag-green';
    $flag_con_colores = $value['con_colores'] == 'NO' ? 'flag-red' : 'flag-green';
    $tr_versiones .= '<tr class="tr_body_versions">';
    $tr_versiones .= '<td>'.$value['marca'].'</td>';
    $tr_versiones .= '<td>'.$value['modelo'].'</td>';
    $tr_versiones .= '<td>'.$value['slug'].'</td>';
    $tr_versiones .= '<td> <button class="'.$flag_con_versiones.'"></button>'.'' .'</td>';
    $str_versiones_sin_caracteristicas = '';
    if (isset($value['arr_versiones_sin_caracteristicas'])) {
        if ( count($value['arr_versiones_sin_caracteristicas']) > 0) {
            foreach ($value['arr_versiones_sin_caracteristicas'] as $key3 => $val3) {
                $separa = $key3 == 0 ? '' : ', ';
                $str_versiones_sin_caracteristicas .= $separa. $val3;
            }
        } else {
            $str_versiones_sin_caracteristicas = '- - -';
        }
    } else {
        $str_versiones_sin_caracteristicas = '- - -';
    }
    $tr_versiones .= '<td>'.$str_versiones_sin_caracteristicas.'</td>';
    $tr_versiones .= '<td> <button class="'.$flag_con_colores.'"></button></td>';
    $tr_versiones .= '<td> <div><button class="btn btn-success" onclick=go_to_unidades_nuevos('.$value['id'].')>'.$view_icon.'</button> <button  class="btn btn-danger" onclick=disable_from_catalogo(\''.$value["slug"].'\')>'.$delete_icon.'</button></div></td>';
    $tr_versiones .= '</tr>';
}
$arr_response = array(
    'body' => $tr_versiones,
    'cant_total' => count($arr_versions_null)
);

echo json_encode($arr_response);
return true;

?>