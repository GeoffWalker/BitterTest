<?php

session_start();
include('includes/Tweet.php');

Tweet::Like($_GET["tweet_id"]);

header("location:index.php");

?>
