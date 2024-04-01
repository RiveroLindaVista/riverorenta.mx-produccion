<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/servicio/orders/espera/'.$sucursalId,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer '.$tokenId
  ),
));

$response = curl_exec($curl);

echo $response;

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/servicio/planning/turnos/'.$sucursalId,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/javascript'
  ),
));

$response = json_decode(curl_exec($curl));

curl_close($curl);
$asesores=[];
$asesoresX=[];
//var_dump($response->data);
foreach ($response->data as $key => $value) {
  $out[$value->turno_tipo][]=$value->turno;
  $out[$value->turno]=$value;
  if($value->turno_tipo=='A'){
    if(!in_array($value->asesor, $asesores)){
     $asesores[]=$value->asesor;
    }
    $asesor[$value->asesor][]=$value;
  }

  if($value->turno_tipo=='X'){
    if(!in_array($value->asesor, $asesoresX)){
     $asesoresX[]=$value->asesor;
    }
    $asesorX[$value->asesor][]=$value;
  }

}

for($i=0;$i<count($asesores);$i++){
  $cadena.='<div class="col card p-2 m-2">
      <center >
        <h6>'.$asesores[$i].'</h6>
        <div class="text-info">Fila: '.count($asesor[$asesores[$i]]).'</div>
        <div class="btnSiguienteAsesor" onclick="enviarHora(\''.$asesor[$asesores[$i]][0]->turno.'\')"><div class="textoIntAsesor">Entrega</div></div>
     </center></div>';
}

for($i=0;$i<count($asesoresX);$i++){
  $cadenaX.='<div class="col card p-2 m-2" >
      <center>
        <h6>'.$asesoresX[$i].'</h6>
        <div class="text-info">Fila: '.count($asesorX[$asesoresX[$i]]).'</div>
        <div class="btnSiguienteAsesorX" onclick="enviarHora(\''.$asesorX[$asesoresX[$i]][0]->turno.'\')"><div class="textoIntAsesor" style="font-size:15px">En Espera</div></div>
     </center></div>';
}
?>
<div class="container">

  <h4><center>Siguiente Turno</center></h4>
<hr/>
   <div class="row">
     <div class="col-6">
      <center id="conBtn" <?php if(count($out["D"])==0){echo "hidden";}?>>
        <h4>Clientes Citados</h4>
        <div class="text-info">Fila: <?=count($out["D"])?></div>
        <div class='btnSiguiente' onclick="enviarHora('<?=$out["D"][0]?>')"><div class="textoInt" >Citados</div></div>
     </center>
     <div <?php if(count($asesores)==0){echo "hidden";}?> class="sinBtnAsesor">
      <hr/>
      <h5 class="text-primary">Entregas</h5>
         <div class="row">
         <?=$cadena?>
       </div>
     </div>

     </div>
     <div class="col-6">
      <center id="sinBtn" <?php if(count($out["W"])==0){echo "hidden";}?>>
        <h4>Clientes sin Cita</h4>
        <div class="text-info">Fila: <?=count($out["W"])?></div>
        <div class="btnSiguiente sin" onclick="enviarHora('<?=$out["W"][0]?>')"><div class="textoInt">Sin Cita</div></div>
     </center>
     <div <?php if(count($asesoresX)==0){echo "hidden";}?> class="sinBtnAsesor"> <hr/>
      <h5>Clientes en Espera de Asesor</h5>
      <div class="row">
        <?=$cadenaX?>
      </div>
    </div>
   </div>
   </div>
   <br/>
   

    
   <hr/>
   <center>
    Turno Actual
    <h4 id="turnoL"></h4>
   <h2 id="nombreL"></h2>
   Modelo:<strong id="modeloL"></strong>, Color:<strong id="colorL"></strong>, VIN:<strong id="vinL"></strong>, Placas:<strong id="placasL"></strong>
 </center>

</div>
<script type="text/javascript">
  function siguienteTurno($obj){
    console.log($obj);
    $("#conBtn").hide();
    $("#sinBtn").hide();
     $(".sinBtnAsesor").hide();
    setTimeout(function() {
      location.reload();
    }, 3000);
  }
  getTurno();
  function getTurno(){
    var settings = {
      "url": "https://multimarca.gruporivero.com/api/v1/servicio/turno/<?=$sucursalId?>",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/javascript"
      },
    };

    $.ajax(settings).done(function (response) {
 
      if(response){
        if(response[0]["turno"]!=$("#turnoIn").val()){
          $("#turnoL").html(response[0]["turno"]);
          $("#nombreL").html(response[0]["nombre"]);
          $("#modeloL").html(response[0]["modelo"]);
          $("#vinL").html(response[0]["vin"]);
          $("#placasL").html(response[0]["placas"]);
          $("#colorL").html(response[0]["color"]);
          
        }
      }
    });
  }

  function enviarHora($turno){
   
     $("#conBtn").hide();
    $("#sinBtn").hide();
    $(".sinBtnAsesor").hide();
    var arrayInfo=[<?=json_encode($out)?>];
    var status='';
    var param={
      sucursal:<?=$sucursalId?>,
      info:arrayInfo[0][$turno],
      status:arrayInfo[0][$turno]["status"]
     }
    

    if(param.status==1){
      param.tipo='hora_asesor';
    }else if(param.status==5){
      param.tipo='entrega_asesor';
    }
        $("#turnoL").html(param.info.turno);
        $("#nombreL").html(param.info.client.name);
        $("#modeloL").html(param.info.car.model);
        $("#vinL").html(param.info.car.vin);
        $("#placasL").html(param.info.car.placas);
        $("#colorL").html(param.info.car.color);

     $.ajax({
        url:"https://multimarca.gruporivero.com/api/v1/servicio/sendhoraplanning",
        method:"POST",
        headers: {
          "Accept": "application/json",
          "Authorization": "Bearer <?=$tokenId?>"
        },
        "data":param,
        success:function(response){
            setTimeout(function() {
              location.reload();
            }, 3000);
        }
      });
     

  }

          setTimeout(function() {
              location.reload();
            }, 60000);
</script>

<style type="text/css">

  .btnSiguiente{
    height: 120px;
    width: 120px;
    border-radius: 50%;
    background: #007bff;
    text-align: center;
    transition-duration: 0.5;
  }
  .btnSiguienteAsesor{
    height: 80px;
    width: 80px;
    border-radius: 50%;
    background: #17a2b8;
    text-align: center;
    transition-duration: 0.5;
  }
  .btnSiguienteAsesorX{
    height: 80px;
    width: 80px;
    border-radius: 50%;
    background: #343a40;
    text-align: center;
    transition-duration: 0.5;
  }
  .textoIntAsesor{
    text-align: center;
    padding-top: 40%;
    font-size: 15px;
    color:#fff;
  }
  .btnSiguiente.sin{
    background: #6c757d;
    text-align: center;
  }
  .textoInt{
    text-align: center;
     padding-top: 40%;
    font-size: 15px;
    color:#fff;
  }
  .btnSiguiente:hover{
    cursor: pointer;
    opacity: 0.7;
    transition-duration: 0.5;
  }
  .btnSiguienteAsesor:hover{
    cursor: pointer;
    opacity: 0.7;
    transition-duration: 0.5;
  }
  .btnSiguienteAsesorX:hover{
    cursor: pointer;
    opacity: 0.7;
    transition-duration: 0.5;
  }
</style>
