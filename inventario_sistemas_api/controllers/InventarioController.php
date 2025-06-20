<?php
include_once "conection/conection.php";
// include_once  "../models/inventario.php";
include_once  "models/InvSistemasModel.php";


class InventarioController extends Database {

    public function fn_get_inventario() {
        
        $resp = new InvSistemasModel;
        $resp_all = $resp->alls();
        // $resp_all = InvSistemasModel::alls();

        echo json_encode($resp_all);
        
        
    }

    public function fn_get_inventario_by_id2() {
        $request_uri = $_SERVER['REQUEST_URI'];
        // echo json_encode($request_uri);

        parse_str($_SERVER['QUERY_STRING'], $params);
        // var_dump( $params);
        $id = $params['/get_inventario_by_id2/?id'];
        // echo json_encode($params['id']);
        // return true;
        $mbd = Database::connect();

        $sentence = $mbd->prepare('SELECT * FROM inv_sistemas where id=?');
        $sentence->execute([$id]);
        $resp = $sentence->fetchAll(PDO::FETCH_OBJ);
        $mbd = Database::disconnect();
        
        echo json_encode($resp[0]);
        return true;
        
        foreach ($resp as $key => $value) {
            
            // return true;
        }     
        
    }
    public function fn_get_inventario_by_id() {
        $request_uri = $_SERVER['REQUEST_URI'];
        // echo json_encode($request_uri);

        parse_str($_SERVER['QUERY_STRING'], $params);
        // var_dump( $params);
        $id = $params['id'];
        // echo json_encode($params['id']);
        // return true;
        $mbd = Database::connect();

        $sentence = $mbd->prepare('SELECT * FROM inv_sistemas where id=?');
        $sentence->execute([$id]);
        $resp = $sentence->fetchAll(PDO::FETCH_OBJ);
        $mbd = Database::disconnect();
        
        echo json_encode($resp);
        return true;
        
        foreach ($resp as $key => $value) {
            
            // return true;
        }     
        
    }

    function fn_save_inventario () {
        
        $request =  json_decode( file_get_contents('php://input', true)) ;

        $nomenclatura = $request->nomenclatura;
        $equipo = $request->equipo;
        $marca = $request->marca;
        $modelo = $request->modelo;
        $serie = $request->serie;
        $so = $request->so;
        $ram = $request->ram;
        $dd = $request->dd;
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $departamento = $request->departamento;
        $sucursal = $request->sucursal;
        $status = $request->status;
        $imei = $request->imei;
        $accesorios = $request->accesorios;
        $numero = $request->numero;
        $tipo_dispositivo = $request->tipo_dispositivo;
        $created_at = $request->created_at;
        $usuario_responsable = $request->usuario_responsable;

        try {
            $mbd = Database::connect();
            $prepa = $mbd->prepare('INSERT INTO 
            inv_sistemas (
                nomenclatura,
                equipo,
                marca,
                modelo,
                serie,
                so,
                ram,
                dd,
                nombre,
                apellido,
                departamento,
                sucursal,
                status,
                imei,
                accesorios,
                numero,
                tipo_dispositivo,
                created_at,
                usuario_responsable
                )
             values (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');        
            
            // var_dump($prepa);
            if ($prepa->execute([$nomenclatura, $equipo, $marca, $modelo, $serie, $so, $ram, $dd, $nombre, $apellido, $departamento, $sucursal, $status, $imei, $accesorios, $numero, $tipo_dispositivo, $created_at, $usuario_responsable])) {
                $arr_resp = array(
                    'status' => '00',
                    'message'=>'Success',
                    'data'=>[]
                );
                echo json_encode($arr_resp);    
            } else {
                $arr_resp = array(
                    'status' => '01',
                    'message'=>'Error',
                    'data'=>[]
                );
                echo json_encode($arr_resp);    
            }
    
            $mbd = Database::disconnect();
        } catch (\Throwable $th) {
            echo json_encode('Error: '.$th);
        }
        
    }


    function fn_update_inv() {
        // $param_url = parse_str($_SERVER["QUERY_STRING"], $arr_params_url);
        // $id= $arr_params_url["id"];
        $request = json_decode(file_get_contents('php://input'));
        $id = $request->id;

        // echo json_encode($id);
        
        $fields = '';
        $arr_values=array();
        foreach ($request as $key => $value) {
            array_push($arr_values, $value);
            
            $keyy = end($request);
            
            if (key($request) == $key) {
                array_push($arr_values,$id);
                $fields .= ''.$key.' = ?';
            } else {
                $fields .= ''.$key.' = ?, ';
            }
            

        }
        // echo json_encode($fields);
        // echo json_encode($arr_values);
        // return true;
        
        // $nomenclatura = $request->nomenclatura;
        // $equipo = $request->equipo;
        // $marca = $request->marca;
        // $modelo = $request->modelo;
        // $serie = $request->serie;
        // $so = $request->so;
        // $ram = $request->ram;
        // $dd = $request->dd;
        // $nombre = $request->nombre;
        // $apellido = $request->apellido;
        // $departamento = $request->departamento;
        // $sucursal = $request->sucursal;
        // $status = $request->status;
        // $imei = $request->imei;
        // $accesorios = $request->accesorios;
        // $numero = $request->numero;
        // $tipo_dispositivo = $request->tipo_dispositivo;
        // $created_at = $request->created_at;
        // $usuario_responsable = $request->usuario_responsable;

        $sql = "UPDATE inv_sistemas SET ".$fields. " WHERE id = ?";

        // echo json_encode($arr_values);
        // return true;
        $conn = Database::connect();
        $prep = $conn->prepare($sql);

        if ($prep->execute($arr_values)) {
            $arr_resp = array(
                'status' => '00',
                'message'=>'Success',
                'data'=>[]
            );
            echo json_encode($arr_resp);    
        } else {
            $arr_resp = array(
                'status' => '01',
                'message'=>'Error',
                'data'=>[]
            );
            echo json_encode($arr_resp);    
        }


    }

    function fn_delete_inv() {
        // $param_url = parse_str($_SERVER["QUERY_STRING"], $arr_params_url);
        // $id = $arr_params_url["id"];
        $request =  json_decode( file_get_contents('php://input', true)) ;
        $id = $request->id;

        
        $sql = "DELETE FROM inv_sistemas WHERE id = ?";
        $mbd = Database::connect();
        $prep = $mbd->prepare($sql);

        if ($prep->execute([$id])) {
            $arr_resp = array(
                'status' => '00',
                'message'=>'Success',
                'data'=>[]
            );
            echo json_encode($arr_resp);    
        } else {
            $arr_resp = array(
                'status' => '01',
                'message'=>'Error',
                'data'=>[]
            );
            echo json_encode($arr_resp);    
        }
    }

    
}


// TODO: VER EN QUE MEJORAR LAS FUNCIONES 





?>