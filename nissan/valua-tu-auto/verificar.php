<?php
session_start();

if ($_POST['captcha_input'] === $_SESSION['captcha']) {
    echo "1";
} else {
    echo "0";
}
?>