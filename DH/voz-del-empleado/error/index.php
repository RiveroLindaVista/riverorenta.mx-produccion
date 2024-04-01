<!DOCTYPE html>
<html>
<head>
	<title>Grupo Rivero | Mejora continua</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../estilo.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>
	<br><br><br><br>
<section class="contenido">
	<img src="logo_rivero.png" width="100%" class="logo_rivero">
	<br><br><br>
	<form method="POST" action="send_mail.php" enctype="multipart/form-data">

		<h1>Lo sentimos, por el momento no se pudo enviar la información</h1>

		<p>Favor de intentar más tarde... o intenta subir una imagen válida</p>
</form>
</div>
<div style="clear: both;"/><br>
</section>
<script>
	$(".btnEnviat").on("click",function(){
		console.log("entro");
		$("#imagen").click();
	});
	$("#imagen").on("change",function(){
		$(".btnEnviat").toggleClass("active");
	});
</script>
</body>
</html>






