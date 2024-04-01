<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$conn=new Conexion();

if ($this_page=="codigos-qr") { $codigos_qr="active"; } else{ $codigos_qr="active"; }

$lista_qr= $conne->get_table_qrs();

    for($i=0;$i<count($lista_qr);$i++){
      //$pathinfo = pathinfo($lista_qr[$i]["forma"]); 
      $params=base64_encode(json_encode($lista_qr[$i]));        

        $cadena.='<tr>
        <td id="N'.$lista_qr[$i]["id"].'">'.$lista_qr[$i]["nombre"].'</td>
        <td id="S'.$lista_qr[$i]["id"].'" style="position: relative;"><i onclick="editSlug(\'Slug\',\''.$lista_qr[$i]["slug"].'\', '.$lista_qr[$i]["id"].')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i>'.$lista_qr[$i]["slug"].'</td>
        <td>'.$lista_qr[$i]["codigo"].'</td>
        <td id="U'.$lista_qr[$i]["id"].'">'.$lista_qr[$i]["url"].'</td>
        <td id="img'.$lista_qr[$i]["id"].'" style="position: relative;"><i onclick="editImg(\''.$lista_qr[$i]["url"].'\', \''.$lista_qr[$i]["slug"].'\')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i><img width="50px" height="60px;" src="'.$lista_qr[$i]["url"].'"/></td>
        </tr>';
    }

?>
<!DOCTYPE html>
<html>
<head>
   <?php include('../../_inc/_header.php');?>
    <link rel='icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"> 
</head>

<body class="theme-blue">
  <!-- #Top Bar -->
   <?php include('../../_inc/_search-bar.php');?>
<!-- #Menu -->
    <section>
    <?php include('../../_inc/_menu.php');?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
    <?//include('../../_inc/_gadgets.php');?>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="header">
                    <h1>
                        Asignación Códigos QR
                    </h1>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>    
                            <tr>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Codigo</th>
                                <th>Url</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?= $cadena ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de edicion Imagen -->
    <div class="modal fade bs-example-modal-lg" id="modal-edit-img" name="modal-edit-img" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Imagen QR</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <div>
                            <input id="nameImg" type="hidden">
                        </div>
                        <div id="imgArea" style="text-align:center">
                        </div>
                        <hr/>
                        <div class="fallback" style="text-align:center">
                            <div id="slugModal"></div><br/>
                        </div>
                        <div class="fallback" style="text-align:center;display:flex;justify-content:center;">
                            <input type="file" id="img_file" name="img_file"/>
                            <input type="hidden" id="slugi" name="slugi" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSubirImg">Cambiar Imagen</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de edicion de inventarios versiones -->

    <!-- Modal de edicion -->
    <div class="modal fade bs-example-modal-lg" id="modal-edit" name="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title" id="modal-title"></div>
            </div>
            <div class="modal-body">
                <div>
                    <div>
                        <input id="idVal" type="hidden">
                    </div>
                    <div>
                        <label for="">Descripcion</label>
                        <textarea id="textEdit" class="form-control" type="text" onkeypress="return check(event)"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSlug" onclick="saveSlug()">Cambiar Slug</button>
                <button type="button" class="btn btn-primary" id="btnNombre" onclick="saveNombre()">Cambiar Nombre</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de edicion -->

<!-- Jquery Core Js -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../../plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<!-- Custom Js -->
<script src="../../js/admin.js"></script>
<script src="../../js/pages/tables/jquery-datatable.js"></script>

<!-- Ckeditor -->
<script src="../../plugins/ckeditor/ckeditor.js"></script>

<!-- TinyMCE -->
<script src="../../plugins/tinymce/tinymce.js"></script>
<script src="../../js/pages/forms/editors.js"></script>
</body>

</html>

<script>

    function editImg(nombre, slug){
        if (slug){
            $("#modal-edit-img").modal('show');
            $("#slugi").val(slug);
            document.getElementById('slugModal').innerHTML='<label>Selecciona la nueva imagen, la cual llevará el nombre: "'+slug+'"</label>';
            document.getElementById('imgArea').innerHTML='<label for="">Imagen Actual</label><br/><img src = "'+nombre+'" style="max-width: 300px;">';
            console.log(nombre);
        } else {
            alert('Para subir una imagen debes llenar la columna "SLUG".');
        }

    }

    $("#btnSubirImg").click(function() {
        let slug = $("#slugi").val();
        let fd = new FormData();
        let imagen = $('#img_file')[0].files[0];
        fd.append('imagen', imagen );
        fd.append('slug', slug);
        console.log(imagen, "Es el FD");

        $.ajax({
            url: "import.php",
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                if (data == 'ok') {
                    console.log('SE SUBIO')
                } else {
                    console.log('NOOOOOO SE SUBIO')
                }
            },
            error: function(err) {
                if (err.responseText == 'ok') {
                    alert('Se ha subido la imagen.')
                    location.reload();
                } else if (err.responseText == 'jpg'){
                    alert('Imagen incorrecta, asegurate de utilizar una con extensión "jpg".')
                } else {
                    alert('Error intente de nuevo.')
                }
            }
        });
    });

    function editSlug(columna, valor, id ){
        console.log(columna);
        if(columna == "Slug"){
            $('#btnNombre').hide();
        } else {
            $('#btnSlug').hide();
        }

        $("#modal-edit").modal('show');
        $("#textEdit").val(valor);
        document.getElementById('modal-title').innerHTML='<h4>Editar '+columna+'</h4>';
        $("#idVal").val(id);

    }

    function check(e) {
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            return true;
        }

        // Patrón de entrada, en este caso solo acepta numeros y letras
        patron = /[A-Za-z0-9_-]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }

    function saveSlug(){
        let slug = $("#textEdit").val();
        let id = $("#idVal").val();
        let url = "https://www.riverorenta.mx/gruporivero/pdf/"+slug+".jpg";
        console.log(url);
        var param={id:id, slug:slug}
        $.ajax({
            url:'update_slug.php',
            type:'POST',
            data:param,
            success: function(resp){
                if (resp == 1){
                    console.log(resp)
                    idElement = 'S'+id;
                    idElementU = 'U'+id;
                    idElementI = 'img'+id;
                    document.getElementById(idElement).innerHTML= '<i onclick="editSlug(\'Slug\',\''+slug+'\','+id+')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i>'+slug;
                    document.getElementById(idElementU).innerHTML= url;
                    document.getElementById(idElementI).innerHTML= '<i onclick="editImg(\''+url+'\', \''+slug+'\')" class="material-icons" style="font-size: 15px; position: absolute; right: 5px;cursor: pointer;">edit</i><img width="50px" height="60px;" src="'+url+'"/></td>';
                    $("#modal-edit").modal('hide');
                } else {
                    alert('Ya existe un campo con el mismo "Slug" ingrese uno diferente.')
                }

            }
        })
    }

</script>