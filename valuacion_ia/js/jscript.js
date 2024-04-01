
$(document).ready(function () {
    marca();

});



function marca() {
    let data = '<option value="">...</option>';
    $.ajax({
        type: "get",
        url: "https://app.intelimotor.com/api/brands?apiKey=58ddf99f8dc571619bcb9603b8eaa7467c2f0db3e78769c63dbc568d4f35507e&apiSecret=af004273051c09189c70be7a50768d85d6574b570cc999fe0577a9f9e6173551",
        data: "",
        dataType: "json",
        success: function (response) {

            for (let i = 0; i < response.data.length; i++) {
                const marca = response.data[i];
                data += '<option value="' + marca.id + '">' + marca.name + '</option>';
            }
            // console.log(data);

            $("#ctrl_marca").html(data);
        }
    });
}

function fun_model(marca_id) {
    let data = '<option value="">...</option>';
    $.ajax({
        type: "get",
        url: "https://app.intelimotor.com/api/brands/" + marca_id + "/models?apiKey=58ddf99f8dc571619bcb9603b8eaa7467c2f0db3e78769c63dbc568d4f35507e&apiSecret=af004273051c09189c70be7a50768d85d6574b570cc999fe0577a9f9e6173551",
        data: "",
        dataType: "json",
        success: function (response) {

            for (let i = 0; i < response.data.length; i++) {
                const marca = response.data[i];
                data += '<option value="' + marca.id + '">' + marca.name + '</option>';
            }
            //console.log(data);

            $("#ctrl_model").html(data);
        }
    });
}
function fun_anos() {
    marca_id = $("#ctrl_marca").val();
    model_id = $("#ctrl_model").val();
    let data = '<option value="">...</option>';
    $.ajax({
        type: "get",
        url: "https://app.intelimotor.com/api/brands/" + marca_id + "/models/" + model_id + "/years?apiKey=58ddf99f8dc571619bcb9603b8eaa7467c2f0db3e78769c63dbc568d4f35507e&apiSecret=af004273051c09189c70be7a50768d85d6574b570cc999fe0577a9f9e6173551",
        data: "",
        dataType: "json",
        success: function (response) {

            for (let i = response.data.length-1; i >0; i--) {
                const marca = response.data[i];
                data += '<option value="' + marca.id + '">' + marca.name + '</option>';
            }
            //console.log(data);

            $("#ctrl_ano").html(data);
        }
    });
}
function fun_version() {
    marca_id = $("#ctrl_marca").val();
    model_id = $("#ctrl_model").val();
    ano_id = $("#ctrl_ano").val();
    let data = '<option value="">...</option>';
    $.ajax({
        type: "get",
        url: "https://app.intelimotor.com/api/brands/" + marca_id + "/models/" + model_id + "/years/" + ano_id + "/trims?apiKey=58ddf99f8dc571619bcb9603b8eaa7467c2f0db3e78769c63dbc568d4f35507e&apiSecret=af004273051c09189c70be7a50768d85d6574b570cc999fe0577a9f9e6173551",
        data: "",
        dataType: "json",
        success: function (response) {

            for (let i = 0; i < response.data.length; i++) {
                const marca = response.data[i];
                data += '<option value="' + marca.id + '">' + marca.name + '</option>';
            }
            //console.log(data);

            $("#ctrl_version").html(data);
        }
    });
}


function consultar() {
    let marca_id = $("#ctrl_marca").val();
    let model_id = $("#ctrl_model").val();
    let ano_id = $("#ctrl_ano").val();
    let trims_versions = $("#ctrl_version").val();
    let business = '623505fce5c26a00138e7293';
    let kms = $("#ctrl_kms").val();

    let datax = '<option value="">...</option>';
    let data = {
        "brandIds": [marca_id],
        "modelIds": [model_id],
        "yearIds": [ano_id],
        "trimIds": [trims_versions],
        "businessUnitId": business,
        "kms": parseInt(kms)
    };
   // console.log(data);

    $.ajax({
        data: data,
        type: "POST",
        dataType: "json",
        // contentType: "application/json",
        url: "controllers/controllers.php",

        success: function (response) {
            //console.log(response);
            if (response.data.regions.length > 0) {
                
                $cadena="";
                 $arrayRows=[];
                 $conetoArray=[];
              
                for($i=0;$i<response.data.regions[0].region.platforms.length;$i++){
                    $conetoArray[response.data.regions[0].region.platforms[$i]]=0;
                     $arrayRows[response.data.regions[0].region.platforms[$i]]=[{}];
                }
              
                $mc=0;
                for($i=0;$i<response.data.regions[0].samples.length;$i++){
                     $arrayRows[response.data.regions[0].samples[$i].vehicle.platform][$conetoArray[response.data.regions[0].samples[$i].vehicle.platform]]={
                            "platform":response.data.regions[0].samples[$i].vehicle.platform,
                            "model":response.data.regions[0].samples[$i].vehicle.model,
                            "trim":response.data.regions[0].samples[$i].vehicle.trim,
                            "kms":response.data.regions[0].samples[$i].vehicle.kms,
                            "price":response.data.regions[0].samples[$i].vehicle.price
                            };
                    $conetoArray[response.data.regions[0].samples[$i].vehicle.platform]=parseInt($conetoArray[response.data.regions[0].samples[$i].vehicle.platform])+1;
                    
                     
                }
      
               
                

                $cadena=crearRegistros($arrayRows,5000,response.data.regions[0].region.platforms);
                
                if($cadena["status"]==400){
                    $cadena=crearRegistros($arrayRows,10000,response.data.regions[0].region.platforms);
                }
               
                document.getElementById("filtro").style.display="none";
                document.getElementById("info").innerHTML = $cadena["cadena"];
            } else {
                // document.getElementById("info").InnerHtml = '';
                $("#info").html('Sin info');
                // document.getElementById("info").textContent = JSON.stringify(response.data.regions[0],  undefined, 2);
            }

            // document.getElementById("info2").textContent = JSON.stringify(response.data.regions,  undefined, 2);
            // $("#info").html(JSON.stringify(response));
        }
    });
}


function crearRegistros(response,kmN,arrayPlatforms){
                $plataforma="";
                $out=[];
                $out["status"]=400;
                $out["cadena"]="";
                $precio1=50000000;
                $precio2=0;
            $cadena="";
            $cadenaF="";
                $kmC=parseInt($("#ctrl_kms").val());

                $km1=$kmC-kmN;
                $km2=$kmC+kmN;
                $conteo=0;

    for($t=0;$t<arrayPlatforms.length;$t++){

    

                for($i=0;$i<response[arrayPlatforms[$t]].length;$i++){
                   $out["status"]=200;
                    if($plataforma!=response[arrayPlatforms[$t]][$i].platform){
                        if($km1<response[arrayPlatforms[$t]][$i].kms&&$km2>response[arrayPlatforms[$t]][$i].kms){
                        $plataforma=response[arrayPlatforms[$t]][$i].platform;
                        $cadenaF+='<h2 style="text-transform: capitalize">'+response[arrayPlatforms[$t]][$i].platform+'</h2>';
                        }
                    }
                    if($km1<response[arrayPlatforms[$t]][$i].kms&&$km2>response[arrayPlatforms[$t]][$i].kms){
                        $conteo=$conteo+1; 
                        $cadenaF+='<div class="card border-secondary mb-3" ><div class="card-header">'+response[arrayPlatforms[$t]][$i].model+'<div style="float:right">'+new Intl.NumberFormat('en-ES', { style: 'currency', currency: 'MXN' }).format(
        response[arrayPlatforms[$t]][$i].price,
      )+'</div></div><div class="card-body text-secondary"><h5 class="card-title">Version: '+response[arrayPlatforms[$t]][$i].trim+'</h5><p class="card-text">Km: '+new Intl.NumberFormat('en-ES').format(response[arrayPlatforms[$t]][$i].kms)+'</p></div></div>';
                      
                        if($precio2<=response[arrayPlatforms[$t]][$i].price){
                            $precio2=response[arrayPlatforms[$t]][$i].price;
                        }
                        if($precio1>=response[arrayPlatforms[$t]][$i].price){
                            $precio1=response[arrayPlatforms[$t]][$i].price;
                        }
                    }
                }
            }
                $cadena+="<h2>Rango de precio: "+new Intl.NumberFormat('en-ES').format($precio1)+" - "+new Intl.NumberFormat('en-ES').format($precio2)+"</h2>";
                $cadena+="<h4>Media precio: "+new Intl.NumberFormat('en-ES').format((($precio2+$precio1)/2))+"</h4>";
                $cadena+="<p>Registros encontrados: "+ $conteo+"</p>";
                $cadena+= $cadenaF;
                if($conteo<5){
                    $out["status"]=400;
                }
                $out["cadena"]=$cadena;
                return $out;
}

$("#ctrl_marca").change(function (e) {
    e.preventDefault();
    //console.log(e.target.value);
    // console.log($("#ctrl_marca").val());
    fun_model(e.target.value);
});

$("#ctrl_model").change(function (e) {
    e.preventDefault();
    //console.log(e.target.value);
    // console.log($("#ctrl_marca").val());
    fun_anos(e.target.value);
});
$("#ctrl_ano").change(function (e) {
    e.preventDefault();
    //console.log(e.target.value);
    // console.log($("#ctrl_marca").val());
    fun_version(e.target.value);
});
$("#ctrl_version").change(function (e) {
    e.preventDefault();
    //console.log(e.target.value);
    // console.log($("#ctrl_marca").val());
    // fun_business();
});