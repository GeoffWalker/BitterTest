<?php

session_start();
session_destroy();
$msg = "You logged out. No more trolling for you!";
header("location:login.php?msg=$msg");

?>
