<?php

if ($_POST['captcha_input'] === $_POST['desca']) {
    echo $_POST['captcha_input'];
} else {
    echo $_POST['desca'].' _ '.$_POST['captcha_input'];
}
?>