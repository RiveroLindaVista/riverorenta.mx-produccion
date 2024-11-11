<?php
include ("../../_inc/_config.php");
include("../../_inc/constructor.php");
include("../lista-politicas-empleados/func_queries.php");


$function = $_POST['function'];

$func_queries = new QueriesPolicy();
$request = $_POST;

switch ($function) {

    case 'get_politicas':
        $response = $func_queries->get_politicas();

        echo json_encode($response);

        break;


    default:
        echo json_encode('invalid function selected');
        break;
}
