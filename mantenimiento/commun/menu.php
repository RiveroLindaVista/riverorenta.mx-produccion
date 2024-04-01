<?php
  session_start();
  require_once("../commun/_config.php");
  require_once("../_classes/_conne.php");
  require_once("../_classes/classes.php");
  require_once("../commun/_config.php");
  $consultas=new Consultas();

    $notif=$consultas->get_user_notificaciones($_SESSION["nombre"]);
    $notificaciones = $notif[0]["notificaciones"];
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img class="mr-3" src="../img/primorivero.png" width="60px" /><img src="../img/logo_rivero.png" width="150px" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="border-left: 1px solid white;">

            <audio autoplay  id="playAudio">
                <source src="https://cdn.pixabay.com/audio/2023/01/06/audio_43c9ef7336.mp3" type="audio/mp3">
            </audio>

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link disabled" href="#"><?= $_SESSION["nombre"] ?> </a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="/home">Mis Solicitudes<span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                    <?php if ($notificaciones > 0){ ?>
                        <div id="badgeN" style="cursor: pointer" onclick="verNotificaciones()"><a class="nav-link" style="position:relative;"><span><i class="fa fa-bell text-white"  aria-hidden="true"></i></span><span id="badgeRed" class="badge" style="top:0;right:0; margin-top: -5px;position:absolute;background-color:red;color:white;box-shadow: 2px 2px 5px gray;"><?= $notificaciones; ?> </span></a></div>
                    <?php } else { ?>
                        <div id="badgeN" style="cursor: pointer"><a class="nav-link" style="position:relative;"><span><i class="fa fa-bell text-white"  aria-hidden="true"></i></span></a></div>
                    <?php } ?>
                </li>

                <li class="nav-item">
                    <a class="nav-link" style="cursor:pointer;" onclick="salir()">Cerrar Sesión</a>
                    <input class="form-control" type="text" name="notificaciones_actual" id="notificaciones_actual" value="<?= $notificaciones ?>" hidden/>
                    <input class="form-control" type="text" name="gerente" id="gerente" value="<?=$_SESSION["nombre"]?>" hidden/>
                </li>

            </ul>
        </div>
    </nav>

    <!-- Modal Notificaciones -->
    <div class="modal fade" id="notificacionesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tus Notificaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="areaNotificaciones"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var audio = document.getElementById('playAudio');
        $(document).ready(function () {


        });

        setInterval(() => {

            var notif_actual = $("#notificaciones_actual").val();
            var gerente = $("#gerente").val();

            let params = {
                gerente: gerente,
                func: "ciclo_notificaciones"
            };

            //console.log(params);

            $.ajax({
                url: "../home/funciones.php",
                method: "POST",
                data: params,
                dataType: "json",
                success: function (resp) {
                    if (resp > notif_actual){
                        audio.play();
                        $("#notificaciones_actual").val(resp);
                        $("#badgeN").html('<a class="nav-link" onclick="verNotificaciones()" style="position:relative;"><span><i class="fa fa-bell text-white"  aria-hidden="true"></i></span><span id="badgeRed" class="badge" style="top:0;right:0; margin-top: -5px;position:absolute;background-color:red;color:white;box-shadow: 2px 2px 5px gray;">'+resp+'</span></a>');
                    }
                }
            });
        }, 10000);

        function verNotificaciones(){
            var gerente = $("#gerente").val();

            let params = {
                gerente: gerente,
                func: "ver_notificaciones"
            };

            $not = '';
            $.ajax({
                url: "../home/funciones.php",
                method: "POST",
                data: params,
                dataType: "json",
                success: function (resp) {
                    for(let i=0;i<resp.length;i++){
                        $not += "<div class='p-3 m-1' style='border-radius:15px;background-color:#E3E9FB;border: 1px solid #4573F8;cursor:pointer;' onclick='irNotificacion("+resp[i]["id"]+")'>#"+resp[i]["id"]+" - "+resp[i]["log_usuario"]+" <i class='fa fa-share' aria-hidden='true'></i> </div>";
                    }

                    $("#areaNotificaciones").html('<div>'+$not+'</div>');
                    $("#notificacionesModal").modal('show');
                }
            });
        }

        function irNotificacion(id){

            let params = {
                id: id,
                func: "limpiar_notificacion"
            };

            $.ajax({
                url: "../home/funciones.php",
                method: "POST",
                data: params,
                dataType: "json",
                success: function (resp) {
                    location.href ="https://mantenimiento.gruporivero.com/solicitud?ticket="+resp;
                }
            });

        }

        function salir(){
            location.href ="https://mantenimiento.gruporivero.com/login";
        }

    </script>

    <style>

        #badgeRed{
            animation-duration: 3s;
            animation-name: izqAder;
            animation-direction: alternate;
        }

        @keyframes izqAder {
            0% { background-color: #C20A0A; }
            100% { background-color: #F2B400; }
        }

    </style>