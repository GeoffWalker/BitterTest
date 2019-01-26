<?php

$valid = checkdate(2,24,2020);
if ($valid){
    echo "valid date<BR>";
}
else{
    echo "invalid date<BR>";
}

//set the timezone to atlantic
date_default_timezone_set("America/Halifax");
//set the locale to english canada
setlocale(LC_ALL, "en-CA");

echo "the time is " . date("h:i:sa") . "<BR>";
echo "the date is " . date("F d, Y") . "<BR>";

$dateArray = getDate();
print_r($dateArray);

echo "<BR>" . strftime("%A %B %d, %Y") . "<BR>";

//last modified
echo "Page last modified on " . date("F d, Y h:i:sa", getlastmod()) . "<BR>";

//net in php 5.1 and higher
$dateTweeted = "2018-1-01"; //hardcoded for now. query the real one from DB
$tweetTime = new DateTime($dateTweeted);
$now = new DateTime(); //defaults to the current timestamp
$interval = $tweetTime->diff($now);
echo "time since tweet " . $interval->format("%y %m %d %h %i %s") . "<BR>";

if($interval->y > 1) echo $interval->format("%y years ago");
else if ($interval->y > 0) echo $interval->format("%y year ago");
else if ($interval->m > 1) echo $interval->format("%m months ago");
else if ($interval->m > 0) echo $interval->format("%m month ago");
else if ($interval->d > 1) echo $interval->format("%d days ago");
else if ($interval->d > 0) echo $interval->format("%d day ago");
else if ($interval->h > 1) echo $interval->format("%h hours ago");
else if ($interval->h > 0) echo $interval->format("%h hour ago");
else if ($interval->i > 1) echo $interval->format("%i minutes ago");
else if ($interval->i > 0) echo $interval->format("%i minute ago");
else if ($interval->s > 1) echo $interval->format("%s seconds ago");
else if ($interval->s >= 0) echo $interval->format("%s second ago");

?>
