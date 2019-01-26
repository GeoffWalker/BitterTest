<?php

$url = "http://localhost/CodeAlongs/Chap20_TempWS.php";
$format = "xml";

$url = $url . "?format=$format&temp=30";

// cURL is a versatile set of libraries that allow php to send/recieve data
// via HTTPS. Amazon (AWS) uses RESTful webservices.

$cobj = curl_init();
curl_setopt($cobj, CURLOPT_URL, $url);
curl_setopt($cobj, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($cobj);
curl_close($cobj);

if ($format == "json"){
    $object = json_decode($data);
    echo $object->temp . "<br>"; //dereferencing the associative array.
}
else{
    $xmlObject = simplexml_load_string($data);
    echo $xmlObject->temp;
}

?>
