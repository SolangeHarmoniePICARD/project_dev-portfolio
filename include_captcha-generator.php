<?php 

session_start();

$text = rand(10000,99999);
$_SESSION["submit_captcha-checker"] = $text;

$height = 32; 
$width = 72;   

$image = imagecreate($width, $height);


$black = imagecolorallocate($image, 0, 0, 0); 
$white = imagecolorallocate($image, 255, 255, 255); 
$font_size = 16;


imagestring($image, $font_size, 12, 8, $text, $white);

imagejpeg($image, null, 80); 

//EOF