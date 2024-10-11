<?php
include ("../../_inc/_config.php");
include("../../_inc/constructor.php");
include("../politicas/func_queries.php");


$function = $_POST['function'];

$func_queries = new QueriesPolicy();
$request = $_POST;

switch ($function) {
    case 'insert_politica':
        $request = $_POST;
        $response = $func_queries->insert_politica($request);
        echo json_encode($response);


        break;
    case 'get_politicas':
        $response = $func_queries->get_politicas();

        echo json_encode($response);
        // echo json_encode('functionget politica selected');

        break;
    case 'update_name_policy':
        $response = $func_queries->update_name_policy($request);
        $response2 = $func_queries->update_name_policies_employee($request);
        echo json_encode($response);
        break;

    case 'update_policy':
        $response = $func_queries->update_policy($request);
        $response2 = $func_queries->set_disabled_politicas_empleados($request);

        echo json_encode($response);
        break;
    default:
        echo json_encode('invalid function selected');
        break;
}
