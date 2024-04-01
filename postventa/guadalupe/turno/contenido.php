

<div class="container-fluid " style="padding-left: 40px; padding-right: 40px; background: linear-gradient(#000204, #02477d); height: 100%;">
  <input type="text" value="" id="turnoIn" hidden/>
<!-- <hr/> -->
<div id="inicio" onclick="activar()" class="btn btn-primary btn-lg">Iniciar</div>


<div class="row" style="background-color: #003864;">
<!-- <div class="row" style="background: linear-gradient(#003864, #003864);"> -->
<div class="col-2" style="">
  <img src="../../recepcion/images/rivero_header_logo.webp" alt="icon Rivero" width="100%" style="max-width: 250px;"/>
</div>
<div class="col-10" id="turnos" style="" >
   <center  style="border-left: 5px rgb(50, 146, 206);">
    <div> <h3 id="turnoL" class="text-light" style="font-size:45px">TURNO ACTUAL: </h3> </div> 
    <!-- <div><h1 id="nombreL" style="font-size:80px"></h1> </div> -->
    <div style="font-size: 35px; color:white">
      Modelo:<strong id="modeloL"></strong>, Color:<strong id="colorL"></strong>, VIN:<strong id="vinL"></strong>, Placas:<strong id="placasL"></strong>
    </div>
   
 </center>
</div>


</div>

<div class="row" style="color: white;">
  <div class="col-3" style="display: flex; align-items: center; justify-content: center; font-weight: bold">
    <h4>CON CITA</h4>
  </div>
  <div class="col-6">
  </div>
  <div class="col-3" style="display: flex; align-items: center; justify-content: center; font-weight: bold">
    <h4>SIN CITA</h4>
  </div>
</div>

<div class="row" style="height: 100% ; background-color: rgb(255, 255, 255);">
  <div class="col-3" style="background: linear-gradient(#003864, #055a9b); height:auto; min-height:80dvh;">
      <ul class="list-group list-group-flush" id="ul_list_con_cita">


      </ul>
    </div>
    <div class="col-6" style="background-color: black; display: flex; align-items: bottom; ">
      <video id="videoId" style="border: 5px rgb(6, 48, 73) solid;" width="100%"  controls autoplay loop>
        <source src="../../recepcion/videos/rivero.mp4" type="video/mp4">
      </video>
    </div>
    <div class="col-3" style=" background: linear-gradient(#003864, #055a9b); height: auto;">
      <ul class="list-group list-group-flush" id="ul_list_sin_cita">

        
      </ul>
    </div>
  </div>

</div>
<audio autoplay loop  id="playAudio">
    <source src="../../recepcion/timbre.mp3" type="audio/mp3">
</audio>

<script type="text/javascript">
   var myaudio = document.getElementById("playAudio");
   var video = document.getElementById("videoId");
   $(document).ready(function () {
    desactivar();
    
   });

   function  loadListTurns() {
    let data = {
      'tokenId' : '<?= $tokenId ?>',
      'sucursalId': '<?= $sucursalId ?>'
    }
    var settings = {
      "url": "get_list_turns.php",
      "method": "POST",
      "data": data,
      "dataType" : "json",
      "timeout": 0,
      "headers": {
        "Accept": "application/javascript"
      },
    };

    $.ajax(settings).done(function (response) {

      console.log(response.data);
      let concita = '';
      let sincita = '';
      let count_concita = 0;
      let count_sincita = 0;
      for (let i = 0; i < response.data.length; i++) {
        const listurn = response.data[i];
        

        if (listurn.turno_tipo == 'A' || listurn.turno_tipo == 'D') {
          count_concita++;
          if (count_concita <= 4) {
            concita += ''+
          '<li class="list-group-item " style="font-size: 18px; display: flex; justify-content: left; background: linear-gradient(#bee5eb, rgb(156, 202, 227));">'+
          '<div style="padding: 0%; font-family:Verdana, Geneva, Tahoma, sans-serif ;">'+
            '<div style="font-weight: bold;">'+listurn.turno+'</div>'+
          '<div>'+listurn.car.model+'</div>'+
          '<div>'+listurn.car.color+'</div>'+
          '<div>PLACAS: '+listurn.car.placas+'</div>'+
          '</div>'+
        '</li>';  
          }
          
        } else {
          count_sincita++;
          if (count_sincita <= 4) {
            sincita += ''+
          '<li class="list-group-item " style="font-size: 18px; display: flex; justify-content: left; background: linear-gradient(#bee5eb, rgb(156, 202, 227));">'+
          '<div style="padding: 0%; font-family:Verdana, Geneva, Tahoma, sans-serif ;">'+
            '<div style="font-weight: bold;">'+listurn.turno+'</div>'+
          '<div>'+listurn.car.model+'</div>'+
          '<div>'+listurn.car.color+'</div>'+
          '<div>PLACAS: '+listurn.car.placas+'</div>'+
          '</div>'+
        '</li>';
          } else {
            break;
          }
          
        }

        //console.log(listurn);
      }
      $("#ul_list_con_cita").html(concita);
      $("#ul_list_sin_cita").html(sincita);



    });


   }


  function activar(){
    $("#inicio").hide();
    $(".row").show();
    video.play();
     setInterval(function() {
      getTurno();
      loadListTurns();
    }, 5000);
  }
  function desactivar(){
    $(".row").css({"display": "none"});
  }
 

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
          myaudio.play();
          $("#turnoL").html("TURNO ACTUAL: "+response[0]["turno"]);
          $("#turnoIn").val(response[0]["turno"]);
          $("#nombreL").html(response[0]["nombre"]);
          $("#placasL").html(response[0]["placas"]);
          $("#modeloL").html(response[0]["modelo"]);
          $("#vinL").html(response[0]["vin"]);
          $("#colorL").html(response[0]["color"]);
          setTimeout(function() {
             myaudio.pause();
           }, 2500);
         
        }
      }
    });
  }

</script>

