<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tweet
 *
 * @author Geoff Walker
 */

include('includes/connect.php');


class tweet {

    private $tweetId;
    private $tweetText;
    private $userId;
    private $originalTweetId;
    private $replyToTweetId;
    private $dateAdded;

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    function __construct($tweetId, $tweetText, $userId, $originalTweetId, $replyToTweetId, $dateAdded) {
        $this->tweetId = $tweetId;
        $this->tweetText = $tweetText;
        $this->userId = $userId;
        $this->originalTweetId = $originalTweetId;
        $this->replyToTweetId = $replyToTweetId;
        $this->dateAdded = $dateAdded;
    }

    function __destruct(){
        echo "<BR>Object destroyed<BR>";
    }

    static function getTweets(){
        $tweetSQL = 'SELECT t.tweet_id as tweet_id, t.user_id as userid, t.tweet_text as tweet_text, t.original_tweet_id as originalId, t.reply_to_tweet_id as replyId, t.date_created as tweetDate, u.first_name as fname, u.last_name as lname, u.screen_name as sname FROM tweets t INNER JOIN users u ON t.user_id=u.user_id WHERE t.user_id IN (SELECT to_id FROM follows WHERE from_id = "' . $_SESSION["SESS_MEMBER_ID"] . '") OR t.user_id = "' . $_SESSION["SESS_MEMBER_ID"] . '" ORDER BY t.date_created DESC;';
        $tweets = mysqli_query($GLOBALS["con"], $tweetSQL);

        while ($tweet = mysqli_fetch_array($tweets)){
            if($tweet["replyId"] == 0){//make sure replies aren't displayed yet.
                echo '<div>' . '<a href="userpage.php?user_id='. $tweet["userid"] . '">' . $tweet["fname"] . ' ' . $tweet["lname"] . ' @' . $tweet["sname"] . '</a> ' . timePassed($tweet["tweetDate"]);
                // if statement checks if the tweet is a retweet, and appends retweet info if it is.
                if ($tweet["originalId"] <> 0){ echo "<b> retweeted from " . User::getUserInfo(User::getUserIdFromTweetId($tweet["originalId"]))["first_name"] . " " . User::getUserInfo(User::getUserIdFromTweetId($tweet["originalId"]))["last_name"] . "</b>";}
                echo '<br>' . $tweet["tweet_text"] .'</div>';
                if(!Tweet::IsLiked($tweet["tweet_id"])){echo '<a href="Like_proc.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/like.ico"></a>';}
                echo '<a href="retweet.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/retweet.png"></a><a href="reply.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/reply.png"></a>';
            }
            //display replies
            Tweet::getReplies($tweet["tweet_id"]);

            if($tweet["replyId"] == 0){
                echo "<hr>";
            }
        };
    }

    static function getLikedTweets(){
        $tweetSQL = 'SELECT t.tweet_id as tweet_id, t.user_id as userid, t.tweet_text as tweet_text, t.original_tweet_id as originalId, t.reply_to_tweet_id as replyId, t.date_created as tweetDate, u.first_name as fname, u.last_name as lname, u.screen_name as sname, l.user_id as likedUser, l.date_created as likedDate FROM users u INNER JOIN tweets t ON u.user_id=t.user_id INNER JOIN likes l ON t.tweet_id = l.tweet_id WHERE t.user_id = "' . $_SESSION["SESS_MEMBER_ID"] . '" AND t.tweet_id IN (SELECT tweet_id FROM likes) ORDER BY t.date_created DESC;';
        $tweets = mysqli_query($GLOBALS["con"], $tweetSQL);
        echo "<h2>Likes</h2>";
        while ($tweet = mysqli_fetch_array($tweets)){
            $likedUserInfo = User::getUserInfo($tweet["likedUser"]);
            echo '<div>' . '<a href="userpage.php?user_id='. $tweet["likedUser"] . '">';
            if($likedUserInfo["profile_pic"] != null){
                echo '<img class="bannericons" src="images/profilepics/' . $likedUserInfo["profile_pic"] . '" title style>';
            }
            else{
                echo '<img class="bannericons" src="images/profilepics/default.jfif" title style>';
            }
            echo "&nbsp;" . $likedUserInfo["first_name"] . ' ' . $likedUserInfo["last_name"] . '</a> liked your tweet ' . timePassed($tweet["likedDate"]);
            echo '<br><br>' . $tweet["tweet_text"] .'</div><hr/>';
        }
    }

    static function getReplies($tweetId){
        $replySQL = 'SELECT t.tweet_id as tweet_id, t.user_id as userid, t.tweet_text as tweet_text, t.original_tweet_id as originalId, t.reply_to_tweet_id as replyId, t.date_created as tweetDate, u.first_name as fname, u.last_name as lname, u.screen_name as sname FROM tweets t INNER JOIN users u ON t.user_id=u.user_id WHERE t.reply_to_tweet_id = "' . $tweetId . '" ORDER BY t.date_created DESC;';
        $replies = mysqli_query($GLOBALS["con"], $replySQL);

            while ($tweet1 = mysqli_fetch_array($replies)){
                    echo '<div style="padding:1px 1px 1px 3em;"><div style="border-radius: 15px; padding: 5px; background-color: #bfbfbf;">' . '<a href="userpage.php?user_id='. $tweet1["userid"] . '">' . $tweet1["fname"] . ' ' . $tweet1["lname"] . ' @' . $tweet1["sname"] . '</a> ' . "<b> Replied </b>" .timePassed($tweet1["tweetDate"]);
                    if ($tweet1["originalId"] <> 0){ echo "<b> retweeted from " . User::getUserInfo(User::getUserIdFromTweetId($tweet1["originalId"]))["first_name"] . " " . User::getUserInfo(User::getUserIdFromTweetId($tweet1["originalId"]))["last_name"] . "</b>";}
                    echo '<br>' . $tweet1["tweet_text"] . '<br>';
                    if(!Tweet::IsLiked($tweetId)){echo '<a href="Like_proc.php?tweet_id=' .$tweetId. '">&nbsp;<input type="image" style="height: 30px" src="images/like.ico">';}
                    echo '</a><a href="retweet.php?tweet_id=' .$tweet1["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px; padding: 2px" src="images/retweet.png"></a></div></div>';
            }
    }

    static function tweetsByUser($userId){
        $tweetSQL = 'SELECT t.tweet_id as tweet_id, t.user_id as userid, t.tweet_text as tweet_text, t.original_tweet_id as originalId, t.reply_to_tweet_id as replyId, t.date_created as tweetDate, u.first_name as fname, u.last_name as lname, u.screen_name as sname FROM tweets t INNER JOIN users u ON t.user_id=u.user_id WHERE t.user_id =' .$userId. ' ORDER BY t.date_created DESC;';
        $tweets = mysqli_query($GLOBALS["con"], $tweetSQL);

        while ($tweet = mysqli_fetch_array($tweets)){
            if($tweet["replyId"] == 0){//make sure replies aren't displayed yet.
                echo '<div>' . '<a href="userpage.php?user_id='. $tweet["userid"] . '">' . $tweet["fname"] . ' ' . $tweet["lname"] . ' @' . $tweet["sname"] . '</a> ' . timePassed($tweet["tweetDate"]);
                // if statement checks if the tweet is a retweet, and appends retweet info if it is.
                if ($tweet["originalId"] <> 0){ echo "<b> retweeted from " . User::getUserInfo(User::getUserIdFromTweetId($tweet["originalId"]))["first_name"] . " " . User::getUserInfo(User::getUserIdFromTweetId($tweet["originalId"]))["last_name"] . "</b>";}
                echo '<br>' . $tweet["tweet_text"] .'</div>';
            if(!Tweet::IsLiked($tweet["tweet_id"])){echo '<a href="Like_proc.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/like.ico"></a>';}
            echo '<a href="retweet.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/retweet.png"></a><a href="reply.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/reply.png"></a>';
            }
            //display replies
            Tweet::getReplies($tweet["tweet_id"]);

            if($tweet["replyId"] == 0){
                echo "<hr>";
            }
        };
    }

    function retweet(){
        $retweetSQL = "INSERT INTO tweets (tweet_text, user_id, original_tweet_id, reply_to_tweet_id) VALUES ('".$this->tweetText."', '".$_SESSION["SESS_MEMBER_ID"]."', '".$this->tweetId."', '0');";

        mysqli_query($GLOBALS["con"], $retweetSQL);

        if(mysqli_affected_rows($GLOBALS["con"]) != 1){
            return false;
        }
        else{
            return true;
        }

    }

    static function reply($replytweetId, $replyText){

        //create tweet and get info.
        $replyTweet = Tweet::TweetInfo($replytweetId);

        $replySQL = "INSERT INTO tweets (tweet_text, user_id, original_tweet_id, reply_to_tweet_id) VALUES ('".$replyText."', '".$_SESSION["SESS_MEMBER_ID"]."', '".$replyTweet->originalTweetId."', '".$replyTweet->tweetId."');";

        mysqli_query($GLOBALS["con"], $replySQL);

        if(mysqli_affected_rows($GLOBALS["con"]) != 1){
            return false;
        }
        else{
            return true;
        }
    }

    static function Like($tweetId){
        $likeSQL = "INSERT INTO likes (tweet_id, user_id) VALUES ('" . $tweetId . "', '" . $_SESSION["SESS_MEMBER_ID"] . "');";

        mysqli_query($GLOBALS["con"], $likeSQL);

        if(mysqli_affected_rows($GLOBALS["con"]) != 1){
            return false;
        }
        else{
            return true;
        }
    }

    static function IsLiked($tweetId){
        $isLikedSQL = "SELECT tweet_id FROM likes WHERE user_id = '" . $_SESSION["SESS_MEMBER_ID"] . "';";
        $likedResult = mysqli_query($GLOBALS["con"], $isLikedSQL);
        $isLiked = false;
        while ($likedRow = mysqli_fetch_array($likedResult)){
            if($likedRow["tweet_id"] == $tweetId){
                $isLiked = true;
            }
        }
        return $isLiked;
    }

    static function TweetInfo($tweetId){
        $tweetSQL = "SELECT * FROM tweets WHERE tweet_id = '" .$tweetId. "';";
        $result = mysqli_query($GLOBALS["con"], $tweetSQL);
        $row = mysqli_fetch_array($result);
        $returnTweet = new Tweet($row["tweet_id"], $row["tweet_text"], $row["user_id"], $row["original_tweet_id"], $row["reply_to_tweet_id"], $row["date_created"]);
        return $returnTweet;
    }

    static function SearchTweets($search){
        $search = mysqli_real_escape_string($GLOBALS["con"], $search);

        $searchSQL = "SELECT t.tweet_id as tweet_id, t.user_id as userid, t.tweet_text as tweet_text, t.original_tweet_id as originalId, t.reply_to_tweet_id as replyId, t.date_created as tweetDate, u.first_name as fname, u.last_name as lname, u.screen_name as sname FROM tweets t INNER JOIN users u ON t.user_id=u.user_id WHERE tweet_text LIKE '%" .$search . "%';";
        $tweets = mysqli_query($GLOBALS["con"], $searchSQL);

        while ($tweet = mysqli_fetch_array($tweets)){
            if($tweet["replyId"] == 0){//make sure replies aren't displayed yet.
                echo '<div>' . '<a href="userpage.php?user_id='. $tweet["userid"] . '">' . $tweet["fname"] . ' ' . $tweet["lname"] . ' @' . $tweet["sname"] . '</a> ' . timePassed($tweet["tweetDate"]);
                // if statement checks if the tweet is a retweet, and appends retweet info if it is.
                if ($tweet["originalId"] <> 0){ echo "<b> retweeted from " . User::getUserInfo(User::getUserIdFromTweetId($tweet["originalId"]))["first_name"] . " " . User::getUserInfo(User::getUserIdFromTweetId($tweet["originalId"]))["last_name"] . "</b>";}
                echo '<br>' . $tweet["tweet_text"] .'</div>';
                echo '<input type="image" style="height: 30px" src="images/like.ico"><a href="retweet.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/retweet.png"></a><a href="reply.php?tweet_id=' .$tweet["tweet_id"]. '">&nbsp;<input type="image" style="height: 30px" src="images/reply.png"></a>';
                echo "<hr width=\"100%\"><br>";

            }
        };
    }

    static function getRetweeted(){
        $sql = "SELECT tweet_text, user_id, date_created FROM tweets WHERE original_tweet_id IN (SELECT tweet_id FROM tweets WHERE user_id = '" . $_SESSION['SESS_MEMBER_ID'] . "') ORDER BY date_created DESC;";
        $tweets = mysqli_query($GLOBALS["con"], $sql);
        echo "<h2>Retweets</h2>";
        while ($tweet = mysqli_fetch_array($tweets)){
            $likedUserInfo = User::getUserInfo($tweet["user_id"]);
            echo '<div>' . '<a href="userpage.php?user_id='. $tweet["user_id"] . '">';
            if($likedUserInfo["profile_pic"] != null){
                echo '<img class="bannericons" src="images/profilepics/' . $likedUserInfo["profile_pic"] . '" title style>';
            }
            else{
                echo '<img class="bannericons" src="images/profilepics/default.jfif" title style>';
            }
            echo "&nbsp;" . $likedUserInfo["first_name"] . ' ' . $likedUserInfo["last_name"] . '</a> retweeted your tweet ' . timePassed($tweet["date_created"]);
            echo '<br><br>' . $tweet["tweet_text"] .'</div><hr/>';
        }
    }

    static function getReplied(){
        $sql = "SELECT tweet_text, user_id, date_created FROM tweets WHERE reply_to_tweet_id IN (SELECT tweet_id FROM tweets WHERE user_id = '" . $_SESSION['SESS_MEMBER_ID'] . "') ORDER BY date_created DESC;";
        $tweets = mysqli_query($GLOBALS["con"], $sql);
        echo "<h2>Replies</h2>";
        while ($tweet = mysqli_fetch_array($tweets)){
            $likedUserInfo = User::getUserInfo($tweet["user_id"]);
            echo '<div>' . '<a href="userpage.php?user_id='. $tweet["user_id"] . '">';
            if($likedUserInfo["profile_pic"] != null){
                echo '<img class="bannericons" src="images/profilepics/' . $likedUserInfo["profile_pic"] . '" title style>';
            }
            else{
                echo '<img class="bannericons" src="images/profilepics/default.jfif" title style>';
            }
            echo "&nbsp;" . $likedUserInfo["first_name"] . ' ' . $likedUserInfo["last_name"] . '</a> replied to your tweet ' . timePassed($tweet["date_created"]);
            echo '<br><br> They said "' . $tweet["tweet_text"] .'"</div><hr/>';
        }
    }
}
