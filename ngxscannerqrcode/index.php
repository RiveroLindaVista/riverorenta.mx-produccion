<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Dynamsoft JavaScript Barcode Scanner</title>
    <!-- include the library -->
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
</head>

<body>


    <div id="qr-reader" style="width: 600px"></div>


    <script>
        function onScanSuccess(decodedText, decodedResult) {
            
            console.log(`Code scanned = ${decodedText}`, decodedResult);
            alert(decodedText);
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>

</html>