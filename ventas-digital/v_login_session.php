<?php
session_start();
include("_config.php");
include("_classes/_conexion.php");
include("_classes/classes.php");

$id= $_SESSION["Id"];
//$id="0062S00000vZnSvQAK";

$conn=new Conexion();
//$param['editor']=$editor;


//var_dump($param);
$registro=$conn->get_hventas_meta($id);
for($i=0;$i<count($registro);$i++){
	$_SESSION[$registro[$i]["meta"]]=utf8_encode($registro[$i]["value"]);
}
/*if($_SESSION["etapa"]==9){
	?>
	<script>window.location.href="<?=URL?>/etapa9"</script>
	<?php
}else */
if($_SESSION["etapa"]!=""){
	?>
	<script>window.location.href="<?=URL?>etapa-<?=$_SESSION["etapa"]?>"</script>
	<?php
}else{
	?>
	<script>window.location.href="<?=URL?>etapa-tipo-auto"</script>
	<?php
}
?>