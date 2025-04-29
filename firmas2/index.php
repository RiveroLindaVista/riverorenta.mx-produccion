<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Generador de QR</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>

  <h2>Generador de QR para un enlace</h2>
  <div id="qrcode"></div>

  <script>
    // URL de destino (puedes construirla dinámicamente)
    const usuario = "juan";
    const accion = "ver";
    const pagina = $_POST["pagina"];
    
    const url = `${pagina}&usuario=${usuario}&accion=${accion}`;

    //const url = `http://www.google.com/calendar/event?action=TEMPLATE&dates=20251031T110000/20251031T120000&text=Taller+Cita+de+Servicio&location=Av.Miguel+Aleman+5400&details=Cita+en+taller+de+servicio+para+tu+Aveo+2020+en+Rivero+Linda+Vista&usuario=${usuario}&accion=${accion}`;
   // http://www.google.com/calendar/event?action=TEMPLATE&dates=20201031T11:00:00-01:00/20201031T12:00:00-01:00&text=Taller+Cita+de+Servicio&location=Av.Miguel+Alemnán+5400&details=Cita+en+taller+de+servicio+para+tu+Aveo+2020+en+Rivero+Linda+Vista
    // Generar el QR
    new QRCode(document.getElementById("qrcode"), {
      text: url,
      width: 200,
      height: 200
    });
  </script>

</body>
</html>