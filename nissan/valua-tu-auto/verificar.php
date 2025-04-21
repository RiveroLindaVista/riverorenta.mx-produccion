<?php
session_start();

if ($_POST['captcha_input'] === $_SESSION['captcha']) {
    echo "CAPTCHA correcto. Bienvenido.";
} else {
    echo "CAPTCHA incorrecto. Intenta de nuevo.";
}
?>