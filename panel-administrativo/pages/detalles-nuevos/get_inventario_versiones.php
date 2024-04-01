<?php
include ("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);


if (count($_POST)) {
    $function = $_POST['func'];
    if($function == 'get_inventario_versiones'){
        get_inventario_versiones($conn);
    } elseif ($function == 'save_inv_versions'){
        save_inv_versions($conn);
    } elseif($function == 'delete_inv_versions') {
        delete_inv_versions($conn);
    } elseif($function == 'change_select_icons'){
        change_select_icons($conn);
    } elseif($function == 'update_invver') {
        update_invver($conn);
    } elseif($function == 'get_colores_asignados') {
        get_colores_asignados($conn);
    }
    
}

function get_inventario_versiones($conn) {
    $utf8 = $conn->set_charset("utf8");
    $sql = "SELECT * FROM inventario_versiones where slug='".$_POST['slug']."' ORDER BY id desc";
    $result=$conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $out[]=$row;
        }
        echo json_encode($out);
    }
}

function save_inv_versions($conn) {
    try {

        $slug = $_POST['slug'];
        $version = $_POST['version'];
        $metakey = 'destacado';
        $metavalue = $_POST['metavalue'];
        $icono = $_POST['icono'];
        $url = 'https://d3s2hob8w3xwk8.cloudfront.net/features/det-'.$icono.'.svg';
        $fecha = date('Y-m-d h:i:s');
        
        $last_val = return_last_value($conn);
        if ($last_val == null) {
            $orden = 1;
        } else {
            $orden = $last_val + 1;
        }

        
        $sql = "INSERT INTO inventario_versiones(slug, version, metakey, metavalue, icono, orden, url, fecha) VALUES ('".$slug."', '".$version."', '".$metakey."', '".$metavalue."', '".$icono."', ".$orden.", '".$url."', '".$fecha."')";
        
        $res = $conn->query($sql);
        if ($res) {
            $resp['slug'] = $slug;
            $resp['version'] = $version;
            $resp['metakey'] = $metakey;
            $resp['metavalue'] = $metavalue;
            $resp['icono'] = $icono;
            $resp['url'] = $url;
            $resp['fecha'] = $fecha;
        } else {
            $resp['error'] = $res;
        }
        echo json_encode($resp);

    }catch(\Throwable $th) {
        echo json_encode('error'. $th);
    }
}

function return_last_value($conn) {
    $utf8 = $conn->set_charset("utf8");
    $sql = "SELECT * FROM inventario_versiones where slug='".$_POST['slug']."' and version='".$_POST['version']."' ORDER BY orden desc";
    $result=$conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $out[]=$row;
        }
        // echo json_encode($out);
        return $out[0]['orden'];
    }
}


function delete_inv_versions($conn){
    $id = $_POST['id'];
    $response = '';
    if ($id != null) {
        $sql = "DELETE FROM inventario_versiones WHERE id = ".$id;
        $res = $conn->query($sql);
        if ($res) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    
}

function change_select_icons($conn){
    $utf8 = $conn->set_charset("utf8");
    $sql = "SELECT icono FROM inventario_versiones WHERE icono IS NOT NULL GROUP BY icono ORDER BY icono asc";
    $result=$conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $out[]=$row;
        }
        echo json_encode($out);
    }
}
function update_invver($conn) {
    try {

        $id = $_POST["id"];
        $metavalue = $_POST["metavalue"];
        $icono = $_POST["icono"];
        $orden = $_POST["orden"];
        
        
        $sql = "UPDATE inventario_versiones SET metavalue='".$metavalue."', icono='".$icono."', orden=".$orden." WHERE id=".$id;
        
        $res = $conn->query($sql);
        if ($res) {
            $resp['id'] = $id;
            $resp['metavalue'] = $metavalue;
            $resp['icono'] = $icono;
            $resp['orden'] = $orden;
            
        } else {
            $resp['error'] = $res;
        }
        echo json_encode($resp);

    }catch(\Throwable $th) {
        echo json_encode('error'. $th);
    }
}

// Funcion no usada actualmente eliminar comentario si se usa
function get_colores_asignados($conn) {
    try {
        $hiColores = null;
        $conne = new Construir();
        $queryColores =mb_convert_encoding( $conne->query_tabla_colores(), 'UTF8');
        foreach ($queryColores as $key => $value) {
            $params = base64_encode(json_encode($value));
            $hiColores .= '<tr><td>' . $value["Orden"] . '</td><td>' . $value["Modelo"] . '</td><td>' . $value["Anio"] . '</td><td style=" display: flex;">' . $value["Color"] . '<div style=" margin-left:10px; width:20px; heigth: 20px; ; color: ' . $value["Hexa"] . ';background-color: ' . $value["Hexa"] . ';">__</div></td><td><center><div class="btn btn-danger" onclick="deleteButton(\'' . $params . '\')">ELIMINAR</div></center></td></tr>';
            
        }

        echo json_encode( $hiColores);
    } catch (\Throwable $th) {
        echo json_encode('error' . $th);
    }
}


$conn->close();

?>
