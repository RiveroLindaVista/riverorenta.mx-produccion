<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Método de Pago v3</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <script>
          tailwind.config = { theme: { extend: { colors: { 'background-dark': '#121212', 'surface-gray': '#1E1E1E', 'primary-blue': '#007AFF', 'text-primary': '#FFFFFF', 'text-secondary': '#A9A9A9' } } } }
      </script>
      <script src="https://unpkg.com/lucide@latest"></script>
      <style>
          @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
          html, body { font-family: 'Inter', sans-serif; background-color: #121212; }
          /* Estilos para la animación de la tarjeta */
          .card-flipper { perspective: 1000px; }
          .card-inner { position: relative; width: 100%; height: 100%; transition: transform 0.6s; transform-style: preserve-3d; }
          .card-flipper.flipped .card-inner { transform: rotateY(180deg); }
          .card-front, .card-back { position: absolute; width: 100%; height: 100%; backface-visibility: hidden; -webkit-backface-visibility: hidden; border-radius: 1rem; }
          .card-back { transform: rotateY(180deg); }
      </style>

    <script>
      if (!window.__NETPAY_TAGS_LOADED__) {
        window.__NETPAY_TAGS_LOADED__ = true;
        var s = document.createElement("script");
        s.src = "https://docs.netpay.mx/cdn/v1.3/netpay.min.js";
        document.head.appendChild(s);
      }
    </script>

    <script>
      if (!window.__NETPAY_TAGS_LOADED_3DS__) {
        window.__NETPAY_TAGS_LOADED_3DS__ = true;
        var t = document.createElement("script");
        t.src = "https://cdn.netpay.mx/js/dev/netpay3ds.js";
        document.head.appendChild(t);
      }
    </script>

  </head>

  <body class="bg-background-dark text-text-primary">
      <div class="max-w-md mx-auto min-h-screen p-6 flex flex-col">
          <header class="flex items-center mb-6">
              <div class="w-6"></div>
              <div class="mx-auto text-center">
                  <h1 class="text-xl font-bold">Realizar Pago</h1>
                  <p class="text-3xl font-bold text-primary-blue">$2,450.00 MXN</p>
              </div>
              <div class="w-6"></div>
          </header>

          <main class="flex-grow">
              <div class="card-flipper aspect-[16/10] w-full mb-6">
                  <div class="card-inner">
                      <div class="card-front bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 p-5 flex flex-col justify-between text-white shadow-lg">
                          <div class="flex justify-between items-center">
                              <i data-lucide="wifi" class="w-6 h-6 -rotate-90"></i>
                              <img id="card-logo" src="" alt="Card Logo" class="h-8 opacity-0 transition-opacity">
                          </div>
                          <div>
                              <p id="card-number-display" class="font-mono text-2xl tracking-widest">•••• •••• •••• ••••</p>
                              <div class="flex justify-between mt-4 text-sm">
                                  <div>
                                      <p class="opacity-70 text-xs">Titular</p>
                                      <p id="card-name-display" class="font-semibold uppercase">NOMBRE APELLIDO</p>
                                  </div>
                                  <div>
                                      <p class="opacity-70 text-xs">Vence</p>
                                      <p id="card-exp-display" class="font-semibold">MM/AA</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card-back bg-gray-700 p-2 flex flex-col justify-center">
                          <div class="w-full h-10 bg-black"></div>
                          <div class="bg-white text-black text-right italic font-semibold p-2 mt-4">
                              <span id="card-cvv-display">•••</span>
                          </div>
                      </div>
                  </div>
              </div>
              
              <form class="space-y-4">
                  <div>
                      <label for="cc-number" class="block text-sm font-medium text-text-secondary mb-1">Número de Tarjeta</label>
                      <input type="tel" value="5120481234567895" id="cc-number" class="w-full bg-surface-gray p-3 rounded-lg font-mono tracking-wider focus:ring-primary-blue focus:border-primary-blue" placeholder="•••• •••• •••• ••••">
                  </div>
                  <div hidden>
                      <label for="cc-name" class="block text-sm font-medium text-text-secondary mb-1">Nombre del Titular</p>
                      <input type="text" id="cc-name" class="w-full bg-surface-gray p-3 rounded-lg uppercase focus:ring-primary-blue focus:border-primary-blue" placeholder="NOMBRE APELLIDO">
                  </div>
                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <label for="cc-exp" class="block text-sm font-medium text-text-secondary mb-1">Vencimiento</label>
                          <input type="tel" value="02/26" id="cc-exp" class="w-full bg-surface-gray p-3 rounded-lg focus:ring-primary-blue focus:border-primary-blue" placeholder="MM / AA">
                      </div>
                      <div>
                          <label for="cc-cvv" class="block text-sm font-medium text-text-secondary mb-1">CVV</label>
                          <input type="tel" value="999" id="cc-cvv" class="w-full bg-surface-gray p-3 rounded-lg focus:ring-primary-blue focus:border-primary-blue" placeholder="•••">
                      </div>
                  </div>
              </form>
              
              <div class="flex items-center justify-between mt-6 bg-surface-gray p-3 rounded-lg">
                  <div class="flex items-center">
                      <i data-lucide="lock" class="w-5 h-5 text-text-secondary mr-3"></i>
                      <label for="save-card" class="font-semibold text-sm">Guardar de forma segura para futuros pagos</label>
                  </div>
                  <input type="checkbox" id="save-card" class="h-6 w-10 rounded-full appearance-none bg-background-dark checked:bg-primary-blue transition-colors cursor-pointer">
              </div>
          </main>

          <footer class="mt-8">
              <button onclick="beginPaymentWithCustomForm()" class="w-full bg-primary-blue text-white font-bold py-4 rounded-lg flex items-center justify-center hover:opacity-80 transition-opacity">
                  <i data-lucide="lock" class="w-5 h-5 mr-2"></i>
                  Pagar $2,450.00
              </button>
          </footer>
      </div>
      
      <script>
          lucide.createIcons();
          // --- LÓGICA DE LA TARJETA INTERACTIVA ---
          const cardNumberInput = document.getElementById('cc-number');
          const cardNameInput = document.getElementById('cc-name');
          const cardExpInput = document.getElementById('cc-exp');
          const cardCvvInput = document.getElementById('cc-cvv');
          
          const cardNumberDisplay = document.getElementById('card-number-display');
          const cardNameDisplay = document.getElementById('card-name-display');
          const cardExpDisplay = document.getElementById('card-exp-display');
          const cardCvvDisplay = document.getElementById('card-cvv-display');
          const cardLogo = document.getElementById('card-logo');
          const cardFlipper = document.querySelector('.card-flipper');

          // Formato de número de tarjeta
          cardNumberInput.addEventListener('input', (e) => {
              let value = e.target.value.replace(/\D/g, '').substring(0, 16);
              let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();
              e.target.value = formattedValue;
              cardNumberDisplay.textContent = formattedValue || '•••• •••• •••• ••••';
              // Detección de marca
              if (value.startsWith('4')) {
                  cardLogo.src = 'https://i.imgur.com/visa-logo.png'; cardLogo.style.opacity = 1;
              } else if (value.startsWith('5')) {
                  cardLogo.src = 'https://i.imgur.com/mastercard-logo.png'; cardLogo.style.opacity = 1;
              } else if (value.startsWith('3')) {
                  cardLogo.src = 'https://i.imgur.com/amex-logo.png'; cardLogo.style.opacity = 1;
              } else {
                  cardLogo.style.opacity = 0;
              }
          });
          // Actualizar nombre
          cardNameInput.addEventListener('input', (e) => {
              cardNameDisplay.textContent = e.target.value.toUpperCase() || 'NOMBRE APELLIDO';
          });
          // Formato de fecha de vencimiento
          cardExpInput.addEventListener('input', (e) => {
              let value = e.target.value.replace(/\D/g, '').substring(0, 4);
              if (value.length > 2) {
                  value = value.slice(0, 2) + ' / ' + value.slice(2);
              }
              e.target.value = value;
              cardExpDisplay.textContent = value || 'MM/AA';
          });
          // Lógica de giro de tarjeta para CVV
          cardCvvInput.addEventListener('focus', () => {
              cardFlipper.classList.add('flipped');
          });
          cardCvvInput.addEventListener('blur', () => {
              cardFlipper.classList.remove('flipped');
          });
          cardCvvInput.addEventListener('input', (e) => {
              cardCvvDisplay.textContent = e.target.value.replace(/./g, '•');
          });
      </script>
  </body>

  <script>

    function beginPaymentWithCustomForm(){
        console.log("Iniciando pago");

        let splitExp = document.getElementById('cc-exp').value.split('/');

        function generateDeviceFingerPrint() {
            console.log('gerenateDeviceFingerPrint........')
            let deviceFingerPrint = NetPay.form.generateDeviceFingerPrint();
            return deviceFingerPrint;
        }
        
        let card = document.getElementById('cc-number').value;
        let expiryMonth = splitExp[0];
        let expiryYear = splitExp[1];
        let cvv = document.getElementById('cc-cvv').value;

        let cardData = {
            cardNumber: card,
            expMonth: expiryMonth,
            expYear: expiryYear,
            cvv2: cvv,
            deviceFingerPrint : generateDeviceFingerPrint()
        };

        console.log(cardData);

        var validateNumber = NetPay.card.validateNumber(cardData.cardNumber);
        var validateExpiry = NetPay.card.validateExpiry(cardData.expMonth, cardData.expYear);
        var validateCVV = NetPay.card.validateCVV(cardData.cvv2, cardData.cardNumber);
        var validateNumberLength = NetPay.card.validateNumberLength(cardData.cardNumber);

        if (!validateNumberLength || !validateNumber || !validateExpiry || !validateCVV) {
            alert("Please, verify the card information");
            return false;
        }

        function success(e) {
            var token = JSON.parse(e.message.data).token;
            console.log("Token created successfully");
            console.log("token: ", token);

            var amount =  1;

            let _this = this;
            let refer;
            netpay3ds.setSandboxMode(true);
            netpay3ds.init(function () {
                netpay3ds.config(_this, 1, callback);//monto
            });

            const callback = function(_this, referenceId) {
                charges(referenceId, token, amount, generateDeviceFingerPrint());
            }

            const charges = function(referenceId, token, amount, deviceFingerPrint) {
                console.log("Reference ID from 3DS: ", referenceId, "token: ", token, "amount: ", amount, "deviceFingerPrint: ", deviceFingerPrint);

                const myHeaders = new Headers();
                myHeaders.append("Authorization", "sk_netpay_VzWcAVZswBXsSaTcwlXONgvnsVZsSvbdvZanzypYVXAMD");
                myHeaders.append("Content-Type", "application/json");
                myHeaders.append("Accept", "application/json");

                const raw = JSON.stringify({
                    "transactionType": "Auth",
                    "amount": amount,
                    "sessionId": deviceFingerPrint,
                    "deviceFingerPrint": deviceFingerPrint,
                    "referenceID": referenceId,
                    "source": token,
                    "description": "Cargo de prueba",
                    "paymentMethod": "card",
                    "currency": "MXN",
                    "billing": {
                        "firstName": "John",
                        "lastName": "Doe",
                        "email": "review@netpay.com.mx",
                        "phone": "5555555555",
                        "merchantReferenceCode": "test-1111",
                        "address": {
                        "city": "San Pedro Garza García",
                        "country": "MX",
                        "postalCode": "66269",
                        "state": "NL",
                        "street1": "Humberto Junco Voigt, México 2307-2o Sector, Santa Engracia"
                        }
                    },
                    "redirect3dsUri": "http://example.com/",
                    "saveCard": "false"
                });

                console.log('Charges payload:', JSON.parse(raw));

                const requestOptions = {
                    method: "POST",
                    headers: myHeaders,
                    body: raw,
                    redirect: "follow"
                };

                fetch("https://gateway-154.netpaydev.com/gateway-ecommerce/v3.5/charges", requestOptions)
                .then((response) => response.text())
                .then((result) => console.log(result))
                .catch((error) => console.error(error));


            }



        }

        function error(e) {
            console.log("Error creating token");
        }

        NetPay.setApiKey("pk_netpay_OvUCmrGrrrbyXVdyfggXPECFp");
        NetPay.setSandboxMode(true);
        NetPay.token.create(cardData, success, error);

    }

  </script>

</html>