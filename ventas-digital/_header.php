<?php
session_start();
require_once("_config.php");
$idSF=null;
if(isset($_GET["Id"])){
    $idSF=$_GET["Id"];
}
if($_SESSION["Id"]!=null&&$idSF==null){
    $idSF=$_SESSION["Id"];
}
$nombre=$_SESSION["Nombre"];
//print(json_encode($_SESSION));
?>
<!DOCTYPE html>
<html>
<head>

    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W4TF7JJ');</script>
<!-- End Google Tag Manager -->

	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="<?=URL?>images/icons/icon-rivero.png" type="image/png">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/57605b482e.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" type="text/css" href="<?=URL?>/styles.css">

    <title>Ventas digital</title>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W4TF7JJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <input id="idSF" type="text" value="<?=$idSF?>" hidden/>
    <script>
        if($("#idSF").val()!="<?=$_SESSION["Id"]?>"){
            updateSession("Id","<?=$_GET["Id"]?>");
            location.reload();
        }
    function updateSession($columna,$val){
        var params={
            columna:$columna,
            valor:$val
        }
        $.ajax({
            url:'<?=URL?>/v_funciones.php',
            method:'POST',
            data:params,
            success:function($resp){
                
            }
        });
    }
    function formatNumber(num) {
        if (!num || num == 'NaN') return '-';
        if (num == 'Infinity') return '&#x221e;';
        num = num.toString().replace(/\$|\,/g, '');
        if (isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        cents = num % 100;
        num = Math.floor(num / 100).toString();
        if (cents < 10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
            num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
        return (((sign) ? '' : '-') + num + '.' + cents);
    }

    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
       $(".rounded-circle").on("click", function(){
        window.history.back();
    })
    })
    


</script>

    <div id="contenedor" class="container-fluid">
        
