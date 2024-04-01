<?php
include("../../_inc/_config.php");
include("../../_inc/conexion.php");
$id=$_GET['i'];
class Conexion extends Database{
    public function query_mail_id($id){
        $conn= Database::connect();
        $utf8 = $conn->set_charset("utf8");
        $sql="SELECT * FROM correos_gr WHERE id = '$id'";
         $result=$conn->query($sql);
         if ($result) {
            while ($row = $result->fetch_assoc()) {
                $out[]=$row;
            }
            return $out;
        }
    }

}
class Construir extends Conexion{
    public function get_mail_detalle($id){
       $conn=new Conexion();
       $consulta_mail= $conn->query_mail_id($id);
      if($consulta_mail){
        for($i=0;$i<count($consulta_mail);$i++){   
            $cadena.='
          <center style="width:100%;background:#fff;"><table border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;font-size:13px;color:#656d78;max-width:800px;width:100%;background:#fff;">
          <tbody>
          <tr width="35%">
          <td style="padding:20px"><img src="https://rivero-static.s3-us-east-2.amazonaws.com/assets/img/commun/logo-grupo-rivero-3d-1.png" width="100%" alt="grupo rivero">
          </td>
          <td width="65%" style="padding:20px">
		  
		  <p style="line-height:0px;font-size:22px">'.$consulta_mail[$i]["ncompleto"].'</p>
		  <p style="font-weight:900;font-size:16px; margin-block-start: 1em;
    margin-block-end: 1em;">'.$consulta_mail[$i]["depto"].'</p>
		  <hr style="border:1px solid #2485fb">
		  <br>
		  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" style="padding-left:0px;font-family:sans-serif;font-size:13px;color:#656d78">
		  <tbody>
		  <tr>
		  <td width="50%" align="left"><img src="http://gruporivero.com/firma/i_correo.gif" height="10" alt=""> <a href="mailto:'.$consulta_mail[$i]["corr"].'" target="_blank">'.$consulta_mail[$i]["corr"].'</a></td>
		  <td> <img src="http://gruporivero.com/firma/i-web.gif" height="10" alt=""> <a href="http://gruporivero.com" target="_blank">gruporivero.com</a>
		  </td>
		  </tr>
		  <tr width="50">
		  <td align="left">
		  ';
      if($consulta_mail[$i]["ndirecto"]){
       $cadena.='<img src="http://gruporivero.com/firma/i_tel.gif" height="10" alt=""> '.$consulta_mail[$i]["ndirecto"].'   ext. '.$consulta_mail[$i]["extencion"];
    }
      
      $cadena.='</td>
		  <td>
		  </td>
		  </tr>
		  <tr>
		  </tr>
		  </tbody>
		  </table>
		  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:sans-serif;font-size:13px;color:#656d78">
		  <tbody>
		  <tr>
		  <td colspan="2"><br><img src="http://gruporivero.com/firma/i_gps.gif" height="10" alt=""> Av. Miguel Alemán No. 5400, Col. Torres de Linda Vista, Guadalupe, Nuevo León</td>
		  </tr>
	      </tbody>
	      </table>
	      </td>
	      </tr>
	      <tr><td colspan="2" style="font-family:sans-serif;font-size:7px;color:#656d78;padding-top:10px;text-align:justify"><p>En términos de la LEY FEDERAL DE PROTECCION DE DATOS PERSONALES EN POSESION DE  LOS PARTICULARES, GRUPO RIVERO está apegado a la normatividad de que el AVISO DE PRIVACIDAD INTEGRAL motivo por el cual, la información personal que nos proporcione es confidencial; de tal manera que no será transferida a terceros con el fin de salvaguardar su confidencialidad.  Para más información revisar aviso de privacidad Integral en <a href="http://www.gruporivero.com" target="_blank">www.gruporivero.com</a></p>
	      <p>Advertencia Legal: La información contenida en este e-mail es confidencial y sólo puede ser utilizada por el individuo o la compañía a la cual está dirigido. Esta información es de carácter provisional y referencial, NO deberá usted utilizar, copiar, revelar, o tomar ninguna acción basada en este correo electrónico o cualquier otra información incluida en el por ningún medio sin la autorización de GRUPO RIVERO la agencia no asume responsabilidad sobre información, opiniones o criterios contenidos en este e-mail. Favor de notificar al remitente de inmediato mediante el reenvió de este correo electrónico y borrar a la brevedad posible este correo electrónico y sus anexos.</p>
	      <p>Disclaimer: The information contained in this e-mail is confidential and may only be used by the individual or entity to whom it is addressed. This information is provisional and referential, you must not use, copy, disclose or take any action based on this message or any information herein by any means without the permission of GRUPO RIVERO the agency assumes responsibility for information, opinions or views contained in this e-mail. Please notify the sender immediately by reply e-mail and delete this as soon as possible this email and its attachments.</p></td></tr>
	      </tbody>
	      </table></center>
          ';
        }
        return $cadena;
        $conn->close();

        }
    }
}
$conne = new Construir();
$firma = $conne->get_mail_detalle($id);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include('../../_inc/_header.php');?>
    <link rel='icon' type='image/png' href='https://rivero-static.s3-us-east-2.amazonaws.com/assets/img/commun/logo-grupo-rivero-3d-1.png' />
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
            <div class="block-header">
                <h2>ADVANCED FORM ELEMENTS</h2>
            </div>
                        <!-- Tabs With Icon Title -->
        <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MAILS
                            </h2>
                        </div>
                        <div class="body">
                           <?=$firma;?>
                                                     
                        </div>
                    </div>
                </div>
            </div>                
                        
            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <button class="btn btn-primary" onclick="copiar()">Copiar Firma</button>
                        </div>
                        <div class="body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active">
                                    <textarea id="myFirma" rows="10" cols="80" style="width: 100%;">
                                      
                                        <?=$firma?>
                                    </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- #END# Tabs With Icon Title -->

        </div>
    </section>
<script>

    $(document).ready(function(){
        $('#myTable').DataTable();
    });
    function save(){
        var tituloL=  document.getElementById('titulo').value;
    var titulo =tituloL.toUpperCase();
        var titleL=  document.getElementById('title').value;
    var title =titleL.toUpperCase();
    var metakeys=document.getElementById('metakeys').value;
    var descripcion=document.getElementById('descripcion').value;
    error('#titulo');
    error('#title');
    error('#metakeys');
    error('#descripcion');

    if (titulo!="" && title!="" && metakeys!="" && descripcion!="") {
            var param={
                titulo:titulo,
                title:title,
                metakeys:metakeys,
                descripcion:descripcion,
            }
            $.ajax({
                url:'save.php',
                type:'POST',
                data:param,
                success: function(resp){
                    //alert(resp);
                    document.getElementById('return_id').innerHTML='<input type="text" id="num_id" value="'+resp+'">';
                	alert("Datos guardados correctamente.");
                    $("#titulo").val("");
                    $("#title").val("");
                    $("#metakeys").val("");
                    $("#descripcion").val("");
                    $(".form-line").removeClass("focused");
                	//location.reload();
                 }
            })        
    } else {
        alert('Campos vacíos!');
    }
}
// SAVE EDITOR HTML //
   function save_editor(){
    var contenido = CKEDITOR.instances.ckeditor.getData();
    var num_id = document.getElementById('num_id').value;
    //errorTextArea('#form-ckeditor');

    if (contenido!="") {
            
            var param={
               contenido:contenido,     
               num_id:num_id
            }
            $.ajax({
                url:'editor_data.php',
                type:'POST',
                data:param,
                success: function(resp){
                    alert(resp);
                    alert("Datos guardados correctamente.");
                    document.getElementById('form-ckeditor').innerHTML='<textarea rows="15" style="width:100%;">'+resp+'</textarea>';                    
                 }
            })    
    } else {
        alert('Campos vacíos, necesitas agregar descripcion al contenido!');
    }
}

// SAVE IMG //
  function clickImg(obj){
    document.getElementById(obj).click();
  }
  function updateImg(obj){
    cambiarImagen(obj);
  }
  function cambiarImagen(obj){
    var carpeta = document.getElementById('num_id').value;
    var fd = new FormData();
    var files = $('#'+obj)[0].files[0];
    fd.append('file',files);
    fd.append('carpeta',carpeta);         
    $.ajax({
      url: 'upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
       document.getElementById('return_file').innerHTML=response;
       $('.dropzone').css({'cssText': 'border: none !important;'});
       $('#contresp').css({'cssText': 'display: block !important;'});
        $('.dropzone').hide();
        alert("Imagen de portada agregada.")
        location.reload();
        }else{
          alert('Error,intenta de nuevo.');
         document.getElementById('return_file').innerHTML='<input type="text" id="copia_" class="form-control disabled" disabled="" value="" style="display:none !important;">';
        }
      }
    });
  }
  function error(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border-bottom: 1px solid red !important; '});
    }
  }
   function errorImg(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border: 1px solid red !important; '});
         location.href = obj;

    }
  }
   function errorTextArea(obj){
    if($(obj).val()==""){
         $(obj).css({'cssText': 'border: 1px solid red !important; '});
          location.href = obj;
    }
  }

</script>
<script>
function copiar(){
  var copyText = document.getElementById("myFirma");
  copyText.select();
  document.execCommand("copy");
  alert("Copiado");
}
</script>
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
