<?php
include("_config.php");
include("constructor.php");

$ano=$_POST['ano'];
$conne = new Construir();
$marcas = $conne->get_marcas($ano);

for($i=0;$i<count($marcas);$i++){
    $cadena.='<option selected value="'.$marcas[$i].'">'.$marcas[$i].'</option>';
}

echo $cadena;
return json_encode($marcas);
?>