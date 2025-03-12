<?php
include ("../../_inc/_config.php");
include("../../_inc/constructor.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

$slug = $_POST['slug'];
if ($slug == '' || $slug == null) {
    echo json_encode('sin parametro');
    return true;
}

$query2 = "UPDATE catalogo set status='0' where slug = '".$slug."' and id>0;";
$conn->query($query2);


$conn->close();
echo json_encode('success');
return $conn

?>
