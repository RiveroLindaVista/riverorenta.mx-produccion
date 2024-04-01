<?php
$str=null;
if($_GET["p"]){
  $str = json_decode(utf8_encode(base64_decode($_GET["p"])));
}
?>

<script type="text/javascript">
  function enviarCita(){
    $("#btnEnviar").hide();
    if($("#vin").val()!=""){
      var param={
        info:<?=json_encode($str)?>,
        tipo:'hora_salida',
        sucursal:<?=$sucursalId?>
      }
      param["info"]["car"]["vin"]=$("#vin").val();
     
      $.ajax({
        url:"https://multimarca.gruporivero.com/api/v1/servicio/sendhoraplanning",
        method:"POST",
        headers: {
          "Accept": "application/json",
          "Authorization": "Bearer <?=$tokenId?>"
        },
        "data":param,
        success:function(response){
          window.location.href="../";
        }
      });
     
    }else{
      $("#vin").css('border-color','red');
      alert("Es necesario agregar el numero de Serie");
       $("#btnEnviar").show();
    }
  };
</script>


<div class="container"><br/>

<button class="btn btn-outline-secondary"><a href="../"><i class="bi bi-chevron-compact-left"></i>&nbsp;&nbsp;Regresar</a></button>
<hr/>
  <h4><?=$str->client->name?></h4>

    <div class="mb-3" hidden>
      <label class="form-label">Sucursal:</label>
      <input type="text" class="form-control" placeholder="Últimos 8 dígitos" value="<?=$sucursalId?>" disabled>
    </div>
  <div class="row">
    <div class="col-6" <?php if($str->client->name!=""){echo 'hidden';}?>>
           <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" value="<?=utf8_encode($str->client->name)?>" required>
          </div>
      </div>

      <div class="col-6">
           <div class="mb-3">
            <label class="form-label">Numero de Serie:</label>
            <input type="text" class="form-control" id="vin" placeholder="Últimos 8 dígitos" value="<?=$str->car->vin?>" <?php if($str->car->vin!=""){echo 'disabled';}?> required>
          </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label class="form-label">Placas:</label>
          <input type="text" class="form-control" value="<?=$str->car->placas?>" disabled>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label class="form-label">Modelo:</label>
          <input type="text" class="form-control" value="<?=$str->car->model?>" disabled>
        </div>
      </div>
       <div class="col-6">
        <div class="mb-3">
          <label class="form-label">Color:</label>
          <input type="text" class="form-control" value="<?=$str->car->color?>" disabled>
        </div>
      </div>
    </div>
<br/><br/>
<center>
  <div class="btn btn-primary btn-lg" onclick="enviarCita()" id="btnEnviar">
    <i class="bi bi-clock"></i>&nbsp;&nbsp;Hora de Salida
  </div>
</center>
<div style="clear: both;"></div><br/><br/>
 <hr/>


</div>



