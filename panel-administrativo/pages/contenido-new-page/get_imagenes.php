<?php
require_once("../../_inc/_config.php");
include("../../_inc/constructor.php");
$auto=$_POST['asignado'];
$anio=$_POST['anio'];
$conne = new Construir();
$marca = $conne->get_marca_by_modelo_ano($auto,$anio);
$mrk=strtolower($marca);
$aut=strtolower($auto);

//print_r($mrk);


$directorio = '../../../assets/img/autos-landing/'.$mrk.'/'.$aut.'-'.$anio.'/galeria/';
$folder_path = $directorio;

$num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);

$folder = opendir($folder_path);
 
if($num_files > 0){
 while(false !== ($file = readdir($folder))) 
 {
  $file_path = $folder_path.$file;
  $extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
  
  //$ruta=str_replace("../../../","https://www.gruporivero.com/", strtolower($file_path));
  
  $open_dir= str_replace("../../../","https://www.gruporivero.com/",$file_path);
  
  $ext=".".$extension;
  $cero=str_replace($ext,"", strtolower($file));
  $uno=str_replace("-Grupo-Rivero-","_",$cero);
  $dos=str_replace("-","_",$uno);
  
  if($extension=='jpg' || $extension =='png' || $extension == 'jpeg'){
      echo '<div style="" class="col-sm-3"><img src="'.$file_path.'" class="img-fluid col-2"  style="max-width: 100% !important; margin-auto"/>
      <div class="form-group">
      <div class="form-line disabled">
      <input type="text" class="form-control" placeholder="Disabled" disabled="" value="'.$open_dir.'" id="'.$dos.'">
      </div>
      </div>
      </div>';
  }
 }
}
else
{
 echo "the folder was empty !";
}
closedir($folder);
/*

$ficheros1  = scandir($directorio);
for($i=0;$i<count($ficheros1);$i++){
            //$metakey=utf8_encode($consulta[$i]["marca"]);
        $cadena_metakey.='<p>'.$consulta[$i].'</p>';
        }
        
print_r($cadena_metakey);*/
//echo $directorio;
?>