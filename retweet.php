<?php
    session_start();
    include('includes/tweet.php');

    $getTweetSQL = 'SELECT * FROM tweets WHERE tweet_id = "' .$_GET["tweet_id"]. '";';
    $result = mysqli_query($GLOBALS["con"], $getTweetSQL);
    $row = mysqli_fetch_array($result);

    $myRetweet = new tweet($row["tweet_id"], $row["tweet_text"], $row["user_id"], $row["original_tweet_id"], $row["reply_to_tweet_id"], $row["date_created"]);

    if($myRetweet->retweet() == true){
        $msg = "Retweeted, great trolling!";
        header("location:index.php?msg=$msg");
    }
    else{
        $msg = "Error retweeting, try again.";
        header("location:index.php?msg=$msg");
    }

?>
