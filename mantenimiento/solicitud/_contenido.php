<?php
  session_start();
  require_once("../commun/_config.php");
  require_once("../_classes/_conne.php");
  require_once("../_classes/classes.php");
  require_once("../commun/_config.php");
  $consultas=new Consultas();

  $gerente = $_SESSION["nombre"];
  $solicitud=$consultas->get_solicitud_by_id($_GET["ticket"],$gerente);
  $chats=$consultas->get_chat_by_id($_GET["ticket"],$gerente);

  $chat = explode("|", $chats[0]["comentarios"]);

  $n = (count($chat));
  $n = $n - 2;
  $chatAll = '';
  for ($i = 0; $i <= $n; $i++) {
    if (substr($chat[$i], -2) == "ad"){
        $chatAll .= '<div class="d-flex justify-content-left"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #103397;background-color:#133CB2;color:white;">Mantenimiento: '.substr($chat[$i], 0, -2).'</div></div><br/>';
    } else {
        $chatAll .= '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '.substr($chat[$i], 0, -2).'</div></div><br/>';
    } 
  }

  $observaciones = explode("|", $solicitud[0]["observaciones"]);
  if(count($observaciones) == 1) {
    $allObserv = '<h4 style="text-align:center;color: white;">Aún no hay observaciones</h4>';
  } else {
    $o = (count($observaciones));
    $o = $o - 2;
    $allObserv = '';
    for ($j = 0; $j <= $o; $j++) {
      $allObserv .= '<h4 style="text-align:center;color: white;"><i style="font-size:15px;margin-right:5px;" class="fa fa-exclamation-circle" aria-hidden="true"></i>'.$observaciones[$j].'</h4><br/>';
    }
  }

  $fecha = date('Y-m-d H:i:s');

?>

<audio autoplay id="playAudioMSJ">
    <source src="https://cdn.pixabay.com/audio/2022/10/30/audio_f5dbe8213e.mp3" type="audio/mp3">
</audio>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12" style="background-color:#fff;border: 3px solid #5a5c69; border-radius: 40px 40px 0px 0px;">
        <h1 class="text-center titulo-solicitud mb-0" id="titulo-solicitud"> Solicitud Folio #<?= $solicitud[0]["id"]; ?> - <?= $solicitud[0]["titulo"]; ?> </h1><br/>
        <p class="text-center mb-0">Status: <?= $solicitud[0]["status"]; ?></p>
        <input type="text" value="<?= $solicitud[0]["id"]; ?>" id="id" name="id" hidden/>
      </div>
      <div class="col-12" style="background-color:#5a5c69;color: white;">
        <h1 class="text-center gerente-solicitud"> Gerente: <?= $solicitud[0]["gerente"]; ?></h1>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-2 d-flex justify-content-center align-items-center" style="background-color:#5a5c69;color:white;align-items-center">
        <h4 class="text-center zona-solicitud mb-0"> <i class="fa fa-map-marker" style="color: #BD4141;"></i> Ubicación: <?= $solicitud[0]["zona"]; ?> </h4>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 p-2 d-flex justify-content-center align-items-center" style="background-color:#5a5c69;color:white;">
        <h4 class="text-center fecha-solicitud mb-0"> Elaboración: <?= substr($solicitud[0]["fecha_solicitud"], 0,10); ?> </h4>
      </div>
      <div class="col-12" style="background-color:#fff;border: 3px solid #5a5c69;border-bottom: 0px solid white;">
        <h4 class="text-center descripcion-titulo-solicitud"> Descripción: </h4>
      </div>
      <div class="col-12" style="background-color:#fff;border: 3px solid #5a5c69;border-top: 0px solid white;">
        <p style="font-size:20px" class="text-center descripcion-solicitud"><?= $solicitud[0]["descripcion"]; ?> </p>
      </div>
      <div class="col-12" style="background-color:#5a5c69;border: 3px solid #5a5c69; border-radius: 0px 0px 20px 20px;">
        <h1 style="text-align:center;font-weight:600;color:white;">Observaciones</h1>
        <?= $allObserv; ?>
      </div>
    </div>

    <div class="row" hidden>
      <div class="col-12 d-flex justify-content-center p-2">
        <div id="divScroll" class="p-3" style="background-color:white;border: 1px solid black;min-width:300px;width:70%; height: 450px;overflow-y:auto;border-radius:20px; word-wrap: break-word;">
          <div id="chatMsj">
            <?= $chatAll; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row" hidden>
      <div class="col-12 d-flex justify-content-center">
        <input style="min-width:200px;width:50%;" class="form-control" type="text" name="mensajeChat" id="mensajeChat" placeholder="Escribe un mensaje..."/>
        <input class="form-control" type="text" name="idChat" id="idChat" value="<?= $_GET["ticket"]; ?>" hidden/>
        <input class="form-control" type="text" name="gerente" id="gerente" value="<?= $gerente; ?>" hidden/>
        <input class="form-control" type="text" name="num_msjs_actual" id="num_msjs_actual" value="<?= $n; ?>" hidden/>
        <button type="button" class="btn btn-primary" onclick="mensaje_chat('<?= $gerente ?>')">Enviar</button>
      </div>
    </div>
  </div>

  <script>
    var audioMSJ = document.getElementById('playAudioMSJ');
    let chat_completo = document.getElementById("chatMsj");
    chat_completo = chat_completo.innerHTML;

    var objDiv = document.getElementById("divScroll");
    objDiv.scrollTop = objDiv.scrollHeight;

    function mensaje_chat(gerente){
      let chat_completo = document.getElementById("chatMsj");
      chat_completo = chat_completo.innerHTML;
      var id = $("#idChat").val();
      var mensaje = $("#mensajeChat").val();

      if (mensaje != ""){
        let params = {
          id: id,
          gerente: gerente,
          mensaje: mensaje,
          func: "enviar_mensaje"
        };

        $.ajax({
          url: "../home/funciones.php",
          method: "POST",
          data: params,
          dataType: "json",
          success: function (resp) {
            console.log(resp, "Resp envio");
            chat_completo+= '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+mensaje+'</div></div><br/>';
            $("#chatMsj").html('<div>'+chat_completo+'<div>');
            var objDiv = document.getElementById("divScroll");
            objDiv.scrollTop = objDiv.scrollHeight;
            audioMSJ.play();
            $("#mensajeChat").val('');
            var iChatmensaje = document.getElementById('mensajeChat');
            iChatmensaje.style.border = ' 1px solid green';
          }
        });
      } else {
        var iChatmensaje = document.getElementById('mensajeChat');
        iChatmensaje.style.border = ' 2px solid red';
      }
    }

    setInterval(() => {

      var num_msjs_actual = $("#num_msjs_actual").val();
      var gerente = $("#gerente").val();
      var id = $("#idChat").val();

      console.log(num_msjs_actual, "MsjActual");

      let params = {
          gerente: gerente,
          id: id,
          func: "ver_chat"
      };

      $.ajax({
          url: "../home/funciones.php",
          method: "POST",
          data: params,
          dataType: "json",
          success: function (resp) {
            
            $chat = resp.split("|");
            $n = $chat.length;
            $n = $n - 2;
            $ult = '';
            console.log($n, "cantidad");
            if ($n > num_msjs_actual){
              for(let i=0;i<=$n;i++){
                console.log($chat[i].substring($chat[i].length -2));
                  if ($chat[i].substring($chat[i].length -2) == "ad"){
                  $ult += '<div class="d-flex justify-content-left"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #103397;background-color:#133CB2;color:white;">Mantenimiento: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                } else {
                  $ult += '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                } 
              }
              audioMSJ.play();
              $("#chatMsj").html('<div>'+$ult+'<div>');
              var objDiv = document.getElementById("divScroll");
              objDiv.scrollTop = objDiv.scrollHeight;

              $("#num_msjs_actual").val($n++);
            }
          }
      });
    }, 10000);
  </script>

  <style>
    @media screen and (max-width: 450px){
      .titulo-solicitud{
          font-size: 15px!important;
      }
      .gerente-solicitud{
          font-size: 20px!important;
      }
      .zona-solicitud{
          font-size: 20px!important;
      }
      .fecha-solicitud{
          font-size: 20px!important;
      }
      .descripcion-titulo-solicitud{
          font-size: 20px!important;
      }
      .descripcion-solicitud{
          font-size: 12px!important;
      }
    }
  </style>