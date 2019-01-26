<?php

$url = "http://api.openweathermap.org/data/2.5/weather?q=Fredericton&units=metric&APPID=45bfb762ed60106a45fd68fdcc0848fa";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($client);
$http_code = curl_getinfo($client, CURLINFO_HTTP_CODE);

curl_close($client);
echo "http code: " . $http_code . "<br><br>";
echo $data . "<br><br><br>";

$myArray = json_decode($data, true); //true means use associative array.

print_r($myArray);
echo "<br><br>";

echo "Longitude: " . $myArray["coord"]["lon"] . "\tLatitude: " . $myArray["coord"]["lat"] . "<br><br>";

echo "Weather is: " . $myArray["weather"][0]["main"] . "<br>Temperature is: " . $myArray["main"]["temp"] . "<br>Wind speed is: " . $myArray["wind"]["speed"] . "<br><br>";

foreach ($myArray as $x){
    echo print_r($x) . "<br>";
}

?>

