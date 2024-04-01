<?php
require_once("../../_inc/_config.php");

$inventario=$_POST['inventario'];

$filename = $_FILES['file']['name'];
$filename = $inventario.'.jpg';

$location = "../../../assets/img/accesorios/".$filename;

     if(move_uploaded_file($_FILES["file"]["tmp_name"],$location)){
         $move=1;
     }else{
         echo "ERROR";
     }


if($move == 1){
 echo '<input type="text" id="imagen" class="form-control disabled" disabled="" value="https://www.gruporivero.com/assets/img/accesorios/'.$filename.'">';
}
?>