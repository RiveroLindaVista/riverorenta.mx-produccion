<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

// Obtener la ruta de la URL
$request_uri = $_SERVER['REQUEST_URI'];

// Dividir la ruta en partes
$uri_parts = explode('/', trim($request_uri, '/'));
echo json_encode($uri_parts);
return true;
// Obtener el método HTTP
$http_method = $_SERVER['REQUEST_METHOD'];
// echo json_encode($http_method);
// return true;

// Definir las rutas y sus correspondientes controladores/manejadores
$routes = [//Method->url->controller
    'GET' => [
        'get_inventario' => 'InventarioController:fn_get_inventario',
        'get_inventario_by_id' => 'InventarioController:fn_get_inventario_by_id',//with id param
        'get_inventario_by_id2' => 'InventarioController:fn_get_inventario_by_id2',//with id param
    ],
    'POST' => [
        'save_inv' => 'InventarioController:fn_save_inventario',
        'update_inv' => 'InventarioController:fn_update_inv',//with id param
    ],
    'DELETE' => [
        'delete_inv' => 'InventarioController:fn_delete_inv',//with id param
    ]
];

// https://riverorenta.mx/beta/inventario_sistemas/index.php/get_inventario
// echo json_encode( $_POST  );

// Verificar si la ruta y el método están definidos
if (isset($routes[$http_method][$uri_parts[3]])) {
    $controller_function = explode(':', $routes[$http_method][$uri_parts[3]]);
    
    $controller = $controller_function[0];
    $function = $controller_function[1];

    
    // Obtener el nombre del controlador/manejador
    // $handler_name = $routes[$http_method][$controller];
    $handler_name = $controller;

    // Incluir el archivo del controlador/manejador
    require_once("controllers/{$handler_name}.php");

    // Instanciar la Clase
    // $handler = new Catalogo();
    $handler = new $handler_name();

    // Llamar al método correspondiente (por ejemplo, index())
    $handler->$function();
    
    
    
} else {
    // Ruta no encontrada
    header("HTTP/1.1 404 Not Found");
    echo "404 Not Founds";
}

?>