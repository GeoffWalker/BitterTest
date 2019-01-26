<?php 
//insert a tweet into the database

session_start();
include('includes/connect.php');

//grab username and tweet text from form
$uname = $_SESSION["SESS_MEMBER_ID"];
$tweetText = $_POST["myTweet"];

$tweetInsert = "INSERT INTO tweets (tweet_text, user_id) VALUES (\"$tweetText\", \"$uname\");";
if ($tweetText != ""){
    if ($result = mysqli_query($con, $tweetInsert))
    {
        $msg = "Tweet Sent!";
        header("location:index.php?msg=$msg");
    }
    else{
        $msg = "Error sending tweet. Please try again!";
        header("location:index.php?msg=$msg");
    }
}
else{
    $msg = "No empty tweets allowed. Troll your friends, not us!";
    header("location:index.php?msg=$msg");
}
?>