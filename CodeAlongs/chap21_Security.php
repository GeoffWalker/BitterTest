<?php

//chap 21 - securing a website

$message = "Hello World!";
echo md5($message) . "<br>";

//iv means initialization vector
$iv = mcrypt_create_iv(8, MCRYPT_RAND);
$key = "secretKey";

//cipher, key, data, mode, iv
$encMessage = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $message, MCRYPT_MODE_CBC, $iv);

echo bin2hex($encMessage) . "<br>";

echo mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $encMessage, MCRYPT_MODE_CBC, $iv);
?>