<?php

session_start();
include('includes/tweet.php');

tweet::Like($_GET["tweet_id"]);

header("location:index.php");

?>
