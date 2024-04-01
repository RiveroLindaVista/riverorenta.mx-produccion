<?php
session_start();
date_default_timezone_set('America/Monterrey');
class Conexion extends Database{
    public function insert_codigo_validacion($codigo,$correo){
        $conn= Database::connect();
        if($correo!=""){
            $sql = 'INSERT INTO hventas_codigo(correo,codigo)VALUES ("'.strtolower($correo).'","'.$codigo.'")';
            $conn->query($sql);
        }
         

        $conn=Database::close();
    } 
    public function confirmar_codigo($codigo,$correo){
        $conn= Database::connect();
        $sql = 'SELECT * FROM hventas_codigo WHERE correo="'.strtolower($correo).'" and codigo="'.$codigo.'"';
        
        $respuesta=$conn->query($sql);
         if ($respuesta->num_rows>0) {
            $out=['msj'=>'1'];
            $_SESSION["owner"]=strtolower($correo).'@gruporivero.com';
            $sql2 = 'DELETE FROM hventas_codigo WHERE correo="'.strtolower($correo).'" and codigo="'.$codigo.'"';
            $conn->query($sql2);
         }else{
            $out=['msj'=>'0'];
         }
        return $out;
        $conn=Database::close();
    } 
    public function getCatalogo(){
        $conn= Database::connect();
        $sql = 'SELECT * FROM get_catalogo WHERE marca="CHEVROLET" order by ano desc, modelo, precio';
         $result1=$conn->query($sql);
         while ($row = $result1->fetch_assoc()) {
                $out[]=$row;
            }
      return $out;
        $conn=Database::close();
    } 

    public function getCatalogoModelos($tipo){
        $conn= Database::connect();
        $sql = 'SELECT * FROM get_catalogo WHERE tipo_vehiculo="'.$tipo.'" and marca="CHEVROLET" order by ano desc, modelo, precio';
         $result1=$conn->query($sql);
         while ($row = $result1->fetch_assoc()) {
                $out[]=$row;
            }
      return $out;
        $conn=Database::close();
    } 

    public function get_versiones_modelo($slug){
        $conn= Database::connect();
        $sql = 'SELECT * FROM get_versiones_hv WHERE slug="'.$slug.'" order by version';
        $result=$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $out[]=$row;
        }
        return $out;
        $conn=Database::close();
    }
    

    public function get_catalogoById($id){
        $conn= Database::connect();
        $sql = 'SELECT * FROM catalogo WHERE id='.$id.' limit 1';
        $result=$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $out=$row;
        }
        return $out;
        $conn=Database::close();
    }

    public function insert_etapa($idSF, $columna, $valor){
        $conn= Database::connect();
        $sqlEtapa = "SELECT meta FROM hventas_meta WHERE idSF='$idSF' and meta = '".$columna."'";
        $resultEtapa=$conn->query($sqlEtapa);

        if ($resultEtapa->num_rows > 0) {
            
            $sqlEtapaUpdate = "UPDATE hventas_meta SET value = '".$valor."' where meta = '".$columna."' and idSF = '$idSF'";
            $resultEtapaUpdate=$conn->query($sqlEtapaUpdate);
        } else {
          
           
            $sqlEtapaInsert = "INSERT INTO hventas_meta (idSF, meta, value) VALUES('$idSF', '$columna', '$valor')";
            $resultEtapainsert=$conn->query($sqlEtapaInsert);
        }
        
        $conn=Database::close();
    

    }

    public function get_accesorios($modelo){

        $conn= Database::connect();
        $sql = "SELECT * FROM accesorios WHERE auto='".$modelo."'";
        
        $result=$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $out[]=$row;
        }
        return $out;
        $conn=Database::close();


    }

     public function get_hventas_meta($id){

        $conn= Database::connect();
        $sql = "SELECT * FROM hventas_meta WHERE idSF='".$id."'";
        
        $result=$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $out[]=$row;
        }
        return $out;
        $conn=Database::close();


    }
    function get_carid($modelo,$anio,$tipo){
        $conn= Database::connect();
        $sql = "SELECT id FROM catalogo WHERE modelo='".$modelo."' and ano='".$anio."' and tipo='".$tipo."'";
        $result=$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
                $out=$row["id"];
        }
        return $out;
        $conn=Database::close();
    }

}


?>