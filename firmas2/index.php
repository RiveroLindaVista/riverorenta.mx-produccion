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
    const url = `http://www.google.com/calendar/event?action=TEMPLATE&usuario=${usuario}&accion=${accion}`;

    // Generar el QR
    new QRCode(document.getElementById("qrcode"), {
      text: url,
      width: 200,
      height: 200
    });
  </script>

</body>
</html>