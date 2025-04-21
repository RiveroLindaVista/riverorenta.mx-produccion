<?php
session_start();
$captcha_text = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6);
$_SESSION['captcha'] = $captcha_text;

// Crear imagen
$width = 120;
$height = 40;
$image = imagecreate($width, $height);
$bg_color = imagecolorallocate($image, 255, 255, 255); // fondo blanco
$text_color = imagecolorallocate($image, 0, 0, 0);     // texto negro
$line_color = imagecolorallocate($image, 100, 100, 100); // color de líneas de ruido

// Añadir líneas aleatorias como ruido
for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand()%50, 120, rand()%50, $line_color);
}

// Dibujar texto
imagestring($image, 5, 25, 10, $captcha_text, $text_color);

// Mostrar imagen como PNG
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>