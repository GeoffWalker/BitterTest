<?php
//insert a tweet into the database

session_start();
include('includes/tweet.php');

tweet::reply($_GET["tweet_id"], $_POST["myReply"]);

header("location:index.php");

?>
