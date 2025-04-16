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

                        <!-- <div class="form-section" >
                            <label for="areaSelect">Selecciona tu Área:</label>
                            <select name="areaSelect" id="areaSelect"
                                onchange="cambiarImagen(); funcionImprimirCodigo()">
                                <option value="otro" selected>Otro</option>
                                <option value="otroDos" selected>A</option>
                            </select>
                        </div> -->

                        <div class="form-section">
                            <label for="nombreInput">Nombre Completo:</label>
                            <input type="text" name="nombreInput" id="nombreInput" onkeypress="actualizarTexto()"
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
                                <option value="contry" selected>Contry</option>
                                <option value="lasTorres">Las Torres</option>
                                <option value="valle">Valle</option>
                                <option value="allende">Allende</option>
                            </select>
                        </div>

                        <div class="form-section">
                            <label for="sucursalSelect">Sucursal:</label>
                            <select name="sucursalSelect" id="sucursalSelect"
                                onchange="actualizarTexto(); funcionImprimirCodigo()">
                                <option value="contry" selected>Contry</option>
                                <option value="lasTorres">Las Torres</option>
                                <option value="valle">Valle</option>
                                <option value="allende">Allende</option>
                                <option value="hyp">HYP</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="tarjetNissan">
            <div class="cardFondoNissan row">
                <div class="cardPrincipalNissan mb-4 col-12" style="height: 274px;">
                    <div class="row" style="background-color:#b32535;border-raduis:border-radius: 0px 0px 20px 20px;">
                        <div class="imgDivisionDer col-6">
                            <img class="divisionImgStyleEmpresarial" id="divisionImagen" src="" alt="ayuda">
                        </div>
                        <div class="imgPrimosizq col-6">
                            <img class="styleNissanPrimos" src="imgs/iniciaviaje.png" alt="ayuda">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="contenidoNissan col-9">
                            <div class="stylePuestoNissan" id="txtPuesto">
                            </div>

                            <div class="styleNombreNissan" id="txtNombre">
                            </div>

                            <div class="styleCorreoNissan" id="txtCorreo">
                            </div>

                            <div class="styleTelefonoNissan" id="txtTelefono">
                            </div>

                            <div class="stylePaginaNissan" id="txtPaginaArea">
                            </div>

                            <div class="styleSucursalNissan" id="txtSucursal">
                            </div>
                        </div>
                        <div class="imgPrimo col-3 d-flex">
                            <img class="imgLogoPrimo" src="imgs/logoPrimo.png" alt="Bienvenido">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="fondoNissan" style="display: flex; justify-content: center; display:none;">

            <table
                style="width: 700px !important; height: 300px !important; margin: 2.0px; overflow: inherit; background: #000000; cursor: default; transition: all 400ms ease; color: black; padding: 5px 8px 10px;">
                <tbody>
                    <tr>
                        <td>
                            <div
                                style="width: 97%; height: 254px; margin-top: 2px; border-radius: 10px; overflow: inherit;  background: #FFFF; cursor: default; transition: all 400ms ease; color: black; padding: 10px 10px 10px;">
                                <div class="row" style="display: flex;">
                                    <div style="display: flex;">
                                        <div class="col-6" style="height: 60px; margin-top: 10px;">
                                            <img id="divisionImagenDos"
                                                src="https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/divisiones/otroNissanDos.png"
                                                alt="ayuda" style="max-width: 64%;">
                                        </div>
                                        <div class="col-6" style="height: 60px; margin-top: 10px;">
                                            <img src="https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/imgs/iniciaviaje.png"
                                                alt="ayuda" style="max-width: 80%; margin-top:9px;">
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-left: 20px;margin-top: 46px;;" class="col-9 row">
                                    <div id="txtPuestoDos"
                                        style="font-weight: bold; margin-top: -16px;  font-size: 21px; color: #000000; text-transform: capitalize;">
                                    </div>

                                    <div id="txtNombreDos"
                                        style="font-size: 28px; font-weight: bold; text-transform: capitalize; margin-top: -25px; color: rgb(0, 0, 0) !important;">
                                    </div>

                                    <div id="txtCorreoDos"
                                        style="font-family:bahnschrift; color: #000000; margin-top: -16px;">
                                    </div>

                                    <div id="txtTelefonoDos"
                                        style="font-family:bahnschrift; color: #000000; margin-top: -10px; ">
                                    </div>

                                    <div id="txtPaginaAreaDos"
                                        style="font-family:bahnschrift; color: #000000; margin-top: -10px; ">
                                    </div>

                                    <div id="txtSucursalDos"
                                        style="font-family:bahnschrift; color: #000000; margin-top: -10px; ">
                                    </div>
                                </div>
                                <div class="col-3 d-flex"
                                    style=" justify-content: center; align-items: center; max-width: 35%; max-height: 20%;">
                                    <img style="max-width: 66%;margin-left: 200%;display: block;margin-top: -207px;;"
                                        src="https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/imgs/logoPrimoNissan.gif"
                                        alt="Bienvenido">
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>



        </div>

        <div class="tarjetNissan">
            <button class="btn btn-secondary btn-lg active styleNissan" onclick="exportarComoImagen()">Exportar Firma en
                Imagen</button>
            <button class="btn btn-secondary btn-lg active styleNissanCopiar" onclick="copiar()"
                style="margin-left: 50px; background: black;">Exportar Firma en Codigo</button>
        </div>

        <textarea name="codigo" id="codigo" cols="150" rows="180" readonly
            style="width: 700px !important; height: 350px !important; margin: 20px; display: flex; justify-content: center;margin-left: 32%;"></textarea>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

        <script>
        function funcionImprimirCodigo() {
            setTimeout(() => {
                var contenedor = document.getElementById("fondoNissan");
                var textarea = document.getElementById("codigo");

                textarea.rows = 20;
                textarea.cols = 120;
                textarea.value = contenedor.innerHTML;

                document.body.appendChild(textarea);

                /* console.log(contenedor); */
            }, 100);
        }



        function copiar() {
            var copyText = document.getElementById("codigo");
            copyText.select();
            document.execCommand("copy");
            alert("Copiado");
        }

        /* function copiar() {
            event.preventDefault();
            $('#codigo').show();
            var copyText = document.getElementById("codigo");
            copyText.select();
            document.execCommand("copy");
            alert("Copiado");

            $('#codigo').hide();
        } */

        function exportarComoImagen() {
            var contenedor = document.querySelector('.cardFondoNissan');

            html2canvas(contenedor, {
                useCORS: true,
                scale: 1,
            }).then(function(canvas) {
                // Convertir a formato JPEG con compresión
                var dataURL = canvas.toDataURL('image/png', 1); // 0.8 es el nivel de compresión (de 0 a 1)

                // Crear un enlace de descarga
                var link = document.createElement('a');
                link.href = dataURL;
                link.download = 'Firma_Electronica.png';
                link.click();
            });
        }

        function cambiarImagen() {
            console.log("AYDUADISANK")
            var areaSelect = document.getElementById("areaSelect");
            var divisionImagen = document.getElementById("divisionImagen");
            var divisionImagenDos = document.getElementById("divisionImagenDos");

            divisionImagen.src = 'divisiones/otroNissan.png';
            divisionImagenDos.src = 'https://d3s2hob8w3xwk8.cloudfront.net/imgFirmas/divisiones/otroNissanDos.png';
            divisionImagen.className = 'imgOtro';
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
                    tamaño.style.fontSize = "27px";
                    tamañoDos.style.fontSize = "27px";
                } else {
                    var tamaño = document.getElementById('txtNombre');
                    var tamañoDos = document.getElementById('txtNombre');
                    tamaño.style.fontSize = "28px";
                    tamañoDos.style.fontSize = "28px";
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

                if (paginaSelect.value === 'contry') {
                    divTextoPagina.innerHTML = "<p>" + "nissanriverocontry.com" + "</p>";
                    divTextoPaginaDos.innerHTML = "<p>" + "nissanriverocontry.com" + "</p>";

                } else if (paginaSelect.value === 'lasTorres') {
                    divTextoPagina.innerHTML = "<p>" + "nissanriverolastorres.com" + "</p>";
                    divTextoPaginaDos.innerHTML = "<p>" + "nissanriverolastorres.com" + "</p>";

                } else if (paginaSelect.value === 'valle') {
                    divTextoPagina.innerHTML = "<p>" + "nissanriverovalle.com" + "</p>";
                    divTextoPaginaDos.innerHTML = "<p>" + "nissanriverovalle.com" + "</p>";

                } else if (paginaSelect.value === 'allende') {
                    divTextoPagina.innerHTML = "<p>" + "nissanriveroallende.com" + "</p>";
                    divTextoPaginaDos.innerHTML = "<p>" + "nissanriveroallende.com" + "</p>";

                } else if (paginaSelect.value === 'hyp') {
                    divTextoPagina.innerHTML = "<p>" + "nissanriveroallende.com" + "</p>";
                    divTextoPaginaDos.innerHTML = "<p>" + "nissanriveroallende.com" + "</p>";

                }


                var sucursalSelect = document.getElementById("sucursalSelect");
                var divTextoSucursal = document.getElementById("txtSucursal");
                var divTextoSucursalDos = document.getElementById("txtSucursalDos");

                if (sucursalSelect.value === 'contry') {

                    divTextoSucursal.innerHTML = "<p>" +
                        "Av. Eugenio Garza Sada 3800, Mas Palomas (Valle de Santiago) Monterrey, NUEVO LEÓN 64780" +
                        "</p>";

                    divTextoSucursalDos.innerHTML = "<p>" +
                        "Av. Eugenio Garza Sada 3800, Mas Palomas (Valle de Santiago) Monterrey, NUEVO LEÓN 64780" +
                        "</p>";

                } else if (sucursalSelect.value === 'lasTorres') {

                    divTextoSucursal.innerHTML = "<p>" +
                        "Av. Lázaro Cárdenas 2514 San Pedro Garza Garcia, NUEVO LEÓN 66200" +
                        "</p>";
                    divTextoSucursalDos.innerHTML = "<p>" +
                        "Av. Lázaro Cárdenas 2514 San Pedro Garza Garcia, NUEVO LEÓN 66200" +
                        "</p>";

                } else if (sucursalSelect.value === 'valle') {

                    divTextoSucursal.innerHTML = "<p>" +
                        "Calzada Del Valle 110, Col Del Valle San Pedro Garza Garcia, NUEVO LEÓN 66220" +
                        "</p>";
                    divTextoSucursalDos.innerHTML = "<p>" +
                        "Calzada Del Valle 110, Col Del Valle San Pedro Garza Garcia, NUEVO LEÓN 66220" +
                        "</p>";

                }  else if (sucursalSelect.value === 'allende') {

                    divTextoSucursal.innerHTML = "<p>" +
                        "Carr Nacional 301, San Javier, 67350 Cdad. de Allende, N.L." +
                        "</p>";
                    divTextoSucursalDos.innerHTML = "<p>" +
                        "Carr Nacional 301, San Javier, 67350 Cdad. de Allende, N.L." +
                        "</p>";

                }  else if (sucursalSelect.value === 'hyp') {

                    divTextoSucursal.innerHTML = "<p>" +
                        "Av. Alfonso Reyes 3237, Alta Vista Sur, 64740 Monterrey, N.L." +
                        "</p>";
                    divTextoSucursalDos.innerHTML = "<p>" +
                        "Av. Alfonso Reyes 3237, Alta Vista Sur, 64740 Monterrey, N.L." +
                        "</p>";

                }
            }, 100);
        }

        cambiarImagen();
        actualizarTexto();
        </script>

        <?php
/* include("footer.php"); */
?>