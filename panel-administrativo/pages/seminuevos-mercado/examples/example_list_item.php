<?php
session_start();

require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);

if($_GET['code']) {

	// If the code was in get parameter we authorize
	$user = $meli->authorize($_GET['code'], $redirectURI);

	// Now we create the sessions with the authenticated user
	$_SESSION['access_token'] = $user['body']->access_token;
	$_SESSION['expires_in'] = $user['body']->expires_in;
	$_SESSION['refresh_token'] = $user['body']->refresh_token;

	// We can check if the access token in invalid checking the time
	if($_SESSION['expires_in'] + time() + 1 < time()) {
		try {
			print_r($meli->refreshAccessToken());
		} catch (Exception $e) {
			echo "Exception: ",  $e->getMessage(), "\n";
		}
	}

	// We construct the item to POST
	$item = array(
                            "title" => "VOLKSWAGEN VENTO 2018",
        "category_id" => "MLM1743",
        "price" => 139000,
        "currency_id" => "MXM",
        "available_quantity" => 1,
        "initial_quantity" => 1,
        "sold_quantity" => 0,
        "condition" => "used",
        "description" => "ESPEJOS SEGUROS Y VIDRIOS ELECTRICOS, STEREO MP, BLUETOOTH, CONTROL DE AUDIO AL VOLANTE, BOLSAS DE AIRE, CIERRE DE PUERTAS CENTRALIZADO, CLIMA, ALARMA, FRENOS ABS",
        "accepts_mercadopago" =>true,
        "pictures" => array(
            array(
                "source" => "https://riverorenta.mx/seminuevos/images/galeria/inv_6486/"
            )/*,
            array(
                "source" => "https://upload.wikimedia.org/wikipedia/commons/a/ab/Teashades.gif"
            )*/
        )
    );
	
	// We call the post request to list a item
	echo '<pre>';
	print_r($meli->post('/items', $item, array('access_token' => $_SESSION['access_token'])));
	echo '</pre>';

} else {

	echo '<a href="' . $meli->getAuthUrl($redirectURI, Meli::$AUTH_URL['MLB']) . '">Login using MercadoLibre oAuth 2.0</a>';
}

