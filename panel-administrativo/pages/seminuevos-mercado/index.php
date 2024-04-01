<?php
session_start();
require 'configApp.php';
//require 'Classes/clases.php';
class Consulta {
    const VERSION  = "2.0.0";
    protected static $API_ROOT_URL = "https://api.mercadolibre.com";
    protected static $OAUTH_URL    = "/oauth/token";
    public static $AUTH_URL = array("MLM" => "https://auth.mercadolibre.com.mx");
    public static $CURL_OPTS = array(
        CURLOPT_USERAGENT => "MELI-PHP-SDK-2.0.0", 
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_CONNECTTIMEOUT => 10, 
        CURLOPT_RETURNTRANSFER => 1, 
        CURLOPT_TIMEOUT => 60
    );

    protected $client_id;
    protected $client_secret;
    protected $redirect_uri;
    protected $access_token;
    protected $refresh_token;

public function getAuthUrl($redirect_uri, $auth_url) {
        $this->redirect_uri = $redirect_uri;
        $params = array("client_id" => $this->client_id, "response_type" => "code", "redirect_uri" => $redirect_uri);
        $auth_uri = $auth_url."/authorization?".http_build_query($params);
        return $auth_uri;
    }
}


$domain = $_SERVER['HTTP_HOST'];
$appName = explode('.', $domain)[0];

//https://api.mercadolibre.com/categories/MLM6071
//https://api.mercadolibre.com/categories/MLM6071#json
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
   <div class="container">
   	<div class="row">
                <div class="col-sm-6 col-md-6">
                    <?php
                    //REVISAMOS SI ESTA CREADA LA SESION
                    $getConsulta = new Consulta($appId, $secretKey);

                    if($_GET['code'] || $_SESSION['access_token']) {
                        // If code exist and session is empty
                        if($_GET['code'] && !($_SESSION['access_token'])) {
                            // If the code was in get parameter we authorize
                            $user = $meli->authorize($_GET['code'], $redirectURI);
                            // Now we create the sessions with the authenticated user
                            $_SESSION['access_token'] = $user['body']->access_token;
                            $_SESSION['expires_in'] = time() + $user['body']->expires_in;
                            $_SESSION['refresh_token'] = $user['body']->refresh_token;
                        } else {
                            // We can check if the access token in invalid checking the time
                            if($_SESSION['expires_in'] < time()) {
                                try {
                                    // Make the refresh proccess
                                    $refresh = $meli->refreshAccessToken();
                                    // Now we create the sessions with the new parameters
                                    $_SESSION['access_token'] = $refresh['body']->access_token;
                                    $_SESSION['expires_in'] = time() + $refresh['body']->expires_in;
                                    $_SESSION['refresh_token'] = $refresh['body']->refresh_token;
                                } catch (Exception $e) {
                                    echo "Exception: ",  $e->getMessage(), "\n";
                                }
                            }
                        }
                        echo '<pre style="font-size:8px;">';print_r($_SESSION);echo '</pre>';

                    } else {
                        $getConsulta->getAuthUrl($redirectURI, Consulta::$AUTH_URL[$siteId]);
                    }
                    ?>

                </div>	

   	</div>
   	
   </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>