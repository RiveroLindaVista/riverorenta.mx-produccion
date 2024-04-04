<?php
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://multimarca.gruporivero.com/api/v1/inventory/catalogo/nissan',
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
$condicionArray["Contry"]=0;
$condicionArray["Valles"]=0;
$condicionArray["Torres"]=0;

$condicionArray["Separadas"]=0;
$condicionArray["Demos"]=0;
$condicionArray["Fallas"]=0;
$condicionArray["Total"]=0;
curl_close($curl);
//echo $response;
for($i=0;$i<count($response->result);$i++){
     $cadena.='<tr>';
      $cadena.='<td>'.$response->result[$i]->STOCK.'</td>';
    $cadena.='<td>'.$response->result[$i]->ANO.'</td>';
    $cadena.='<td>'.$response->result[$i]->TYPES.'</td>';
    $cadena.='<td>'.$response->result[$i]->MAKE.'</td>';
    $cadena.='<td>'.$response->result[$i]->MODEL.'</td>';
    $cadena.='<td>'.$response->result[$i]->EXTERIOR_COLOR.'</td>';
    $cadena.='<td>'.$response->result[$i]->INTERIOR_COLOR.'</td>';
    $cadena.='<td>'.$response->result[$i]->VIN.'</td>';
    $cadena.='<td>'.$response->result[$i]->SUCURSAL.'</td>';
    $cadena.='<td>0</td>';
     $cadena.='<td>$'.number_format($response->result[$i]->SELLING_PRICE,2).'</td>';
     $cadena.='<td>'.$response->result[$i]->EST_SALIDA.'</td>';
     $cadena.='</tr>';
     if($response->result[$i]->EST_SALIDA=='Reservado'){
        $condicionArray["Separadas"]=$condicionArray["Separadas"]+1;
        $condicionArray["Total"]=$condicionArray["Total"]+1;
     }
      if($response->result[$i]->EST_SALIDA=='Demo'){
        $condicionArray["Demos"]=$condicionArray["Demos"]+1;
        $condicionArray["Total"]=$condicionArray["Total"]+1;
     }
      if($response->result[$i]->EST_SALIDA=='Falla'){
        $condicionArray["Fallas"]=$condicionArray["Fallas"]+1;
        $condicionArray["Total"]=$condicionArray["Total"]+1;
     }

      if($response->result[$i]->SUCURSALID=='1043194'){
          //echo $response->result[$i]->SUCURSAL.'<br>';
        $condicionArray["Contry"]=$condicionArray["Contry"]+1;
     }
     if($response->result[$i]->SUCURSALID=='599457775'){
        $condicionArray["Valles"]=$condicionArray["Valles"]+1;
     }
     if($response->result[$i]->SUCURSALID=='279130042'){
        $condicionArray["Torres"]=$condicionArray["Torres"]+1;
     }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventario de Unidades Nissan</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
  <div class="container"><br>
<div class="row">
    <div class="col-12 col-md-8">
    <img src="https://www.gruporivero.com/images/header-logo@2x.png" width="200px">
    </div>
    <div class="col-12 col-md-4">
        <table class="table table-striped" style="width:100%;font-size: 10px;">
       
        <tbody>
             <tr> 
                <th>CONTRY</th>
                <th><?=$condicionArray["Contry"]?></th>
                <th>Separadas</th>
                <th><?=$condicionArray["Separadas"]?></th>
            </tr>
            <tr> 
                <th>VALLES</th>
                <th><?=$condicionArray["Valles"]?></th>
                <th>Demos</th>
                <th><?=$condicionArray["Demos"]?></th>
            </tr>
            <tr> 
                <th>LAS TORRES</th>
                <th><?=$condicionArray["Torres"]?></th>
                <th>Dañadas</th>
                <th><?=$condicionArray["Fallas"]?></th>
            </tr>
            <tr> 
                <th>TOTAL</th>
                <th><?=count($response->result)?></th>
                <th>TOTAL</th>
                <th><?=$condicionArray["Total"]?></th>
            </tr>
        </table>
    </div>

</div>

<h3>Inventario de Unidades</h3>
   <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#Inv</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Color</th>
                <th>Interior</th>
                <th>Serie</th>
                <th>Agencia</th>
                <th>Km</th>
                <th>Precio</th>
                <th>Estatus</th>
            </tr>
        </thead>
        <tbody>
            <?=$cadena?>
        </tbody>
        <tfoot>
            <tr>
                 <th>#Inv</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Color</th>
                <th>Interior</th>
                <th>Serie</th>
                <th>Agencia</th>
                <th>Km</th>
                <th>Precio</th>
                <th>Estatus</th>
            </tr>
        </tfoot>
    </table>
  </div>

<script type="text/javascript">
  new DataTable('#example');
</script>
</body>
</html>