<?php
session_start();

date_default_timezone_set('America/Monterrey');
require_once("_config.php");
require_once(__DIR__. "/../_classes/_conne.php");
require_once(__DIR__."/../_classes/classes.php");

if(!isset($_SESSION["login"])){
    ?>
    <script type="text/javascript">
        window.location.href="<?=URL?>/login";
    </script>
    <?php
}

$consultas=new Consultas();
$datenow = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="es-MX">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tickets</title>
    <link rel="icon" type="image/x-icon" href="https://transportesrivero.com.mx/assets/images/favicon-32x32.png">

    <!-- Custom fonts for this template-->
    <link href="<?=URL?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
  
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=URL?>/css/sb-admin-2.min.css" rel="stylesheet">
       <!-- Custom styles for this page -->
    <link href="<?=URL?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body id="page-top">
      <!-- Page Wrapper -->
    <div >
        <div style="position: relative;">
<?php if ($_SESSION["rol"] == "ADMINISTRADOR"){
        include("menu_admin.php");
    } else {
        include("menu.php");
    }
?></div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" >
            <!-- Main Content -->
            <div id="content">
                <br/>
<style>

</style>