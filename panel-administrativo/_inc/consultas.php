<?php
include_once("conexion.php");

class Conexion extends Database{
    public function query_autos_banner_publicidad($pag){
            $conn= Database::connect();
            $sql = "SELECT * FROM publicidad WHERE titulo='$pag'";
            $result=$conn->query($sql);
            if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }
        public function get_paginas_admin($modelo){
            $conn= Database::connect();
            $sql = "SELECT url,page,subpage FROM frutas WHERE route='$modelo'";
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();

        }
        
        public function query_modelos_taller(){
            $conn= Database::connect();
            $sql = 'SELECT modelo from paquetes_taller_servicio WHERE kms <>"" GROUP BY modelo';
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row["modelo"];
                        }
                    } 

            return $out;
            $conn=Database::close();
        }
        public function query_km_taller($modelo){
             $conn= Database::connect();
            $sql = 'SELECT kms from paquetes_taller_servicio WHERE kms not in("","6","30") and modelo="'.$modelo.'" and paquete<>"" GROUP BY kms';
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row["kms"];
                        }
                    } 

                    $out[]='6';$out[]='18';$out[]='30';$out[]='42';$out[]='54';$out[]='66';
                    sort($out);
            return $out;
            $conn=Database::close();
        }



        public function query_paquete_taller($modelo,$km){
             $conn= Database::connect();
             if($km!="6"&&$km!="18"&&$km!="30"&&$km!="42"&&$km!="54"&&$km!="66"){
                $sql = 'SELECT * from paquetes_taller_servicio WHERE modelo="'.$modelo.'" and kms="'.$km.'" and     paquete<>""';
            }else{
                 $sql = 'SELECT SUM(precf) as precf from paquetes_taller_servicio WHERE modelo="'.$modelo.'" and descripcion like "CAFDX-'.$modelo.'%"';
            }
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }




        public function cambiarNombre($nombre){
            $alias=$nombre;
            $url=str_replace(' ', '-',$nombre);
            if($nombre=="C 35"){
              $alias="SILVERADO 3500";
              $nombre="c-35";
              $url='c-35';
            }
            if($nombre=="C 20"){
              $alias="SILVERADO 2500";
              $nombre="c-20";
               $url=$modelo[0].'-c-20-'.$modelo[2];
            }
            if($nombre=="C 20 CREW"){
              $alias="CHEYENNE";
              $nombre="C-20 CREW";
               $url='c-20-crew';
            }
            return ["nombre"=>$nombre,"nombre2"=>$alias,"url"=>$url];
        }


         public function query_get_accesorios($modelo,$amo){
            $conn= Database::connect();
            $autos= Conexion::cambiarNombre($modelo);
            $sql = 'SELECT t1.auto,t1.num_inventario,t1.descripcion,t1.tiempo_instalacion,t2.anio,t1.precio,t1.instalacion,t1.categoria FROM accesorios t1 inner join accesorios_anios t2 on t1.num_inventario=t2.accesorio_id WHERE (t1.auto ="'.$autos["nombre2"].'" or t1.auto = "'.$autos["nombre"].'") and t1.status=1 and t2.anio="'.$amo.'" and t1.instalacion<>"" group by t1.num_inventario,t1.precio order by t1.precio';
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }


         public function query_colores($nombre1,$ano){
            $conn= Database::connect();

            $sql='SELECT t1.color as color_exterior,t2.color,t3.tipo_vehiculo FROM inventario_colores t1 inner join colores_hex_inventario t2 on t1.color=t2.nombre inner join inventario_nuevos t3 on t1.modelo=t3.modelo WHERE (t1.modelo ="'.$nombre1.'" or t1.modelo = "'.$nombre1.'") and t1.ano="'.$ano.'" GROUP BY t1.color ORDER BY t1.orden ';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
            
            return $out;

            }
            $conn=Database::close();

        }


        
        public function query_total_comparativas($modelo,$amo){
            $conn= Database::connect();
            $autos= Conexion::cambiarNombre($modelo);
            $sql = 'SELECT t3.version,t2.nombre,t1.valor FROM versiones_relacion t1 inner join versiones_comparativa t2 on t1.comparativa_id=t2.id inner join versiones t3 on t1.version_id=t3.id inner join inventario_nuevos t4 on t3.modelo=t4.modelo WHERE (t4.modelo ="'.$autos["nombre"].'" or t4.modelo = "'.$autos["nombre2"].'") and t3.ano="'.$amo.'" group by t4.modelo,t2.nombre,t3.version ORDER BY t2.orden asc';
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }
        public function query_get_comparativa_versiones($modelo){
            $conn= Database::connect();
            $autos= Conexion::cambiarNombre($modelo);
            $consultaVentaja=str_replace('NG','',$autos["nombre"]);
            $sql='SELECT * FROM comparativas WHERE auto ="'.$autos["nombre2"].'" or auto = "'.$consultaVentaja.'"';
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }


        public function query_get_versiones($modelo,$amo){
             $conn= Database::connect();

            $autos= Conexion::cambiarNombre($modelo);
            $sql = 'SELECT t1.tipo,t1.precio,t2.version FROM inventario_nuevos t1 left join versiones t2 on t1.modelo=t2.modelo and t1.tipo=t2.tipo  and t1.ano=t2.ano  WHERE (t1.modelo ="'. $autos["nombre"].'" or t1.modelo = "'.$autos["nombre2"].'")  and t1.ano ="'.$amo.'" group by t1.tipo order by t1.precio';

            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
             return $out;
             $conn=Database::close();

        }






       public function get_historial_web($correo){
            $conn= Database::connect();
            $sql="SELECT GROUP_CONCAT(\"'\",t2.ip,\"'\")as ip FROM usuarios_post t1 inner join usuarios_ips t2 on t1.id=t2.user_id Where t1.email ='$correo'";
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out=$row["ip"];
                        }
                    }  
             $sql2="SELECT meta_key,meta_value,fecha,count(*) as cantidad FROM historial WHERE IP in(". $out.") and meta_key in('pagina','pagina referencia','informes') group by meta_value order by fecha desc limit 100";
            $result2=$conn->query($sql2);
            if ($result2) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $out2[]=$row2;
                        }
                    }  
            return $out2;


            $conn=Database::close();
    }

    public function query_color_principal($auto,$ano){
            $conn= Database::connect();
            $sql="SELECT color FROM inventario_colores WHERE modelo='".$auto."' and ano='".$ano."' order by orden LIMIT 1";
           //echo $sql.'<br>';
           
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out=str_replace(' ', '-', $row["color"]);
                        }
                        return $out;
                    }  
            $conn=Database::close();
    }
/*Paises y estados*/
    public function query_get_nacionalidad($pais){
            $conn= Database::connect();
            $pais=utf8_decode($pais);
            $sql="SELECT nacionalidad FROM paises_nacionalidades";
           
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=array_map("utf8_encode", $row);
                        }
                        $out2=json_encode($out);
                        return json_decode($out2);
                    }  
            $conn=Database::close();
    }
    public function query_get_estados($pais){
            $conn= Database::connect();
            $pais=utf8_decode($pais);
            $sql="SELECT estado from paises_select WHERE pais='$pais' GROUP BY estado";
           
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=array_map("utf8_encode", $row);
                        }
                        $out2=json_encode($out);
                        return json_decode($out2);
                    }  
            $conn=Database::close();
    }
    public function query_get_paises(){
            $conn= Database::connect();
            $sql="SELECT pais from paises_select GROUP BY pais";
            $result=$conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=array_map("utf8_encode", $row);
                        }
                        $out2=json_encode($out);
                        return json_decode($out2);
                    }  
            $conn=Database::close();
    }
    /*Acceso a cuentas*/
    public function query_update_personales($param,$id){
        $conn= Database::connect();
        $contar=0;
         foreach ($param as $key => $value) {
             $contar++;
             $out="";
            $sql1="SELECT * FROM usuarios_postmeta WHERE user_id='$id' and meta_key='$key'";
             $result=$conn->query($sql1);
                while ($row = $result->fetch_assoc()) {
                        $out=array_map("utf8_encode", $row);
                    }
             if($out!=""){
                 $sql="UPDATE usuarios_postmeta set meta_value='$value' WHERE user_id='$id' and meta_key='$key'";
                 $result=$conn->query($sql);
                
             }else{
                $sql="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$id','$key','$value')";
                 $result=$conn->query($sql);
                
             }
             
             
         } 
        
         $conn=Database::close();

    }
    public function query_get_cuenta($id){
            $conn= Database::connect();
            $sql="SELECT * FROM usuarios_postmeta WHERE user_id='$id'";
            $result=$conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $out[]=array_map("utf8_encode", $row);
                    }
                    $out2=json_encode($out);
                    return json_decode($out2);
                }  
             $conn=Database::close();
    }
    public function query_valdiar_cuenta($param){
        $conn= Database::connect();
        $user=json_encode(strtolower($param["user"]));
        $pass=sha1($param["pass"]);
        $sql="SELECT id,nombre,email,tel,medio,fecha FROM usuarios_post WHERE email=$user and pass='$pass' LIMIT 1";
        $result=$conn->query($sql);
          if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=array_map("utf8_encode", $row);
                }
                $out2=json_encode($out);
                return json_decode($out2);
            }  

        $conn=Database::close();
    }
      public function query_valdiar_cuenta2($param){
        $conn= Database::connect();
        $user=strtolower($param["user"]);
        $user2=strtolower($param["correo"]);
        $sql="SELECT id,nombre,email,tel,medio,fecha FROM usuarios_post WHERE user ='$user' or email ='$user' LIMIT 1";

        $result=$conn->query($sql);
          if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=array_map("utf8_encode", $row);
                }
                $out2=json_encode($out);
                return json_decode($out2);
            }  

        $conn=Database::close();
    }
     public function query_crear_cuenta($param){
        $conn= Database::connect();
        $nombre=$param["nombre"];
        $apellido_paterno=$param["apellido_paterno"];
        $apellido_materno=$param["apellido_materno"];
        $celular=$param["celular"];
        $correo=strtolower($param["correo"]);
        $user=strtolower($param["correo"]);
        $pass=sha1($param["pass"]);
        $pass2=$param["pass"];
         $sql="INSERT INTO usuarios_post (nombre,user,pass,email,tel,medio,status) VALUES('$nombre','$user','$pass','$correo','$celular','pagina','1')";
         $conn->query($sql);
         $sql2="SELECT id from usuarios_post WHERE email='$correo' and status=1 and user='$user'";
         $result=$conn->query($sql2);

          while ($row = $result->fetch_assoc()) {
                    $out=$row["id"];
                }
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','nombre','$nombre');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','apellido_paterno','$apellido_paterno');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','apellido_materno','$apellido_materno');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','celular','$celular');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','correo','$correo');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','pass','$pass2');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','user','$user');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','user_id','$out');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_postmeta (user_id,meta_key,meta_value) VALUES('$out','ip','". $_SESSION["user"]["ip"]."');";
        $conn->query($sql3);
        $sql3="INSERT INTO usuarios_ips (user_id,ip) VALUES('$out','". $_SESSION["user"]["ip"]."');";
        $conn->query($sql3);
        $conn=Database::close();
        return $out;
    }


    /*Blogs*/
    public function query_all_blogs(){
        $conn= Database::connect();
        $sql="SELECT id,titulo,descripcion,fecha FROM blogs ORDER BY id DESC LIMIT 10";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_encode", $row);
            }
            $out2=json_encode($out);
            return json_decode($out2);
        }
        $conn=Database::close();

    }
    public function query_get_blog_by_id($blogId){
        $conn= Database::connect();
        $blogId=$blogId;
        $blogId=str_replace('-', ' ', $blogId);
        $sql="SELECT * FROM blogs WHERE titulo like '%$blogId%'";
       
        $result=$conn->query($sql);
         if ($result) {
           

            while ($row = $result->fetch_assoc()) {
                 $out["titulo"]=$row["titulo"];
                 $out["contenido"]=$row["contenido"];
                  $out["fecha"]=$row["fecha"];        
             }
           
        return $out;
        }
        $conn=Database::close();

    }

    public function get_last_blog(){
        $conn= Database::connect();
        $sql= "SELECT id FROM blogs ORDER BY id desc limit 1";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
        return $out;
        }
        $conn=Database::close();
    }

    public function create_new_blog($param){
         $conn= Database::connect();
            $titulo=utf8_decode($param["titulo"]);
            $contenido=utf8_decode($param["contenido"]);
            $titleSeo=utf8_decode($param["titleSeo"]);
            $metakeys=utf8_decode($param["metakeys"]);
            $metaDescripcion=utf8_decode($param["metaDescripcion"]);
         
         $sql= "INSERT INTO blogs (titulo,contenido,title,metakeys,descripcion) VALUES ('$titulo','$contenido','$titleSeo','$metakeys','$metaDescripcion')";
         $result=$conn->query($sql);
         $conn=Database::close();

    }



    public function query_banners($meta_key){
        $conn= Database::connect();
        $sql= "SELECT meta_value,titulo,tipo FROM admin WHERE meta_key='$meta_key' and status=1 ORDER BY RAND()";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
        return json_encode($out);
        }
        $conn=Database::close();

    }
    public function query_carrusel(){
        $conn= Database::connect();
        $sql= "SELECT marca,modelo,ano,tipo_vehiculo,MIN(precio) FROM inventario_nuevos WHERE status=1 GROUP BY modelo,ano ORDER BY tipo_vehiculo asc ,FIELD (marca,'CHEVROLET','CADILLAC','BUICK','GMC','PERFORMANCE'),MIN(precio),ano";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            $out2=json_encode($out);
        return json_decode($out2);
        }
        $conn=Database::close();

    }
    public function query_all_nuevos(){
        $conn= Database::connect();
        $sql= "SELECT * FROM view_get_all_nuevos WHERE ano>='".(date("Y")-1)."' and status=1 ORDER BY tipo_vehiculo,precio asc";
       
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            $out2=json_encode($out);
        return json_decode($out2);
        }
        $conn=Database::close();

    }
    public function query_all_nuevos_mobile($tipoVehiculo){
        $conn= Database::connect();
        $tipovehi = ($tipoVehiculo != 0) ? "AND vgn.tipo_vehiculo = '".$tipoVehiculo."'" : "";
        $sql= "SELECT
               vgn.stock as stock,
               vgn.marca as marca,
               vgn.modelo as modelo,
               vgn.ano as ano,
               vgn.precio as precio,
               vgn.totalstock as totalstock,
               vgn.tipo_vehiculo as tipo_vehiculo,
               vgn.color_exterior as color_exterior,
               rtv.id as rtv_id,
               rtv.tipo as rtv_tipo,
               rtv.valor as rtv_valor
               FROM view_get_nuevos vgn 
               LEFT JOIN referencia_tipo_vehiculo rtv 
               ON rtv.tipo = vgn.tipo_vehiculo
               WHERE vgn.ano>='".(date("Y")-1)."' ORDER BY vgn.precio asc";

 
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            $out2=json_encode($out);
        return json_decode($out2);
        }
        $conn=Database::close();

    }
     public function query_all_seminuevos(){
            $conn= Database::connect();
            $sql= "SELECT vin,year,sucursal,marca,nombre,color,precio,trim,trans,serie as stock, km FROM inventario WHERE foto='1' and precio>'20000' and km<>0 ORDER BY precio asc";
            $result=$conn->query($sql);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                $out2=json_encode($out);
            return json_decode($out2);
            }
            $conn=Database::close();

        }

    public function query_banner_nuevos($nombre1,$nombre2,$ano){
        $conn= Database::connect();

        $sql='SELECT t1.modelo,t1.color as color_exterior,t2.color,t3.tipo_vehiculo,(SELECT f1.precio FROM inventario_nuevos f1 WHERE (f1.modelo ="'.$nombre1.'" or f1.modelo = "'.$nombre1.'") and f1.ano="'.$ano.'" order by f1.precio asc limit 1 )as precio,t1.orden FROM inventario_colores t1 inner join colores_hex_inventario t2 on t1.color=t2.nombre inner join inventario_nuevos t3 on t1.modelo=t3.modelo WHERE (t1.modelo ="'.$nombre1.'" or t1.modelo = "'.$nombre1.'") and t1.ano="'.$ano.'" GROUP BY t1.color ORDER BY t1.orden ';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_decode", $row);
            }
        $out2=json_encode($out);
        return json_decode($out2);

        }
        $conn=Database::close();

    }

    public function query_similares_nuevos($nombre1){
        $conn= Database::connect();
        $sql='SELECT * FROM view_get_nuevos WHERE precio between (SELECT precio-1200000 FROM view_get_nuevos WHERE modelo="'.$nombre1.'" limit 1) and (SELECT precio+300000 FROM view_get_nuevos WHERE modelo="'.$nombre1.'" limit 1) and modelo<>"'.$nombre1.'" ORDER BY RAND() LIMIT 3';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_decode", $row);
            }
            $out2=json_encode($out);
        return json_decode($out2);
        }
        $conn=Database::close();

    }
    public function query_similares_nuevos2(){
        $conn= Database::connect();
        $sql='SELECT * FROM view_get_nuevos ORDER BY RAND() LIMIT 3';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_decode", $row);
            }
            $out2=json_encode($out);
        return json_decode($out2);
        }
        $conn=Database::close();

    }
     public function query_similares_seminuevos($vin){
        $conn= Database::connect();
        $sql='SELECT * FROM inventario WHERE precio between (SELECT precio-100000 FROM inventario WHERE sha1(serie)="'.$vin.'" limit 1) and (SELECT precio+100000 FROM inventario WHERE sha1(serie)="'.$vin.'" limit 1) and sha1(serie)<>"'.$vin.'" and precio >0 and km<>"" and foto=1 ORDER BY RAND() limit 3';
       
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_decode", $row);
            }
            $out2=json_encode($out);
            return json_decode($out2);
        }
        $conn=Database::close();

    }
    public function query_similares_seminuevos2(){
        $conn= Database::connect();
        $sql='SELECT * FROM inventario WHERE precio >0 and km<>"" and foto=1 ORDER BY RAND() limit 3';
       
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_decode", $row);
            }
            $out2=json_encode($out);
            return json_decode($out2);
        }
        $conn=Database::close();

    }
    public function query_inv_colores_disponibles($modelo,$ano){
         $conn= Database::connect();
        $sql="SELECT t1.id,t1.tipo,t2.version,count(t2.version)as cantidad FROM inventario_nuevos t1 inner join versiones t2 on t1.tipo=t2.tipo and t1.modelo=t2.modelo and t1.ano=t2.ano inner join colores_hex_inventario t3 on t1.color_exterior=t3.nombre WHERE t1.modelo='$modelo' AND t1.ano='$ano' and t1.vin<>'' group by t1.tipo order by t1.tipo,RAND()";
         $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_decode", $row);
            }
            $out2=json_encode($out);
            return json_decode($out2);
        }
        $conn=Database::close();
    }
    public function query_auto_seminuevos($vin){
         $conn= Database::connect();
        $sql='SELECT * FROM inventario where sha1(serie)="'.$vin.'"';
       
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_decode", $row);
            }
            $out2=json_encode($out);
            return json_decode($out2);
        }
        $conn=Database::close();
    }

    public function query_promociones($marcas){
        $mysqli = Database::connect();
        $utf8 = $mysqli->set_charset("utf8");
        $sql = "SELECT * FROM promociones WHERE tipo = '$marcas' ORDER by RAND()";
        $res = $mysqli->query($sql);
        if($res){
            while($ls = $res->fetch_assoc()){
                $raw[] = $ls;
            }
            $enc = json_encode($raw);
            $dec = json_decode($enc);
            $ctd = count($dec);
            return array($ctd,$dec);
        }else{
            return false;
        }
        $mysqli = Database::close();

    }
      public function query_promociones_blog(){
        $mysqli = Database::connect();
        $utf8 = $mysqli->set_charset("utf8");
        $sql = "SELECT * FROM promociones ORDER by RAND() limit 2";
        $res = $mysqli->query($sql);
        if($res){
            while($ls = $res->fetch_assoc()){
                $raw[] = $ls;
            }
            $enc = json_encode($raw);
            $dec = json_decode($enc);
            $ctd = count($dec);
            return array($ctd,$dec);
        }else{
            return false;
        }
        $mysqli = Database::close();

    }
    public function getFiltros(){
        $mysqli = Database::connect();
        $utf8 = $mysqli->set_charset("utf8");
        $sql = " SELECT marca as filtro,COUNT(marca)as total FROM inventario WHERE precio>10000 and km<>0 and foto=1 GROUP BY marca";
        $res = $mysqli->query($sql);
         if($res){
            while($ls = $res->fetch_assoc()){
                $out["marcas"][] =["marca"=>$ls["filtro"],"total"=>$ls["total"]];
            }
         }
        $sql2 = "SELECT year as filtro,COUNT(year)as total FROM inventario WHERE precio>10000 and km<>0 and foto=1 GROUP BY year order by year desc";
        $res2 = $mysqli->query($sql2);
        if($res2){
            while($ls = $res2->fetch_assoc()){
                $out["ano"][] =["ano"=>$ls["filtro"],"total"=>$ls["total"]];
            }
         }
        $sql3 = "SELECT MIN(precio) as minmo,MAX(precio)as maximo FROM inventario WHERE precio>10000 and km<>0 and foto=1";
        $res3 = $mysqli->query($sql3);
        if($res3){
            while($ls = $res3->fetch_assoc()){
                $out["precio"][] =["minimo"=>$ls["minmo"],"maximo"=>$ls["maximo"]];
            }
         }

        $sql4 = "SELECT MIN(km) as minimo,MAX(km)as maximo FROM inventario WHERE km<>0 and foto=1 order by km asc";
        $res4 = $mysqli->query($sql4);
        if($res4){
            while($ls = $res4->fetch_assoc()){
                $out["km"][] =["minimo"=>$ls["minimo"],"maximo"=>$ls["maximo"]];
            }
         }

        $sql5 = "SELECT sucursal as filtro,COUNT(sucursal)as total FROM inventario WHERE precio>10000 and km<>0 and foto=1 GROUP BY sucursal";
        $res5 = $mysqli->query($sql5);
        if($res5){
            while($ls = $res5->fetch_assoc()){
                $out["sucursal"][] =["sucursal"=>$ls["filtro"],"total"=>$ls["total"]];
            }
         }
         $sql6 = "SELECT trans as filtro,COUNT(trans)as total FROM inventario WHERE precio>10000 and km<>0 and foto=1 GROUP BY trans";
        $res6 = $mysqli->query($sql6);
        if($res6){
            while($ls = $res6->fetch_assoc()){
                $out["trans"][] =["trans"=>$ls["filtro"],"total"=>$ls["total"]];
            }
         }

         $sql7 = "SELECT COUNT(nombre)as total FROM inventario WHERE precio>10000 and km<>0 and foto=1";
        $res7 = $mysqli->query($sql7);
        if($res7){
            while($ls = $res7->fetch_assoc()){
                $out["total"][] =["inv"=>$ls["total"]];
            }
         }

       
        $out=json_encode($out);
        return json_decode($out);
        $mysqli = Database::close();

    }
    public function query_insertar_historial($param){
        $conn= Database::connect();
        $ip=$param["ip"];
        $meta_key=$param["meta_key"];
        $meta_value=$param["meta_value"];
        $sql="INSERT INTO historial (IP,meta_key,meta_value) VALUES('$ip','$meta_key','$meta_value')";
        $result=$conn->query($sql);
    }


    public function query_insertar_contacto_info($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];
        $contacto = $param["contacto"];
        $sucursal = $param["sucursal"];
        $medio = $param["medio"];
        $mensaje = $param["comentario"];
        $url = $param["url"];
        $formulario = $param["formulario"];


        $sql = "INSERT INTO contacto_info (nombre_completo, correo, telefono, como_contactar, sucursal_cercana, como_entero, mensaje, url, formulario) VALUES ('$nombre', '$correo', '$telefono', '$contacto', '$sucursal', '$medio', '$mensaje', '$url', '$formulario')";
        $result = $conn->query($sql);


    }

     public function query_insertar_contacto_cita($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];
        $contacto = $param["contacto"];
        $sucursal = $param["sucursal"];
        $medio = $param["medio"];
        $mensaje = $param["comentario"];
        $url = $param["url"];
        $formulario = $param["formulario"];
        $marca = $param["auto_marca"];
        $modelo = $param["auto_modelo"];
        $ano = $param["auto_ano"];
        $kms = $param["auto_kms"];
        $horario = $param["horario_cita"];
        $servicio = $param["servicio"];
        $sql = "INSERT INTO contacto_info (nombre_completo, correo, telefono, como_contactar, sucursal_cercana, como_entero, mensaje, url, formulario, auto_marca, auto_modelo, auto_ano, auto_kms, horario_cita, servicio_ofrecer) VALUES ('$nombre', '$correo', '$telefono', '$contacto', '$sucursal', '$medio', '$mensaje', '$url', '$formulario', '$marca', '$modelo', '$ano', '$kms', '$horario', '$servicio')";
        $result = $conn->query($sql);

    }

    public function query_insertar_contacto_auto_nuevo($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];
        $contacto = $param["contacto"];      
        $url = $param["url"];
        $formulario = $param["formulario"];
        $marca = $param["auto_marca"];
        $modelo = $param["auto_modelo"];
        $ano = $param["auto_ano"];
        $version = $param["auto_version"];
        $color = $param["auto_color"];
        $precio = intval($param["auto_precio"]);
        $condicion = $param["auto_condicion"];
        $enganche = floatval($param["auto_enganche"]);
        $meses = $param["auto_meses"];
        $cuenta = $param["auto_cuenta"];
        $garantia = $param["auto_garantia"];
        $accesorios = floatval($param["auto_accesorios"]);      
        
        $sql = "INSERT INTO contacto_info (nombre_completo, correo, telefono, como_contactar, url, formulario, auto_marca, auto_modelo, auto_ano, auto_enganche, auto_version, auto_precio, auto_condicion, auto_meses, auto_color, auto_cuenta, auto_garantia, auto_accesorios) VALUES ('$nombre', '$correo', '$telefono', '$contacto', '$url', '$formulario', '$marca', '$modelo', '$ano', '$enganche', '$version', '$precio', '$condicion', '$meses', '$color', '$cuenta', '$garantia', '$accesorios')";
        $result = $conn->query($sql);

    }

    public function query_insertar_contacto_auto_seminuevo($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];
        $contacto = $param["contacto"];      
        $url = $param["url"];
        $formulario = $param["formulario"];
        $marca = $param["auto_marca"];
        $modelo = $param["auto_modelo"];
        $ano = $param["auto_ano"];
        $color = $param["auto_color"];
        $precio = intval($param["auto_precio"]);
        $condicion = $param["auto_condicion"];
        $enganche = floatval($param["auto_enganche"]);
        $meses = $param["auto_meses"];
        $cuenta = $param["auto_cuenta"];
        $stock = $param["auto_numero_stock"];
        
        $sql = "INSERT INTO contacto_info (nombre_completo, correo, telefono, como_contactar, url, formulario, auto_marca, auto_modelo, auto_ano, auto_enganche, auto_version, auto_precio, auto_condicion, auto_meses, auto_color, auto_cuenta, auto_numero_stock) VALUES ('$nombre', '$correo', '$telefono', '$contacto', '$url', '$formulario', '$marca', '$modelo', '$ano', '$enganche', '$version', '$precio', '$condicion', '$meses', '$color', '$cuenta', '$stock')";
        $result = $conn->query($sql);

    }


    public function query_insertar_contacto_auto_promociones($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];
        $contacto = $param["contacto"];      
        $url = $param["url"];
        $formulario = $param["formulario"];
        $marca = $param["auto_marca"];
        $modelo = $param["auto_modelo"];
        $ano = $param["auto_ano"];     
        $condicion = $param["auto_condicion"];
        $precio = $param["auto_precio"];
        $auto_precio = intval(preg_replace('/\D/', '', $precio));
                       
        $sql = "INSERT INTO contacto_info (nombre_completo, correo, telefono, como_contactar, url, formulario, auto_marca, auto_modelo, auto_ano, auto_precio, auto_condicion) VALUES ('$nombre', '$correo', '$telefono', '$contacto', '$url', '$formulario', '$marca', '$modelo', '$ano', '$auto_precio', '$condicion')";
        $result = $conn->query($sql);

    }

    public function query_insertar_valuacion_auto($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];             
        $marca = $param["marca"];
        $modelo = $param["modelo"];
        $anio = $param["anio"];     
        $version = $param["version"];
        $total = $param["total"];
        $compra = $param["compra"];
        $venta = $param["venta"];
        $oferta = $param["oferta"];
        $exteriores = $param["exteriores"];
        $interiores = $param["interiores"];

        $url = $param["url"];
                          
        $sql = "INSERT INTO valuaciones_autos (nombre, correo, tel, anio, marca, modelo, version, exteriores, interiores, oferta, compra, venta) VALUES ('$nombre', '$correo', '$telefono', '$anio', '$marca', '$modelo', '$version', '$exteriores', '$interiores' , '$oferta', '$compra', '$venta')";
        $result = $conn->query($sql);

    }

    public function query_insertar_prueba_manejo($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];                   
        $modelo = $param["modelo"];
        $anio = $param["anio"];
        $sucursal = $param["sucursal"];
        $contacto = $param["contacto"];
        $hora = $param["hora"];
        $fecha = $param["fecha"];
        $url = $param["url"];

        $sql = "INSERT INTO prueba_manejo (nombre, correo, telefono, sucursal, contacto, modelo, anio, fecha, hora) VALUES ('$nombre', '$correo', '$telefono', '$sucursal', '$contacto', '$modelo', '$anio', '$fecha', '$hora')";
        //var_dump($sql);
        $result = $conn->query($sql);

    }

    public function query_insertar_cita_servicio($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $nombre = $param["nombre"];
        $correo = $param["correo"];
        $telefono = $param["telefono"];                   
        $modelo = $param["modelo"];
        $anio = $param["anio"];
        $km = $param["km"];
        $sucursal = $param["sucursal"];
        $contacto = $param["contacto"];
        $hora = $param["hora"];
        $fecha = $param["fecha"];
        $paquete = $param["km"].',000 km';
        $precio = $param["precio"];
        $url = $param["url"];

    
        $sql = "INSERT INTO cita_servicio (nombre, correo, telefono, sucursal, contacto, auto_modelo, auto_anio, auto_km, fecha, hora, paquete, precio, url) VALUES ('$nombre', '$correo', '$telefono', '$sucursal', '$contacto', '$modelo', '$anio', '$km', ' ', ' ', '$paquete', ' ', '$url')";
    
        $result = $conn->query($sql);
       
    }

//<!-- PANEL ADMINISTRATIVO -->//

    public function query_insertar_promociones_accesorios($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $imagen = $param["imagen"];
        $titulo1 = $param["titulo_uno"];
        $titulo2 = $param["titulo_dos"];

        $modelo ="imagen";
        $forma = $imagen;
        $status ="1";
        $tipo = "ACCESORIOS";
       
        $sql = "INSERT INTO promociones (modelo, forma, titulo1, titulo2, status, tipo) VALUES ('$modelo', '$forma', '$titulo1', '$titulo2', '$status', '$tipo')";
        $result = $conn->query($sql);
       
    }

    public function query_insertar_blog($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $titulo =$param['titulo'];
        $title =$param['titulo'];
        $metakeys =$param['titulo'];
        $slug =$param['slug'];
        $descripcion =$param['descripcion'];
        $contenido=$param["contenido"];
        $make=$param["make"];
        $id_blog=$param["id_blog"];

        $sql = "INSERT INTO blogs (id, titulo, title, metakeys, descripcion, slug, contenido, make) VALUES ('$id_blog','$titulo', '$title', '$metakeys', '$descripcion' , '$slug' , '$contenido', '$make')";
        $result = $conn->query($sql);
/* 
        $sql2="SELECT id from blogs WHERE titulo='$titulo' ORDER BY id DESC LIMIT 1";
        $result2=$conn->query($sql2);
        $blog = $result2->fetch_assoc(); */
         echo $sql;
    }

    public function query_insertar_blog_editor($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $contenido=$param["contenido"];
        $num_id=$param["num_id"];

        $sql="UPDATE blogs set contenido='$contenido' WHERE id='$num_id'";
        $result=$conn->query($sql);         
        echo $editor_data;
    }

    public function query_actualizar_blog($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $titulo =$param['titulo'];
        $descripcion =$param['descripcion'];
        $contenido=$param["contenido"];
        $make=$param["make"];
        $id_blog=$param["id_blog"];

        $sql = "UPDATE blogs set contenido='$contenido', titulo='$titulo', title='$titulo', metakeys='$titulo', descripcion='$descripcion', make='$make' WHERE id='$id_blog'";
        $result = $conn->query($sql);
        return $sql;
    }

    public function query_insertar_publicidad($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $imagen=$param["imagen"];
        $pagina_titulo=$param["pagina_titulo"];
        $imagen_titulo=$param["imagen_titulo"];

        $sql="INSERT INTO publicidad(titulo, imagen) VALUES ('$pagina_titulo', '$imagen')";
        $result=$conn->query($sql);
    }

    public function query_insertar_adwords($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $pagina_titulo=$param["pagina_titulo"];
        $imagen=$param["imagen"];
        $slug=$param["slug"];
        $carros_select = $param["carros_select"];

        $sql="INSERT INTO adwords SET titulo='".$pagina_titulo."', imagen='".$imagen."', slug='".$slug."', carros_select='".$carros_select."'";
        $result=$conn->query($sql);
        return $sql;
    }

    public function query_report_blogs(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT id,titulo,descripcion,fecha,slug FROM blogs ORDER BY id DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_report_promociones($tipo){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT * FROM promociones where tipo ='$tipo' ORDER BY id DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function autos_promociones(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT forma FROM promociones where status=1 and tipo='NUEVOS' ORDER BY forma DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function taller_promociones(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT forma FROM promociones where status=1 and tipo='TALLER' ORDER BY id DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function accesorios_promociones(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT forma FROM promociones where status=1 and tipo='ACCESORIOS' ORDER BY id DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }
    
   public function query_autos_promo_color($param){
        $modelo = $param["modelo"];
        $anio = $param["anio"];
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT * FROM inventario_colores WHERE modelo='$modelo' and ano='$anio' ORDER BY color ASC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }
    

    public function query_insertar_promociones($param){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $forma = $param["imagen_titulo"];
        $titulo2 = $param["descripcion"];
        $tipo = $param["tipoUpper"];
        $marca = $param["marca"];
        $modelo_unidad = $param["modelo_unidad"];
        $ano = $param["ano"];
        $cantidad = $param["cantidad"];
        $tipo_promo = $param["tipo_promo"];

        $sql="INSERT INTO promociones (marca, modelo, modelo_unidad, ano, cantidad, forma, titulo2, status, tipo, tipo_promo) VALUES ('$marca', 'imagen', '$modelo_unidad', '$ano', '$cantidad', '$forma', '$titulo2', 1, '$tipo', '$tipo_promo')";
        $result=$conn->query($sql);         
    }

    public function query_status_promociones($param){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $id = $param["id"];
        $status = $param["status"];

        $sql="UPDATE promociones SET status='$status' WHERE id='$id'";
        $result=$conn->query($sql);         
    }

    public function query_descripcion_promociones($param){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $id = $param["id"];
        $descripcion = $param["descripcion"];

        $sql="UPDATE promociones SET titulo2='$descripcion' WHERE id='$id'";
        $result=$conn->query($sql);         
    }
    
/*
    public function query_autos_banner(){
            $conn= Database::connect();
            $sql = 'SELECT  DISTINCT modelo,GROUP_CONCAT(marca,"-",modelo,"-",ano ) AS auto FROM inventario_nuevos WHERE status =1 GROUP BY modelo ,ano,tipo,vin;';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
*/
    public function query_report_publicidad(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT id,titulo, imagen, fecha FROM publicidad ORDER BY id DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

     public function query_report_adwords(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT id,titulo, imagen, fecha FROM adwords ORDER BY id DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_insertar_banner($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $metakey=$param["metakey"];
        $meta_value=$param["meta_value"];
        $titulo=strtolower($param["titulo"]);
        $tipo=0;
        $status=1;
        $pag="home";

        $sql="INSERT INTO admin (pag, meta_key, meta_value, titulo, tipo, status) VALUES ('$pag', '$metakey', '$meta_value','$titulo', '$tipo','$status')";
        $result=$conn->query($sql);
    }

    public function query_actualizar_banner($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $id=$param["id"];
        $stat=$param["status"];

        if ($stat==1) {
            $status=0;
        }else{
            $status=1;
        }

        $sql="UPDATE admin SET status='$status' WHERE id='$id' ";
        $result=$conn->query($sql);
    }

    	public function query_autos_banner(){
            $conn= Database::connect();
            $sql = 'SELECT DISTINCT modelo,marca, ano FROM inventario_nuevos WHERE ano !=2018  ORDER BY marca,modelo ASC';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
    
        public function query_report_banners(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT * FROM admin ORDER BY id DESC";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_request_chat($date, $id_mensaje){
        $conn= Database::connect();
        $sql = "SELECT * FROM request_chat WHERE id_mensaje = '$id_mensaje' and status = 1 and mensaje_create = '$date'";

        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=array_map("utf8_encode", $row);
            }
            $out2=json_encode($out);
            return json_decode($out2);
        }
        return 0;
        
    }

    public function query_insertar_request_chat($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $id_mensaje=$param["id_mensaje"];
        $id_cliente=$param["id_cliente"];
        $nombre=$param["nombre"];
        $correo=$param["correo"];
        $telefono=$param["telefono"];
        $mensaje=$param["mensaje"];
        $mensaje_create=$param["mensaje_create"];

        $sql="INSERT INTO request_chat (id_mensaje, id_cliente, nombre, correo, telefono, mensaje, mensaje_create, status) VALUES ('$id_mensaje', '$id_cliente', '$nombre','$correo', '$telefono','$mensaje', '$mensaje_create', 1)";
        $result=$conn->query($sql);
    }

    public function query_eliminar_publicidad($param){
            $conn= Database::connect();
            $id=$param["id"];

            $sql = "DELETE FROM publicidad WHERE id='$id'";
            $result=$conn->query($sql);
        }
/*MAIL*/
   public function query_all_mail(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT * FROM correos_gr";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_report_accesorios(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT * FROM accesorios ORDER BY id";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }
    
    /*ACCESORIOS*/
    public function query_autos_accesorios(){
            $conn= Database::connect();
            $sql = 'SELECT DISTINCT modelo FROM inventario_nuevos ORDER BY modelo ASC';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
    
    public function query_anios_accesorios($numinv){
            $numinv=$numinv;
            $conn= Database::connect();
            $sql = "SELECT GROUP_CONCAT(DISTINCT anio) as anios FROM accesorios_anios WHERE accesorio_id = '$numinv'";
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
    
    public function query_anios_modelo_accesorios($auto){
        $auto=$auto;
        $conn= Database::connect();
        $sql = "SELECT DISTINCT ano FROM inventario_nuevos WHERE modelo = '$auto' ORDER BY ano DESC ";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_insertar_accesorio($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $asignado=$param["asignado"];
        $inventario=intval($param["inventario"]);
        $instalacion=$param["instalacion"];
        $precio=floatval($param["precio"]);
        $costo_inst=floatval($param["costo_inst"]);
        $categoria=$param["categoria"];
        $descripcion=$param["descripcion"];

        $sql="INSERT INTO accesorios (auto, num_inventario, descripcion, tiempo_instalacion, precio, instalacion, categoria) VALUES ('$asignado', $inventario, '$descripcion',$instalacion, $precio,'$costo_inst', '$categoria')";
        $result=$conn->query($sql);
    }

    public function query_insertar_accesorio_anio($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $anio=intval($param["anio"]);
        $inventario=intval($param["inventario"]);
        

        $sql="INSERT INTO accesorios_anios (accesorio_id, anio) VALUES ('$inventario', $anio)";
        $result=$conn->query($sql);
    }
    public function query_report_ip(){
            $conn= Database::connect();
            $sql = "SELECT IP,count(IP) AS cantidad FROM historial WHERE IP NOT LIKE '%local%' AND IP != ''  AND meta_key = 'pagina' GROUP BY IP ORDER BY cantidad DESC";
            $result=$conn->query($sql);
            if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }
        
        public function query_paginas_vistas(){
            $conn= Database::connect();
            $sql = "SELECT COUNT(meta_value) as cantidad, meta_value FROM historial WHERE IP NOT LIKE '%local%' AND IP != '' AND meta_key = 'pagina' GROUP BY meta_value ORDER BY cantidad DESC";
            $result=$conn->query($sql);
            if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }
        public function query_acciones_click(){
            $conn= Database::connect();
            $sql = "SELECT COUNT(meta_key) as cantidad, meta_value FROM historial WHERE IP NOT LIKE '%local%' AND IP != '' AND meta_key = 'acciones' GROUP BY meta_value ORDER BY cantidad DESC";
            $result=$conn->query($sql);
            if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }
        public function query_get_formularios(){
            $conn= Database::connect();
            $sql = "SELECT url, nombre_completo, correo, telefono, formulario, COUNT(url) as cantidad FROM contacto_info WHERE formulario!='' AND correo NOT LIKE  '%gruporivero%' AND nombre_completo != '' GROUP BY url ORDER BY cantidad DESC;";
            $result=$conn->query($sql);
            if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }
        public function query_get_conteo_forms(){
            $conn= Database::connect();
            $sql = "SELECT COUNT(formulario) as cantidad, formulario FROM contacto_info WHERE formulario!='' AND correo NOT LIKE  '%gruporivero%' AND nombre_completo != '' GROUP BY formulario  ORDER BY cantidad DESC;";
            $result=$conn->query($sql);
            if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $out[]=$row;
                        }
                    } 
            return $out;
            $conn=Database::close();
        }
    /*PAGINA NUEVA*/
    public function query_autos_catalogo(){
            $conn= Database::connect();
            $sql = 'SELECT DISTINCT modelo FROM catalogo ORDER BY modelo ASC';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
    
    public function query_anios_by_modelo($auto){
        $auto=$auto;
        $conn= Database::connect();
        $sql = "SELECT DISTINCT ano FROM catalogo WHERE modelo = '$auto' ORDER BY ano DESC ";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }
    public function query_categoria_nevos_detalle(){
            $conn= Database::connect();
            $sql = 'SELECT DISTINCT categoria FROM inventario_nuevos_detalles ORDER BY categoria ASC';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
    
        public function query_get_meta_key_new(){
            $conn= Database::connect();
            $sql = "SELECT DISTINCT meta_key, categoria FROM inventario_nuevos_detalles  ORDER BY meta_key ASC";
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
        
        public function query_get_marca_by_modelo_ano($auto,$anio){
            $auto=$auto;
            $anio=$anio;
            $conn= Database::connect();
            $sql = 'SELECT DISTINCT marca FROM catalogo WHERE modelo = "'.$auto.'" and ano = "'.$anio.'" LIMIT 1';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
        public function query_charge_meta_key($categoria){
            $cat=$categoria;
            $conn= Database::connect();
            $sql = 'SELECT DISTINCT meta_key FROM inventario_nuevos_detalles WHERE categoria ="'.$cat.'" ORDER BY meta_key ASC';
            $result=$conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $out[]=$row;
                }
                return $out;
            }
        }
        
        public function query_insertar_nevos_detalles($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $modelo= $param['modelo'];
        $anio= $param['anio'];
        $categoria= $param['categoria'];
        $meta_key= $param['meta_key'];
        $meta_value= $param['meta_value'];

        $sql="INSERT INTO inventario_nuevos_detalles (modelo, anio, categoria, meta_key, meta_value) VALUES ('$modelo', $anio, '$categoria','$meta_key', '$meta_value')";
        $result=$conn->query($sql);
    }

    //AGREGAR AUTO

    public function query_tipo_autos(){
        $conn= Database::connect();
        $sql = 'SELECT * FROM referencia_tipo_vehiculo ORDER BY id';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_insertar_autonuevo($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $marca =$param['marca'];
        $nombre =$param['nombre'];
        $anio =$param['anio'];
        $version =$param['version'];

        $sql = "INSERT INTO versiones (marca, modelo, ano, tipo) VALUES ('$marca', '$nombre', '$anio' ,'$version')";
        $result = $conn->query($sql);
        echo $sql;

        //$sql2="SELECT id from blogs WHERE titulo='$titulo' ORDER BY id DESC LIMIT 1";
        //$result2=$conn->query($sql2);
        //$blog = $result2->fetch_assoc();
    }

    public function query_crear_color($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $color_hex =$param['color_hex'];
        $color_name=$param['color_name'];

        $sql = "INSERT INTO colores_hex_inventario (nombre, color) VALUES ('$color_name', '$color_hex')";
        $result = $conn->query($sql);
    }

    public function query_asignar_color($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $modelo =$param['modelo'];
        $slug =$param['slug'];
        $color =$param['color'];
        $ano=$param['ano'];

        $sql = "INSERT INTO inventario_colores (slug, modelo, ano, color, orden) VALUES ('$slug','$modelo', '$ano', '$color', 2)";
        $result = $conn->query($sql);
    }

    public function query_lista_autos(){
        $conn= Database::connect();
        $sql = 'SELECT modelo FROM versiones group by modelo';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_lista_marcas(){
        $conn= Database::connect();
        $sql = 'SELECT marca FROM versiones group by marca';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_tabla_autos(){
        $conn= Database::connect();
        $sql = 'SELECT marca, modelo, ano, version FROM versiones order by modelo';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_tabla_colores($slug){
        $conn= Database::connect();
        $sql = 'SELECT A.id as Id, A.modelo as Modelo, A.ano as Anio, A.color as Color, A.orden as Orden, B.color as Hexa FROM inventario_colores A join colores_hex_inventario B on A.color = B.nombre WHERE A.slug="'.$slug.'" order by A.modelo, A.ano';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_lista_colores(){
        $conn= Database::connect();
        $sql = 'SELECT nombre, color FROM colores_hex_inventario group by nombre';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_lista_versiones_nissan($modelo, $ano){
        $conn= Database::connect();

        $sql = 'SELECT t1.version , t2.precio, t3.enganche, t3.mensualidad FROM versiones t1 LEFT JOIN catalogo t2 ON t1.tipo=t2.tipo LEFT JOIN planes_nissan t3 ON t2.tipo=t3.tipo WHERE t2.modelo="'.$modelo.'" AND t2.ano="'.$ano.'" group BY t1.version order BY t2.precio';
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_modelos_by_marca($marca){
        // $auto=$auto;
        $conn= Database::connect();
        $sql = "SELECT modelo FROM versiones WHERE marca = '$marca' group by modelo";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }
    public function query_anos_by_model($modelo){
        // $auto=$auto;
        $conn= Database::connect();
        $sql = "SELECT ano FROM versiones WHERE modelo = '$modelo' group by ano";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_lista_colores_by_carro($modeloC, $ano){
        $auto=$auto;
        $conn= Database::connect();
        $sql = "SELECT color FROM inventario_colores WHERE modelo = '$modeloC' and ano = '$ano' group by color";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function query_eliminar_color($param){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $modelo =$param['modelo'];
        $ano=$param['ano'];
        $color =$param['color'];
        $id=$param['id'];

        $sql = "DELETE from inventario_colores WHERE id = '$id'";
        $result = $conn->query($sql);
    }
    
        
    public function query_versiones_sin_version(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $sql = "SELECT * FROM versiones WHERE version is null";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function update_version_versiones($id, $version) {
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        if($id == null){
            return false;
        }

        $sql = "UPDATE versiones SET version='".$version."' WHERE id =".$id;
        $result = $conn->query($sql);
        return $result;
    }

    public function query_select_all_colors(){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $sql = "SELECT * FROM colores_hex_inventario";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }
    public function update_color($id, $nombre, $color){
        $conn = Database::connect();
        $utf8 = $conn->set_charset("utf8");
        if($id == null){
            return false;
        }

        $sql = "UPDATE colores_hex_inventario SET nombre='".$nombre."', color='".$color."' WHERE id =".$id;
        $result = $conn->query($sql);
        return $result;
    }


    public function query_select_cars_by_color($color){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $sql = "SELECT * FROM inventario_colores where color='".$color."' order by ano desc";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function update_inv_versions($param){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");

        $id = $param['id'];
        $orden = $param['orden'];
        $metavalue = $param['metavalue'];
        $icono = $param['icono'];
        $url = 'https://d3s2hob8w3xwk8.cloudfront.net/features/det-'.$icono.'.svg';
        $fecha = date('Y-m-d h:i:s');
        
        $sql="UPDATE inventario_versiones set metavalue='".$metavalue."', icono='".$icono."', url='".$url."', orden='".$orden."' WHERE id='$id'";
        echo $sql;
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    public function blog_id($id){
        $conn = Database::connect();
        $sql = 'SELECT * FROM blogs WHERE id='.$id;
        $result = $conn->query($sql);
        return $result;
    }

    public function query_qrs(){
        $conn = Database::connect();
        $sql = 'SELECT * FROM mkt_qr order by nombre asc';
        $result = $conn->query($sql);
        return $result;
    }

    public function validar_slug_qr($param){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $id = $param["id"];
        $slug = $param["slug"];

        $sql="SELECT * from mkt_qr WHERE slug='$slug'";
        $result=$conn->query($sql);
        return $result;    
    }

    public function query_slug_qr($param){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $id = $param["id"];
        $slug = $param["slug"];

        $sql="UPDATE mkt_qr SET slug='$slug', url='https://www.riverorenta.mx/gruporivero/pdf/$slug.jpg' WHERE id='$id'";
        $result=$conn->query($sql);         
    }

    public function query_update_nombre($param){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $id = $param["id"];
        $nombre_nuevo = $param["nombre_nuevo"];

        $sql="UPDATE promociones SET forma='$nombre_nuevo' WHERE id='$id'";
        $result=$conn->query($sql);         
    }

    //Promociones
    public function query_ano_by_modelo($auto){
        $auto=$auto;
        $conn= Database::connect();
        $sql = "SELECT DISTINCT ano FROM catalogo WHERE modelo = '$auto' ORDER BY ano DESC ";
        $result=$conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

    


//NO BORRAR
}
?>