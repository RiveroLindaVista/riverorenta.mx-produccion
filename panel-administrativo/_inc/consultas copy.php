<?php
class Conexion extends Database{
    public function get_publicidad($pag){
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
}
?>