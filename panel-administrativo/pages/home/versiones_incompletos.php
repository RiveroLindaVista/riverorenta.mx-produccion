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
    if ($key == 7) {
        break;
    }
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
foreach ($arr_versions_null as $key => $value) {
    $flag_con_versiones = $value['con_versiones'] == 'SI' ? 'flag-red' : 'flag-green';
    $flag_con_colores = $value['con_colores'] == 'SI' ? 'flag-red' : 'flag-green';
    $tr_versiones .= '<tr class="tr_body_versions" onclick=go_to_unidades_nuevos('.$value['id'].')>';
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
    $tr_versiones .= '</tr>';
}
$arr_response = array(
    'body' => $tr_versiones,
    'cant_total' => count($arr_versions_null)
);

echo json_encode($arr_response);
return true;

?>