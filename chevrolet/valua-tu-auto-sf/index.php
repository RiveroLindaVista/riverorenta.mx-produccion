<?php

include("_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

$hoy = date('Y-m-d');
$manana = strtotime('+1 day', strtotime($hoy));
$manana = date('Y-m-d', $manana);
/* $sql = "Select year from valuacion_autometrica group by year order by year desc";
$resultQuery = $conn->query($sql);
if ($resultQuery->num_rows > 0) {
    while($row = $resultQuery->fetch_assoc()) {
        $opcionesYears.='<option value="'.$row['year'].'">'. $row['year'].'</option>';
    }
 } */

/* $sqlMarcas = "Select marca from valuacion_autometrica group by marca order by marca asc";
$marcasQry = $conn->query($sqlMarcas);
if ($marcasQry->num_rows > 0) {
    while($row = $marcasQry->fetch_assoc()) {
        $opcionesMarcas.='<option value="'.$row['marca'].'">'. $row['marca'].'</option>';
    }
 } */
 $captcha_text = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
 $captcha_textp = $captcha_text."J89"; 
?>

<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Valua tu carro - Chevrolet Rivero</title>
        
    <link href="<?=URL?>/estilos/main.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </head>

    <body style="background-color:#1d1d1d;">
    <div class="container" style="display:flex; justify-content: center; align-items: center;">

        <div id="formLoading" class="container p-2" style="text-align: center" hidden>
            <div class="spinner-border text-light m-5" role="status">
                <span class="sr-only"></span>
            </div>
        </div>

        <div id="formOferta" class="container p-4">
            <div class="row p-2" id="divYears">
                <label for="basic-url" class="form-label text-white">¿Qué año es tu auto?</label>
                <select class="form-select" id="filtroYears" onchange="getMarcas()">
                </select>
            </div>
            <div class="row p-2" id="divMarcas" hidden onchange="getModelos()">
                <select class="form-select" id="filtroMarcas">
                </select>
            </div>

            <div class="row p-2" id="divModelos" hidden onchange="getVersiones()">
                <select class="form-select" id="filtroModelos">
                </select>
            </div>

            <div class="row p-2" id="divVersiones" hidden>
                <select class="form-select" id="filtroVersiones" onchange="getKM()">
                </select>
            </div>

            <div class="row" id="divKM" hidden>
                <div class="input-group p-2 mb-3">
                    <span class="input-group-text" id="basic-addon1">Kilometraje:</span>
                    <input type="number" class="form-control" placeholder="Añade el kilometraje de tu vehículo" aria-label="KM" aria-describedby="basic-addon1" id="filtroKM" onkeypress="upKM()" onkeydown="upKM()">
                </div>
            </div>

            <div class="row" id="captcha" hidden>
                <p class="text-white m-0">Introduce el texto que ves en la imagen:</p>
                <img class="mb-1" src="captcha.php?text=<?= urlencode($captcha_text) ?>" style="width:200px;height: 80px" alt="CAPTCHA"><br>
                <input type="text" id="captcha_input" class="mb-1" name="captcha_input" required><br>
                <p id="msjCaptcha" class="text-white m-0" hidden>Captcha Incorrecto.</p>
                <button type="button" class="btn bg-dark text-white" onclick="getCAPTCHA()">LISTO</button>
            </div>

            <div class="row p-2" id="btnSig" hidden>
                <button class="btn btn-dark bg-dark" type="button" onclick="siguienteDatos()">Siguiente</button>
            </div>

            <div id="cargando" class="spinner-grow text-light text-center" role="status" hidden>
                <span class="visually-hidden">Loading...</span>
            </div>

        </div>

        <div id="ofertaFinal" class="container p-4" hidden>
            <div id="of1" hidden>
                <div class="row align-items-center">
                    <h2 class="text-center text-white" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">DESCRIPCIÓN DEL AUTO</h3>

                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div id="descripcionAuto">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <h3 class="text-center text-white pulso" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">ELIGE UNA OFERTA PARA GUARDAR LA VALUACIÓN</h3>
                    <div class="btnOfertaNormal" onclick="selectOferta('Normal')">
                        <h3 class="text-center text-white" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">OFERTA VÁLIDA POR 7 DÍAS</h3>

                        <h2 id="precio" class="text-white text-center"></h2>
                        <img style="top: 40px;position:absolute;right: 12px;height: 30px;" src="https://www.riverorenta.mx/valua-tu-carro/img/iconos/flecha_blanca.svg">
                    </div>
                </div>

                <div class="row" id="OfertaPrimo" hidden>
                    <div class="btnOfertaPrimo" onclick="selectOferta('Precio Primo')">
                        <h3 class="text-center text-white" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">PRECIO PRIMO VÁLIDO POR 48 HRS</h3>

                        <h2 class="text-white text-center"><img style="height: 50px;filter: saturate(230%);" src="https://www.riverorenta.mx/valua-tu-carro/img/precio-primo.png"><span id="precioPrimo" style="font-size: calc(1.325rem + .9vw);"></span></h2>
                        <div style="font-size:1em;line-height:20px !important">Con el precio Primo tienes solamente 48 horas para tomar la decisión, solo es cuestión que tengas a la mano la siguiente papelería:<br>
                            <ul style="font-size: 1em;margin-top:10px;">
                                <li>Factura Original</li>
                                <li>Refrendos</li>
                                <li>INE</li>
                                <li>Comprobante de Domicilio</li>
                                <li>Constancia de Insitituto de Control Vehicular</li>
                                <li>Carátula Estado de Cuenta Bancario</li>
                            </ul>
                            <img style="top: 40px;position:absolute;right: 12px;height: 30px;" src="https://www.riverorenta.mx/valua-tu-carro/img/iconos/flecha_blanca.svg">
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <button class="btn btn-dark bg-dark" type="button" style="width:auto;" onclick="nuevaOferta()">Elige otro auto</button>
                </div>
            </div>

            <div id="formDatos" class="container p-4" hidden>
                <div>
                    <h1 class="text-white text-center m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">INGRESA TUS DATOS</h1><br/>
                    <p class="text-white"> Te haremos llegar en este instante la información </p>
                </div>
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">Nombre:</p>
                <input style="border-radius: 5px; width: 100%; height: 40px;font-size: 1.2em" placeholder="Ingresa tu nombre" type="text" id="nombre" name="nombre" required>
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">Correo:</p>
                <input style="border-radius: 5px; width: 100%; height: 40px;font-size: 1.2em" placeholder="Ingresa tu correo" type="text" id="correo" name="correo" required>
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">Teléfono:</p>
                <input style="border-radius: 5px; width: 100%; height: 40px;font-size: 1.2em" placeholder="Ingresa tu teléfono" type="number" id="telefono" max="10" name="telefono" required>
                <div class="row p-2" id="btnOferta">
                    <button class="btn btn-dark bg-dark" type="button" onclick="getOferta()">Ver Oferta</button>
                </div>
            </div>

            <div id="formMensajeExito" class="container p-2" hidden>
                <div>
                    <h1 class="text-white text-center m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">VALUACIÓN GENERADA CON ÉXITO</h1>
                </div>
            </div>

            <div id="formCita" class="container p-2" hidden>
                <div>
                    <h1 class="text-white text-center m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;">ÚLTIMO PASO</h1>
                    <p class="text-white text-center m-0"> Revisión física y mecánica de tu unidad </p>
                    <p class="text-white text-center m-0" style="font-size:.7em"> Tiempo estimado de cita es de 1 hora </p>
                </div>
                <div class="d-flex justify-content-center">
                    <img class="imgSucursal" style="position: relative;" src="images/sucursales/linda_vista.jpg" width="100%">
                    <p class="text-white text-center m-0" style="font-size: 1.2em;text-shadow: black 2px 2px 2px;font-family: 'Narrow';position: absolute;"> Agencia Chevrolet Rivero Linda Vista<br/> Centro de Valuación </p>
                </div>
                <div class="d-flex justify-content-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d898.8335676812155!2d-100.2391712!3d25.6933543!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8662ebbe71daaebf%3A0xc00ce93fa848615d!2sChevrolet%20Rivero%20Linda%20Vista!5e0!3m2!1ses-419!2smx!4v1602263768511!5m2!1ses-419!2smx" width="600" height="200" title="ContImgMap" style="border: 0" allowFullScreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <p class="text-white text-center m-0" style="font-size: .7em;">Av. Miguel Alemán No. 5400, Col. Torres de Linda Vista, Guadalupe, Nuevo León, CP 67138</p>
                <hr/>
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">¿Cuándo te vemos?</p>
                <input style="border-radius: 5px; width: 100%; height: 40px;font-size: 1.2em;padding:10px;" type="date" id="fecha" name="fecha" value="<?= $manana ?>" min="<?= $manana ?>" >
                <p class="text-white m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;font-size: 1.7em;">Elige una hora:</p>
                <select class="form-select" id="hora">
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                </select>

                <div class="row p-2" id="btnCrearCita">
                    <button class="btn btn-dark bg-dark" type="button" onclick="crearCita()">Crear Cita</button>
                </div>
            </div>

            <div id="formCalendar" class="container p-2" hidden>
                <div>
                    <h1 id="genial" class="text-white text-center m-0" style="font-family: Narrow;text-shadow: 2px 3px 5px black;"></h1>
                    <p id="teesperamos" class="text-white text-center m-0"> Revisión física y mecánica de tu unidad </p>
                    <p id="papeleria" class="text-white text-center m-0" style="font-size:.7em"> Tiempo estimado de cita es de 1 hora </p>
                </div>
                <div id="divQR" class="d-flex justify-content-center">
                    
                </div>

                <div id="btnCalendar" class="row p-2">
                </div>
            </div>

        </div>

    </div>
    <input type="hidden" id="descripcion_auto" name="descripcion_auto" value="<?= htmlspecialchars($captcha_textp) ?>">
    </body>
    
</html>
<script>

    var ofertas = {
        ofertaElegida: '',
        precio_normal: '',
        precio_primo: '',
        precio_ofrecido: '',
        km_group: '',
        compra: '',
        venta: ''
    };

    $(document).ready(function() {

        let data = {
            ano: 1,
        }

        $.ajax({
                type: "POST",
                url: "getYears.php",
                data: data,
                dataType: "json",
                success: function(resp) {
                    
                    let opcionesYears = '<option value="0">Selecciona el año...</option>';
                    resp.forEach(elem => {
                    opcionesYears += `
                            <option value="${elem.year}">${elem.year}</option>
                    `;
                    });

                    console.log(opcionesYears);
                    $("#filtroYears").html(opcionesYears);
                }
            });
    })


    function getMarcas(){

        let select_ano = $('#filtroYears').val();

        let data = {
            ano: select_ano,
        }
    
        $.ajax({
            type: "POST",
            url: "getMarcas.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                
                let opcionesMarcas = '<option value="0">Selecciona la marca...</option>';
                resp.forEach(elem => {
                   opcionesMarcas += `
                        <option value="${elem.marca}">${elem.marca}</option>
                   `;
                });

                console.log(opcionesMarcas);
                $("#divMarcas").attr('hidden', false);
                $("#filtroMarcas").html(opcionesMarcas);
            }
        });

    }

    function getModelos(){

        let select_marca = $('#filtroMarcas').val();
        let select_ano = $('#filtroYears').val();

        let data = {
            marca: select_marca,
            ano: select_ano,
        }

        $.ajax({
            type: "POST",
            url: "getModelos.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                
                let opcionesModelos = '<option value="0">Selecciona el modelo...</option>';
                resp.forEach(elem => {
                    opcionesModelos += `
                            <option value="${elem.modelo}">${elem.modelo}</option>
                    `;
                });

                $("#divModelos").attr('hidden', false);
                $("#filtroModelos").html(opcionesModelos);

            }
        });

    }

    function getVersiones(){

        let select_marca = $('#filtroMarcas').val();
        let select_ano = $('#filtroYears').val();
        let select_modelo = $('#filtroModelos').val();

        let data = {
            modelo: select_modelo,
            marca: select_marca,
            ano: select_ano,
        }

        $.ajax({
            type: "POST",
            url: "getVersiones.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                
                let opcionesVersiones = '<option value="0">Selecciona la versión...</option>';
                resp.forEach(elem => {
                    opcionesVersiones += `<option value='${elem.version}'>${elem.version}</option>
                    `;
                });

                $("#divVersiones").attr('hidden', false);
                $("#filtroVersiones").html(opcionesVersiones);

            }
        });

    }

    function getKM(){
        $("#divKM").attr('hidden', false);
    }

    function upKM(){
        setTimeout(() => {
            let kms = $("#filtroKM").val();

            if(kms == ""){
                $("#btnSig").attr('hidden', true);
            } else {
                $("#btnSig").attr('hidden', false);
            }
        }, 300);
    }

    function getOferta(){

        let select_marca = $('#filtroMarcas').val();
        let select_ano = $('#filtroYears').val();
        let select_modelo = $('#filtroModelos').val();
        let select_version = $('#filtroVersiones').val();
        let select_km = $('#filtroKM').val();

        select_version = select_version.replaceAll(" ", "%20");
        select_modelo = select_modelo.replaceAll(" ", "%20");

/*         let obj = '{"lineal": [{"year": 2024,"brand": "Chevrolet","subbrand": "Onix","version": "4 pts. LS, 1.3l, TM5, a\/ac., BA, R-15","km_group": "A","sale": 239000,"purchase": 209800},{"year": 2024,"brand": "Chevrolet","subbrand": "Onix","version": "Valor kilometraje","km_group": "A","sale": -4800,"purchase": -4800}]}';
        objetoOferta(JSON.parse(obj)); */
        const requestOptions = { 
        };

        

            fetch(`https://multimarca.gruporivero.com/api/v1/autometrica/lineal?empresa=chevrolet&year=${select_ano}&brand=${select_marca}&subbrand=${select_modelo}&version=${select_version}&kilometraje=${select_km}`, requestOptions)
            .then((response) => response.text())
            .then((result) => this.objetoOferta(JSON.parse(result)))
            .catch((error) => console.error(error));

    }

    function objetoOferta(obj){

        $("#formOferta").attr('hidden', true);
        $("#formDatos").attr('hidden', true);
        let data = obj.lineal;
//NISSAN, CHEVROLET, MAZDA, TOYOTA, HONDA

        let params = {
            modelo: obj.lineal[0].subbrand.toUpperCase(),
            
            marca: obj.lineal[0].brand.toUpperCase(),
            ano: obj.lineal[0].year,
        }

        $.ajax({
            type: "POST",
            url: "getTipos.php",
            data: params,
            dataType: "json",
            success: function(resp) {
                
                let precioAjustado = 0;
                console.log(resp.tipo);
                switch (resp.tipo) {
                    case "A":
                        precioAjustado = obj.lineal[0].purchase;
                        break;
                    case "B":
                        precioAjustado = obj.lineal[0].purchase * .05;
                        precioAjustado = obj.lineal[0].purchase - precioAjustado;
                        break;
                    case "C":
                        precioAjustado = obj.lineal[0].purchase * .1;
                        precioAjustado = obj.lineal[0].purchase - precioAjustado;
                        break;
                    case "D":
                        precioAjustado = obj.lineal[0].purchase * .13;
                        precioAjustado = obj.lineal[0].purchase - precioAjustado;
                        break;
                    case "E":
                        precioAjustado = "SIN OPCIÓN A COMPRA.";
                        $("#precio").html("SIN OPCIÓN A COMPRA.");
                        $("#descripcionAuto").html( `
                            <p style="font-family: Narrow;text-align: center;font-size: 1.5em;">${obj.lineal[0].brand} ${obj.lineal[0].subbrand} ${obj.lineal[0].year}</p>
                            <p style="font-family: Narrow;text-align: center;">${obj.lineal[0].version}</p>
                            `);
                        return 0;
                        break;
                    default:
                        precioAjustado = obj.lineal[0].purchase;
                        break;
                }

                let precio = '$ '+new Intl.NumberFormat('en-US').format(precioAjustado)+'.00 MXN';
                ofertas.precio_normal = precioAjustado;
                ofertas.km_group = obj.lineal[0].km_group;
                ofertas.compra = precioAjustado;
                ofertas.venta = obj.lineal[0].sale;

                let descripcionAuto = `
                    <p style="font-family: Narrow;text-align: center;font-size: 1.5em;">${obj.lineal[0].brand} ${obj.lineal[0].subbrand} ${obj.lineal[0].year}</p>
                    <p style="font-family: Narrow;text-align: center;">${obj.lineal[0].version}</p>
                    `;

                $("#formLoading").attr('hidden', true);
                $("#ofertaFinal").attr('hidden', false);
                $("#of1").attr('hidden', false);
                $("#precio").html(precio);
                $("#descripcionAuto").html(descripcionAuto);

                let precioPrimo = "";

                console.log("Marca: ", obj.lineal[0].brand.toLowerCase().includes("nissan"));
                console.log("Precio Venta: ", obj.lineal[0].sale);

                if(obj.lineal[0].brand.toLowerCase().includes("chevrolet") || obj.lineal[0].brand.toLowerCase().includes("nissan") || obj.lineal[0].brand.toLowerCase().includes("mazda") || obj.lineal[0].brand.toLowerCase().includes("mazda") || obj.lineal[0].brand.toLowerCase().includes("toyota")){
                    console.log("Entro al primero del IF: ", obj.lineal[0].brand.toLowerCase());

                    if (obj.lineal[0].sale != "" ){
                        let formula = (precioAjustado + obj.lineal[0].sale) / 2;
                        ofertas.precio_primo = formula;
                        precioPrimo = '$ '+new Intl.NumberFormat('en-US').format(formula)+'.00 MXN';
                        $("#precioPrimo").html(precioPrimo);
                        $("#OfertaPrimo").attr('hidden', false);
                    }

                } else {
                    console.log("Entro al SEGUNDO del IF: ", obj.lineal[0].brand.toLowerCase());
                }

            }
        });

    }

    function sendSF(){

        let nombre = $('#nombre').val();
        let correo = $('#correo').val();
        let telefono = parseInt($('#telefono').val());
        let year = parseInt($('#filtroYears').val());
        let marca = $('#filtroMarcas').val();
        let modelo = $('#filtroModelos').val();
        let version = $('#filtroVersiones').val();
        let kilometraje = parseInt($('#filtroKM').val());

        let data = {
            ano: year,
            marca: marca,
            modelo: modelo,
            version: version,
            km: kilometraje,
            venta: ofertas.venta,
            compra: ofertas.compra,
            ofrecido: ofertas.precio_ofrecido,
            ownerid:"<?=$_GET['ownerid']?>",
            leadid: "<?=$_GET['leadid']?>",
            opid:"<?=$_GET['opid']?>"
        }
        
        console.log(data);
        
        $.ajax({
            type: "POST",
            url: "https://www.riverorenta.mx/api/salesforce/valuacion-express-sf/resumen/send-salesforce.php",
            data: data,
            dataType: "json",
            success: function(resp) {
                console.log('Entra SF', resp);
            }

        });

    }

    function nuevaOferta(){
        location.reload();
/*         $('#filtroMarcas').val(0);
        $('#filtroYears').val('2026');
        $('#filtroModelos').val(0);
        $('#filtroVersiones').val(0);
        $('#filtroKM').val("");
        $("#cargando").attr('hidden', true);
        $("#divMarcas").attr('hidden', true);
        $("#divModelos").attr('hidden', true);
        $("#divVersiones").attr('hidden', true);
        $("#divKM").attr('hidden', true);

        $("#formOferta").attr('hidden', false);
        $("#ofertaFinal").attr('hidden', true); */

    }

    function getCAPTCHA(){

        let captcha_input = $('#captcha_input').val();
        let descripcion_auto = $('#descripcion_auto').val();

        descripcion_auto = descripcion_auto.substr(0,6);

        let data = {
            captcha_input: captcha_input,
            desca: descripcion_auto,
        }

        $.ajax({
            type: "POST",
            url: "verificar.php",
            data: data,
            dataType: "json",
            success: function(resp) {

                if(resp == "1"){
                    $("#btnSig").attr('hidden', false);
                    $("#captcha").attr('hidden', true);
                    $("#msjCaptcha").attr('hidden', true);
                } else {
                    $("#btnSig").attr('hidden', true);
                    var capt = document.getElementById('captcha_input');
                    capt.style.background= "#f5a0a0fa";
                    $("#msjCaptcha").attr('hidden', false);
                }

            }
        });

    }

    function selectOferta(oferta){
        $("#of1").attr('hidden', true);

        // AQUI PONER MENSAJE DE CITA GENERADA CON EXITO
        $("#formMensajeExito").attr('hidden', false);
        // AQUI PONER MENSAJE DE CITA GENERADA CON EXITO

        ofertas.ofertaElegida = oferta;

        if(oferta == "Normal"){
            ofertas.precio_ofrecido = ofertas.precio_normal; 
        } else {
            ofertas.precio_ofrecido = ofertas.precio_primo;
        }
        sendSF();
        console.log(oferta);

        setTimeout(() => {
            location.reload();
        }, 2000);
    }

    function siguienteDatos(){
        $("#formDatos").attr('hidden', true);
        $("#formOferta").attr('hidden', true);
        //AQUI FORM DE CARGA
        $("#formLoading").attr('hidden', false);
        //AQUI FORM DE CARGA

        getOferta();
    }

    function validarCorreo(valor,id) {
        if ( /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test(valor)){
            $(id).css("borderColor","#2b9c1fc7");
        return 1;
        } else {
            $(id).css("borderColor","yellow");
            return 0;
        }
    }

    function campoVacio(id){
        if($(id).val()==""){
            $(id).css("borderColor","yellow");
        }else{
            $(id).css("borderColor","#2b9c1fc7");
        }
    }

    function crearCita(){

        let nombre = $('#nombre').val();
        let correo = $('#correo').val();
        let telefono = parseInt($('#telefono').val());
        let year = parseInt($('#filtroYears').val());
        let marca = $('#filtroMarcas').val();
        let modelo = $('#filtroModelos').val();
        let version = $('#filtroVersiones').val();
        let kilometraje = parseInt($('#filtroKM').val());
        let fecha = $('#fecha').val();
        let hora = $('#hora').val();
        let direccion = 'Av. Miguel Alemán No. 5400, Col. Torres de Linda Vista, Guadalupe, Nuevo León, CP 67138';

        let data = {
            nombre: nombre,
            correo: correo,
            telefono: telefono,
            year: year,
            marca: marca,
            modelo: modelo,
            version: version,
            km_group: ofertas.km_group,
            kilometraje: kilometraje,
            venta: ofertas.venta,
            compra: ofertas.compra,
            ofrecido: ofertas.precio_ofrecido,
            oferta_elegida: ofertas.ofertaElegida,
            fecha: fecha,
            hora: hora,
            sucursal: 1043193,
            origen: 'chevroletrivero.com',
            preferencia: 'Celular'
        }

        $("#formCita").attr('hidden', true);
        $("#formCalendar").attr('hidden', false);
        console.log(data);

        let horadosLinkSplit = hora.split(":");
        let horadosLink = Number(horadosLinkSplit[0]);
        horadosLink = horadosLink + 1;

        if(horadosLink <= 9){
            horadosLink = "0"+horadosLink.toString();
        }

        horadosLink =  horadosLink + hora.substring(2,5);
        horadosLink = horadosLink.replaceAll(":","");

        let qrLink = "http://www.google.com/calendar/event?action=TEMPLATE&dates="+fecha.replaceAll("-", "")+"T"+hora.replaceAll(":", "")+"00/"+fecha.replaceAll("-", "")+"T"+horadosLink+"00&text=Cita+de+Valuacion+Chevrolet+Rivero&location="+direccion.replaceAll(" ", "+")+"&details=Cita+en+centro+de+valuacion+para+tu+"+modelo.replaceAll(" ", "+")+"+en+la+sucursal+Rivero+Contry";

        let frame = '<iframe src="https://www.riverorenta.mx/produccion/riveroQR/index.php?pagina='+qrLink+'" width="100%" height=200 style="border: 0" title="QRNissan"></frame>';

        let botonLink = "<a style='text-align:center' href='http://www.google.com/calendar/event?action=TEMPLATE&dates="+fecha.replaceAll("-", "")+"T"+hora.replaceAll(":", "")+"00/"+fecha.replaceAll("-", "")+"T"+horadosLink+"00&text=Cita+de+Valuacion+Chevrolet+Rivero&location="+direccion.replaceAll(" ", "+")+"&details=Cita+en+centro+de+valuacion+para+tu+"+modelo.replaceAll(" ", "+")+"+en+la+sucursal+Rivero+Contry' target='blank'> <img src='images/botones/btn_calendar.svg' style='width:220px'> </a>";
        $("#divQR").html(frame);
        $("#btnCalendar").html(botonLink);
    }

    function sendSalesforce(){
            var param={
                compra:$("#libroCompra").val(),
                venta:$("#libroVenta").val(),
                ofrecido:$("#precioPrimoVal").val(),
                modelo:"<?=$_GET['mot']?>",
                ano:"<?=$_GET['y']?>",
                marca:"<?=$_GET['mat']?>",
                version:"<?=$_GET['vet']?>",
                km:"<?=$_GET['km']?>",
                ownerid:"<?=$_GET['ownerid']?>",
                leadid:"<?=$_GET['leadid']?>",
                opid:"<?=$_GET['opid']?>",
            }
            //console.log(param);
            $.ajax({
                  url: 'send-salesforce.php',
                  type: 'POST',
                  data: param,
                  success:function(respuesta){
                    console.log(respuesta)
                  },
                  error: function () {
                      alert("error");
                  }
              }); 
        }

</script>

<style>
    #divYears{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #divMarcas{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #divModelos{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #divVersiones{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #precio{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #btnOferta{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #formOferta{
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: #0f3261;
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #ofertaFinal{
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: #0f3261;
    }

    #descripcionAuto{
        background-color: white;
        border-top: 2px solid #3275bb;
        border-left: 1px solid #3275bb;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 1px 2px 3px 1px;
        width: 100%;
    }

    .btnOfertaNormal{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #3275bb;
    }

    .btnOfertaPrimo{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #3275bb;
    }

    .btnOfertaPrimo:hover{
        background-color: #1056a1ff;
    }

    .btnOfertaNormal:hover{
        background-color: #1056a1ff;
    }

    #formCita{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #formDatos{
        animation-duration: 1s;
        animation-name: slide-in;
    }

    #formCalendar{
        animation-duration: 1s;
        animation-name: slide-in;
    }
        
    .pulso {
        font-size: 2rem;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes slide-in {
        from {
            translate: 0 -20px;
        }

        to {
            translate: 0 0;
        }
    }

    @keyframes up {
        from {
            translate: 0 0;
        }

        to {
            translate: 0 -200px;
        }
    }

    @font-face{
        font-family: Narrow;
        src: url('Narrow/owners-narrow-black.ttf');
    }

    .imgSucursal{
        width: 600px;
    }

    @media only screen and (max-width: 767px) {
        .imgSucursal{
            width: 100%;
        }
    }


</style>