<?php
session_start();

if ($_POST['captcha_input'] === $_SESSION['captcha']) {
    echo $_SESSION['captcha'];
} else {
    echo $_SESSION['captcha'];
}
?>