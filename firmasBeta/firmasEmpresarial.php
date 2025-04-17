<?php
include("header.php");
?>
<header>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="estilos/style.css">
    </head>

    <body>
        <div class="fondo">
            <div class="cardFormulario mb-4">
                <center>
                    <h3>Crea tu firma electronica:</h3>
                    <br>
                </center>
                <form action="">

                    <div class="contenedorUno">
                        <div class="form-section">
                            <label for="puestoInput">Ingresa tu Puesto:</label>
                            <input type="text" name="puestoInput" id="puestoInput" onkeypress="actualizarTexto()"
                                onkeydown="actualizarTexto()" onchange="funcionImprimirCodigo()">
                        </div>

                        <!-- <div class="form-section">
                            <label for="areaSelect">Selecciona tu Área:</label>
                            <select name="areaSelect" id="areaSelect"
                                onchange="cambiarImagen(); funcionImprimirCodigo()">
                                <option value="bodyShop" selected>Body Shop</option>
                                <option value="flotillas">Flotillas</option>
                                <option value="rentas">Rentas</option>
                                <option value="seminuevos">Seminuevos</option>
                                <option value="tallerServicio">Taller de Servicio</option>
                                <option value="transportes">Transportes</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div> -->

                        <div class="form-section">
                            <label for="nombreInput">Nombre Completo:</label>
                            <input type="text" id="nombreInput" onkeypress="actualizarTexto()"
                                onkeydown="actualizarTexto()" onchange="funcionImprimirCodigo()">
                        </div>

                        <div class="form-section">
                            <label for="correoInput">Correo:</label>
                            <input type="email" name="correoInput" id="correoInput" onkeypress="actualizarTexto()"
                                onkeydown="actualizarTexto()" onchange="funcionImprimirCodigo()">
                        </div>

                        <div class="form-section">
                            <label for="telefonoInput">Telefono o Extensión:</label>
                            <input type="tel" name="telefonoInput" id="telefonoInput" onkeypress="actualizarTexto()"
                                onkeydown="actualizarTexto()" onchange="funcionImprimirCodigo()">
                        </div>

                        <div class="form-section">
                            <label for="paginaSelect">Página de tu Área:</label>
                            <select name="paginaSelect" id="paginaSelect"
                                onchange="actualizarTexto(); funcionImprimirCodigo()">
                                <option value="bodyShop">Body Shop</option>
                                <option value="flotillas">Flotillas</option>
                                <option value="rentas">Rentas</option>
                                <option value="seminuevos">Seminuevos</option>
                                <option value="tallerServicio">Taller de Servicio</option>
                                <option value="transportes">Transportes</option>
                                <option value="otro" selected>Otro</option>
                            </select>
                        </div>

                        <div class="form-section">
                            <label for="sucursalSelect">Sucursal:</label>
                            <select name="sucursalSelect" id="sucursalSelect"
                                onchange="actualizarTexto(); funcionImprimirCodigo()">
                                <option value="lindaVista" selected>Linda Vista</option>
                                <option value="guadalupe">Guadalupe</option>
                                <option value="humbertoLobo">Humberto Lobo</option>
                                <option value="santaCatarina">Santa Catarina</option>
                                <option value="gomezMorin">Gomez Morin</option>
                                <option value="loboAlianza">Humberto Lobo Alianza</option>
                                <option value="venustianoCarranza">Venustiano Carranza</option>
                                <option value="transportes">Transportes</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="tarjetNissan" id="tarjetaChevrolet">
            <div class="cardFondoEmpresarial row">
                <div class="cardPrincipalEmpresarial mb-4 col-12" style="height: 274px;">
                    <div class="row" style="background-color:#b32535;border-radius: 0px 0px 30px 30px;padding-bottom:15px;padding-top:15px;">
                        <div class="imgDivisionDer col-6">
                            <img class="divisionImgStyleEmpresarial" id="divisionImagen" src="" alt="ayuda">
                        </div>
                        <div class="imgPrimosizq col-6">
                            <img class="styleNissanPrimos" src="imgs/iniciaviaje.png" alt="ayuda">
                        </div>
                    </div>
                
                <br>
                <div class="row">
                    <div class="conteidoChevrolet col-7">

                        <div class="styleNombreCorporativo" id="txtNombre">
                        </div>

                        <div class="stylePuestoCorporativo" id="txtPuesto">
                        </div>

                    </div>
                    <div class="imgPrimo col-3 d-flex">
                        <div class="styleCorreoCorporativo" id="txtCorreo">
                        </div>

                        <div class="styleTelefonoCorporativo" id="txtTelefono">
                        </div>

                        <div class="stylePaginaCorporativo" id="txtPaginaArea">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="styleSucursalCorporativo" id="txtSucursal">
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div id="fondoCorporativo" style="display: flex; justify-content: center; display: none;" >
            <table style="width: 700px !important; height: 300px !important; margin: 20px; overflow: inherit; 
        background: #1e345e; cursor: default; transition: all 400ms ease; color: black; padding: 10px 20px 20px;">
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex;">
                                <div class="col-6" style="height: 60px;">
                                <img id="divisionImagenDos" src="https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/divisiones/corporativo.png" alt="ayuda" style="max-width: 125px;">
                                </div>
                                <div class="col-6" style="height: 60px;">
                                <img src="https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/imgs/somos_primos_chevrolet.png" alt="ayuda" style="max-width: 32%;margin-left: 68%;">
                                </div>
                            </div>
                            <div style="height: 220px; margin-top: -5px; border-radius: 10px; overflow: inherit;  background: #d6d6d6; 
                                cursor: default; transition: all 400ms ease; color: black; padding: 10px 10px 10px;">
                                <div class="row" style="display: flex;">
                                    <div class="col-9">
                                        <div id="txtPuestoDos" style="font-family:Arial; margin-top: -10px;  font-size: 21px;
                            color: #0F3261; text-transform: capitalize;">
                                        </div>

                                        <div id="txtNombreDos" style=" font-size: 38px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                            color: #0F3261 !important; text-transform: uppercase; margin-top: -25px;">
                                        </div>

                                        <div id="txtCorreoDos" style="font-family:Arial; color: #0F3261; margin-top: -16px; ">
                                        </div>

                                        <div id="txtTelefonoDos" style="font-family:Arial; color: #0F3261; margin-top: -10px; ">
                                        </div>

                                        <div id="txtPaginaAreaDos" style="font-family:Arial; color: #0F3261; margin-top: -10px; ">
                                        </div>

                                        <div id="txtSucursalDos" style="font-family:Arial; color: #0F3261; margin-top: -10px; ">
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex"
                                        style=" justify-content: center; align-items: center; max-width: 35%; max-height: 20%;">
                                        <img style="max-width: 125%;margin-left: 15%;display: block;max-height: 70%;"
                                            src="https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/imgs/logoPrimo.png"
                                            alt="Bienvenido">
                                    </div>
                                </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="tarjetNissan">
            <button class="btn btn-primary btn-lg active styleChevrolet" onclick="exportarComoImagen()">Exportar Firma en Imagen</button>
            <button class="btn btn-secondary btn-lg active styleNissanCopiar" onclick="copiar()" style="margin-left: 50px; background: black;">Exportar Firma en Codigo</button>
        </div>

        <textarea name="codigo" id="codigo" cols="150" rows="180" readonly
            style="width: 700px !important; height: 350px !important; margin: 20px; display: flex; justify-content: center;margin-left: 32%;"></textarea>

    </body>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script>
    /* console.log(fondoChevrolet); */

    function funcionImprimirCodigo() {
        setTimeout(() => {
            var contenedor = document.getElementById("fondoCorporativo");
            var textarea = document.getElementById("codigo");

            textarea.rows = 20;
            textarea.cols = 120;
            textarea.value = contenedor.innerHTML;

            document.body.appendChild(textarea);

            console.log(contenedor);
        }, 100);
    }
    
    function copiar() {
        var copyText = document.getElementById("codigo");
        copyText.select();
        document.execCommand("copy");
        alert("Copiado");
    }

    function exportarComoImagen() {
        /* $('#tarjetaChevrolet').show(); */
        var contenedor = document.querySelector('.cardFondoEmpresarial');

        html2canvas(contenedor, {
            useCORS: true,
            scale: 1,
        }).then(function(canvas) {

            var dataURL = canvas.toDataURL('image/png', 1);
            var link = document.createElement('a');
            link.href = dataURL;
            link.download = 'Firma_Electronica.png';
            link.click();
        });

        /* $('#tarjetaChevrolet').hide(); */
    }

    

    function cambiarImagen() {
            console.log("AYDUADISANK")
            var areaSelect = document.getElementById("areaSelect");
            var divisionImagen = document.getElementById("divisionImagen");
            var divisionImagenDos = document.getElementById("divisionImagenDos");

            divisionImagen.src = 'divisiones/corporativo.png';
            divisionImagenDos.src = 'https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/divisiones/corporativo.png';
            divisionImagen.className = 'imgCorporativo';
        }

    function actualizarTexto() {
        setTimeout(() => {

            var inputPuesto = document.getElementById("puestoInput");
            var divTextoPuesto = document.getElementById("txtPuesto");
            var divTextoPuestoDos = document.getElementById("txtPuestoDos");

            var inputNombre = document.getElementById("nombreInput");
            var divTextoNombre = document.getElementById("txtNombre");
            var divTextoNombreDos = document.getElementById("txtNombreDos");

            if (inputNombre.value.length >= 25) {
                var tamaño = document.getElementById('txtNombre');
                var tamañoDos = document.getElementById('txtNombreDos');
                tamaño.style.fontSize = "28px";
                tamañoDos.style.fontSize = "28px";
            } else {
                var tamaño = document.getElementById('txtNombre');
                var tamañoDos = document.getElementById('txtNombreDos');
                tamaño.style.fontSize = "38px";
                tamañoDos.style.fontSize = "38px";
            }

            var inputCorreo = document.getElementById("correoInput");
            var divTextoCorreo = document.getElementById("txtCorreo");
            var divTextoCorreoDos = document.getElementById("txtCorreoDos");

            var inputTelefono = document.getElementById("telefonoInput");
            var divTextoTelefono = document.getElementById("txtTelefono");
            var divTextoTelefonoDos = document.getElementById("txtTelefonoDos");

            divTextoPuesto.innerHTML = "<p>" + inputPuesto.value + "</p>";
            divTextoPuestoDos.innerHTML = "<p>" + inputPuesto.value + "</p>";

            divTextoNombre.innerHTML = "<p>" + inputNombre.value + "</p>";
            divTextoNombreDos.innerHTML = "<p>" + inputNombre.value + "</p>";

            divTextoCorreo.innerHTML = "<p>" + inputCorreo.value + "</p>";
            divTextoCorreoDos.innerHTML = "<p>" + inputCorreo.value + "</p>";

            divTextoTelefono.innerHTML = "<p>" + inputTelefono.value + "</p>";
            divTextoTelefonoDos.innerHTML = "<p>" + inputTelefono.value + "</p>";


            var paginaSelect = document.getElementById("paginaSelect");
            var divTextoPagina = document.getElementById("txtPaginaArea");
            var divTextoPaginaDos = document.getElementById("txtPaginaAreaDos");

            if (paginaSelect.value === 'bodyShop') {
                divTextoPagina.innerHTML = "<p>" + "gruporivero.com/taller-de-colision" + "</p>";
                divTextoPaginaDos.innerHTML = "<p>" + "gruporivero.com/taller-de-colision" + "</p>";

            } else if (paginaSelect.value === 'flotillas') {
                divTextoPagina.innerHTML = "<p>" + "riverorenta.com/empresarial" + "</p>";
                divTextoPaginaDos.innerHTML = "<p>" + "riverorenta.com/empresarial" + "</p>";

            } else if (paginaSelect.value === 'rentas') {
                divTextoPagina.innerHTML = "<p>" + "riverorenta.com" + "</p>";
                divTextoPaginaDos.innerHTML = "<p>" + "riverorenta.com" + "</p>";

            } else if (paginaSelect.value === 'seminuevos') {
                divTextoPagina.innerHTML = "<p>" + "gruporivero.com/catalogo/seminuevos" + "</p>";
                divTextoPaginaDos.innerHTML = "<p>" + "gruporivero.com/catalogo/seminuevos" + "</p>";

            } else if (paginaSelect.value === 'tallerServicio') {
                divTextoPagina.innerHTML = "<p>" + "gruporivero.com/taller-de-servicio" + "</p>";
                divTextoPaginaDos.innerHTML = "<p>" + "gruporivero.com/taller-de-servicio" + "</p>";

            } else if (paginaSelect.value === 'transportes') {
                divTextoPagina.innerHTML = "<p>" + "transportesrivero.com.mx" + "</p>";
                divTextoPaginaDos.innerHTML = "<p>" + "transportesrivero.com.mx" + "</p>";

            } else if (paginaSelect.value === 'otro') {
                divTextoPagina.innerHTML = "<p>" + "gruporivero.com" + "</p>";
                divTextoPaginaDos.innerHTML = "<p>" + "gruporivero.com" + "</p>";
            }


            var sucursalSelect = document.getElementById("sucursalSelect");
            var divTextoSucursal = document.getElementById("txtSucursal");
            var divTextoSucursalDos = document.getElementById("txtSucursalDos");

            if (sucursalSelect.value === 'lindaVista') {

                divTextoSucursal.innerHTML = "<p>" +
                    "Av. Miguel Alemán No. 5400, Col. Torres de Linda Vista, Guadalupe, Nuevo León, CP 67138" +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Av. Miguel Alemán No. 5400, Col. Torres de Linda Vista, Guadalupe, Nuevo León, CP 67138" +
                    "</p>";

            } else if (sucursalSelect.value === 'guadalupe') {

                divTextoSucursal.innerHTML = "<p>" +
                    "Carretera a Reynosa, cruz con Ave. México Col. Industrial La Silla, Guadalupe, Nuevo León, CP 67199" +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Carretera a Reynosa, cruz con Ave. México Col. Industrial La Silla, Guadalupe, Nuevo León, CP 67199" +
                    "</p>";

            } else if (sucursalSelect.value === 'humbertoLobo') {

                divTextoSucursal.innerHTML = "<p>" +
                    "Av. Humberto Lobo #660 cruz con Rio Rhin, Col. Del Valle, San Pedro Garza Garcia, Nuevo León, CP 66220" +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Av. Humberto Lobo #660 cruz con Rio Rhin, Col. Del Valle, San Pedro Garza Garcia, Nuevo León, CP 66220" +
                    "</p>";

            } else if (sucursalSelect.value === 'santaCatarina') {

                divTextoSucursal.innerHTML = "<p>" +
                    "Blvd. Gustavo Díaz Ordaz 100-A, Col. La Fama, Santa Catarina, Nuevo León, CP 66100" +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Blvd. Gustavo Díaz Ordaz 100-A, Col. La Fama, Santa Catarina, Nuevo León, CP 66100" +
                    "</p>";

            } else if (sucursalSelect.value === 'gomezMorin') {

                divTextoSucursal.innerHTML = "<p>" +
                    "Avenida Gómez Morin 402, Villas de Aragón, San Pedro Garza Garcia, Nuevo León, CP 67273" +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Avenida Gómez Morin 402, Villas de Aragón, San Pedro Garza Garcia, Nuevo León, CP 67273" +
                    "</p>";

            } else if (sucursalSelect.value === 'loboAlianza') {
                divTextoSucursal.innerHTML = "<p>" +
                    "Av. José Vasconcelos #1555 Entre Neil Armstrong y Av. De los Conquistadores Col. Del Valle, San Pedro Garza Garcia, Nuevo León, CP 66220" +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Av. José Vasconcelos #1555 Entre Neil Armstrong y Av. De los Conquistadores Col. Del Valle, San Pedro Garza Garcia, Nuevo León, CP 66220" +
                    "</p>";
            } else if (sucursalSelect.value === 'venustianoCarranza') {
                divTextoSucursal.innerHTML = "<p>" +
                    "Venustiano Carranza 811, Col. Centro, 64000 Monterrey, N.L." +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Venustiano Carranza 811, Col. Centro, 64000 Monterrey, N.L." +
                    "</p>";
            }else if (sucursalSelect.value === 'transportes') {
                divTextoSucursal.innerHTML = "<p>" +
                    "Salvador Chávez 101, Fraccionamiento Campestre La Encarnación, Campestre, 66633 Cdad. Apodaca, N.L." +
                    "</p>";
                divTextoSucursalDos.innerHTML = "<p>" +
                    "Salvador Chávez 101, Fraccionamiento Campestre La Encarnación, Campestre, 66633 Cdad. Apodaca, N.L." +
                    "</p>";
            }
        }, 100);
    }

    cambiarImagen();
    actualizarTexto();
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <?php
/* include("footer.php"); */
?>