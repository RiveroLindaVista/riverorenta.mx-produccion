<?php
  session_start();
  require_once("../commun/_config.php");
  require_once("../_classes/_conne.php");
  require_once("../_classes/classes.php");
  require_once("../commun/_config.php");
  $consultas=new Consultas();

  $solicitudes=$consultas->get_solicitudes_by_user($_SESSION["nombre"]);
  $usu=$consultas->get_user($_SESSION["nombre"]);
  $sucursal = $usu[0]["sucursal"];
  $gerente = $_SESSION["nombre"];
  $fecha = date('Y-m-d H:i:s');

  foreach ($solicitudes as $key => $value) {

    $params=base64_encode(json_encode($value));
    $listaSolicitudes.= '
    <div class="row">
        <div class="card shadow m-1 p-2 col-12 col-lg-6 col-md-5 col-sm-12">
            <h3 class="mt-3">'.$value["titulo"].' - '.$value["zona"].'</h3> <br/>
            <p style="position:relative;">'.$value["descripcion"].'</p>
            <span style="position: absolute; right:5px; font-size: 12px;">'.$value["fecha_solicitud"].'</span>
        </div>

        <div class="card shadow m-1 p-2 col-12 col-lg-5 col-md-4 col-sm-12">
            <h3 class="text-center">'.$value["status"].'</h3>
            <div class="btn bg-success text-white m-1" onclick="irSolicitud(\''.$value["id"].'\')"> Ir a Solicitud </div>
            <div class="btn bg-info text-white m-1" onclick="chat(\''.$value["id"].'\')"> Ver Mensajes </div>
        </div>
    </div> <hr/>
    ';
  }
?>

<div class=" row d-flex justify-content-center align-items-center p-2">
    <div class="btn bg-success text-white m-1" onclick="showCrear()"> CREAR SOLICITUD </div>
    <div class="btn bg-primary text-white m-1" onclick="showMisSolicitudes()"> VER MIS SOLICITUDES </div>
</div>

<hr/>

<div id="areaMisSolicitudes">
    <div class="d-flex justify-content-center">
        <div>
            <h1 class="text-center"> Solicitudes Realizadas </h1>
            <?= $listaSolicitudes; ?>
        </div>
    </div>
</div>

<div id="areaCrearSolicitud" style="display:none;">

    <div class="card shadow mb-4">

        <div class="card-body">
            <h1 class="text-center">Nueva Solicitud </h1>
            </hr>
            <div class="row form-group">

                <div class="col-3 m-2" >
                    <label for="exampleInputUnidad">Gerente:</label>
                    <input class="form-control" type="text" name="gerente" id="gerente" value="<?= $_SESSION["nombre"]; ?>" disabled/>
                    <input class="form-control" type="text" name="fecha" id="fecha" value="<?= $fecha; ?>" hidden/>
                </div>

                <div class="col-3 m-2" >
                    <label for="exampleInputUnidad">Sucursal:</label>
                    <input class="form-control" type="text" name="sucursal" id="sucursal" value="<?= $usu[0]["sucursal"]; ?>" disabled/>
                </div>

                <div class="col-5 m-2" >
                    <label for="exampleInputUnidad">Área:</label>
                    <input class="form-control" type="text" name="zona" id="zona" placeholder="Escribe el área / ubicación afectada"/>
                </div>

                <div class="col-12 m-2" >
                    <label for="exampleInputUnidad">Titulo:</label>
                    <input class="form-control" type="text" name="titulo" id="titulo"/>
                </div>

                <div class="col-12 m-2" >
                    <label for="exampleInputUnidad">Descripcion:</label>
                    <textarea class="form-control" type="text" name="descripcion" id="descripcion"></textarea>
                </div>

                <div class="col-12 d-flex justify-content-center" >
                    <div class="btn bg-success text-white m-1" onclick="enviarSolicitud('<?= $sucursal ?>', '<?= $gerente ?>')"> ENVIAR </div>
                </div>

            </div>
        </div>
    </div>
</div>

  <!-- Creacion de Solicitud Modal -->
<div class="modal fade" id="okModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body d-flex justify-content-center">
                <h3 style="color:black;"> Se ha enviado tu solicitud al Equipo de Mantenimiento </h3>
            </div>
            <div class="d-flex justify-content-center" id="numTicket"></div>
            
            <div class="modal-footer d-flex justify-content-center"><button type="button" class="btn btn-success" onclick="refresh()">OK</button></div>
        </div>
    </div>
</div>

  <!-- Enviar Mensaje Modal -->
  <div class="modal fade" id="enviarMensajeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Escribe tu mensaje</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <div class="col-12 m-2" >
                        <div id="lastMsj"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12 m-2" >
                        <label for="exampleInputUnidad">Mensaje:</label>
                        <input class="form-control" type="text" name="id-solicitud" id="id-solicitud" hidden/>
                        <input class="form-control" type="text" name="mensaje" id="mensaje"/>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="enviarMensaje('<?= $gerente ?>')">ENVIAR</button>
            <audio autoplay  id="playAudio">
                <source src="https://cdn.pixabay.com/audio/2022/10/30/audio_f5dbe8213e.mp3" type="audio/mp3">
            </audio>
        </div>
        </div>
    </div>
</div>

<!-- Modal Chat Completo -->
<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatTitulo">Chat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="chatMsj"></div>
        <br/>
        <input class="form-control" type="text" name="mensajeChat" id="mensajeChat" placeholder="Escribe un mensaje..."/>
        <input class="form-control" type="text" name="idChat" id="idChat" hidden/>
        <input class="form-control" type="text" name="num_msjs_actual" id="num_msjs_actual" hidden/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="mensaje_chat('<?= $gerente ?>')">Enviar Mensaje</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    var audio = document.getElementById('playAudio');

    function enviarSolicitud($sucursal, $gerente){

        var gerente = $gerente;
        var sucursal = $sucursal;
        var fecha = $("#fecha").val();
        var zona = $("#zona").val();
        var titulo = $("#titulo").val();
        var descripcion = $("#descripcion").val();

        let params = {
            gerente: gerente,
            sucursal: sucursal,
            fecha: fecha,
            zona: zona,
            titulo: titulo,
            descripcion: descripcion,
            func: "nueva_solicitud"
        };

        console.log(params);

        $.ajax({
            url: "funciones.php",
            method: "POST",
            data: params,
            dataType: "json",
            success: function (resp) {
                $("#numTicket").html('<h2> Ticket #'+resp+'</h1>');
                $("#okModal").modal('show');
            }
        });
    }

    function irSolicitud(id){
        location.href ="https://mantenimiento.gruporivero.com/solicitud?ticket="+id;
    }

/*     function mensajear(idSolicitud){
        $("#notificacionesModal").modal('hide')
        $("#lastMsj").html('');
        $("#id-solicitud").val(idSolicitud);
        var imensaje = document.getElementById('mensaje');
        imensaje.style.border = ' 2px solid green';

        let params = {
            id: idSolicitud,
            func: "ver_ultimo_mensaje"
        };

        $.ajax({
            url: "funciones.php",
            method: "POST",
            data: params,
            dataType: "json",
            success: function (resp) {
                $chat = resp.split("|");
                $n = $chat.length;
                $n = $n - 2;
                console.log($chat[$n].substring($chat[$n].length -2));
                if ($chat[$n].substring($chat[$n].length -2) == "ad"){
                    $ult = 'Mantenimiento: '+$chat[$n].substring(0, $chat[$n].length -2);
                } else {
                    $ult = 'Tú: '+$chat[$n].substring(0, $chat[$n].length -2);
                }

                $("#lastMsj").html('<label for="exampleInputUnidad">Último Mensaje</label><p>'+$ult+'</p><hr/>');
            }
        });

        $("#enviarMensajeModal").modal('show')
    } */

    function enviarMensaje(gerente){

        var id = $("#id-solicitud").val();
        var mensaje = $("#mensaje").val();
        
        if (mensaje != ""){
            let params = {
                id: id,
                gerente: gerente,
                mensaje: mensaje,
                func: "enviar_mensaje"
            };

            $.ajax({
                url: "funciones.php",
                method: "POST",
                data: params,
                dataType: "json",
                success: function (resp) {
                    console.log(resp, "Resp envio");
                    audio.play();
                    $("#mensaje").val('');
                    $("#enviarMensajeModal").modal('hide')
                }
            });
        } else {
            var imensaje = document.getElementById('mensaje');
            imensaje.style.border = ' 2px solid red';
        }

    }

    let chat_completo = '';

    function chat(idSolicitud){

        $("#idChat").val(idSolicitud);

        let params = {
            id: idSolicitud,
            func: "ver_chat"
        };

        $.ajax({
            url: "funciones.php",
            method: "POST",
            data: params,
            dataType: "json",
            success: function (resp) {
                
                $chat = resp.split("|");
                $n = $chat.length;
                $n = $n - 2;
                $("#num_msjs_actual").val($n);
                $ult = '';
                for(let i=0;i<=$n;i++){
                    console.log($chat[i].substring($chat[i].length -2));
                     if ($chat[i].substring($chat[i].length -2) == "ad"){
                        $ult += '<div class="d-flex justify-content-left"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #103397;background-color:#133CB2;color:white;">Mantenimiento: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                    } else {
                        $ult += '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                    } 
                    
                }

                chat_completo = $ult;
                console.log(chat_completo, "chat completo");
                
                $("#chatMsj").html('<div>'+$ult+'<div>');
            }
        });

        $("#chatModal").modal('show')
    }

    function mensaje_chat(gerente){
        var id = $("#idChat").val();
        var mensaje = $("#mensajeChat").val();
        var num_msjs_actual = $("#num_msjs_actual").val();

        if (mensaje != ""){
            let params = {
                id: id,
                gerente: gerente,
                mensaje: mensaje,
                func: "enviar_mensaje"
            };

            $.ajax({
                url: "funciones.php",
                method: "POST",
                data: params,
                dataType: "json",
                success: function (resp) {
                    console.log(resp, "Resp envio");
                    chat_completo+= '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+mensaje+'</div></div><br/>';
                    $("#chatMsj").html('<div>'+chat_completo+'<div>');
                    $("#num_msjs_actual").val(num_msjs_actual++);
                    audio.play();
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

        let params = {
            gerente: gerente,
            id: id,
            func: "ver_chat"
        };

        //console.log(params);

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
            console.log(num_msjs_actual, "-> msjActual. ", $n, "-> cantidad");
            if ($n > num_msjs_actual){
                $("#num_msjs_actual").val($n);
                for(let i=0;i<=$n;i++){
                    console.log($chat[i].substring($chat[i].length -2));
                    if ($chat[i].substring($chat[i].length -2) == "ad"){
                        $ult += '<div class="d-flex justify-content-left"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #103397;background-color:#133CB2;color:white;">Mantenimiento: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                    } else {
                        $ult += '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                    } 
                }
                audio.play();
                $("#chatMsj").html('<div>'+$ult+'<div>');
                chat_completo = $ult;
                var objDiv = document.getElementById("divScroll");
                objDiv.scrollTop = objDiv.scrollHeight;

            }
            }
        });
    }, 10000);

    function showCrear(){
        $("#areaMisSolicitudes").hide();
        $("#areaCrearSolicitud").show();
    }

    function showMisSolicitudes(){
        $("#areaMisSolicitudes").show();
        $("#areaCrearSolicitud").hide();
    }

    function refresh(){
        $("#okModal").modal('hide')
        location.reload();
    }

</script>