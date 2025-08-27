<?php
include("_config.php");
include("constructor.php");

$conne = new Construir();
$anos = $conne->get_anos();

echo json_encode($anos);
return json_encode($anos);
?>