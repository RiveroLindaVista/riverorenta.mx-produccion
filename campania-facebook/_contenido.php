<script>
    function init() {
    var inputFile = document.getElementById('archivo');
    inputFile.addEventListener('change', mostrarImagen, false);
    }

    function mostrarImagen(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(event) {
        var img = document.getElementById('img1');
        img.src= event.target.result;
    }
    reader.readAsDataURL(file);
    }

    window.addEventListener('load', init, false);
</script>

<form action="upload.php" method="POST" enctype="multipart/form-data"/>
    <div class="container pt-4">
        <div class="row">
            <center>
                <h3>Subir imagen</h3>
            </center>
        </div>
        <div class="row">
            <div class="col col-lg-7 col-md-7 col-sm-6">
                <label>Agregar imagen</label>
                <input class="form-control"  name="archivo" id="archivo" type="file" required/>
                <div class="p-4">
                    <center>
                        <img id="img1" class="imageSelected"><br/>
                    </center>
                </div>
            </div>
            <div class="col col-lg-5 col-md-5 col-sm-6">
                <label>Ingrese el ID</label>
                <input class="form-control" id="idInput" name="idInput" required/>
            </div>
        </div>
        <div class="row pt-4">
            <center>
                <button type="submit" name="subir" class="btn btn-primary">Subir imagen</button>
            </center>
        </div>
    </div>
</form>

<form action="upload.php" method="POST" enctype="multipart/form-data">
    <div class="pt-4">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Reemplazar Id imagen
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="p-2">
                            <label>Ingrese el ID a reemplazar</label>
                            <input class="form-control" id="idInputReemplazar" name="idInputReemplazar" required/>
                        </div>
                        <div class="p-2">
                            <label>Ingrese el ID nuevo</label>
                            <input class="form-control" id="idInputReemplazarNuevo" name="idInputReemplazarNuevo" required/>
                        </div>
                        <div class="row pt-4">
                            <center>
                                <button type="submit" name="reemplazar" class="btn btn-primary">Reemplazar</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
