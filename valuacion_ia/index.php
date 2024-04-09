<?php
//echo $_GET["valuacionid"];
//echo $_GET["ownerid"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
   
    <title>Valuacion IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="height: 1200px;">
    <div class="container">
        <div style="float:right">Refrescar: <img src="reload.png" loading="eager|lazy" width="20px"  onclick="location.reload()" ></div>
        <div style="clear: both;" />
        <div style="padding-top: 30px;" class="row" id="filtro">
            <div class="form-control">
                <label class="" for="">Seleccione una marca</label>
                <div class="col-md-12">
                    <select class="form-control form-select" aria-label="Default select example" id="ctrl_marca">
                        <!-- jquery -->
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="" for="">Seleccione un modelo</label>
                    <select class="form-control form-select" aria-label="Default select example" id="ctrl_model">
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="" for="">Seleccione año</label>
                    <select class="form-control form-select" aria-label="Default select example" id="ctrl_ano">
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="" for="">Seleccione version</label>
                    <select class="form-control form-select" aria-label="Default select example" id="ctrl_version">
                    </select>
                </div>
                <!-- <div class="col-md-12">
                    <label class="" for="">Unidad de negocio</label>
                    <select class="form-control form-select" aria-label="Default select example" id="ctrl_business">
                        <option value="">Seleccione </option>
                        <option value="623505fce5c26a00138e7293">Grupo Rivero</option>
                      </select>
                </div> -->
                <div class="col-md-12">
                    <label class="" for="">Kilometros</label>
                    <input class="form-control" type="text" id="ctrl_kms">
                </div>
                <div class="col-md-12" style="justify-content: end; align-items: end; padding-top: 30px;">

                    <button onclick="consultar()" style="justify-content: end; align-items: end;"
                        class="btn btn-primary">Consultar</button>
                </div>
            </div>


        </div>


        <div style="padding-top: 30px;" class="row">
            <div class="col-md-12">
                <div class="form-control" id="info" style="overflow-y: scroll;height: 1100px;"></div>
            </div>

        </div>

        
        <!-- <div style="padding-top: 30px;" class="row">
            <div class="col-md-12">
                <div class="form-control">
                    <pre style="color: white; background-color: rgb(23, 65, 88); height: 500px;" id="info2">

                        </pre>
                </div>
            </div>

        </div> -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


    <script src="js/jscript.js"></script>

</body>

</html>