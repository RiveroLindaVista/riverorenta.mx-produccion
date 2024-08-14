<?php
include_once("consultas.php");

session_start();
class Construir extends Conexion{
   public function get_modelos_taller(){
      $conn=new Conexion();
      $consulta= $conn->query_modelos_taller();
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
         if($consulta[$i]=='AVEO'){
            $cadena.='<option selected value="'.$consulta[$i].'">'.$consulta[$i].'</option>';
         }else{
            $cadena.='<option value="'.$consulta[$i].'">'.$consulta[$i].'</option>';
         }
        }
      }
      return  $cadena;
   }
  public function get_km_taller($modelo){
      $conn=new Conexion();
      $consulta= $conn->query_km_taller($modelo);
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
          $cadena.='<option value="'.$consulta[$i].'">'.$consulta[$i].',000</option>';
        }
      }
      return  $cadena;
  }
  public function get_paquete_taller($modelo,$km){
      $conn=new Conexion();
      $consulta= $conn->query_paquete_taller($modelo,$km);


      if($km!="6"&&$km!="18"&&$km!="30"&&$km!="42"&&$km!="54"&&$km!="66"){
          if ($consulta) {
            for($i=0;$i<count($consulta);$i++){
                if(strpos($consulta[$i]["descripcion"], 'BASICO')){
                  $cadena['BASICO'][]=$consulta[$i];
                }
                if(strpos($consulta[$i]["descripcion"], 'INTERMEDIO')){
                  $cadena['INTERMEDIO'][]=$consulta[$i];
                }
                if(strpos($consulta[$i]["descripcion"], 'COMPLETO')){
                  $cadena['COMPLETO'][]=$consulta[$i];
                }
                 if(strpos($consulta[$i]["descripcion"], 'ESPECIAL')){
                  $cadena['ESPECIAL'][]=$consulta[$i];
                }
              
            }
          $cadenaPaquetes="";
           $arrayTipos=["BASICO","INTERMEDIO","COMPLETO"];
            for($i=0;$i<count($arrayTipos);$i++){
               $total=0;
               
                $cadenaPaquetes2="";
                for($t=0;$t<count($cadena[$arrayTipos[$i]]);$t++){
                  $cadenaPaquetes2.='<li type="disc">'.$cadena[$arrayTipos[$i]][$t]["descripcion_detalle"].'</li>';
                  $total=$total+$cadena[$arrayTipos[$i]][$t]["precf"];
                }
                
                $cadenaPaquetes.='<div class="col taller" data-bs-hover-animate="pulse" data-paquete="'.$arrayTipos[$i].'" data-precio="'. $total.'" data-metakey="servicio-'.$arrayTipos[$i].'"><h3 class="titulo2">'.$arrayTipos[$i].'</h3>';

                $cadenaPaquetes.='<div class="precio"><h3 class="titulo2">$'.number_format($total,2).'</h3></div><hr>';
                $cadenaPaquetes.='<ul class="listaServ">';
                $cadenaPaquetes.=$cadenaPaquetes2;
                $cadenaPaquetes.='</ul>';
                $cadenaPaquetes.='<div class="btnSend">Seleccionar</div></div>';
          }  
       }
     }else{
              $cadenaPaquetes2="";
              $total=0;
                for($t=0;$t<count($consulta);$t++){
                  $cadenaPaquetes2.='<li type="disc">Cambio de Aceite y Filtro</li>';
                  $total=$total+$consulta[$t]["precf"];
                }
                
                $cadenaPaquetes.='<div class="col taller" data-bs-hover-animate="pulse" data-paquete="'.$consulta['paquete'].'" data-precio="'. $total.'" data-metakey="servicio-Cambio de Aceite y Filtro"><h3 class="titulo2">Cambio de Aceite y Filtro</h3>';

                $cadenaPaquetes.='<div class="precio"><h3 class="titulo2">$'.number_format($total,2).'</h3></div><hr>';
                $cadenaPaquetes.='<ul class="listaServ">';
                $cadenaPaquetes.=$cadenaPaquetes2;
                $cadenaPaquetes.='</ul>';
                $cadenaPaquetes.='<div class="btnSend">Seleccionar</div></div>';
     }

      return  $cadenaPaquetes;
  }



  public function get_accesorios($modelo,$amo){
    $conn=new Conexion();
    $consulta= $conn->query_get_accesorios($modelo,$amo);
    $cadenasArray=[];
    if ($consulta) {
      for($i=0;$i<count($consulta);$i++){
        $precioAcc=$consulta[$i]["precio"]+$consulta[$i]["instalacion"];
        $precioAcc=$precioAcc*precio_iva;
        $accesoriosArray=explode(', ',$_SESSION["cotizador"]["accesorios_inv"]);

        $categoria=$consulta[$i]["categoria"];
      
       

        if(!in_array($categoria,$cadenasArray)){
            $cadenasArray[]=$categoria;
            
             $cadenaAcceosrios.='<div style="clear:both;"></div><br><h3>'.ucfirst(strtolower($categoria)).'</h3><div style="clear:both;"></div><br>';
             

        }
       

        if(in_array($consulta[$i]["num_inventario"],$accesoriosArray)){
          $cadenaAcceosrios.=' <div class="colaccesorios2 active" data-precioaccesorio="'.$precioAcc.'" data-inv="'.$consulta[$i]["num_inventario"].'" data-titulo="'.utf8_encode($consulta[$i]["descripcion"]).'" data-metakey="accesorio-articulo-'.utf8_encode($consulta[$i]["descripcion"]).'">';
        
        }else{
           $cadenaAcceosrios.=' <div class="colaccesorios2" data-precioaccesorio="'.$precioAcc.'" data-inv="'.$consulta[$i]["num_inventario"].'" data-titulo="'.utf8_encode($consulta[$i]["descripcion"]).'" data-metakey="accesorio-articulo-'.utf8_encode($consulta[$i]["descripcion"]).'">';
        }

              $cadenaAcceosrios.='<div class="accesorios_catalogo2" data>
               <div class="imagen_alto_acc2">
              <img src="'.URL.'/assets/img/accesorios/'.$consulta[$i]["num_inventario"].'.jpg" class="imgAccesorios" alt="'.utf8_encode($consulta[$i]["descripcion"]).'"/></div>
             <p class="textoAccesorios">'.utf8_encode($consulta[$i]["descripcion"]).'<br>
              <strong class="costoAccesorio" data-precioacc="'.number_format($precioAcc,2).'">$ '.number_format($precioAcc,2).' MXN</strong>
              </p>
              
              </div>
              
            </div>';

       


      }
       
    }
    $cadenaAcceosrios.='<div style="clear:both;"></div>';
    return $cadenaAcceosrios;
  }



  public function get_colores($modelo,$amo,$marca){
    $conn=new Conexion();
    $consulta= $conn->query_colores($modelo,$amo);
    $auto=$conn->cambiarNombre($modelo);
    $path=strtolower($marca).'/'.strtolower($auto["url"]).'-'.$amo;
             for($i=0;$i<count($consulta);$i++){
                $nombreUrlColor2=str_replace(' ','-',$consulta[$i]["color_exterior"]);
                $nombreUrlColor=str_replace('OTO?O','OTONO',utf8_encode($nombreUrlColor2));

                $url=URL.'/assets/img/autos-landing/'.$path.'/colores/'.$nombreUrlColor.'.png';
                $nombreUrlColor=str_replace('OTONO','OTOÑO',utf8_encode($nombreUrlColor));
                 $nombreColor=str_replace('-',' ',utf8_encode($nombreUrlColor));
            
               if($_SESSION["cotizador"]["color"]){
                  if($_SESSION["cotizador"]["color"]==$nombreUrlColor){
                     $cadenaColores.='<div class="nuevos-colores active" data-color="'.$url.'" style="background-color: '.utf8_encode($consulta[$i]["color"]).';" data-bs-hover-animate="pulse" data-nombreColor="'.$nombreUrlColor.'" data-hexacolor="'.$consulta[$i]["color"].'" 
                    data-nombre="'. $nombreColor.'" data-metakey="btn cambio color-'.str_replace('-', '', $modelo).'-'.$amo.'-'.str_replace('-','',$nombreUrlColor).'"></div>';
                  }else{
                     $cadenaColores.='<div class="nuevos-colores" data-color="'.$url.'" style="background-color: '.utf8_encode($consulta[$i]["color"]).';" data-bs-hover-animate="pulse" data-nombreColor="'.$nombreUrlColor.'" data-hexacolor="'.$consulta[$i]["color"].'" 
                    data-nombre="'. $nombreColor.'" data-metakey="btn cambio color-'.str_replace('-', '', $modelo).'-'.$amo.'-'.str_replace('-','',$nombreUrlColor).'"></div>';
                  
                  }
               }else{
                  if($i==0){
                         $cadenaColores.='<div class="nuevos-colores active" data-color="'.$url.'" style="background-color: '.utf8_encode($consulta[$i]["color"]).';" data-bs-hover-animate="pulse" data-nombreColor="'.$nombreUrlColor.'" data-hexacolor="'.$consulta[$i]["color"].'" 
                        }
                        data-nombre="'. $nombreColor.'" data-metakey="btn cambio color-'.str_replace('-', '', $modelo).'-'.$amo.'-'.str_replace('-','',$nombreUrlColor).'"></div>';
                      }else{
                        $cadenaColores.='<div class="nuevos-colores" data-color="'.$url.'" style="background-color: '.utf8_encode($consulta[$i]["color"]).';" data-bs-hover-animate="pulse" data-nombreColor="'.$nombreUrlColor.'" data-hexacolor="'.$consulta[$i]["color"].'" 
                        }
                        data-nombre="'. $nombreColor.'" data-metakey="btn cambio color-'.str_replace('-', '', $modelo).'-'.$amo.'-'.str_replace('-','',$nombreUrlColor).'"></div>';
                      }
               }
               
               
             }
             $cadenaColores.='<div style="clear:both;"></div>';
         return ["cadenaBanner"=>$cadenaColores,"cantidad"=>count($consulta)];
        
  }
  public function get_comparativa_versiones($modelo,$amo,$versionesParam){
     $conn=new Conexion();
    $consulta= $conn->query_get_comparativa_versiones($modelo);
    $comparativa= $conn->query_total_comparativas($modelo,$amo);
    $arrayComparativa=[];
    if($comparativa){
      for($i=0;$i<count($comparativa);$i++){

          $paramero[$comparativa[$i]["version"]][utf8_encode($comparativa[$i]["nombre"])]=utf8_encode($comparativa[$i]["valor"]);
          if(!in_array(utf8_encode($comparativa[$i]["nombre"]), $arrayComparativa)){
             $arrayComparativa[]=utf8_encode($comparativa[$i]["nombre"]);
          }
      }

    }

    if($consulta){
      $ventajas=count($consulta);
      for($i=0;$i<count($arrayComparativa);$i++){
        $cadenaComparativa.='<tr>';
        $espacioFinal="";
        if($i%2==0){
          $espacioFinal.='<td  class="tblAzul1"  width="700" style="font-size:13px;">&nbsp;</td>';
              $cadenaComparativa.= '<td  class="tblAzul0"  width="700" style="font-size:13px;">'.$arrayComparativa[$i].'</td>';
      
        }else{
          $espacioFinal.='<td  class="tblAzul0"  width="700" style="font-size:13px;">&nbsp;</td>';
          $cadenaComparativa.= '<td class="tblAzul1"  width="700" style="font-size:13px;">'.$arrayComparativa[$i].'</td>';
              
        }

        if($i%2==0){
    
          for($t=0;$t<count($versionesParam);$t++){

            $espacioFinal.='<td class="espacio"></td><td  class="tblAzul001" width="50">&nbsp;</td>';

            if($t==0){
              $cadenaComparativa.= '<td class="espacio"></td><td  class="tblAzul01 active"  width="50" data-col="'.$t.'">';
            }else{
              $cadenaComparativa.= '<td class="espacio"></td><td  class="tblAzul01"  width="50" data-col="'.$t.'">';
            }


            if($paramero[$versionesParam[$t]][$arrayComparativa[$i]]=="SI"){
              $cadenaComparativa.= '<img src="/assets/img/commun/ok_icon.png" width="10px" alt="icon ok"/>';
            }else{
              $cadenaComparativa.= $paramero[$versionesParam[$t]][$arrayComparativa[$i]];
            }
            $cadenaComparativa.= '</td>';
            
          }
        }else{
          

          for($t=0;$t<count($versionesParam);$t++){
            $espacioFinal.='<td class="espacio"></td><td  class="tblAzul01"  width="50">&nbsp;</td>';

            if($t==0){
              $cadenaComparativa.= '<td class="espacio"></td><td  class="tblAzul001 active"  width="50" data-col="'.$t.'">';
            }else{
              $cadenaComparativa.= '<td class="espacio"></td><td  class="tblAzul001"  width="50" data-col="'.$t.'">';
            }

            if($paramero[$versionesParam[$t]][$arrayComparativa[$i]]=="SI"){
              $cadenaComparativa.= '<img src="/assets/img/commun/ok_icon.png" width="10px" alt="icon ok"/>';
            }else{
              $cadenaComparativa.= $paramero[$versionesParam[$t]][$arrayComparativa[$i]];
            }
            $cadenaComparativa.= '</td>';
            
          }
        }


        $cadenaComparativa.= '</tr>';
      }
    }
    return ["cadenaComparativa"=>$cadenaComparativa,"espacioFinal"=> $espacioFinal];

  }
  public function get_versiones($modelo,$amo){
      $conn=new Conexion();
      $consulta= $conn->query_get_versiones($modelo,$amo);
      $colores_versiones=Construir::get_colores_disponibles_info($modelo,$amo);

      $versionesParam=[];
       if($consulta){
        $totalVersiones=count($consulta);
        $numero=2;
           for($i=0;$i<count($consulta);$i++){
                $versionesParam[]=$consulta[$i]["version"];
                  $espacios.='<td class="espacio"  width="5"></td><td class="tblAzul'.$numero.'" width="50" data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'" data-metakey="cambio-version-'.$modelo.'-'.$consulta[$i]["version"].'">  </td>';
     
                 $versiones.='<td class="espacio" width="5"></td><td class="tblAzul'.$numero.'" width="50"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'" data-metakey="cambio-version-'.$modelo.'-'.$consulta[$i]["version"].'"><div class="titulo">'.$consulta[$i]["version"].'</div></td>';

                 $precio.='<td class="espacio" width="5"></td><td class="tblAzul'.$numero.'" width="50" data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'" data-metakey="cambio-version-'.$modelo.'-'.$consulta[$i]["version"].'"><div class="precio" data-precio="'.$consulta[$i]["precio"].'"></div></td>';
                 if($numero==2){
                    $espaciosCheck.='<td class="espacio" width="5"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'" data-metakey="cambio-version-'.$modelo.'-'.$consulta[$i]["version"].'"></td><td class="tblAzul'.$numero.'" width="50"  data-version="'.$consulta[$i]["version"].'"> <center>
                      <input type="radio" class="option-input radio" name="version" checked data-precio="'.$consulta[$i]["precio"].'" data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'"  data-versionnum="'.$numero.'"/> </center></td>';
                }else{
                  if($numero==count($consulta)+1){
                    $espaciosCheck.='<td class="espacio" width="5"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'"></td><td class="tblAzul'.$numero.'"  width="150"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'"><center> <input type="radio" class="option-input radio" name="version" data-precio="'.$consulta[$i]["precio"].'"  data-version="'.$consulta[$i]["version"].'" data-versionnum="'.$numero.'"/> </center></td>';
                  }else{
                     $espaciosCheck.='<td class="espacio" width="5"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'"></td><td class="tblAzul'.$numero.'"  width="50"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'"><center> <input type="radio" class="option-input radio" name="version" data-precio="'.$consulta[$i]["precio"].'"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'" data-versionnum="'.$numero.'" data-metakey="cambio-version-'.$modelo.'-'.$consulta[$i]["version"].'"/> </center></td>';
                  }
                }
                if($colores_versiones[$consulta[$i]["version"]]!=""){

                    $ESPACIOCOLORES.='<td class="espacio" width="5"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'"></td>
                      <td class="tblAzul'.$numero.'"  width="50"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'">'.$colores_versiones[$consulta[$i]["version"]].'</td>';
                  }else{
                      $ESPACIOCOLORES.='<td class="espacio" width="5"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'"></td>
                      <td class="tblAzul'.$numero.'"  width="50"  data-version="'.str_replace(' ', '-', $consulta[$i]["version"]).'">sobre pedido</td>';
                  }

                $numero++;
           }
       }
      return ["totalVersiones"=> $totalVersiones,"versionesParam"=>$versionesParam,"espacios"=>$espacios,"versiones"=>$versiones,"precio"=>$precio,"espaciosCheck"=>$espaciosCheck,"ESPACIOCOLORES"=>$ESPACIOCOLORES];
  }

  public function get_nacionalidad($paisActual,$nacionalidad){
      $conn=new Conexion();
      $consulta= $conn->query_get_nacionalidad($paisActual);
       if($consulta){
          for($i=0;$i<count($consulta);$i++){
            if($nacionalidad==$consulta[$i]->nacionalidad){
             $cedena.= '<option selected>'.$consulta[$i]->nacionalidad.'</option>';
            }else{
              $cedena.= '<option>'.$consulta[$i]->nacionalidad.'</option>';
            }
          }
          return $cedena;
       }
  }
   public function get_estados($paisActual,$estado_actual){
     $conn=new Conexion();
      $consulta= $conn->query_get_estados($paisActual);
       if($consulta){
          for($i=0;$i<count($consulta);$i++){
            if($estado_actual==$consulta[$i]->estado){
             $cedena.= '<option selected>'.$consulta[$i]->estado.'</option>';
            }else{
              $cedena.= '<option>'.$consulta[$i]->estado.'</option>';
            }
          }
          return $cedena;
       }
  }
  public function get_paises($paisActual){
     $conn=new Conexion();
      $consulta= $conn->query_get_paises();
       if($consulta){
          for($i=0;$i<count($consulta);$i++){
            if($paisActual==$consulta[$i]->pais){
             $cedena.= '<option selected>'.$consulta[$i]->pais.'</option>';
            }else{
              $cedena.= '<option>'.$consulta[$i]->pais.'</option>';
            }
          }
          return $cedena;
       }
  }
  public function get_cuenta($id){
      $conn=new Conexion();
      $consulta= $conn->query_get_cuenta($id);
       if($consulta){
          for($i=0;$i<count($consulta);$i++){
            $param[$consulta[$i]->meta_key]= $consulta[$i]->meta_value;
          }
          return $param;
       }

  }
  public function get_blogs(){
      $conn=new Conexion();
      $consulta= $conn->query_all_blogs();
      

          if($consulta){
             
          for($i=0;$i<count($consulta);$i++){

                  $titulo= $consulta[$i]->titulo;
                  $titulo=strtolower($titulo);
                  $titulo=str_replace(' ', '-', $titulo);
                  $titulo=str_replace('?', '', $titulo);
                  $titulo=str_replace('¿', '', $titulo);
                  $titulo=str_replace('!', '', $titulo);
                  $titulo=str_replace('¡', '', $titulo);
                  $titulo=str_replace('ó', 'o', $titulo);
                  $titulo=str_replace('Ó', 'o', $titulo);
                  $titulo=str_replace('á', 'a', $titulo);
                  $titulo=str_replace('í', 'i', $titulo);
                  $titulo=str_replace('ú', 'u', $titulo);
                  $date=date_create($consulta[$i]->fecha);
                  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                  $fechaFormat=date_format($date,"d").' de '.$meses[date_format($date,'n')-1].' del '.date_format($date,"Y H:i:s");

            if($i==0){
               $cadena.='<div class="noticia1">
                  <a href="../blog/'.$titulo.'" ><div class="imgArea" data-bs-hover-animate="pulse"><img src="'.URL.'/assets/img/blog/'.$consulta[$i]->id.'/portada.png" width="100%" alt="imagen portada"/></div><h4>'.$consulta[$i]->titulo.'</h4><p>'.$consulta[$i]->descripcion.'</p></a></div><div style="clear: both;"></div>';
              }
              if($i>=1&&$i<4){
                $cadena.='<div class="noticia'.($i+1).'">
                    <a href="blog/'.$titulo.'" ><div class="imgArea" data-bs-hover-animate="pulse"><img src="'.URL.'/assets/img/blog/'.$consulta[$i]->id.'/portada.png" width="100%" alt="imagen portada"/></div><h4>'.$consulta[$i]->titulo.'</h4></a>
                  </div><div style="clear: both;"></div>';
           
            }
            $noticias.='  <div class="noticias">
                      <a href="../blog/'.$titulo.'">
                        <div class="col2"><div class="imgArea2" data-bs-hover-animate="pulse">
                          <img src="'.URL.'/assets/img/blog/'.$consulta[$i]->id.'/portada.png" width="100%" alt="imagen blog"/></div>
                        </div>
                        <div class="col2">
                          <h4>'.$consulta[$i]->titulo.'</h4><p>'.substr($consulta[$i]->descripcion, 0,100).'... ver mas</p>

                          <div class="fechaBlog">Publicado '.$fechaFormat.'</div>
                        </div>
                      </a>
                      <div style="clear: both;"></div></div>';
             
          }
         return $out=["not1"=>$cadena,"not2"=> $noticias]; 
        }
       
  }
  public function create_new_blog($params){
     $conn=new Conexion();
    $conne= $conn->create_new_blog($params);

  }
   public function get_blog_byId($blogId){
       $conn=new Conexion();
        $conne= $conn->query_get_blog_by_id($blogId);
        $consulta=json_encode($conne,true);

        
        $param["titulo"]=utf8_encode($conne["titulo"]);
         $param["contenido"]=utf8_encode($conne["contenido"]);
         $date=date_create($conne["fecha"]);
         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $param["fecha"]=date_format($date,"d").' de '.$meses[date_format($date,'n')-1].' del '.date_format($date,"Y H:i:s");
         return $param;
        

   }
     public function banners_web($meta_key){
        $conn=new Conexion();
        $conne= $conn->query_banners($meta_key);
        $consulta=json_decode($conne,true);
        $cadena="";$indicadores="";
        if($consulta){
            $num=0;
           foreach ($consulta as $value) {

                if($num==0){
                   

                    if($value["tipo"]==1){
                    	 $cadena.='<div data-slide="'.$num.'" class="banner-item active" data-tipo="0">';
                     $cadena.='<video autoplay muted loop autobuffer ><source src="'.URL.'/assets/banners/media/'.$value["meta_value"].'.mp4" type="video/mp4"><source src="'.URL.'/assets/banners/media/'.$value["meta_value"].'.webm" type="video/webm">Su navegador no soporta la etiqueta de vídeo.</video>';
              		}else{
              			 $cadena.='<div data-slide="'.$num.'" class="banner-item active" data-tipo="1">';
              			 $cadena.='<a href="'.URL.'/'.$value["titulo"].'"><img src="'.URL.'/assets/banners/img/'.$value["meta_value"].'" alt="'.$value["titulo"].'" width="100%"/></a>';
              		}


                    $indicadores.='<li class="homepage_slider active" data-num="'.$num.'" data-metakey="clic-banner-inicio-indicador-'.$num.'"></li>';
                }else{
                    if($value["tipo"]==1){
                    	 $cadena.='<div data-slide="'.$num.'" class="banner-item" data-tipo="0">';
                     	$cadena.='<video muted loop autobuffer ><source src="'.URL.'/assets/banners/media/'.$value["meta_value"].'.mp4" type="video/mp4"><source src="'.URL.'/assets/banners/media/'.$value["meta_value"].'.webm" type="video/webm">Su navegador no soporta la etiqueta de vídeo.</video>';
              		}else{
              			 $cadena.='<div data-slide="'.$num.'" class="banner-item" data-tipo="1">';
              			  $cadena.='<a href="'.URL.'/'.$value["titulo"].'"><img src="'.URL.'/assets/banners/img/'.$value["meta_value"].'" alt="'.$value["titulo"].'" width="100%"/></a>';
              		}


                    $indicadores.='<li class="homepage_slider" data-num="'.$num.'" data-metakey="clic-banner-inicio-indicador-'.$num.'"></li>';
                }
              
               


                   $cadena.='</div>';

                   $num++;

            }
            return $out=["banner"=>$cadena,"indicador"=>$indicadores]; 
        }
     }

     public function get_reviews(){
        $_numeros=[0,1,2,3,4,5,6,7,8,9,10];
        $_nombres=["Jose Garza","José Olvera Ruizanchez","Martha Elena Silva Castillo","Izak Chavez","familia","Juan Carlos Solís Castillo","Mario Rodriguez Gonzalez","Melissa Anahi Torres Vega","Mario Carrillo","robert 509","Antonio Guerrero","Andrea Galván"];
        $_fecha=["Dic 13, 2018","Dic 24,2018","Dic 10,2018","Feb 26,2019","Feb 25,2019","Feb 20,2019","Feb 27, 2019","Mar 29 2019","Abr 02 2019","Mar 20 2019","Abr 28 2019","Abr 10 2019"];
        $_comentario=[
            "Buena Agencia y Buen trato de parte de los empleados..aparte de los refrigerios que te obsequian en tu visita para los diferentes trámites.",
            "Trato excelente por el asesor de ventas, instalaciones cómodas, cuenta con área de juegos infantiles y sanitarios.",
            "Excelente Servicio y Atención!!! Muchas Gracias a todos por sus atenciones en especial a la Srita. Laura Burciaga.","Muy amables las personas que trabajan ahí","Excelente atención de jakelin, Christian diaz y todo el personal....","Buena atención cuando fui al mantenimiento.","Muy buena atención!","Muy buen servicio, estamos muy contentos con la atención que nos brindaron además que nos entregaron rápido el carro.","Muy buena atención","Excelente atención gracias a nuestro ejecutivo de ventas  Angel Esparza muy buena atención y trato sin duda fue nuestra mejor elección gracias","Excelente atendía.  Buen trato y buen servicio","Muy buen servicio, recién compre mi carro 🚘   es de las mejores marcas y muy rendidores en cuanto a la gasolina. "];
        $random_aleatorias = array_rand($_numeros,3);
        for($i=0;$i<3;$i++){
          if($i==0){
            $cadena.='<div class="home-review-item active" data-idrev="'.$i.'">';
          }else{
             $cadena.='<div class="home-review-item" data-idrev="'.$i.'">';
          }
                     $cadena.=' <div class="home-review-meta">
                        <span class="home-review-author">'. $_nombres[$random_aleatorias[$i]].'</span>
                        <span class="home-review-date">'.$_fecha[$random_aleatorias[$i]].'</span>
                    </div>
                    <div class="home-review-stars">
                        <ul>
                            <li>
                                <i class="home-star"></i>
                            </li>
                                <li>
                                    <i class="home-star"></i>
                            </li>
                            <li>
                                <i class="home-star"></i>
                            </li>
                            <li>
                                <i class="home-star"></i>
                            </li>
                            <li>
                                <i class="home-star"></i>
                            </li>
                        </ul>
                    </div>
                    <p class="home-review-text">'.$_comentario[$random_aleatorias[$i]].'</p>
                </div>';
          
        }
                
            
            return $cadena; 
        
     }

      public function get_colores_disponibles($modelo,$ano,$path){
         $conn=new Conexion();
        $consulta= $conn->query_inv_colores_disponibles($modelo,$ano);
        if($consulta){
          for($i=0;$i<count($consulta);$i++){

                $nombreUrlColor2=str_replace(' ','-',$consulta[$i]->color_exterior);
                $nombreUrlColor=str_replace('OTO?O','OTONO',utf8_encode($nombreUrlColor2));

                $url=URL.'/assets/img/autos-landing/'.$path.'/colores/'.$nombreUrlColor.'.png';
                $nombreUrlColor=str_replace('OTONO','OTOÑO',utf8_encode($url));
                 $nombreColor=str_replace('-',' ',utf8_encode($nombreUrlColor));


            $cadena.='<div class="coloresDis" data-hexa="'.$consulta[$i]->color.'" data-vin="'.$consulta[$i]->vin.'" data-color="'.$consulta[$i]->color_exterior.'" data-stock="'.$consulta[$i]->stock.'" data-version="'.$consulta[$i]->version.'" data-cantidad="'.$consulta[$i]->cantidad.'" style="background-color:'.$consulta[$i]->color.'" data-urlp="'.$nombreUrlColor.'"><label>'.$consulta[$i]->cantidad.'</label></div>';
          }
        }
        return $cadena;

     }

     public function get_colores_disponibles_info($modelo,$ano){
         $conn=new Conexion();
        $consulta= $conn->query_inv_colores_disponibles($modelo,$ano);
        if($consulta){
         
          for($i=0;$i<count($consulta);$i++){
           // $cadena[$consulta[$i]->version].='<div class="coloresDis2" style="background-color:'.$consulta[$i]->color.'"><label>'.$consulta[$i]->cantidad.'</label></div>';
             //$cadena[$consulta[$i]->version].='<div class="coloresDis2" style="background-color:'.$consulta[$i]->color.'"></div>';
            $cadena[$consulta[$i]->version]=$consulta[$i]->cantidad;
          }
        }
        return $cadena;

     }
     public function get_carrusel(){
        $conn=new Conexion();
        $conne= $conn->query_carrusel();
        $consulta= $conne;
        $tipoAutos=["Autos","Suv's","Pickups","Vans y Comerciales","Deportivos","Eléctricos"];
        if($consulta){
          $tipo_vehiculo=[];
          for($i=0;$i<count($consulta);$i++){
            if(!in_array($consulta[$i]->tipo_vehiculo, $tipo_vehiculo)){
              $tipo_vehiculo[]=$consulta[$i]->tipo_vehiculo;
            }
              $unidad[$consulta[$i]->tipo_vehiculo]["marca"][]=$consulta[$i]->marca;
              $unidad[$consulta[$i]->tipo_vehiculo]["modelo"][]=$consulta[$i]->modelo;
              $unidad[$consulta[$i]->tipo_vehiculo]["ano"][]=$consulta[$i]->ano;
          }
          for($i=0;$i<count($tipo_vehiculo);$i++){
            if($i==0){

              $cadena.='<div id="cat_'.($i+1).'" class="home-cat active"> <h4>Autos</h4>';
            }else{
              $cadena.='<div id="cat_'.($i+1).'" class="home-cat">  <h4>'.$tipoAutos[$i].'</h4>';
            }
            $cantidadRows=ceil(count($unidad[$tipo_vehiculo[$i]]["modelo"])/5);
             $cantidadRows=$cantidadRows*5;
             
            
            if($cantidadRows==0){
              $cantidadRows=6;
            }
            for($t=0;$t<$cantidadRows;$t++){
              if($t==0){
                 $cadena.='<div class="row">';
               };
               if($t%5==0&&$t!=0){
                 $cadena.='</div><div class="row">';
               };
               if($unidad[$tipo_vehiculo[$i]]["modelo"][$t]!=""){
              
                  if(strstr($unidad[$tipo_vehiculo[$i]]["modelo"][$t],'CAMARO')||strstr($unidad[$tipo_vehiculo[$i]]["modelo"][$t],'CORVETTE')){
                  		$marcaP='performance';
                      $urlLink='performance-'.str_replace(' ','%20', $unidad[$tipo_vehiculo[$i]]["modelo"][$t]).'-'.$unidad[$tipo_vehiculo[$i]]["ano"][$t];
	                }else{
	                	$marcaP=$unidad[$tipo_vehiculo[$i]]["marca"][$t];
	                    $urlLink=$unidad[$tipo_vehiculo[$i]]["marca"][$t].'-'.str_replace(' ','%20', $unidad[$tipo_vehiculo[$i]]["modelo"][$t]).'-'.$unidad[$tipo_vehiculo[$i]]["ano"][$t];
	                }




                  $urlLink=strtolower($urlLink);

                  $urlLink=str_replace('c-20', 'c%20',  $urlLink);
                  $urlLink=str_replace('c-20-crew', 'c%2020%20crew',  $urlLink);
                  $urlLink=str_replace('c-35', 'c%2035',  $urlLink);

                  $imgLink=str_replace(' ','-', $marcaP.'/'.$unidad[$tipo_vehiculo[$i]]["modelo"][$t].'-'.$unidad[$tipo_vehiculo[$i]]["ano"][$t].'/colores/');
                  $imgLink=str_replace('--','-', strtolower($imgLink));


                  $modeloP= $unidad[$tipo_vehiculo[$i]]["modelo"][$t];
                  $modeloP=str_replace('SILVERADO', 'c-20',   $modeloP);
                  $modeloP=str_replace('c-20-crew', 'c-20 crew',   $modeloP);

                  $colorP= $conn->query_color_principal($modeloP,$unidad[$tipo_vehiculo[$i]]["ano"][$t]);
                  //echo '<hr>'.$modeloP.'/'. $colorP.'<br>';
                  
                  $imgLink=$imgLink.$colorP;
                   //echo $imgLink.'<br>';
                 
                  if($unidad[$tipo_vehiculo[$i]]["ano"][$t]!=date(Y)){
                    $nombreUnidad=$unidad[$tipo_vehiculo[$i]]["modelo"][$t].' '.$unidad[$tipo_vehiculo[$i]]["ano"][$t];
                  }else{
                     $nombreUnidad=$unidad[$tipo_vehiculo[$i]]["modelo"][$t];
                  }
                 
                   
                  $nombreUnidad=str_replace('C-20 CREW', 'CHEYENNE', $nombreUnidad);
                  $nombreUnidad=str_replace('C-20', 'SILVERADO 2500', $nombreUnidad);
                  $nombreUnidad=str_replace('C-35', 'SILVERADO 3500', $nombreUnidad);
                  /*$imgLink=str_replace('C-20-CREW', 'CHEYENNE', $imgLink);
                  $imgLink=str_replace('C-20', 'SILVERADO', $imgLink);
                  $imgLink=str_replace('C-35', 'SILVERADO-3500', $imgLink);*/
                  
                  $imgLink=str_replace('cheyenne', 'c-20-crew', $imgLink);
                  $imgLink=str_replace('silverado', 'c-20', $imgLink);

                  $cadena.='<div class="col">
                      <a href="/'.$urlLink.'" data-metakey="carrusel-inicio-'.$nombreUnidad.'">
                      <img src="'.URL.'/assets/img/autos-landing/'.$imgLink.'.png" data-bs-hover-animate="pulse" style="width: 100%;" alt="vista '.$nombreUnidad.'">
                      <label class="text-center" style="width: 100%;">'.$nombreUnidad.'</label></a>
                  </div>';
                          
               }else{
                 // $cadena.='<div class="col"></div>';
               }
               
              if(($cantidadRows-1)==$t){
                 $cadena.='</div>';
               };

            }
           

            $cadena.='</div>';
          }


        }

        return $cadena;
     }



     public function get_all_catalogo_nuevos($marca){
        $conn=new Conexion();
        $conne= $conn->query_all_nuevos();
        $consulta= $conne;
        if($_SESSION["cotizador"]["enganche"]){
            $enganche=$_SESSION["cotizador"]["enganche"];
            $meses=$_SESSION["cotizador"]["meses"];
        }else{
            $_SESSION["cotizador"]["enganche"]=10;
            $_SESSION["cotizador"]["meses"]=60; 
            $_SESSION["cotizador"]["condicion"]="CRÉDITO";
            $enganche=10;
            $meses=60;
        }
         if($consulta){

              for($i=0;$i<count($consulta);$i++){
                $pagoInicial=($consulta[$i]->precio*($enganche/100));
                $financiado=$consulta[$i]->precio- $pagoInicial;
                $nombreVisible=$consulta[$i]->modelo;
                $modelo_url=str_replace(' ', '-', $consulta[$i]->modelo);
                $modelo_ano= $modelo_url.'-'.$consulta[$i]->ano;
               

                if($nombreVisible=="C-20"){
                    $nombreVisible="SILVERADO 2500";
                    $modelo_ano="SILVERADO-".$consulta[$i]->ano;
                    $url_link="chevrolet-silverado%202500-".$consulta[$i]->ano;
                }
                if($nombreVisible=="C-20 CREW"){
                    $nombreVisible="CHEYENNE";
                     $modelo_ano="CHEYENNE-".$consulta[$i]->ano;
                      $url_link="chevrolet-cheyenne-".$consulta[$i]->ano;
                }
                if($nombreVisible=="C-35"){
                    $nombreVisible="SILVERADO 3500";
                    $modelo_ano="SILVERADO-3500-".$consulta[$i]->ano;
                    $url_link="chevrolet-silverado%203500-".$consulta[$i]->ano;
                }
               
                if(strstr($nombreVisible,'CAMARO')||strstr($nombreVisible,'CORVETTE')){
                    $consulta[$i]->marca="performance";
                     $url_link=strtolower('performance-'.str_replace('-','%20',$modelo_url).'-'.$consulta[$i]->ano);
                }else{
                   $url_link=strtolower($consulta[$i]->marca.'-'.str_replace('-','%20',$modelo_url).'-'.$consulta[$i]->ano);
                }

                 if($marca==strtolower($consulta[$i]->marca)){
                     $cadena.='<div class="col-md-6 col-lg-4 items active" id="card-'.$i.'" data-sort="'.$consulta[$i]->precio.'" data-marca="'.$consulta[$i]->marca.'" data-category="'.$consulta[$i]->tipo_vehiculo.'" data-nombre="'.$consulta[$i]->modelo.'" data-metakey="catalogo-nuevos-auto-'.$consulta[$i]->modelo.'" data-precio="'.$consulta[$i]->precio.'" style="display: block; opacity: 1;">';
                 }else{
                     $cadena.='<div class="col-md-6 col-lg-4 items" id="card-'.$i.'" data-sort="'.$consulta[$i]->precio.'" data-marca="'.$consulta[$i]->marca.'" data-category="'.$consulta[$i]->tipo_vehiculo.'" data-nombre="'.$consulta[$i]->modelo.'" data-metakey="catalogo-nuevos-auto-'.$consulta[$i]->modelo.'" data-precio="'.$consulta[$i]->precio.'" style="display: none; opacity: 0;">';
                 }
                 

                          $cadena.='<a href="'.URL.'/'.$url_link.'">
                        <div class="card border-dark">
                         <div class="card-body">
                                <h4 class="class-titulo">'.str_replace('CORVETTE ', '', $nombreVisible).'</h4>';

                              
                          if($consulta[$i]->ano<=date('Y')){
                           $cadena.='<div class="card-anio">'.$consulta[$i]->ano.'</div>';
                         } else{
                             $cadena.='<div class="card-anio_new">'.$consulta[$i]->ano.'</div>';
                         } 


                           $cadena.='<div class="areaImgAuto">
                             <img src="'.URL.'/assets/img/autos/'.$modelo_ano.'.png" class="autoImg" data-bs-hover-animate="pulse" alt="'.$modelo_ano.'">
                          </div>
                          <div style="clear: both;"></div>';

                          if($consulta[$i]->ano<=date('Y')){
                           $cadena.='<div class="cintilla">';
                         } else{
                             $cadena.='<div class="cintilla_new">';
                         } 

                            $cadena.='<label class="class-des-enganche" id="eng-'.$i.'" data-precio="'.$consulta[$i]->precio.'">$'.number_format($pagoInicial,2).'
                          /<i>Enganche</i>
                            </label>
                               <br>
                               <label class="class-des-mensual" id="precio-'.$i.'" data-precio="'.$consulta[$i]->precio.'">
                              $<script type="text/javascript">
                                var balance = "'.$financiado.'";
                                var meses='.$meses.';
                                var resultado=autos_nuevos_interes(meses,balance);
                                 document.write(resultado);
                                </script><i> / mens</i>
                                </label>
                              <div class="disponibles">'.$consulta[$i]->totalstock.' Disponibles</div>
                                </div>
                            </div>
                        </div></a></div>';
                    }

              }
         
        return  $cadena;
     }
      public function get_all_catalogo_seminuevos(){
        $conn=new Conexion();
        $conne= $conn->query_all_seminuevos();
        $consulta= $conne;
        if($_SESSION["cotizador"]["enganche"]){
            $enganche=$_SESSION["cotizador"]["enganche"];
            $meses=$_SESSION["cotizador"]["meses"];
        }else{
            $_SESSION["cotizador"]["enganche"]=30;
            $_SESSION["cotizador"]["meses"]=24;
            $_SESSION["cotizador"]["condicion"]="CRÉDITO";
            $enganche=30;
            $meses=24;
        }
         if($consulta){
          for($i=0;$i<count($consulta);$i++){
           
            $url_link='catalogo/seminuevos/'.sha1($consulta[$i]->stock);
            $inv=$consulta[$i]->stock;
            $marca=$consulta[$i]->marca;
            $nombreVisible=$consulta[$i]->nombre;
            $km=$consulta[$i]->km;
            $trans=$consulta[$i]->trans;
            $ano=$consulta[$i]->year;
            $precio=$consulta[$i]->precio;
            $sucursal=str_replace("RIVERO ", "", $consulta[$i]->sucursal);
             $sucursal=str_replace(' ', '-',  $sucursal);
            $modelo_ano='';
            $vin=$consulta[$i]->vin;
            $pagoInicial=($consulta[$i]->precio*($enganche/100));
            $financiado=$consulta[$i]->precio- $pagoInicial;
            $objEng=('#eng-'.$i);
            $nombreVisible= $nombreVisible;
            
            $engancheDespliegue="";
            if($ano>"2012"){
              $engancheDespliegue="$".number_format($pagoInicial,2)."<i> / eng</i>";
            }
          
              $cadena.='<div class="col-md-6 col-lg-4 items2 active" id="card-'.$i.'" data-precio="'.$precio.'" data-marca="'.$marca.'" data-anio="'.$ano.'" data-nombre="'.$nombreVisible.'" data-km="'.$km.'" data-trans="'.$trans.'" data-metakey="'.$nombreVisible.'" data-sucursal="'.$sucursal.'">
                   
                <a href="../../'.$url_link.'">
                        <div class="card border-dark">
                        
                          <span class="semi-titulo">'.$nombreVisible.'</span>
                    <div class="areaContenidoSem"><span class="semi-tipo">Trans </span><span class="semi-transValue">'.$trans.'</span></div>

                          <div class="semi-areaImgAuto"><center><img src="'.URLSeminuevos.'/APPS/subastas/images/principal/inv_'.$inv.'/imagen-preview.png" alt="'.$nombreVisible.'" class="semi-autoImg" data-bs-hover-animate="pulse"/></center> </div>
                          <div class="semi-cintilla">

                                <label class="semi-des-mensual" id="precio-'.$i.'" data-precio="'.$precio.'" data-anio="'.$ano.'">
                               <script type="text/javascript">
                                var resultado=autos_seminuevos_interes("'.$meses.'","'.$financiado.'","'.$ano.'","'.$enganche.'","'.$objEng.'");
                                 document.write(resultado);
                                </script>
    
                            </label>

                                <div class="semi-disponibles">
                                  <label class="anio">'.$ano.'</label>
                                  <label class="marcaCinta">'.$marca.'</label>
                                  &nbsp;
                                    
                                </div>
                               </div>
                              
                               <br>
                               <div>
                                 <label class="semi-des-enganche" id="eng-'.$i.'" data-precio="'.$precio.'" data-anio="'.$ano.'">'.$engancheDespliegue.'</label>
                               
                      
                               </div>

                         </div>
                      </a>
                        
                    </div> ';

              
           }
        }
         
        return  $cadena;
     }

      public function get_banner_nuevos($nombre1,$nombre2,$ano,$path){
        $conn=new Conexion();
        $conne= $conn->query_banner_nuevos($nombre1,$nombre2,$ano);
        $consulta= $conne;
       
         if($consulta){
             for($i=0;$i<count($consulta);$i++){
                $nombreUrlColor2=str_replace(' ','-',$consulta[$i]->color_exterior);
                $nombreUrlColor=str_replace('OTO?O','OTONO',utf8_encode($nombreUrlColor2));

                $url=URL.'/assets/img/autos-landing/'.$path.'/colores/'.$nombreUrlColor.'.png';
                $nombreUrlColor=str_replace('OTONO','OTOÑO',utf8_encode($nombreUrlColor));
                 $nombreColor=str_replace('-',' ',utf8_encode($nombreUrlColor));
               
                if($i==0){
                  $cadenaColores.='<div class="nuevos-color active" data-color="'.$url.'" style="background-color: '.$consulta[$i]->color.';" data-bs-hover-animate="pulse" data-nombreColor="'.$nombreUrlColor.'" data-hexacolor="'.$consulta[$i]->color.'" data-nombre="'. $nombreColor.'"  data-metakey="btn cambio color-'.str_replace('-', '', $nombre1).'-'.$ano.'-'.str_replace('-','',$nombreUrlColor).'">
                  <i>'.$nombreColor.'--</i></div>';
                    $primerColor=$path.'/colores/'.$nombreUrlColor.'.png';
                }else{
                  $cadenaColores.='<div class="nuevos-color" data-color="'.$url.'" style="background-color: '.utf8_encode($consulta[$i]->color).';" data-bs-hover-animate="pulse" data-nombreColor="'.$nombreUrlColor.'" data-hexacolor="'.$consulta[$i]->color.'" 
                  data-nombre="'. $nombreColor.'" data-metakey="btn cambio color-'.str_replace('-', '', $nombre1).'-'.$ano.'-'.str_replace('-','',$nombreUrlColor).'"><i>'.$nombreColor.'--</i></div>';
                }
             }
         }else{
              $primerColor=$path.'/colores/blanco.png';
              $cadenaColores.='<div class="nuevos-color active" data-color="'.$url.'" style="background-color: #fff;" data-bs-hover-animate="pulse" data-nombreColor="BLANCO" data-hexacolor="#FFFF"  data-nombre="'. $nombreColor.'" data-metakey="btn cambio color-'.str_replace('-', '', $nombre1).'-'.$ano.'-BLANCO"><i>BLANCO--</i></div>';
         }
         return ["primerColor"=> $primerColor,"cadenaBanner"=>$cadenaColores];
        
      }

      public function get_similares_nuevos($nombre1){
            $conn=new Conexion();
            $conne= $conn->query_similares_nuevos($nombre1);
            $consulta= $conne;
          
            if($consulta){
              for($i=0;$i<count($consulta);$i++){
                $nombreModelo=str_replace(' ', '-', $consulta[$i]->modelo);
                $nombreModelo2=str_replace(' ', '%20', $consulta[$i]->modelo);


                $nombreUnidad=str_replace("-"," ",$nombreModelo);
                $imagenLinkUnidad=$nombreModelo.'-'.$consulta[$i]->ano;

                 $urlLink=strtolower($consulta[$i]->marca).'-'.strtolower($nombreModelo2).'-'.$consulta[$i]->ano;

                 if(strstr($urlLink,'camaro')||strstr($urlLink,'corvette')){
                   $urlLink='performance-'.strtolower($nombreModelo2).'-'.$consulta[$i]->ano;
                }else{
                  $urlLink=strtolower($consulta[$i]->marca).'-'.strtolower($nombreModelo2).'-'.$consulta[$i]->ano;
                }

                if( $nombreUnidad=="C 20"){
                  $nombreUnidad="SILVERADO 2500";
                  $urlLink=strtolower($consulta[$i]->marca).'-c%2020-'.$consulta[$i]->ano;
                   $imagenLinkUnidad="SILVERADO-2019";
                }
                if( $nombreUnidad=="C 35"){
                  $nombreUnidad="SILVERADO 3500";
                  $urlLink=strtolower($consulta[$i]->marca).'-c%2035-'.$consulta[$i]->ano;
                   $imagenLinkUnidad="SILVERADO-3500-2019";
                }
                 if( $nombreUnidad=="C 20 CREW"){
                  $nombreUnidad="CHEYENNE";
                  $urlLink=strtolower($consulta[$i]->marca).'-c%2020_crew-'.$consulta[$i]->ano;
                  $imagenLinkUnidad="CHEYENNE-2019";
                }

               
                    $cadenaSimilares.= '<div class="col-md-6 col-lg-3 items active" >
                                 <a href="../'.$urlLink.'"  data-metakey="btn-similares-nuevos-'.$nombreUnidad.'">

                                      <div class="card border-dark" >
                                         

                                       <div class="card-body">
                                              <h4 class="class-titulo">'.$nombreUnidad.'</h4>
                                 <div class="card-anio">'.$consulta[$i]->ano.'</div>


                                        <div class="areaImgAuto">
                                           <img src="'.URL.'/assets/img/autos/'.$imagenLinkUnidad.'.png" class="autoImg" data-bs-hover-animate="pulse" alt="'.$imagenLinkUnidad.'"/>
                                        </div>
                                       <div style="clear: both;"></div>
                                       </div></div></a></div>';
            }
            return $cadenaSimilares;
            }
      }

       public function get_similares_nuevos2(){
            $conn=new Conexion();
            $conne= $conn->query_similares_nuevos2();
            $consulta= $conne;
          
            if($consulta){
              for($i=0;$i<count($consulta);$i++){
                $nombreModelo=str_replace(' ', '-', $consulta[$i]->modelo);
                $nombreModelo2=str_replace(' ', '%20', $consulta[$i]->modelo);


                $nombreUnidad=str_replace("-"," ",$nombreModelo);
                $imagenLinkUnidad=$nombreModelo.'-'.$consulta[$i]->ano;

                 $urlLink=strtolower($consulta[$i]->marca).'-'.strtolower($nombreModelo2).'-'.$consulta[$i]->ano;

                 if(strstr($urlLink,'camaro')||strstr($urlLink,'corvette')){
                   $urlLink='performance-'.strtolower($nombreModelo2).'-'.$consulta[$i]->ano;
                }else{
                  $urlLink=strtolower($consulta[$i]->marca).'-'.strtolower($nombreModelo2).'-'.$consulta[$i]->ano;
                }

                if( $nombreUnidad=="C 20"){
                  $nombreUnidad="SILVERADO 2500";
                  $urlLink=strtolower($consulta[$i]->marca).'-c%2020-'.$consulta[$i]->ano;
                   $imagenLinkUnidad="SILVERADO-2019";
                }
                if( $nombreUnidad=="C 35"){
                  $nombreUnidad="SILVERADO 3500";
                  $urlLink=strtolower($consulta[$i]->marca).'-c%2035-'.$consulta[$i]->ano;
                   $imagenLinkUnidad="SILVERADO-3500-2019";
                }
                 if( $nombreUnidad=="C 20 CREW"){
                  $nombreUnidad="CHEYENNE";
                  $urlLink=strtolower($consulta[$i]->marca).'-c%2020_crew-'.$consulta[$i]->ano;
                  $imagenLinkUnidad="CHEYENNE-2019";
                }

               
                    $cadenaSimilares.= '<div class="col-md-6 col-lg-3 items active" >
                                 <a href="'.URL.'/'.$urlLink.'"  data-metakey="btn-similares-nuevos-'.$nombreUnidad.'">

                                      <div class="card border-dark" >
                                         

                                       <div class="card-body">
                                              <h4 class="class-titulo">'.$nombreUnidad.'</h4>
                                 <div class="card-anio">'.$consulta[$i]->ano.'</div>


                                        <div class="areaImgAuto">
                                           <img src="'.URL.'/assets/img/autos/'.$imagenLinkUnidad.'.png" class="autoImg" data-bs-hover-animate="pulse" alt="'.$imagenLinkUnidad.'"/>
                                        </div>
                                       <div style="clear: both;"></div>
                                       </div></div></a></div>';
            }
            return $cadenaSimilares;
            }
      }

      
        public function get_similares_seminuevos($vin){
            $conn=new Conexion();
            $conne= $conn->query_similares_seminuevos($vin);
            $consulta= $conne;
            
            if($consulta){
              
              for($i=0;$i<count($consulta);$i++){
                  

                     $cadena.='<div class="col-md-6 col-lg-3 items2 active" data-metakey="similares-'.$consulta[$i]->nombre.'" >
                   
                <a href="'.URL.'/catalogo/seminuevos/'.sha1($consulta[$i]->serie).'" data-metakey="btn-similares-seminuevos-'.$consulta[$i]->nombre.'-'.$consulta[$i]->year.'">
                        <div class="card border-dark">
                        
                          <span class="semi-titulo">'.$consulta[$i]->nombre.' '.$consulta[$i]->year.'</span>
                    <div><span class="semi-tipo">Trans </span><span class="semi-transValue">'.$consulta[$i]->trans.'</span></div>

                          <div class="semi-areaImgAuto"><center>
                          <img src="'.URLSeminuevos.'/APPS/subastas/images/principal/inv_'.$consulta[$i]->serie.'/imagen-preview.png" alt="'.$consulta[$i]->nombre.'" class="semi-autoImg" data-bs-hover-animate="pulse" style="width:90%;margin-top:0px;"/></center> </div>
                          </div>
                            <div class="cintilla">
                               <label class="semi-des-mensual">$'.number_format($consulta[$i]->precio,2).' <i>mxn</i>
                                </label>

                                <div class="semi-disponibles" style="top:300px;">
                                  <label class="anio">'.$consulta[$i]->year.'</label>
                                  <label class="marcaCinta">'.$consulta[$i]->marca.'</label>
                                  &nbsp;
                                    
                                </div>
                          </div>

                      </a>
                        
                    </div> ';
            }
            return $cadena;
            }
      }
      public function get_similares_seminuevos2(){
            $conn=new Conexion();
            $conne= $conn->query_similares_seminuevos2();
            $consulta= $conne;
            
            if($consulta){
              
              for($i=0;$i<count($consulta);$i++){
                  

                     $cadena.='<div class="col-md-6 col-lg-3 items2 active" data-metakey="similares-'.$consulta[$i]->nombre.'" >
                   
                <a href="../../catalogo/seminuevos/'.sha1($consulta[$i]->serie).'" data-metakey="btn-similares-seminuevos-'.$consulta[$i]->nombre.'-'.$consulta[$i]->year.'">
                        <div class="card border-dark">
                        
                          <span class="semi-titulo">'.$consulta[$i]->nombre.' '.$consulta[$i]->year.'</span>
                    <div><span class="semi-tipo">Trans </span><span class="semi-transValue">'.$consulta[$i]->trans.'</span></div>

                          <div class="semi-areaImgAuto"><center>
                          <img src="'.URLSeminuevos.'/APPS/subastas/images/principal/inv_'.$consulta[$i]->serie.'/imagen-preview.png" alt="'.$consulta[$i]->nombre.'" class="semi-autoImg" data-bs-hover-animate="pulse" style="width:90%;margin-top:0px;"/></center> </div>
                          </div>
                            <div class="cintilla">
                               <label class="semi-des-mensual">$'.number_format($consulta[$i]->precio,2).' <i>mxn</i>
                                </label>

                                <div class="semi-disponibles" style="top:300px;">
                                  <label class="anio">'.$consulta[$i]->year.'</label>
                                  <label class="marcaCinta">'.$consulta[$i]->marca.'</label>
                                  &nbsp;
                                    
                                </div>
                          </div>

                      </a>
                        
                    </div> ';
            }
            return $cadena;
            }
      }
      public function get_auto_seminuevos($vin){
          $conn=new Conexion();
            $conne= $conn->query_auto_seminuevos($vin);
            $consulta= $conne;
            
            return $consulta;

      }
      public function get_cadena_promociones($marcas){
        $conn = new Conexion();
        list($ctd,$dts) = $conn->query_promociones($marcas);
        $str = "";

        for($i=0;$i<$ctd;$i++){
        	$nombreVisible=$dts[$i]->modelo;
         		if($nombreVisible=="C-20"){
                    $nombreVisible="SILVERADO 2500";
                    $modelo_ano="SILVERADO-".$consulta[$i]->ano;
                    $url_link="chevrolet-silverado_2500-".$consulta[$i]->ano;
                }
                if($nombreVisible=="C-20 CREW"){
                    $nombreVisible="CHEYENNE";
                     $modelo_ano="CHEYENNE-".$consulta[$i]->ano;
                      $url_link="chevrolet-cheyenne-".$consulta[$i]->ano;
                }
                if($nombreVisible=="C-35"){
                    $nombreVisible="SILVERADO 3500";
                    $modelo_ano="SILVERADO-3500-".$consulta[$i]->ano;
                    $url_link="chevrolet-silverado_3500-".$consulta[$i]->ano;
                }
               

         if(strstr($dts[$i]->modelo,'CAMARO')||strstr($dts[$i]->modelo,'CORVETTE')){
               $url=strtolower(str_replace(' ','-',$dts[$i]->modelo).'-'.$dts[$i]->ano);
               $dts[$i]->marca="PERFORMANCE";
                     
          }else{
              $url=strtolower(str_replace(' ','-',$dts[$i]->modelo).'-'.$dts[$i]->ano);
                  
          }

          if($dts[$i]->modelo!="imagen"){
            if($dts[$i]->tipo=="NUEVOS"){
              if($dts[$i]->marca=="CHEVROLET"){
               $str .= "<div class='promociones-items active'";
              }else{
                 $str .= "<div class='promociones-items'";
              }
            }else{
               $str .= "<div class='promociones-items active'";
            }
         

                  $str .= " data-modelo='".$nombreVisible."' 
                  data-ano='".$dts[$i]->ano."' 
                  data-imagen='".URL."/assets/img/autos-landing/".strtolower($dts[$i]->marca)."/".$url."/colores/".$dts[$i]->imagen.".png' 
                  data-cantidad='".$dts[$i]->cantidad."' 
                  data-forma='".$dts[$i]->forma."' 
                  data-titulo1='".$dts[$i]->titulo1."' 
                  data-titulo2='".$dts[$i]->titulo2."'
                  data-tipo='".$dts[$i]->tipo."'
                   data-marca='".$dts[$i]->marca."'
                  >
                    <div class='promociones-fondoitem' style='background-image:url(\"".URL."/assets/img/promociones/backs_".rand(1,6).".jpg\")'>
                      <div class='promociones-titulo'>".$nombreVisible."</div>";

          if($dts[$i]->cantidad == '18 MESES'){
            $str .= "<div class='promociones-cantidad18'>".$dts[$i]->cantidad."</div>
                     <div class='promociones-forma18'>".$dts[$i]->forma."</div>";
          }else{
            $str .= "<div class='promociones-cantidad'>".$dts[$i]->cantidad."</div>
                     <div class='promociones-forma'>".$dts[$i]->forma."</div>";
          }

          $str .= " </div>
                    <div class='promociones-titulo1'>".$dts[$i]->titulo1."</div>
                    <div class='promociones-titulo2'>".$dts[$i]->titulo2."</div>
                    <div style='clear:both'></div>
                    <div class='promociones-btnSolicitud'>
                    <div style='float: left;'>
                      <label class='promociones-anio'>".$dts[$i]->ano."</label>                    
                    </div>
                     
                      <div class='promociones-btn-solicita'>
                        <label style='margin-bottom: 0; cursor: pointer;' class='promociones-solicita'>Solicita una Cotización</label>
                      </div>
                    </div>
                    <img src='".URL."/assets/img/autos-landing/".strtolower($dts[$i]->marca)."/".$url."/colores/".$dts[$i]->imagen.".png' class='promociones-imgItems' data-bs-hover-animate='pulse' alt='".strtolower($dts[$i]->marca)."'/>
                  </div>";
          }else{
            

          $str .= "<a href='tel:8111608665'><div class='promociones-itemsImg active'>
                    <img src='".$dts[$i]->forma."' data-bs-hover-animate='pulse' width='100%' alt='icon telefono'/>
                  </div></a>";
          }
        }

      return $str;
      $conn->close();
      }

        public function get_cadena_promociones_blog(){
        $conn = new Conexion();
        list($ctd,$dts) = $conn->query_promociones_blog();
        $str = "";

        for($i=0;$i<$ctd;$i++){
          
         if(strstr($dts[$i]->modelo,'CAMARO')||strstr($dts[$i]->modelo,'CORVETTE')){
               $url=strtolower(str_replace(' ','-',$dts[$i]->modelo).'-'.$dts[$i]->ano);
               $dts[$i]->marca="performance";
                     
          }else{
              $url=strtolower(str_replace(' ','-',$dts[$i]->modelo).'-'.$dts[$i]->ano);
                  
          }
          $str .= "<div class='promociones-items active' 
                  data-modelo='".$dts[$i]->modelo."' 
                  data-ano='".$dts[$i]->ano."' 
                  data-imagen='".URL."/assets/img/autos-landing/".strtolower($dts[$i]->marca)."/".$url."/colores/".$dts[$i]->imagen.".png' 
                  data-cantidad='".$dts[$i]->cantidad."' 
                  data-forma='".$dts[$i]->forma."' 
                  data-titulo1='".$dts[$i]->titulo1."' 
                  data-titulo2='".$dts[$i]->titulo2."' style='width:100%'>
                    <div class='promociones-fondoitem' style='background-image:url(\"".URL."/assets/img/promociones/backs_".rand(1,6).".jpg\")'/>
                      <div class='promociones-titulo'>".$dts[$i]->modelo."</div><div style='clear: both;'></div>";

          if($dts[$i]->cantidad == '18 MESES'){
            $str .= "<div class='promociones-cantidad18'>".$dts[$i]->cantidad."</div>
                     <div class='promociones-forma18'>".$dts[$i]->forma."</div>";
          }else{
            $str .= "<div class='promociones-cantidad'>".$dts[$i]->cantidad."</div>
                     <div class='promociones-forma'>".$dts[$i]->forma."</div>";
          }

          $str .= " </div>
                    <div class='promociones-titulo1'>".$dts[$i]->titulo1."</div>
                    <div class='promociones-titulo2'>".$dts[$i]->titulo2."</div>
                    <div style='clear:both'></div>
                    <div class='promociones-btnSolicitud'>
                      <label class='promociones-anio'>".$dts[$i]->ano."</label>
                      <label class='promociones-solicita'>Solicita una Cotización</label>
                    </div>
                    <img src='".URL."/assets/img/autos-landing/".strtolower($dts[$i]->marca)."/".$url."/colores/".$dts[$i]->imagen.".png' class='promociones-imgItems' data-bs-hover-animate='pulse' alt='".strtolower($dts[$i]->marca)."' alt='".strtolower($dts[$i]->marca)."'/>
                  </div><div style='clear: both;'></div><br>";
        }

      return $str;
      $conn->close();
      }


       public function libro_azul_conne(){
          $ws = new class_ws();
          $result = $ws->iniciar_sesion();
          $error = false; $error_con = false; $set_con = false;
          $key = "";
          if(@$result["success"]){
              $key = $result["data"]["key"];
              return $key;
          }else{
              $error_con = true;
              if($result["message"]==""){ 
                  $set_con = true;
              }else{ $message_error = $result["message"]; }
               return $message_error;

              
          }
       }

       public function getFiltrosSeminuevos(){
          $conn=new Conexion();
            $conne= $conn->getFiltros();
            $consulta= $conne;
            if($consulta){
              return $consulta;
            }
       }
       
  public function get_session_id_token(){
            $nvpreq = "apiOperation=CREATE_CHECKOUT_SESSION&apiPassword=3ce6b04801c44c16f803d99f83d9d505&apiUsername=merchant.1094989&merchant=1094989&order.id=124581&order.amount=10.00&order.currency=MXN&interaction.returnUrl=".URL."/success"; 

          $ch = curl_init('https://banamex.dialectpayments.com/api/nvp/version/51/');

          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
          curl_setopt ($ch, CURLOPT_TIMEOUT, 5);
         curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
          
          // execute!
          $response = curl_exec($ch);

          // close the connection, release resources used
          curl_close($ch);

          // do anything you want with your response
         return $response;

  }


  public function insertar_contacto_info($param){
    $conn = new Conexion();
    $conne = $conn->query_insertar_contacto_info($param);
  }


//Blogs
   public function get_table_blogs(){
      $conn=new Conexion();
      $consulta_blogs= $conn->query_report_blogs();
      if($consulta_blogs){

        for($i=0;$i<count($consulta_blogs);$i++){

          $titulo1=str_replace('ó', 'o', $consulta_blogs[$i]["titulo"]);
          $titulo2=str_replace('Ó', 'o', $titulo1);
          $titulo3=str_replace('á', 'a', $titulo2);
          $titulo4=str_replace('í', 'i', $titulo3);
          $titulo5=str_replace('ú', 'u', $titulo4);
          $titulo6=str_replace('?', '', $titulo5);
          $titulo7=str_replace('¿', '', $titulo6);
          $titulo8=str_replace('!', '', $titulo7);
          $titulo9=str_replace('¡', '', $titulo8);
          $titulo10=str_replace(' ', '-', $titulo9);
          //$titulo=strtolower($consulta_blogs[$i]["titulo"]);

          $fechaBlog = $consulta_blogs[$i]["fecha"];
          $fechaBlog = substr($fechaBlog, 0, -9);

          $cadena.='<tr>
                        <td>'.$consulta_blogs[$i]["id"].'</td>
                        <td>'.$consulta_blogs[$i]["titulo"].'</td>
                        <td><center><img src="https://d3s2hob8w3xwk8.cloudfront.net/blog/'.$consulta_blogs[$i]["id"].'/portada.png" width="100px;"  height="50px;"/></center></td>
                        <td>'.$consulta_blogs[$i]["fecha"].'</td>
                        <td style="display:flex;justify-content:center;"><a style="margin-right:5px;" href="https://www.gruporivero.com/blog/'.str_replace('-', '/', $fechaBlog).'/'.$consulta_blogs[$i]["slug"].'" target="_blank"><center><button class="btn btn-primary">Ver</button></center></a><a href="https://www.riverorenta.mx/produccion/panel-administrativo/pages/edit-blog/?'.$consulta_blogs[$i]["id"].'"><center><button class="btn btn-success">Editar</button></center></a></td>
                    </tr>';
        }
        return $cadena;
        $conn->close();

        }
    }
//Fin Blogs

//Promociones
    public function get_table_promociones($tipo){
      $conn=new Conexion();

      
      $consulta_promociones= $conn->query_report_promociones($tipo);
      if($consulta_promociones){
              
        for($i=0;$i<count($consulta_promociones);$i++){
          $pathinfo = pathinfo($consulta_promociones[$i]["forma"]); 
          $params=base64_encode(json_encode($consulta_promociones[$i]));        

            if ($tipo == 'accesorios') {
                $cadena.='<tr>
                <td>'.$consulta_promociones[$i]["id"].'</td>
                <td id="img'.$consulta_promociones[$i]["id"].'" style="position: relative;"><i onclick="editImg(\''.$consulta_promociones[$i]["forma"].'\',\''.$consulta_promociones[$i]["id"].'\')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i><img width="50px" height="60px;" src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/accesorios/'.$pathinfo['filename'].'.'.$pathinfo['extension'].'"/></td>
                <td id="desc'.$consulta_promociones[$i]["id"].'" style="position: relative;"><i onclick="editDesc(\''.$consulta_promociones[$i]["titulo2"].'\', '.$consulta_promociones[$i]["id"].')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i>'.$consulta_promociones[$i]["titulo2"].'</td>';
                if ($consulta_promociones[$i]["status"] == 1){
                  $cadena.='<td id="'.$consulta_promociones[$i]["id"].'"><img role="button" onclick="changeStatus(0, '.$consulta_promociones[$i]["id"].' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-on.png"/>';
                } else {
                  $cadena.='<td id="'.$consulta_promociones[$i]["id"].'"><img role="button" onclick="changeStatus(1, '.$consulta_promociones[$i]["id"].' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-off.png"/>';
                }
                $cadena.='<td>'.$consulta_promociones[$i]["fecha"].'</td>';
                $cadena.='<td><a href="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/accesorios/'.$pathinfo['filename'].'.'.$pathinfo['extension'].'" target="_blank"><button class="btn btn-primary">Ver</button></a></td>
                </tr>';
              } else if($tipo == 'taller'){
                $cadena.='<tr>
                <td>'.$consulta_promociones[$i]["id"].'</td>
                <td id="img'.$consulta_promociones[$i]["id"].'" style="position: relative;"><i onclick="editImg(\''.$consulta_promociones[$i]["forma"].'\',\''.$consulta_promociones[$i]["id"].'\')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i><img width="50px" height="60px;" src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/taller/'.$pathinfo['filename'].'.'.$pathinfo['extension'].'"/></td>
                <td id="desc'.$consulta_promociones[$i]["id"].'" style="position: relative;"><i onclick="editDesc(\''.$consulta_promociones[$i]["titulo2"].'\', '.$consulta_promociones[$i]["id"].')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i>'.$consulta_promociones[$i]["titulo2"].'</td>';
                if ($consulta_promociones[$i]["status"] == 1){
                  $cadena.='<td id="'.$consulta_promociones[$i]["id"].'"><img role="button" onclick="changeStatus(0, '.$consulta_promociones[$i]["id"].' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-on.png"/>';
                } else {
                  $cadena.='<td id="'.$consulta_promociones[$i]["id"].'"><img role="button" onclick="changeStatus(1, '.$consulta_promociones[$i]["id"].' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-off.png"/>';
                }
                $cadena.='<td>'.$consulta_promociones[$i]["fecha"].'</td>';
                $cadena.='<td><a href="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/taller/'.$pathinfo['filename'].'.'.$pathinfo['extension'].'" target="_blank"><button class="btn btn-primary">Ver</button></a></td>
                </tr>';
            }else if($tipo == 'nuevos'){
                $cadena.='<tr>
                <td>'.$consulta_promociones[$i]["id"].'</td>
                <td id="img'.$consulta_promociones[$i]["id"].'" style="position: relative;"><i onclick="editImg(\''.$consulta_promociones[$i]["forma"].'\',\''.$consulta_promociones[$i]["id"].'\')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i><img width="50px" height="60px;" src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/nuevos/'.$pathinfo['filename'].'.'.$pathinfo['extension'].'"/></td>
                <td id="desc'.$consulta_promociones[$i]["id"].'" style="position: relative;"><i onclick="editDesc(\''.$consulta_promociones[$i]["titulo2"].'\', '.$consulta_promociones[$i]["id"].')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i>'.$consulta_promociones[$i]["titulo2"].'</td>';
                if ($consulta_promociones[$i]["status"] == 1){
                  $cadena.='<td id="'.$consulta_promociones[$i]["id"].'"><img role="button" onclick="changeStatus(0, '.$consulta_promociones[$i]["id"].' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-on.png"/>';
                } else {
                  $cadena.='<td id="'.$consulta_promociones[$i]["id"].'"><img role="button" onclick="changeStatus(1, '.$consulta_promociones[$i]["id"].' )" style="max-width: 50px; cursor: pointer;" src="../promociones-autos/btn-off.png"/>';
                }
                $cadena.='<td>'.$consulta_promociones[$i]["fecha"].'</td>';
                $cadena.='<td><a href="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/nuevos/'.$pathinfo['filename'].'.'.$pathinfo['extension'].'" target="_blank"><button class="btn btn-primary">Ver</button></a></td>
                </tr>';
            }
        }
        return $cadena;
        $conn->close();

        }
    }
    
     public function get_autos_promociones(){
      $conn=new Conexion();
      $consulta= $conn->query_autos_banner();
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
            $modelo=$consulta[$i]["modelo"];
            $auto=$consulta[$i]["marca"].",".$consulta[$i]["modelo"].",".$consulta[$i]["ano"];
            $cadena_autos_banner.='<option value="'.$auto.'" class="sel_auto">'.$auto.'</option>';
        }
      }
      return  $cadena_autos_banner;
      $conn->close();
   }
   
    public function autos_promo_color($param){
      $conn=new Conexion();
      $consulta= $conn->query_autos_promo_color($param);
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
            $auto=$consulta[$i]["color"];
            $cadena_autos_banner.='<option value="'.$auto.'" class="sel_auto">'.$auto.'</option>';
        }
      }
      return  $cadena_autos_banner;
      $conn->close();
   }
   

//Fin Promociones

//Publicidad
    public function get_table_publicidad(){
      $conn=new Conexion();
      $consulta_publicidad= $conn->query_report_publicidad();
      if($consulta_publicidad){
              
        for($i=0;$i<count($consulta_publicidad);$i++){         
         
          $cadena.='<tr>
                        <td>'.$consulta_publicidad[$i]["id"].'</td>
                        <td>'.$consulta_publicidad[$i]["titulo"].'</td>
                        <td><img src="'.URL.'/assets/img/publicidad/'.$consulta_publicidad[$i]["imagen"].'" width="80px;"/></td>
                        <td>'.$consulta_publicidad[$i]["fecha"].'</td>
                        <td><a href="'.URL.'/publicidad/'.$consulta_publicidad[$i]["titulo"].'" target="_blank"><button class="btn btn-primary btn-block" style="border-radius: 7px;">Ver</button></a>
                        <br><button class="btn btn-danger btn-block" style="border-radius: 7px;"  onclick="cambiarStatus('.$consulta_publicidad[$i]["id"].')">Eliminar</button>
                        </td>
                    </tr>';
        }
        return $cadena;
        $conn->close();

        }
    }
//Fin Publicidad

//Adwords
    public function get_table_adwords(){
      $conn=new Conexion();
      $consulta_publicidad= $conn->query_report_adwords();
      if($consulta_publicidad){
              
        for($i=0;$i<count($consulta_publicidad);$i++){         
         
          $cadena.='<tr>
                        <td>'.$consulta_publicidad[$i]["id"].'</td>
                        <td>'.$consulta_publicidad[$i]["titulo"].'</td>
                        <td><img src="'.URL.'/assets/img/adwords/'.$consulta_publicidad[$i]["imagen"].'" width="80px;"/></td>
                        <td>'.$consulta_publicidad[$i]["fecha"].'</td>
                        <td><a href="'.URL.'/adwords/'.$consulta_publicidad[$i]["titulo"].'" target="_blank"><button class="btn btn-primary" style="border-radius: 7px;">Ver</button></a></td>
                    </tr>';
        }
        return $cadena;
        $conn->close();

        }
    }
//Fin Adwords

//Banners
 public function get_autos_banner(){
      $conn=new Conexion();
      $consulta= $conn->query_autos_banner();
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
            $modelo=$consulta[$i]["modelo"];
            $auto=$consulta[$i]["marca"]."-".$consulta[$i]["modelo"]."-".$consulta[$i]["ano"];
            $cadena_autos_banner.='<option value="'.$auto.'">'.$auto.'</option>';
        }
      }
      return  $cadena_autos_banner;
      $conn->close();
   }
   
     public function get_table_banners(){
      $conn=new Conexion();
      $consulta_banners= $conn->query_report_banners();
      if($consulta_banners){
              
        for($i=0;$i<count($consulta_banners);$i++){
            
         if($consulta_banners[$i]["tipo"]==0){
             $preview='<img src="'.URL.'/assets/banners/img/'.$consulta_banners[$i]["meta_value"].'" width="80px;"/>';
             $ruta= URL.'/assets/banners/'.$consulta_banners[$i]["meta_value"];
         }else{
              $preview= '<video width="80" height="80" controls><source src="'.URL.'/assets/banners/media/'.$consulta_banners[$i]["meta_value"].'.mp4" type="video/mp4"></video>';
             $ruta= URL.'/assets/banners/media/'.$consulta_banners[$i]["meta_value"].'.mp4';
         }
          $cadena.='<tr>
                        <td>'.$consulta_banners[$i]["id"].'</td>
                        <td>'.$consulta_banners[$i]["meta_key"].'</td>';
          $cadena.='<td>'.$preview.'</td>';
          $cadena.='<td>'.$ruta.'</td>';
          $cadena.='<td>'.$consulta_banners[$i]["status"].'</td>
                        <td>'.$consulta_banners[$i]["modificacion"].'</td>
                        <td><a href="'.URL.'/assets/banners/img/'.$consulta_banners[$i]["meta_value"].'" target="_blank"><button class="btn btn-primary btn-block" style="border-radius: 7px;">Ver</button></a>
                        <br><button class="btn btn-danger btn-block" style="border-radius: 7px;"  onclick="cambiarStatus('.$consulta_banners[$i]["id"].','.$consulta_banners[$i]["status"].')">Cambiar Status</button>
                        </td>
                    </tr>';
        }
        return $cadena;
        $conn->close();

        }
    }
//Fin Banners    

//Seminuevos
public function get_all_catalogo_seminuevos_dev(){
        $conn=new Conexion();
        $conne= $conn->query_all_seminuevos();
        $consulta= $conne;
        if($_SESSION["cotizador"]["enganche"]){
            $enganche=$_SESSION["cotizador"]["enganche"];
            $meses=$_SESSION["cotizador"]["meses"];
        }else{
            $_SESSION["cotizador"]["enganche"]=30;
            $_SESSION["cotizador"]["meses"]=24;
            $_SESSION["cotizador"]["condicion"]="CRÉDITO";
            $enganche=30;
            $meses=24;
        }
         if($consulta){
          for($i=0;$i<count($consulta);$i++){
           
            $url_link='catalogo/seminuevos/'.sha1($consulta[$i]->stock);
            $inv=$consulta[$i]->stock;
            $marca=$consulta[$i]->marca;
            $nombreVisible=$consulta[$i]->nombre;
            $km=$consulta[$i]->km;
            $trans=$consulta[$i]->trans;
            $ano=$consulta[$i]->year;
            $precio=$consulta[$i]->precio;
            $sucursal=str_replace("RIVERO ", "", $consulta[$i]->sucursal);
             $sucursal=str_replace(' ', '-',  $sucursal);
            $modelo_ano='';
            $vin=$consulta[$i]->vin;
            $pagoInicial=($consulta[$i]->precio*($enganche/100));
            $financiado=$consulta[$i]->precio- $pagoInicial;
            $objEng=('#eng-'.$i);
            $nombreVisible= $nombreVisible;
            
            $engancheDespliegue="";
            if($ano>"2012"){
              $engancheDespliegue="$".number_format($pagoInicial,2)."<i> / eng</i>";
            }
                    $cadena.='<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
                    <a href="'.URLSeminuevos.'/images/principal/inv_'.$inv.'/imagen-preview.png" data-sub-html="'.$marca.' '.$nombreVisible.' '.$ano.'- KM:'.$km.', TRANS:'.$trans.', PRECIO:'.$precio.'">
                    <img class="img-responsive thumbnail" src="'.URLSeminuevos.'/images/principal/inv_'.$inv.'/imagen-preview.png" style="min-width:250px; min-height:200px;max-width:250px; max-height:200px;"/>
                    <div class="carousel-caption">
                    <p style="background: #ffffff; color: #000;">'.$marca.'-'.$nombreVisible.'</p>
                    </div>
                    </a>
                    </div>';
           }
        }
        //https://www.riverorenta.mx/seminuevos/images/principal/inv_6238/imagen-preview.png
         
        return  $cadena;
     }
//Fin Seminuevos

//Mails
   public function get_mail(){
       $conn=new Conexion();
       $consulta_mails= $conn->query_all_mail();
      if($consulta_mails){
        for($i=0;$i<count($consulta_mails);$i++){         
          $cadena.='<tr onclick="location_mail('.$consulta_mails[$i]["id"].')">';
          $cadena.='<td>'.$consulta_mails[$i]["id"].'</td>';
          $cadena.='<td>'.$consulta_mails[$i]["ncompleto"].'</td>';
          $cadena.='<td>'.$consulta_mails[$i]["agencia"].'</td>';
          $cadena.='<td>'.$consulta_mails[$i]["depto"].'</td>';
          
            $cadena.='<td>'.$consulta_mails[$i]["extencion"].'</td>';
          
          $cadena.='<td>'.$consulta_mails[$i]["corr"].'</td>';
          $cadena.='<td>'.$consulta_mails[$i]["celu"].'</td>';
          $cadena.='<td>'.$consulta_mails[$i]["ndirecto"].'</td>';
          $cadena.='</tr>';
        }
        return $cadena;
        $conn->close();

        }
    }
    
     public function get_mail_detalle($obj){
       $conn=new Conexion();
       $consulta_mail= $conn->query_mail_id();
      if($consulta_mail){
        for($i=0;$i<count($consulta_mail);$i++){         

        }
        return 1;
        $conn->close();

        }
    }
//Fin Mails

    //Accesorios
    public function get_autos_accesorios(){
      $conn=new Conexion();
      $consulta= $conn->query_autos_accesorios();
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
            $modelo=$consulta[$i]["modelo"];
            $auto=$consulta[$i]["modelo"];
            $cadena_autos_banner.='<option value="'.$auto.'">'.$auto.'</option>';
        }
      }
      return  $cadena_autos_banner;
      $conn->close();
   }


   public function get_all_accesorios(){
       $conn=new Conexion();
       $consulta_accesorios= $conn->query_report_accesorios();
      if($consulta_accesorios){
        for($i=0;$i<count($consulta_accesorios);$i++){
             $numinv=$consulta_accesorios[$i]["num_inventario"];
             $consulta_anios_accesorios= $conn->query_anios_accesorios($numinv);
             if($consulta_anios_accesorios){
                 foreach($consulta_anios_accesorios as $row){}
                 $anios = $row['anios'];
             }
          $cadena.='<tr>
          <td>'.$consulta_accesorios[$i]["id"].'</td>
          <td>'.$consulta_accesorios[$i]["auto"].'</td>
          <td>'.$consulta_accesorios[$i]["num_inventario"].'</td>
          <td>'.$consulta_accesorios[$i]["descripcion"].'</td>
          <td>'.$consulta_accesorios[$i]["tiempo_instalacion"].'</td>
          <td>'.$consulta_accesorios[$i]["precio"].'</td>
          <td>'.$consulta_accesorios[$i]["categoria"].'</td>
          <td>'.$anios.'</td>
          <td><div class="btn btn-primary">Editar</div></td></tr>';
        }
        return $cadena;
        $conn->close();

        }
    }
    
    public function get_anios_accesorios_auto($auto){
      $conn=new Conexion();
      $consulta= $conn->query_anios_modelo_accesorios($auto);
      if ($consulta) {
           $cadena_autos_banner.='
            <b>Años para los que este articulo esta disponible</b>
            <div class="form-group form-float">
            <div class="form-line">';
        for($i=0;$i<count($consulta);$i++){
            $ano=$consulta[$i]["ano"];
            $cadena_autos_banner.='
            <input type="checkbox" id="anio_'.$ano.'" class="filled-in chk-col-light-blue checkAnio" checked data-anio="'.$ano.'">
            <label for="anio_'.$ano.'">'.$ano.'</label>&nbsp;&nbsp;';
        }
         $cadena_autos_banner.='</div></div>';
      }else{
           $cadena_autos_banner.='
            <b>Años para los que este articulo esta disponible</b>
            <div class="form-group form-float">
            <div class="form-line">
            <input type="number" placeholder="Este vehículo no se encuentra en inventario." class="form-control" readonly="">
            </div></div>';
          
      }
      return  $cadena_autos_banner;
      $conn->close();
   }
   
    public function get_ipes(){
       $conn=new Conexion();
       $consulta_ip= $conn->query_report_ip();
      if($consulta_ip){
        foreach($consulta_ip as $ip){
          $cadena.='<tr>
          <td>'.$ip["cantidad"].'</td>
          <td>'.$ip["IP"].'</td>
          </tr>';
        }
        return $cadena;
        $conn->close();
        }
    }
    
    public function get_paginas_vistas(){
       $conn=new Conexion();
       $consulta_paginas_vistas= $conn->query_paginas_vistas();
      if($consulta_paginas_vistas){
        foreach($consulta_paginas_vistas as $paginas_vistas){
          $cadena.='<tr>
          <td>'.$paginas_vistas["cantidad"].'</td>
          <td>'.$paginas_vistas["meta_value"].'</td>
          </tr>';
        }
        return $cadena;
        $conn->close();
        }
    }
    public function get_acciones_click(){
       $conn=new Conexion();
       $consulta_acciones_click= $conn->query_acciones_click();
      if($consulta_acciones_click){
        foreach($consulta_acciones_click as $acciones_click){
          $cadena.='<tr>
          <td>'.$acciones_click["cantidad"].'</td>
          <td>'.$acciones_click["meta_value"].'</td>
          </tr>';
        }
        return $cadena;
        $conn->close();
        }
    }
    public function get_formularios(){
       $conn=new Conexion();
       $get_formularios= $conn->query_get_formularios();
      if($get_formularios){
        foreach($get_formularios as $formularios){
          $cadena.='<tr>
          <td>'.$formularios["cantidad"].'</td>
          <td>'.$formularios["url"].'</td>
           <td>'.$formularios["nombre_completo"].'</td>
          <td>'.$formularios["correo"].'</td>
          <td>'.$formularios["telefono"].'</td>
          <td>'.$formularios["formulario"].'</td>
          </tr>';
        }
        return $cadena;
        $conn->close();
        }
    }
    public function get_conteo_forms(){
       $conn=new Conexion();
       $get_formularios_cont= $conn->query_get_conteo_forms();
      if($get_formularios_cont){
        foreach($get_formularios_cont as $formularios){
          $cadena.='<tr>
          <td>'.$formularios["cantidad"].'</td>
           <td>'.$formularios["formulario"].'</td> 
          </tr>';
        }
        return $cadena;
        $conn->close();
        }
    }
/*PAGINA NUEVA*/

public function get_autos_catalogo(){
      $conn=new Conexion();
      $consulta= $conn->query_autos_catalogo();
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
            $modelo=$consulta[$i]["modelo"];
            $auto=$consulta[$i]["modelo"];
            $cadena_autos_banner.='<option value="'.$auto.'">'.$auto.'</option>';
        }
      }
      return  $cadena_autos_banner;
      $conn->close();
   }
   
   public function get_anios_by_modelo($auto){
      $conn=new Conexion();
      $consulta= $conn->query_anios_modelo_accesorios($auto);
      if ($consulta) {
           $cadena_autos_banner.='<select id="anio" class="form-control">';
        for($i=0;$i<count($consulta);$i++){
            $ano=$consulta[$i]["ano"];
            $cadena_autos_banner.='<option value="'.$ano.'">'.$ano.'</option>';
        }
        $cadena_autos_banner.='</select>';
      }
      return  $cadena_autos_banner;
      $conn->close();
   }
   
   public function get_categoria_new_page(){
      $conn=new Conexion();
      $consulta= $conn->query_categoria_nevos_detalle();
      if ($consulta) {
        for($i=0;$i<count($consulta);$i++){
            $categoria=$consulta[$i]["categoria"];
            $cadena_categoria.='<option value="'.$categoria.'">'.$categoria.'</option>';
        }
      }
      return  $cadena_categoria;
      $conn->close();
   }
   
   public function get_meta_key_new_page(){
      $conn=new Conexion();
      $consulta= $conn->query_get_meta_key_new();
      if ($consulta) {
           //$cadena_metakey.='<select id="meta_key" class="form-control">';
        for($i=0;$i<count($consulta);$i++){
            $metakey = utf8_encode($consulta[$i]["meta_key"]);
            $cat = $consulta[$i]["categoria"];
            $cadena_metakey.='<option class="dos" value="'.$metakey.'">'.$metakey.'</option>';
        }
        $cadena_metakey.='<hr>
        <option value="add_nuevo" class="bg-success">Agregar nuevo</option>';
      }
      return  $cadena_metakey;
      $conn->close();
   }
   
   public function get_marca_by_modelo_ano($auto,$anio){
      $auto=$auto;
      $anio=$anio;
      $conn=new Conexion();
      $consulta= $conn->query_get_marca_by_modelo_ano($auto,$anio);
      if ($consulta) {
           //$cadena_metakey.='<select id="meta_key" class="form-control">';
        for($i=0;$i<count($consulta);$i++){
            $metakey=utf8_encode($consulta[$i]["marca"]);
            $cadena_metakey.=$metakey;
        }
       }
      return  $cadena_metakey;
      $conn->close();
   }
   
   public function charge_meta_key($categoria){
       $categoria=$categoria;
      $conn=new Conexion();
      $consulta= $conn->query_charge_meta_key($categoria);
      if ($consulta) {
           $cadena_metakey.='<select id="meta_key" class="form-control" onchange="val_metakey()">
           <option value="" selected  disabled></option>';
        for($i=0;$i<count($consulta);$i++){
            $metakey = utf8_encode($consulta[$i]["meta_key"]);
            $cadena_metakey.='<option value="'.$metakey.'">'.$metakey.'</option>';
        }
         $cadena_metakey.='<hr>';
        if($categoria=="version"){
            $cadena_metakey.='<option value="add_nuevo" class="bg-success">Agregar nuevo</option>';
        }
        $cadena_metakey.='</select>';
      }
      return  $cadena_metakey;
      $conn->close();
   }

   public function query_todo_blogs(){
    $conn= Database::connect();
    $sql="SELECT id,titulo,descripcion,fecha FROM blogs ";
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

// AGREGAR AUTO


public function get_tipos_autos(){
  $conn=new Conexion();
  $consulta= $conn->query_tipo_autos();

    for($i=0;$i<count($consulta);$i++){
        $ref=$consulta[$i]["valor"];
        $tipo=$consulta[$i]["tipo"];
        $cadena_tipos.='<option value="'.$tipo.'">'.$ref.'</option>';
    }
  
  return  $cadena_tipos;
  $conn->close();
}

public function get_lista_colores(){
  $conn=new Conexion();
  $consulta= $conn->query_lista_colores();

    for($i=0;$i<count($consulta);$i++){
        $color=$consulta[$i]["nombre"];
        $hex=$consulta[$i]["color"];
        $lista_colores.='<option style="border: 5px solid '.$hex.';" data-hexa="'.$hex.'"value="'.$color.'">'.$color.'<div style="background-color:'.$hex.';width: 20px; height: 20px;"></div></option>';
    }
  
  return  $lista_colores;
  $conn->close();
}

public function get_lista_versiones_nissan($modelo, $ano){
  $conn=new Conexion();
  $result=$conn->query_lista_versiones_nissan($modelo, $ano);

  if ($result) {
    while ($row = $result->fetch_assoc()) {
        $out[]=array_map("utf8_encode", $row);
    }
} 
$conn=Database::close();
return  $result;

/*     for($i=0;$i<count($consulta);$i++){
        $lista_versiones.='<div class="card" >' +
                            '<div class="card-body" >' +
                                '<h3 style="display: flex; align-items: center; justify-content: center;" class="card-title">'.$consulta[$i]["version"].'</h3><hr/>' +
                                '<h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">ENGANCHE:</h5>' +
                                '<input class="form-control" style="width: 100%" type="text" id="enganche_'.$consulta[$i]["version"].'" hidden>'+
                                '<h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">MENSUALIDAD:</h5>' +
                                '<input class="form-control" style="width: 100%" type="text" id="mensualidad_'.$consulta[$i]["version"].'" hidden>'+
                                '<h5 style="display: flex; align-items: center; justify-content: center;" class="card-title">PRECIO CONTADO: '.$consulta[$i]["precio"].'</h5>' +
                                '<input class="form-control" style="width: 100%" type="text" id="precio_'.$consulta[$i]["version"].'" value="'.$consulta[$i]["precio"].'" hidden>'+
                                '<a onclick="modalEditar(\''.$consulta[$i]["version"].'\')" style="display: flex; align-items: center; justify-content: center;" class="btn btn-primary" >Editar </a>' +
                            '</div>' +
                        '</div>';
      } */


}


public function get_lista_autos(){
  $conn=new Conexion();
  $consulta= $conn->query_lista_autos();

    for($i=0;$i<count($consulta);$i++){
        $modelo=$consulta[$i]["modelo"];
        $lista_autos.='<option value="'.$modelo.'">'.$modelo.'</option>';
    }
  
  return  $lista_autos;
  $conn->close();
}

public function get_lista_marcas(){
  $conn=new Conexion();
  $consulta= $conn->query_lista_marcas();
  $lista_marcas = '';
  $lista_marcas.='<option value="">Seleccione...</option>';
    for($i=0;$i<count($consulta);$i++){
        $marca=$consulta[$i]["marca"];
        $lista_marcas.='<option value="'.$marca.'">'.$marca.'</option>';
    }
  
  return  $lista_marcas;
  $conn->close();
}

public function get_tabla_autos(){
  $conn=new Conexion();
  $consulta= $conn->query_tabla_autos();

    for($i=0;$i<count($consulta);$i++){
        $modelo=$consulta[$i]["modelo"];
        $marca=$consulta[$i]["marca"];
        $ano=$consulta[$i]["ano"];
        $version=$consulta[$i]["version"];

        if ($marca=="Chevrolet") {
          $img_marca="https://gruporivero.com/assets/img/commun/icon-chevy.png";
      }else if ($marca=="Buick") {
          $img_marca="https://gruporivero.com/assets/img/commun/icon-buick.png";
      }else if ($marca=="Cadillac") {
          $img_marca="https://gruporivero.com/assets/img/commun/icon-cadillac.png";
      }else if ($marca=="GMC") {
          $img_marca="https://gruporivero.com/assets/img/commun/icon-gmc.png";
      }

        $tabla_autos.='<tr><td><center><img src="'.$img_marca.'" width="50" height="50"/></center></td><td>'.$modelo.'</td><td>'.$ano.'</td><td>'.$version.'</td></tr>';
    }
  
  return  $tabla_autos;
  $conn->close();
}

public function get_tabla_colores(){
  $conn=new Conexion();
  $consulta= $conn->query_tabla_colores();

    for($i=0;$i<count($consulta);$i++){
        $modelo=$consulta[$i]["Modelo"];
        $ano=$consulta[$i]["Anio"];
        $color=$consulta[$i]["Color"];
        $hexa=$consulta[$i]["Hexa"];
        $orden=$consulta[$i]["Orden"];
        $tabla_colores.='<tr><td>'.$orden.'</td><td>'.$modelo.'</td><td>'.$ano.'</td><td style=" display: flex;">'.$color.'<div style=" margin-left:10px; width:20px; heigth: 20px; ; color: '.$hexa.';background-color: '.$hexa.';">__</div></td><td><div class="btn btn-primary" onclick="deleteButton(\''.$params.'\')">ELIMINAR</div></td></tr>';
    }
  
  return  $tabla_colores;
  $conn->close();
}

public function get_modelos_by_marca($marca){
  $conn=new Conexion();
  $consulta= $conn->query_modelos_by_marca($marca);

  if ($consulta) {
    $opciones_modelos.='<b> SELECCIONA EL MODELO: </b>
    <select id="modelo" class="form-control" name="name" required="" aria-required="true" >';

    for($i=0;$i<count($consulta);$i++){
      $modelo =$consulta[$i]["modelo"];
      $opciones_modelos.='<option value="'.$modelo.'">'.$modelo.'</option>';
    }
    $opciones_modelos.='</select>';

  }
    return  $opciones_modelos;
    $conn->close();
}
public function getCarsWithoutVersion(){
  $conn=new Conexion();
  $qry= $conn->query_versiones_sin_version();
  $cadena = null;
  if ($qry) {
    for($i=0;$i<count($qry);$i++){
      $cadena .= '<tr><td hidden>'.$qry[$i]['id'].'</td><td>'.$qry[$i]['marca'].'</td><td>'.$qry[$i]['modelo'].'</td><td>'.$qry[$i]['ano'].'</td><td>'.$qry[$i]['tipo'].'</td><td>'.$qry[$i]['version'].'</td><td>'.$qry[$i]['modelCode'].'</td><td>'.$qry[$i]['boakey'].'</td><td>'.$qry[$i]['fecha'].'</td><td> <button  class="btn btn-primary btn-block" style="border-radius: 7px;" onclick="fun_open_edit_modal(\''.base64_encode(json_encode(mb_convert_encoding($qry[$i], 'UTF8', mb_detect_encoding($qry[$i]))) ).'\')">edit</button></td> </tr>';
    }
  }
  return  $cadena;
}

public function getAllColors(){
  $conn=new Conexion();
  $qry= $conn->query_select_all_colors();
  $cadena = null;
  if ($qry) {
    for($i=0;$i<count($qry);$i++){
      $cadena .= '<tr><td hidden>'.$qry[$i]['id'].'</td><td>'.$qry[$i]['nombre'].'</td> <td><label style="background-color: '.$qry[$i]['color'].'; border: 15px solid; border-color: transparent;" class="form-control"></label></td>  <td class="row"> <button  class="btn btn-primary col-xl-6 col-md-5 col-sm-4" style="border-radius: 7px;" onclick="fun_open_edit_modal(\''.base64_encode(json_encode(mb_convert_encoding($qry[$i], 'UTF8', mb_detect_encoding($qry[$i]))) ).'\')">edit</button> - <button style="margin-left:40px"class="btn btn-primary col-xl-6 col-md-5 col-sm-4" style="border-radius: 7px;" onclick="fn_mdl_autos(\''.$qry[$i]['nombre'].'\')">autos</button></td> </tr>';
    }
  }
  return  $cadena;
}

public function get_all_promos_autos(){
  $conn=new Conexion();
  $qry= $conn->autos_promociones();
  $cadena = null;
  if ($qry) {
    $cadena.='<ol class="carousel-indicators" style="z-index: 10;">';
    for($i=0;$i<count($qry);$i++){
      $cadena .= '<li data-target="#carousel-example-generic_2" data-slide-to="'.$i.'"></li>';
    }

    $cadena.='</ol> <div class="carousel-inner" role="listbox">';

    $cadena .= '
    <div class="item active">
        <img src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/'.$qry[0]['forma'].'" style="max-width: auto" />
    </div>';

    for($k=1;$k<count($qry);$k++){
      $cadena .= '
      <div class="item">
          <img src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/'.$qry[$k]['forma'].'" style="max-width: auto" />
      </div>';
    }
    $cadena.='</div>';
  }
  return  $cadena;
}

public function get_all_promos_taller(){
  $conn=new Conexion();
  $qry= $conn->taller_promociones();
  $cadena = null;
  if ($qry) {
    $cadena.='<ol class="carousel-indicators" style="z-index: 10;">';
    for($i=0;$i<count($qry);$i++){
      $cadena .= '<li data-target="#carousel-example-generic_3" data-slide-to="'.$i.'"></li>';
    }

    $cadena.='</ol> <div class="carousel-inner" role="listbox">';

    $cadena .= '
    <div class="item active">
        <img src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/'.$qry[0]['forma'].'" style="max-width: auto" />
    </div>';

    for($k=1;$k<count($qry);$k++){
      $cadena .= '
      <div class="item">
          <img src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/'.$qry[$k]['forma'].'" style="max-width: auto" />
      </div>';
    }
    $cadena.='</div>';
  }
  return  $cadena;
}

public function get_all_promos_accesorios(){
  $conn=new Conexion();
  $qry= $conn->accesorios_promociones();
  $cadena = null;
  if ($qry) {
    $cadena.='<ol class="carousel-indicators" style="z-index: 10;">';
    for($i=0;$i<count($qry);$i++){
      $cadena .= '<li data-target="#carousel-example-generic_1" data-slide-to="'.$i.'"></li>';
    }

    $cadena.='</ol> <div class="carousel-inner" role="listbox">';

    $cadena .= '
    <div class="item active" style="justify-content:center;align-items:center;">
        <img src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/'.$qry[0]['forma'].'" style="max-width: auto;object-fit: contain;" />
    </div>';

    for($k=1;$k<count($qry);$k++){
      $cadena .= '
      <div class="item" style="justify-content:center;align-items:center;">
          <img src="https://d3s2hob8w3xwk8.cloudfront.net/promociones/ofertas/'.$qry[$k]['forma'].'" style="max-width: auto;object-fit: contain;" />
      </div>';
    }
    $cadena.='</div>';
  }
  return  $cadena;
}

public function query_blog($id){
  $conn= Database::connect();
  $sql="SELECT * FROM blogs WHERE id=".$id;
  $result=$conn->query($sql);
  if ($result) {
      while ($row = $result->fetch_assoc()) {
          $out[]=array_map("utf8_encode", $row);
      }
  } 
$conn=Database::close();
return $out;
}

//QRs
public function get_table_qrs(){
  $conn= Database::connect();
  $sql = 'SELECT * FROM mkt_qr order by nombre asc';
  $result=$conn->query($sql);
  if ($result) {
      while ($row = $result->fetch_assoc()) {
          $out[]=array_map("utf8_encode", $row);
      }
  } 
  $conn=Database::close();
  return $out;
  
}
public function catalogo_autos_activos(){
  $conn= Database::connect();
  $sql = 'SELECT * FROM catalogo where status = 1  GROUP BY slug, marca, modelo, ano';
  $result=$conn->query($sql);
  if ($result) {
      while ($row = $result->fetch_assoc()) {
          $out[]=array_map("utf8_encode", $row);
      }
  } 
  $conn=Database::close();
  return $out;
}
  public function get_versiones_not_null($marca, $modelo, $ano)
  {
    $out = array();
    $conn = Database::connect();
    $sql = 'SELECT * FROM riverorenta_grupormx_exp.versiones where marca="' . $marca . '" AND modelo = "' . $modelo . '" AND ano = "' . $ano . '" AND version IS NOT NULL;';
    $result = $conn->query($sql);
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $out[] = array_map("utf8_encode", $row);
      }
    }
    $conn = Database::close();
    return $out;
  }

  public function get_inventario_versiones($slug, $version){
    $out = array();
    $conn = Database::connect();
    $sql = 'SELECT * FROM riverorenta_grupormx_exp.inventario_versiones where slug="' . $slug .'" AND version = "'.$version.'";';
    $result = $conn->query($sql);
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $out[] = array_map("utf8_encode", $row);
      }
    }
    $conn = Database::close();
    return $out;
  }
  
  public function get_inventario_colores_by_slug($slug){
    $out = array();
    $conn = Database::connect();
    $sql = 'SELECT * FROM riverorenta_grupormx_exp.inventario_colores WHERE slug="'.$slug.'"';
    $result = $conn->query($sql);
    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $out[] = array_map("utf8_encode", $row);
      }
    }
    $conn = Database::close();
    return $out;
  }

/*Fin Class Construir*/
}

?>
