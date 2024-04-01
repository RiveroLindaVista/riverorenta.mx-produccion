<?php
  session_start();
  require_once("../commun/_config.php");
  require_once("../_classes/_conne.php");
  require_once("../_classes/classes.php");
  require_once("../commun/_config.php");
  $consultas=new Consultas();

  if(!isset($_GET["filtro"])){
    $filtro='todo';
    $filtroSelected='<option value="'.$filtro.'">'.strtoupper($filtro).'</option>';
  }else {
    $filtro=substr($_GET["filtro"], 0, -1);
    $labelFiltro = str_replace("-", " ", $filtro);
    $filtroSelected='<option value="'.$filtro.'" selected>'.strtoupper($labelFiltro).'</option>';
  }

  $solicitudes=$consultas->get_solicitudes_admin($filtro);
  $trabajadores=$consultas->get_trabajadores();

  foreach ($trabajadores as $key => $value) {
    $selectTrabajadores.='<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
  }

  $fecha = date('Y-m-d H:i:s');
  foreach ($solicitudes as $key => $value) {
    $params=base64_encode(json_encode($value));

    if ($value["prioridad"] == '1'){
      $prioridad = 'ALTA';
      $estiloPrioridad = 'style="background-color:#F1A5A5;"';
    } else if ($value["prioridad"] == '2'){
      $prioridad = 'MEDIA';
      $estiloPrioridad = 'style="background-color:#EAE4C7;"';
    } else if ($value["prioridad"] == '3'){
      $prioridad = 'BAJA';
      $estiloPrioridad = 'style="background-color:#C8EAC7;"';
    } else if ($value["prioridad"] == '0'){
      $prioridad = 'BAJA';
      $estiloPrioridad = '';
    }

    $tablaSolicitudes.= '<tr>
    <td>'.$value["titulo"].'</td>
    <td>'.$value["zona"].'</td>
    <td>'.substr($value["descripcion"], 0,35).'...</td>
    <td>'.$value["sucursal"].'</td>
    <td>'.$value["gerente"].'</td>
    <td>'.substr($value["fecha_solicitud"], 0,10).'</td>
    <td>'.$value["status"].'<i class="fa fa-angle-down ml-2" style="cursor:pointer;" aria-hidden="true" onclick="changeStatus(\''.$params.'\')"></i></td>';

    if ($value["trabajador"] == ""){
      $tablaSolicitudes.= '<td><i class="fa fa-user-plus" style="cursor:pointer;" aria-hidden="true" onclick="asignar(\''.$params.'\')"></i></td>';
    } else {
      $tablaSolicitudes.= '<td>'.$value["trabajador"].'<i class="fa fa-angle-down ml-2" style="cursor:pointer;" aria-hidden="true" onclick="asignar(\''.$params.'\')"></i></td>';
    }

    $tablaSolicitudes.= '
    <td '.$estiloPrioridad.'>
    <button class="btn bg-success text-white mr-2" onclick="verSolicitud(\''.$value["id"].'\')">Ver Solicitud</button>
    <button class="btn bg-primary text-white" onclick="chat(\''.$value["id"].'\')"><i class="fa fa-comments" aria-hidden="true"></i></button>
    </td>
    </tr>';

    $tablaSolicitudesMovil.= '<tr>
    <td '.$estiloPrioridad.'>'.$value["titulo"].'</td>
    <td>
    <button class="btn bg-success text-white mr-2" onclick="verSolicitud(\''.$value["id"].'\')">Ver</button>
    <button class="btn bg-primary text-white" onclick="chat(\''.$value["id"].'\')"><i class="fa fa-comments" aria-hidden="true"></i></button>
    </td>
    </tr>';
  }
  ?>

<div class=" container-fluid">
    <div style="width:200px;display:flex;margin-bottom:10px;">
      <i class="fa fa-filter mt-2 mr-2" aria-hidden="true"></i>
      <select class="form-control" id="filtros">
        <?= $filtroSelected ?>
        <option value="prioridad">Ordena por Prioridad</option>
        <option value="prioridad-alta">Ver Prioridad Alta</option>
        <option value="prioridad-media">Ver Prioridad Media</option>
        <option value="prioridad-baja">Ver Prioridad Baja</option>
        <option value="fecha-estimada">Ordena por Fecha Estimada</option>
        <option value="todo">Todas</option>
      </select>
    </div>
    <!-- DataTables Examplee -->
    <div class="card shadow mb-4  d-md-block d-sm-none d-none">
        <div class="card-body">
            <table class="table-sm table-bordered table-hover" id="tablaSuper" width="100%" data-toggle="table" cellspacing="0">
                <thead class="bg-secondary text-white text-center ">
                    <tr>
                        <th class="p-2">Titulo</th>
                        <th class="p-2">Área</th>
                        <th class="p-2">Descripcion</th>
                        <th class="p-2">Sucursal</th>
                        <th class="p-2">Gerente</th>
                        <th class="p-2">Fecha</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Asignado a</th>
                        <th class="p-2">Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?=$tablaSolicitudes;?>
                </tbody>
            </table>
        </div>
    </div>

        <!-- Tabla Movil d-sm-block d-md-none -->
    <div class="card shadow mb-4 d-md-none d-sm-block d-block">
        <div class="card-body">
            <table class="table-sm table-bordered table-hover" id="tablaSuper" width="100%" data-toggle="table" cellspacing="0">
                <thead class="bg-secondary text-white text-center ">
                    <tr>
                        <th class="p-2">Titulo</th>
                        <th class="p-2">Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?=$tablaSolicitudesMovil;?>
                </tbody>
            </table>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="mensaje_chat()">Enviar Mensaje</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Asignacion -->
<div class="modal fade" id="asignarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatTitulo">Asignar Solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label> Elige el trabajador que deseas asignarle la solicitud: </label>
        <select id="trabajador" class="form-control" name="trabajador">
            <?= $selectTrabajadores; ?>
        </select>
        <input class="form-control" type="text" name="idSoli" id="idSoli" hidden/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="asignarTrabajador()">ASIGNAR</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Status -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatTitulo">Status de la Solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label> Elige el status actual de la solicitud: </label>
        <select id="status" class="form-control" name="status">
            <option value="ASIGNADA">ASIGNADA</option>
            <option value="TRABAJANDO">TRABAJANDO</option>
            <option value="FINALIZADA">FINALIZADA</option>
            <option value="ESPERA PROVEEDOR">ESPERA PROVEEDOR</option>
            <option value="RECHAZADA">RECHAZADA</option>
        </select>
        <input class="form-control" type="text" name="idSolicitud" id="idSolicitud" hidden/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="saveStatus()">ACTUALIZAR</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

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
                $ult = '';
                for(let i=0;i<=$n;i++){
                    console.log($chat[i].substring($chat[i].length -2));
                    if ($chat[i].substring($chat[i].length -2) == "ad"){
                        $ult += '<div class="d-flex" style="justify-content:flex-end"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #96ABE7;background-color:#9CB4F5;color:black;">Tú: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                        console.log('ad');
                    } else {
                        $ult += '<div class="d-flex justify-content-left"><div class="p-2" style="max-width: 320px;border-radius: 10px;border: 1px solid #103397;background-color:#133CB2;color:white;">Gerente: '+$chat[i].substring(0, $chat[i].length -2)+'</div></div><br/>';
                        console.log('tu');
                    } 
                    
                }

                chat_completo = $ult;
                console.log(chat_completo, "chat completo");
                
                $("#chatMsj").html('<div>'+$ult+'<div>');
            }
        });

        $("#chatModal").modal('show')
    }

    function mensaje_chat(){
        var id = $("#idChat").val();
        var mensaje = $("#mensajeChat").val();

        if (mensaje != ""){
            let params = {
                id: id,
                mensaje: mensaje,
                func: "enviar_mensaje_admin"
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

    function asignar(params){
        $parametros=window.atob(params);
        $parametros=JSON.parse($parametros);

        $("#trabajador").val($parametros["trabajador"]);
        $("#idSoli").val($parametros["id"]);

        $("#asignarModal").modal('show');
    }

    function asignarTrabajador(){
        var trabajador = $("#trabajador").val();
        var id = $("#idSoli").val();

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

    function changeStatus(param){
        $parametros=window.atob(param);
        $parametros=JSON.parse($parametros);

        $("#status").val($parametros["status"]);
        $("#idSolicitud").val($parametros["id"]);

        $("#statusModal").modal('show');
    }

    function saveStatus(){

        var id = $("#idSolicitud").val();
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

    function verSolicitud(id){
      location.href ="https://mantenimiento.gruporivero.com/solicitud?ticket="+id;
    }

    $("#filtros").on("change",function(){
        window.location.href="?filtro="+$(this).val()+"/";
    });

    $(document).ready(function () {
        $('#tablaSuper').DataTable({
            order: [[4, 'asc']],
            aLengthMenu: [
                [10,25, 50, 100, -1],
                [10,25, 50, 100, "Todos"]
            ],
            iDisplayLength: -1
        });
    });

</script>