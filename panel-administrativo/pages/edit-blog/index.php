<?php
include("../../_inc/_config.php");
include("../../_inc/constructor.php");

$conne = new Construir();
$conn=new Conexion();

$url_blog = explode("/?",$_SERVER['REQUEST_URI']);

$id_blog = $url_blog[1];
$blog = $conne->query_blog($id_blog);

echo($blog[0]["title"]);

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
            <h1>Editar Blog </h1>
            <div class="card" style="padding: 1em">
                <label>Modifica el titulo</label>
                <input style="font-size:2em;font-weight:600" type="text" id="titulo" class="form-control" aria-required="true" value="<?= $blog[0]["title"] ?> ">
                <input style="font-size:2em;display:none;" type="text" id="id_blog" class="form-control" aria-required="true" value="<?= $blog[0]["id"] ?> ">
                <hr/>
                <label>Modifica la agencia</label>
                <div class="form-group form-float">
                    <div class="form-line">
                        <select id="make" class="form-control" name="make" onchange="updateMarca()">
                            <option value="chevrolet">CHEVROLET</option>
                            <option value="nissan">NISSAN</option>
                        </select>
                    </div>
                </div>
                <hr/>
                <img id="portada" style="width: 60%;margin-top: 10px;margin-bottom: 10px;" src="https://d3s2hob8w3xwk8.cloudfront.net/blog/<?= $blog[0]["id"] ?>/portada.png" />
                <hr/>
                <!-- CKEditor -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div>
                            <form id="form-ckeditor">
                                <textarea id="ckeditor" name="ckeditor" rows="10" cols="80" style="width: 100%;">
                                    <?= $blog[0]["contenido"] ?>
                                </textarea>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- CKEditor -->
                <hr/>
                <h2>Entrada al Blog </h2>

                <div class="row" style="padding-left:5em;padding-right:5em;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img id="portada" style="width: 50%;margin-top: 10px;margin-bottom: 10px;" src="https://d3s2hob8w3xwk8.cloudfront.net/blog/<?= $blog[0]["id"] ?>/portada.png" />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h4><?= $blog[0]["title"]?> </h4>
                        <textarea id="descripcion" rows="5" style="width: 100%;"><?=$blog[0]["descripcion"]?></textarea>
                        <div class="btn bg-primary" style="border-radius:8px; margin-top:5px;">Leer más... ></div>
                    </div>
                </div>

                <hr/>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding-bottom: 15px;">
                        <button type="button" class="btn btn-primary m-t-15 waves-effect" onclick="save();">GUARDAR CAMBIOS</button>
                    </div>
                </div>

            </div>
        </div>
    </section>

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

    function save(){

        var titulo=  document.getElementById('titulo').value;
        var id_blog=  document.getElementById('id_blog').value;
        var descripcion=document.getElementById('descripcion').value;
        var contenido = CKEDITOR.instances['ckeditor'].getData();
        var make=  document.getElementById('make').value;

        console.log(titulo , " - ", id_blog )

        if (titulo && contenido && descripcion) {

            var param={
                titulo:titulo,
                descripcion:descripcion,
                contenido:contenido,
                id_blog:id_blog,
                make: make
            }

            $.ajax({
                url:'update.php',
                type:'POST',
                data:param,
                success: function(resp){
                    alert("Cambios guardados correctamente.");
                    location.reload();
                }
            })

        } else {
            alert('Debes llenar todos los campos incluyendo la elección de la imagen del blog.');
        }

    }

</script>