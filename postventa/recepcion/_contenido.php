
<nav class="p-2">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Entradas</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Salidas</button>
    <button class="nav-link" id="nav-entregados-tab" data-bs-toggle="tab" data-bs-target="#nav-entregados" type="button" role="tab" aria-controls="nav-entregados" aria-selected="false">Entregados</button>
    
  </div>
</nav>
<div class="tab-content p-2" id="nav-tabContent">
  <div class="tab-pane fade show active p-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="bg-light" style="overflow: hidden;width: 100%;height: 900px;overflow-y: scroll;">
      <button class="btn btn-warning" onclick="reloadCitas()">Actualizar</button>
      <!-- <div class="container"> -->
        <div class="row" style="width: 100%;">
          <div class="col-6 col-md-6">
            <label class="" for="buscadorId"> Buscar.</label>
          </div>
          <div class="col-6 col-md-6" style="display:flex; align-items:center; justify-content:end;">
            <p id="totalRows"></p>
          </div>
          
        </div>
        <!-- </div> -->
        <input autofocus class="form-control" type="text" id="buscadorId">
      
      <div id="citashoy"></div>
    </div>
  </div>
  <div class="tab-pane fade p-2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="bg-light" style="overflow: hidden;width: 100%;height: 900px;overflow-y: scroll;">
      <button class="btn btn-warning" onclick="get_salidas_de_hoy()">Actualizar</button>
      <div id="salidashoy"></div>
    </div>
  </div>

  <div class="tab-pane fade p-2" id="nav-entregados" role="tabpanel" aria-labelledby="nav-entregados-tab">
    <div class="bg-light" style="overflow: hidden;width: 100%;height: 900px;overflow-y: scroll;">
      <button class="btn btn-warning" onclick="get_entregados_de_hoy()">Actualizar</button>
      <div id="entregadoshoy"></div>
    </div>
  </div>

  
</div>


<script>
  reloadCitas();
  get_salidas_de_hoy();
  get_entregados_de_hoy();
  function reloadCitas(){
    $("#citashoy").html("cargando");
      get_entregas_de_hoy();
  }

  $("#buscadorId").keyup (function() {
  
  buscarCoincidencias();
}
) ;

    function buscarCoincidencias() {
    var busqueda = $('#buscadorId').val().toLowerCase();

    $('.rowEntradas').each(function () {
        var texto = $(this).text().toLowerCase();

        if (texto.includes(busqueda)) {
            $(this).show();
        } else {
            $(this).hide();
        }
      });
    }

  function get_citas_de_hoy(cant_entregas){
     //$("#citashoy").html("cargando");
    //$tokenId
    //obtiene informacion de tabla de recepcion
    let resp_recepcion_taller = '';
    var settings2 = {
      "url": "https://multimarca.gruporivero.com/api/v1/servicio/planning/lista-recepcion-taller/<?=$sucursalId?>/null",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json",
        "Authorization": "Bearer <?=$tokenId?>"
      },
    };

    $.ajax(settings2).done(function (response) {
      resp_recepcion_taller = response;
    });
    


    var settings = {
      "url": "https://multimarca.gruporivero.com/api/v1/planning/day?date=<?=date('Y-m-d')?>&agency=<?=$sucursalId?>",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json",
        "Authorization": "Bearer <?=$tokenId?>"
      },
    };

    $.ajax(settings).done(function (response) {
      var cadena="";
      console.log(resp_recepcion_taller);

      for(var i=0;i<response["data"].length;i++){
        let visible = true;
        for (let j = 0; j < resp_recepcion_taller.length; j++) {
          const r_t_Obj = resp_recepcion_taller[j];
          const w32Obj = response["data"][i];
          // filtra informacion para que no aparezcan en entradas si ya se dio entrada excepto si status sea 4
          if ( w32Obj.car.matricul == r_t_Obj["vin"]) {
            visible = false;
            if (r_t_Obj["status"] == 4) {
              visible = true;
            }
          }
          
        }
        // TODO: verificar que no se repita cuando estatus sea 4 ver que no aparezcan 2 veces
        let style = '';
        if (!visible) {
          style = 'background: #e2dada;';
        }

        cadena+="<div style='"+style+"' class='card mt-2 rowEntradas' onclick='abrirCita("+JSON.stringify(response["data"][i])+","+visible+")'>";
        cadena+='<div class="card-body"><div class="row"><div class="col-6 col-md-2"><div class="font-weight-bold">VIN:</div>'+response["data"][i].car.vin+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Placas:</div>'+response["data"][i].car.placas+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Hora:</div>'+response["data"][i].time+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Modelo:</div>'+response["data"][i].car.model+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Color:</div>'+response["data"][i].car.color+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Nombre:</div>'+response["data"][i].client.name+'</div><div class="position-absolute" style="right:10px;top:40px;"><i class="bi bi-chevron-compact-right"></i></div></div></div></div>';          

        
      }
      $("#totalRows").html('Total: '+(cant_entregas + i));
      $("#citashoy").html(cadena+$("#citashoy").html());
    });
  }
  function get_entregas_de_hoy(){
    //$tokenId
    //$("#entregashoy").html("cargando");
    var settings = {
      "url": "https://multimarca.gruporivero.com/api/v1/servicio/planning/satus/4/<?=$sucursalId?>",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json",
        "Authorization": "Bearer <?=$tokenId?>"
      },
    };

    $.ajax(settings).done(function (response) {
      var cadena="";
      for(var i=0;i<response["data"].length;i++){
        cadena+="<div class='card mt-2 bg-info text-white rowEntradas' onclick='abrirEntrega("+JSON.stringify(response["data"][i])+")'>";

          cadena+='<div class="card-body"><div class="row"><div class="col-6 col-md-2"><div class="font-weight-bold">VIN:</div>'+response["data"][i].car.vin+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Placas:</div>'+response["data"][i].car.placas+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Hora:</div>'+response["data"][i].time+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Modelo:</div>'+response["data"][i].car.model+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Color:</div>'+response["data"][i].car.color+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Nombre:</div>'+response["data"][i].client.name+'</div><div class="position-absolute" style="right:10px;top:40px;"><i class="bi bi-chevron-compact-right"></i></div></div></div></div>';
        
      }
      $("#citashoy").html(cadena);
      get_citas_de_hoy(i);
    });
  }

  function get_salidas_de_hoy(){
    //$tokenId
    $("#salidashoy").html("cargando");
    var settings = {
      "url": "https://multimarca.gruporivero.com/api/v1/servicio/planning/salidas/<?=$sucursalId?>",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json",
        "Authorization": "Bearer <?=$tokenId?>"
      },
    };

    $.ajax(settings).done(function (response) {
      var cadena="";
      for(var i=0;i<response["data"].length;i++){
        if(response["data"][i].status==2){
          cadena+="<div class='card mt-2' onclick='abrirSalida("+JSON.stringify(response["data"][i])+")'>";
        }else{
          cadena+="<div class='card mt-2 bg-info' onclick='abrirSalida2("+JSON.stringify(response["data"][i])+")'>";
        }

        cadena+='<div class="card-body"><div class="row"><div class="col-6 col-md-2"><div class="font-weight-bold">VIN:</div>'+response["data"][i].car.vin+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Placas:</div>'+response["data"][i].car.placas+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Hora:</div>'+response["data"][i].time+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Modelo:</div>'+response["data"][i].car.model+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Color:</div>'+response["data"][i].car.color+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Nombre:</div>'+response["data"][i].client.name+'</div><div class="position-absolute" style="right:10px;top:40px;"><i class="bi bi-chevron-compact-right"></i></div></div></div></div>';
        
      }
      $("#salidashoy").html(cadena);
     
    });
  }

  function get_entregados_de_hoy(){
    //$tokenId
    $("#entregadoshoy").html("cargando");
    var settings = {
      "url": "https://multimarca.gruporivero.com/api/v1/servicio/planning/lista-recepcion-taller/<?=$sucursalId?>/8",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json",
        "Authorization": "Bearer <?=$tokenId?>"
      },
    };

    $.ajax(settings).done(function (response) {
      var cadena="";
      for(var i=0;i<response.length;i++){
          let d1 = new Date(response[i].entrega_h_salida); 
          let entrega_h_salida = d1.getHours() +":"+ d1.getMinutes();

          cadena+="<div class='card mt-2' style='background-color: #a7ffa7'>";
          cadena+='<div class="card-body"><div class="row"><div class="col-6 col-md-2"><div class="font-weight-bold">VIN:</div>'+response[i].vin+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Placas:</div>'+response[i].placas+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Hora salida:</div>'+entrega_h_salida+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Modelo:</div>'+response[i].modelo+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Color:</div>'+response[i].color+'</div><div class="col-6 col-md-2"><div class="font-weight-bold">Nombre:</div>'+response[i].nombre+'</div><div class="position-absolute" style="right:10px;top:40px;"><i class="bi bi-chevron-compact-right"></i></div></div></div></div>';
      }
      
      $("#entregadoshoy").html(cadena);
     
    });
  }

  function abrirCita(obj, visible){
     var id_e=JSON.stringify(obj);
      id_e = window.btoa(id_e);
      window.location.href="formulario?visible="+visible+"&p="+id_e;
    return;
  }
  function abrirEntrega(obj){
     var id_e=JSON.stringify(obj);
      id_e = window.btoa(id_e);
      window.location.href="formulario-entrega?p="+id_e;
    return;
  }
  function abrirSalida(obj){
     var id_e=JSON.stringify(obj);
      id_e = window.btoa(id_e);
      window.location.href="formulario-salida?p="+id_e;
    return;
  }
  function abrirSalida2(obj){
     var id_e=JSON.stringify(obj);
      id_e = window.btoa(id_e);
      window.location.href="formulario-salida-entrega?p="+id_e;
    return;
  }
</script>


