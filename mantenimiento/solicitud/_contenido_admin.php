<?php
  session_start();
  require_once("../commun/_config.php");
  require_once("../_classes/_conne.php");
  require_once("../_classes/classes.php");
  require_once("../commun/_config.php");
  $consultas=new Consultas();

  $solicitud=$consultas->get_solicitud_admin_by_id($_GET["ticket"]);
  $chats=$consultas->get_chat_admin_by_id($_GET["ticket"]);

  if ($solicitud[0]["prioridad"] == '0'){
    $priori = 'Elige la prioridad';
  } else if ($solicitud[0]["prioridad"] == '1'){
    $priori = 'ALTA';
  } else if ($solicitud[0]["prioridad"] == '2'){
    $priori = 'MEDIA';
  } else if ($solicitud[0]["prioridad"] == '3'){
    $priori = 'BAJA';
  }

  $chat = explode("|", $chats[0]["comentarios"]);

  $n = (count($chat));
  $n = $n - 2;
  $chatAll = '';
  for ($i = 0; $i <= $n; $i++) {
    if (substr($chat[$i], -2) == "ad"){
        $chatAll .= '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '.substr($chat[$i], 0, -2).'</div></div><br/>';
    } else {
        $chatAll .= '<div class="d-flex justify-content-left"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #103397;background-color:#133CB2;color:white;">'.$solicitud[0]["gerente"].': '.substr($chat[$i], 0, -2).'</div></div><br/>';
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

  $trabajadores=$consultas->get_trabajadores();

  foreach ($trabajadores as $key => $value) {
    if ($value["nombre"] != $solicitud[0]["trabajador"]){
        $selectTrabajadores.='<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
    }
  }
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
            <h4 class="text-center fecha-solicitud mb-0"> Elaboración: <?= $solicitud[0]["fecha_solicitud"]; ?> </h4>
        </div>
        <div class="col-12" style="background-color:#fff;border: 3px solid #5a5c69;border-bottom: 0px solid white;">
            <h4 class="text-center descripcion-titulo-solicitud"> Descripción: </h4>
        </div>
        <div class="col-12" style="background-color:#fff;border: 3px solid #5a5c69;border-top: 0px solid white;">
            <p style="font-size:20px" class="text-center descripcion-solicitud"><?= $solicitud[0]["descripcion"]; ?> </p>
        </div>
        <div class="col-12" style="background-color:#5a5c69;border: 3px solid #5a5c69;border-top: 0px solid white;">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3">
                    <label style="color:white;">Trabajador Asignado:</label>
                    <select id="trabajador" class="form-control" name="trabajador" onchange="asignarTrabajador()">
                        <option value="<?= $solicitud[0]["trabajador"]; ?>" selected><?= $solicitud[0]["trabajador"]; ?></option>
                        <?= $selectTrabajadores; ?>
                    </select>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3">
                    <label style="color:white;">Status:</label>
                    <select id="status" class="form-control" name="status" onchange="saveStatus()">
                        <option value="<?= $solicitud[0]["status"]; ?>" selected><?= $solicitud[0]["status"]; ?></option>
                        <option value="disabled" disabled>______</option>
                        <option value="ASIGNADA">ASIGNADA</option>
                        <option value="TRABAJANDO">TRABAJANDO</option>
                        <option value="ESPERA PROVEEDOR">ESPERA PROVEEDOR</option>
                        <option value="FINALIZADA">FINALIZADA</option>
                        <option value="RECHAZADA">RECHAZADA</option>
                    </select>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3">
                    <label style="color:white;">Prioridad:</label>
                    <select id="prioridad" class="form-control" name="prioridad" onchange="asignarPrioridad()">
                        <option value="<?= $solicitud[0]["prioridad"]; ?>" selected><?= $priori; ?></option>
                        <option value="disabled" disabled>______</option>
                        <option value="1">ALTA</option>
                        <option value="2">MEDIA</option>
                        <option value="3">BAJA</option>
                    </select>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3">
                    <label style="color:white;">Fecha Estimada:</label><br/>
                    <input type="date" id="fecha_estimada" onchange="saveEstimada()" style="width:200px;height:40px;" value="<?= $solicitud[0]["fecha_estimada"]; ?>"/>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12" style="background-color:#5a5c69;border: 3px solid #5a5c69; border-radius: 0px 0px 20px 20px;">
            <h1 style="text-align:center;font-weight:600;color:white;">Observaciones</h1>
            <?= $allObserv; ?>
        </div>
    </div>

    <div class="row" hidden>
      <div class="col-12"><h1 class="text-center"> Chatea con el Gerente </h1></div>
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
        <input class="form-control" type="text" name="gerente1" id="gerente1" value="<?= $solicitud[0]['gerente'] ?>" hidden/>
        <input class="form-control" type="text" name="num_msjs_actual" id="num_msjs_actual" value="<?= $n; ?>" hidden/>
        <button type="button" class="btn btn-primary" onclick="mensaje_chat('<?= $solicitud[0]['gerente'] ?>')">Enviar</button>
      </div>
    </div>
</div>

<script>

    function asignarTrabajador(){
        var trabajador = $("#trabajador").val();
        var id = $("#id").val();

        let params = {
            id: id,
            trabajador:trabajador,
            func: "change_trabajador"
        };

        $.ajax({
            url: "../home/funciones.php",
            method: "POST",
            data: params,
            dataType: "json",
            success: function (resp) {
                location.reload();
            }
        });
    }

    function asignarPrioridad(){
        var prioridad = $("#prioridad").val();
        var id = $("#id").val();

        let params = {
            id: id,
            prioridad:prioridad,
            func: "change_prioridad"
        };

        $.ajax({
            url: "../home/funciones.php",
            method: "POST",
            data: params,
            dataType: "json",
            success: function (resp) {
                location.reload();
            }
        });
    }

    function saveEstimada(){
        var fecha_estimada = $("#fecha_estimada").val();
        var id = $("#id").val();

        let params = {
            id: id,
            fecha_estimada:fecha_estimada,
            func: "change_fecha_estimada"
        };

        console.log(params);

        $.ajax({
            url: "../home/funciones.php",
            method: "POST",
            data: params,
            dataType: "json",
            success: function (resp) {
                location.reload();
            }
        });
    }

    function saveStatus(){

        var id = $("#id").val();
        var status = $("#status").val();

        if (status == "ASIGNADA"){
            mensaje = "Hemos asignado tu solicitud a un compañero de mantenimiento, pronto acudirá a trabajar en lo que solicitaste.";
        } else if (status == "TRABAJANDO"){
            mensaje = "Actualmente estamos trabajando en tu solicitud.";
        } else if (status == "ESPERA PROVEEDOR"){
            mensaje = "Tu solicitud se encuentra en espera ya que requerimos apoyo de un proveedor para atenderla.";
        } else if (status == "FINALIZADA"){
            mensaje = "Tu solicitud ha sido trabajada y finalizada.";
        } else if (status == "RECHAZADA"){
            mensaje = "Tu solicitud ha sido rechazada.";
        }

        let params = {
            id: id,
            status:status,
            mensaje: mensaje,
            func: "change_status"
        };

        $.ajax({
            url: "../home/funciones.php",
            method: "POST",
            data: params,
            dataType: "json",
            success: function (resp) {
                location.reload();
            }
        });
    }

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
          func: "enviar_mensaje_admin"
        };

        $.ajax({
          url: "../home/funciones.php",
          method: "POST",
          data: params,
          dataType: "json",
          success: function (resp) {
            chat_completo+= '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+mensaje+'</div></div><br/>';
            $("#chatMsj").html('<div>'+chat_completo+'<div>');
            var objDiv = document.getElementById("divScroll");
            objDiv.scrollTop = objDiv.scrollHeight;
            $("#mensajeChat").val('');
            audioMSJ.play();
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
      var gerente = $("#gerente1").val();
      var id = $("#idChat").val();

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
            if ($n > num_msjs_actual){
              for(let i=0;i<=$n;i++){
                if ($chat[i].substring($chat[i].length -2) == "ad"){
                    $ult += '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                } else {
                    $ult += '<div class="d-flex justify-content-left"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #103397;background-color:#133CB2;color:white;">'+gerente+': '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
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