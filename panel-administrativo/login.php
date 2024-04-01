<?php
include("_inc/_config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head><meta charset="gb18030">

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>GRUPO RIVERO PANEL DE ADMINISTRACION</title>

     <meta name="author" content="Enrique Casas">
     <meta name="title" content="Grupo Rivero">
    <meta name="description" content="Grupo Rivero somos una Agencia Automotriz en Monterrey tenemos las mejores marcas de automóviles Chevrolet, Buick, Cadillac y GMC. Hazlo a tu manera"/>

    <link rel="canonical" href="https://www.gruporivero.com" />
    <meta property="og:title" content="Grupo Rivero" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.gruporivero.com/" />
    <meta property="og:image" content="https://www.gruporivero.com/assets/img/commun/gporiv.png" />
    <meta property="og:description" content="Grupo Rivero somos una Agencia Automotriz en Monterrey tenemos las mejores marcas de automóviles Chevrolet, Buick, Cadillac y GMC. Hazlo a tu manera" />
    <meta property="og:determiner" content="the" />
    <meta property="og:locale" content="es_MX" />
    <meta property="og:site_name" content="Grupo Rivero" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@agenciarivero" />
    <meta name="twitter:creator" content="@agenciarivero" />
    <!-- Favicon
    -->
     <!--link rel="icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- SEND AJAX FUNCTION   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link rel='icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />
    <!--link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/-->
    <link rel='shortcut icon' type='image/png' href='https://www.gruporivero.com/assets/img/commun/gporiv.png' />

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page" style="background: linear-gradient(100deg, #848484, #AFAFAF);">
    <div class="login-box" style="background: #083261;border-radius: 10px;padding:20px;justify-content: center; align-items: center;">
        <div class="logo-primo" style="display:flex; justify-content: center; align-items: center;">
            <img src="/produccion/panel-administrativo/images/primorivero.png" style="width: 100px" />
        </div>
        <div class="logo" style="display:flex; justify-content: center; align-items: center;">
            <h2 style="color: white; text-align: center;">PANEL DE ADMINISTRACION</h2>
        </div>
        <div class="card">
            <div class="body">
                
                    <div class="msg">Panel de acceso para MTK y Desarrollo</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="btn btn-block bg-red waves-effect" style="width: auto" onclick="loginPanel()">ENTRAR</div>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            
                        </div>
                        <div class="col-xs-6 align-right">
                            <?= date("m - j, Y, g:i"); ?>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
    	 //$('form').submit(false);
    	function loginPanel(){

    		var username= $('#username').val();
    		var password= $('#password').val();
    		if (username !=""  && password !="") {
    			var param={
    				username:username,
    				password:password
    			}
    			$.ajax({
    				type:'POST',
    				url:'checklogin.php',
    				data:param,    				
    				success(res){
                        console.log(res)
    					if (res==1) {
    						console.log("/produccion/panel-administrativo/pages/home");
    						window.location.href="<?= URL?>"+"/produccion/panel-administrativo/pages/home";
    					}else{
    						alert('Error, Usuario o Contraseña incorrectos!.');
    					}
    				}
    			})

    		}else{
    			alert('Error, Campos requeridos!');
    		}
    	}
    </script>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Efflugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>