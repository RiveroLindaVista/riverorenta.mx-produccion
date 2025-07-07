<?php

include("_config.php");
$conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD, DB_DB);

$hoy = date('Y-m-d');
$manana = strtotime('+1 day', strtotime($hoy));
$manana = date('Y-m-d', $manana);

 $captcha_text = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
 $captcha_textp = $captcha_text."J89"; 
?>

<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Evento - Nissan Rivero</title>

    <link href="<?=URL?>/estilos/main.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <body style="background-color:#1d1d1d;">
        <div style="display:flex; justify-content: center; align-items: center;">
            <div id="formOferta" class="formOferta row" class="p-4">
                <div class="col-8"></div>

                <div class="col-4 d-flex justify-content-center">
                    <img src="logoOffroad.png" style="width:90%" />
                </div>

                <div class="col-8"></div>

                <div class="col-4 d-flex justify-content-center">
                    <div>
                        <div class="form-group pb-2">
                            <label class="labelEvento" for="nombre">Nombre *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Nombre" id="nombre" maxlength="40" name="nombre" size="30" type="text" required />
                        </div>

                        <div class="form-group pb-2">
                            <label class="labelEvento" for="nombre">Apellidos *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Apellidos" id="apellidos" maxlength="40" name="apellidos" size="30" type="text" required />
                        </div>

                        <div class="form-group pb-2" hidden>
                            <input class="inputEvento p-2 mb-1" id="evento" maxlength="40" name="evento" size="30" type="text" value="offroad" />
                        </div>

                        <div class="form-group pb-2">
                            <label class="labelEvento" for="telefono">Teléfono *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Telefono" id="telefono" maxlength="10" name="telefono" size="30" type="text" required />
                        </div>

                        <div class="form-group pb-2">
                            <label class="labelEvento" for="email">Correo *</label><br/>
                            <input class="inputEvento p-2 mb-1" placeholder="Correo" id="email" maxlength="80" name="email" size="30" type="text" required />
                        </div>

                        <div class="form-group p-2 d-flex justify-content-center">
                            <div class="botonEvento text-white px-4 py-0" onclick="enviarRegistro()">ENVIAR2</div>
                        </div>
                    </div>
                </div>

                <div class="col-8 "></div>

                <div class="d-flex justify-content-center col-4 p-0">
                    <img src="logoTinaja.png" style="width:80%" />
                </div>
                
            </div>
        </div>
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

        function enviarRegistro(){
console.log('hola');
    let nombre = $('#nombre').val();
    let apellidos = $('#apellidos').val();
    let email = $('#email').val();
    let telefono = $('#telefono').val();

    console.log(nombre, apellidos,email,telefono);

/*     var myHeaders = new Headers();
    myHeaders.append("Accept", "application/javascript");
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify({
      "nombre": nombre+" "+apellidos,
      "telefono": telefono,
      "email": email,
      "agencia": "Contry",
      "evento": "OffRoad Rivero"
    });

    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw,
      redirect: 'follow'
    };
    console.log("Sucede lo siguiente: ", raw);

    let postplanning = await fetch(this.multimarcaURL+`api/v1/registro/nissan/insert`, requestOptions) */

    }


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
                    opcionesVersiones += `
                        <option value="${elem.version}">${elem.version}</option>
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
                $("#captcha").attr('hidden', true);
            } else {
                $("#captcha").attr('hidden', false);
            }
        }, 300);
    }

    function getOferta(){

        var valCorreo=validarCorreo($("#correo").val(),"#correo");

        if($("#telefono").val().length<10){
            campoVacio("#telefono");
        }

        if($("#nombre").val()!=""&&$("#correo").val()!=""&&$("#telefono").val()!=""&&valCorreo==1&&$("#telefono").val().length==10){
            $("#btnOferta").attr('hidden', true);
            $("#cargando").attr('hidden', false);

            let select_marca = $('#filtroMarcas').val();
            let select_ano = $('#filtroYears').val();
            let select_modelo = $('#filtroModelos').val();
            let select_version = $('#filtroVersiones').val();
            let select_km = $('#filtroKM').val();

            select_version = select_version.replaceAll(" ", "%20");
            select_modelo = select_modelo.replaceAll(" ", "%20");

            let obj = '{"lineal": [{"year": 2024,"brand": "Chevrolet","subbrand": "Onix","version": "4 pts. LS, 1.3l, TM5, a\/ac., BA, R-15","km_group": "A","sale": 239000,"purchase": 209800},{"year": 2024,"brand": "Chevrolet","subbrand": "Onix","version": "Valor kilometraje","km_group": "A","sale": -4800,"purchase": -4800}]}';
            objetoOferta(JSON.parse(obj));
    /*         const requestOptions = {
                method: "GET",
                redirect: "follow"
            };

            fetch("https://multimarca.gruporivero.com/api/v1/autometrica/lineal?empresa=nissan&year="+select_ano+"&brand="+select_marca+"&subbrand="+select_modelo+"&version="+select_version+"&kilometraje="+select_km+"", requestOptions)
            .then((response) => response.text())
            .then((result) => this.objetoOferta(JSON.parse(result)))
            .catch((error) => console.error(error)); */
        } else {
            campoVacio("#nombre");
            validarCorreo("#correo");
            if($("#telefono").val().length != 10){
                $("#telefono").css("borderColor","yellow");
            }else{
                $("#telefono").css("borderColor","#2b9c1fc7");
            }
        }
    }

    function objetoOferta(obj){

        $("#formOferta").attr('hidden', true);
        $("#formDatos").attr('hidden', true);
        $("#ofertaFinal").attr('hidden', false);
        $("#of1").attr('hidden', false);
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
                            <p style="font-family: Narrow;text-align: center;font-size: 2em;">${obj.lineal[0].brand} ${obj.lineal[0].subbrand} ${obj.lineal[0].year}</p>
                            <p style="font-family: Narrow;text-align: center;">${obj.lineal[0].version}</p>
                            `);
                        return 0;
                        break;
                    default:
                        console.log('Sinco');
                        break;
                }
console.log(resp.tipo);
                let precio = '$ '+new Intl.NumberFormat('en-US').format(precioAjustado)+'.00 MXN';
                ofertas.precio_normal = precioAjustado;
                ofertas.km_group = obj.lineal[0].km_group;
                ofertas.compra = precioAjustado;
                ofertas.venta = obj.lineal[0].sale;

                let descripcionAuto = `
                    <p style="font-family: Narrow;text-align: center;font-size: 2em;">${obj.lineal[0].brand} ${obj.lineal[0].subbrand} ${obj.lineal[0].year}</p>
                    <p style="font-family: Narrow;text-align: center;">${obj.lineal[0].version}</p>
                    `;
                $("#precio").html(precio);
                $("#descripcionAuto").html(descripcionAuto);

                let precioPrimo = "";

                console.log("Marca: Chevrolet", obj.lineal[0].brand.toLowerCase().includes("chevrolet"));
                console.log("Precio Venta: ", obj.lineal[0].sale);

                if(obj.lineal[0].brand.toLowerCase().includes("chevrolet") == false && obj.lineal[0].brand.toLowerCase().includes("nissan") == false && obj.lineal[0].brand.toLowerCase().includes("mazda") == false && obj.lineal[0].brand.toLowerCase().includes("mazda") == false && obj.lineal[0].brand.toLowerCase().includes("toyota") == false){
                    console.log("Entro al primero del IF");
                } else {
                    console.log("Entro al SEGUNDO del IF");
                    if (obj.lineal[0].sale != "" ){
                        let formula = (precioAjustado + obj.lineal[0].sale) / 2;
                        ofertas.precio_primo = formula;
                        precioPrimo = '$ '+new Intl.NumberFormat('en-US').format(formula)+'.00 MXN';
                        $("#precioPrimo").html(precioPrimo);
                        $("#OfertaPrimo").attr('hidden', false);
                    }

                }

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
        $("#formCita").attr('hidden', false);

        ofertas.ofertaElegida = oferta;

        if(oferta == "Normal"){
            ofertas.precio_ofrecido = ofertas.precio_normal; 
        } else {
            ofertas.precio_ofrecido = ofertas.precio_primo;
        }

        console.log(oferta);
    }

    function siguienteDatos(){
        $("#formDatos").attr('hidden', false);
        $("#ofertaFinal").attr('hidden', false);
        $("#formOferta").attr('hidden', true);
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
        let direccion = 'Av. Eugenio Garza Sada 3800, Mas Palomas (Valle de Santiago), 64780 Monterrey, N.L., Mexico';

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
            sucursal: 1043194,
            origen: 'nissanrivero.com',
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

        let qrLink = "http://www.google.com/calendar/event?action=TEMPLATE&dates="+fecha.replaceAll("-", "")+"T"+hora.replaceAll(":", "")+"00/"+fecha.replaceAll("-", "")+"T"+horadosLink+"00&text=Cita+de+Valuacion+Nissan+Rivero&location="+direccion.replaceAll(" ", "+")+"&details=Cita+en+centro+de+valuacion+para+tu+"+modelo.replaceAll(" ", "+")+"+en+la+sucursal+Rivero+Contry";

        let frame = '<iframe src="https://www.riverorenta.mx/produccion/riveroQR/index.php?pagina='+qrLink+'" width="100%" height=200 style="border: 0" title="QRNissan"></frame>';

        let botonLink = "<a style='text-align:center' href='http://www.google.com/calendar/event?action=TEMPLATE&dates="+fecha.replaceAll("-", "")+"T"+hora.replaceAll(":", "")+"00/"+fecha.replaceAll("-", "")+"T"+horadosLink+"00&text=Cita+de+Valuacion+Nissan+Rivero&location="+direccion.replaceAll(" ", "+")+"&details=Cita+en+centro+de+valuacion+para+tu+"+modelo.replaceAll(" ", "+")+"+en+la+sucursal+Rivero+Contry' target='blank'> <img src='images/botones/btn_calendar.svg' style='width:220px'> </a>";
        $("#divQR").html(frame);
        $("#btnCalendar").html(botonLink);
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

    .formOferta{
        height: 100vh;
        width: 100vw;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: #94001c;
        animation-duration: 1s;
        animation-name: slide-in;
        background-image: url(backOffRoad.png);
        background-size: cover;
    }

    #ofertaFinal{
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: #94001c;
    }

    #descripcionAuto{
        background-color: white;
        border-top: 2px solid #d40028;
        border-left: 1px solid #d40028;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 1px 2px 3px 1px;
        width: 100%;
    }

    .inputEvento{
        border-radius: 15px;
        background-color:rgba(194, 194, 194, 0.56);
    }

    .labelEvento{
        color: white;
    }

    .botonEvento{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #d40028;
    }

    .btnOfertaNormal{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #d40028;
    }

    .btnOfertaPrimo{
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        position: relative;
        background-color: #d40028;
    }

    .btnOfertaPrimo:hover{
        background-color:rgb(173, 4, 35);
    }

    .btnOfertaNormal:hover{
        background-color:rgb(173, 4, 35);
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
