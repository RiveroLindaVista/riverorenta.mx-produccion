<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="imgs/rivero-icon.png">
    <title>FIRMAS - Grupo Rivero</title>
    <!-- Importaciones CSS && SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/stylesContent.css">

    <div id="container">
        <div class="fondoH">
            <div class="header p-2">
                <img class="logoRivero" src="imgs/logo_rivero.png" alt="logoRivero">
            </div>
            <br>
            <div class="header-menu">
                <center>
                    <h3>Elige tu Agencia:</h3>
                    <br>
                    <a onclick="openUrl()" class="btn btn-primary btn-lg active styleChevrolet" role="button">
                        <img src="imgs/logo_chevrolet_rivero.png" alt="logoNissan" class="btnLogoChevrolet"></a>
                    <!-- #0062cc -->

                    <a onclick="openSearch()" class="btn btn-secondary btn-lg active styleNissan" role="button">
                        <img src="imgs/logo_nissan_rivero.png" alt="logoNissan" class="btnLogoNissan"></a>

                    <a onclick="openEmpresarial()" class="btn btn-primary btn-lg active styleEmpresarial" role="button">
                        <img src="divisiones/corporativo.png" alt="logoNissan" class="btnLogoEmpresarial"></a>
                </center>
                <br>
            </div>
        </div>
    </div>

    <hr />
    <br>

    <script type="text/javascript">
    function openUrl() {

        window.location.replace('firmasChevrolet.php');
    }
    </script>

    <script type="text/javascript">
    function openSearch() {

        window.location.replace('firmasNissan.php');
    }
    </script>

    <script type="text/javascript">
    function openEmpresarial() {

        window.location.replace('firmasEmpresarial.php');
    }
    </script>

</head>

</html>