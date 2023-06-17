<?php 
     include('../dropship-project/backend/agentLogin.php');


$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$captcha_length = 5; // Length of the captcha string

// Generate a random captcha string
$rand_num = '';
for ($i = 0; $i < $captcha_length; $i++) {
    $rand_num .= $characters[rand(0, strlen($characters) - 1)];
}

$_SESSION['CODE'] = $rand_num;


// Set the image width and height
$image_width = 250;
$image_height = 50;

// Create the CAPTCHA image
$layer = imagecreate($image_width, $image_height);

// Define the colors
$background_color = imagecolorallocate($layer, 190, 47, 47);
$text_color = imagecolorallocate($layer, 255, 255, 255);

// Fill the image with the background color
imagefill($layer, 0, 0, $background_color);

// Add the captcha text to the image
imagettftext($layer, 20, 10, 85, 40, $text_color, "../dropship-project/font/Lato-BoldItalic.ttf", $rand_num);

// Set the content type header
header('Content-Type: image/jpeg');

// Output the image as JPEG
imagejpeg($layer);

// Destroy the image resource
imagedestroy($layer);

?>