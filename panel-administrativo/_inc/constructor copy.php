<?php
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


}

?>
