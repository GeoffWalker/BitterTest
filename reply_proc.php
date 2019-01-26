<?php 
//insert a tweet into the database

session_start();
include('includes/Tweet.php');

Tweet::reply($_GET["tweet_id"], $_POST["myReply"]);

header("location:index.php");

?>