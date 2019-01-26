<?php

/**
 * Description of User
 *
 * @author Geoff Walker
 */

include('includes/tweet.php');

class user {

    private $userId;
    private $userName;
    private $password;
    private $firstName;
    private $lastName;
    private $address;
    private $province;
    private $postalCode;
    private $contactNo;
    private $email;
    private $dateAdded;
    private $profImage;
    private $location;
    private $description;
    private $url;

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    function __construct($userId, $userName, $password, $firstName, $lastName, $address, $province, $postalCode, $contactNo, $email, $dateAdded, $profImage, $location, $description, $url) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->province = $province;
        $this->postalCode = $postalCode;
        $this->contactNo = $contactNo;
        $this->email = $email;
        $this->dateAdded = $dateAdded;
        $this->profImage = $profImage;
        $this->location = $location;
        $this->description = $description;
        $this->url = $url;
    }

    function __destruct(){
    }

    static function createNewUser($fname, $lname, $uname, $pword, $address, $province, $postal, $phone, $email, $url, $description, $location){

        $newUserSQL = "insert into users (first_name, last_name, screen_name, password, address, province, postal_code, contact_number, email, url, description, location) values (\"$fname\", \"$lname\", \"$uname\", \"$pword\", \"$address\", \"$province\", \"$postal\", \"$phone\", \"$email\", \"$url\", \"$description\", \"$location\");";

        if ($result = mysqli_query($GLOBALS["con"], $newUserSQL))
        {
            $msg = "Signup Complete!";
            header("location:login.php?msg=$msg");
        }
    }

    function userLogin($username, $pword){

        $sql = 'SELECT first_name, last_name, user_id, password from users WHERE screen_name = "' . $username . '";';

        $Users = mysqli_query($GLOBALS["con"], $sql);
        $row = mysqli_fetch_array($Users);

        if(mysqli_num_rows($Users) == 1 && password_verify($pword, $row["password"])){
            $_SESSION["SESS_FIRST_NAME"] = $row["first_name"];
            $_SESSION["SESS_LAST_NAME"] = $row["last_name"];
            $_SESSION["SESS_MEMBER_ID"] = $row["user_id"];
            header("Location:index.php");
        }
        else{
            $msg = "Login failed. Please try again.";
            header("location:login.php?msg=$msg");
        }
    }

    function getUserObject($userId){
        $objectSQL = 'SELECT * FROM users WHERE user_id = "' . $userId . '";';
        $userResult = mysqli_query($GLOBALS["con"], $objectSQL);

        $row = mysqli_fetch_array($userResult);
        $currentUser = new User($row["user_id"], $row["screen_name"], $row["password"], $row["first_name"], $row["last_name"], $row["address"], $row["province"], $row["postal_code"], $row["contact_number"], $row["email"], $row["date_created"], $row["profile_pic"], $row["location"], $row["description"], $row["url"]);

        return $currentUser;
    }

    static function updateProfPic($userId){
        if (empty($_FILES['pic']['name'])){
            echo '<script>alert("error, please select an image to upload.");</script>';
        }
        else{ //by default, 1mb is max file size.
            if ($_FILES['pic']['size'] > 1024*1024){
                $msg = "error, file must be 1MB or smaller.";
                header("location:edit_photo.php?msg=$msg");
                unlink($_FILES['pic']['temp_name']);
            }
            else{
                $picName = $userId . "." . pathinfo($_FILES['pic']['name'],PATHINFO_EXTENSION); //taken from stack overflow.
                if(!move_uploaded_file($_FILES['pic']['tmp_name'], "images/profilepics/" . $picName)){
                    $msg = "ERROR: handling uploaded file.";
                    header("location:edit_photo.php?msg=$msg");
                    unlink($_FILES['pic']['temp_name']);
                }
                else{
                    //file upload worked.
                    // update the profile_pic field in the users table of the DB.
                    $sqlUpdate1 = "UPDATE users SET profile_pic = '' WHERE user_id = '" . $userId . "';";
                    $sqlUpdate2 = "UPDATE users SET profile_pic = '" . $picName . "' WHERE user_id = '" . $userId . "';";
                    mysqli_query($GLOBALS["con"], $sqlUpdate1);
                    $result = mysqli_query($GLOBALS["con"], $sqlUpdate2);
                    if(mysqli_affected_rows($GLOBALS["con"]) > 0){
                        $msg = "Image Upload Complete!";
                        header("location:index.php?msg=$msg");
                    }
                    else{
                        $msg = "Error uploading image, try again.";
                        header("location:edit_photo.php?msg=$msg");
                    }
                }
            }
        }
    }

    static function getProfPic($id){
        $profSQL = "SELECT profile_pic FROM users WHERE user_id = '" . $id . "' AND profile_pic IS NOT NULL;";
        $result = mysqli_query($GLOBALS["con"], $profSQL);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            echo '<img class="bannericons" src="images/profilepics/' . $row["profile_pic"] . '" title style>';
        }
        else{
            echo '<img class="bannericons" src="images/profilepics/default.jfif" title style>';
        }
    }

    static function getFollowerCount($id){
        $followersSQL = 'SELECT COUNT(follow_id) as followersCount FROM follows WHERE from_id =' . $id . ';';
        $result = mysqli_query($GLOBALS["con"], $followersSQL);
        $row = mysqli_fetch_array($result);
        return $row["followersCount"];
    }

    static function getFollowCount($id){
        $followSQL = 'SELECT COUNT(follow_id) as followCount FROM follows WHERE to_id =' . $id . ';';
        $result = mysqli_query($GLOBALS["con"], $followSQL);
        $row = mysqli_fetch_array($result);
        return $row["followCount"];
    }

    static function getTweetCount($id){
        $followersSQL = 'SELECT COUNT(tweet_id) as tweetCount FROM tweets WHERE user_id =' . $id . ';';
        $result = mysqli_query($GLOBALS["con"], $followersSQL);
        $row = mysqli_fetch_array($result);
        return $row["tweetCount"];
    }

    static function followersYouKnowCount($id){
        $followersSQL = 'SELECT COUNT(user_id) as count FROM users WHERE user_id IN (SELECT to_id FROM follows WHERE from_id = "' . $_SESSION["SESS_MEMBER_ID"] . '") AND user_id IN (SELECT to_id FROM follows WHERE from_id = "' . $id . '")';
        $result = mysqli_query($GLOBALS["con"], $followersSQL);
        $row = mysqli_fetch_array($result);
        return $row["count"];
    }

    static function followersYouKnow($id){
    $followersSQL = 'SELECT user_id, first_name, last_name, screen_name, profile_pic FROM users WHERE user_id IN (SELECT to_id FROM follows WHERE from_id = "' . $_SESSION["SESS_MEMBER_ID"] . '") AND user_id IN (SELECT to_id FROM follows WHERE from_id = "' . $id . '") ORDER BY RAND() LIMIT 3;';
    $users = mysqli_query($GLOBALS["con"], $followersSQL);

    while ($row = mysqli_fetch_array($users)){

        $info = $row["first_name"] . " " . $row["last_name"] . " @" . $row["screen_name"];
        $info = substr($info, 0, 20);
        echo    '<div class="bold">';
            if($row["profile_pic"] != null){
                echo '<img class="bannericons" src="images/profilepics/' . $row["profile_pic"] . '" title style>';
            }
            else{
                echo '<img class="bannericons" src="images/profilepics/default.jfif" title style>';
            }
        echo '<a href="userpage.php?user_id=' . $row["user_id"] . '">' . $info . '</a></div><hr>';
    };
}

    static function getProvince($id){
        $provinceSQL = 'SELECT province FROM users WHERE user_id =' . $id . ';';
        $result = mysqli_query($GLOBALS["con"], $provinceSQL);
        $row = mysqli_fetch_array($result);
        $prov = null;

        if ($row["province"] == "BC" || $row["province"] == "British Columbia"){
            $prov = "British Columbia";
        }
        else if($row["province"] == "AB" || $row["province"] == "Alberta"){
            $prov = "Alberta";
        }
        else if($row["province"] == "SK" || $row["province"] == "Saskatchewan"){
            $prov = "Saskatchewan";
        }
        else if($row["province"] == "MB" || $row["province"] == "Manitoba"){
            $prov = "Manitoba";
        }
        else if($row["province"] == "ON" || $row["province"] == "Ontario"){
            $prov = "Ontario";
        }
        else if($row["province"] == "QC" || $row["province"] == "Quebec"){
            $prov = "Quebec";
        }
        else if($row["province"] == "NB" || $row["province"] == "New Brunswick"){
            $prov = "New Brunswick";
        }
        else if($row["province"] == "PE" || $row["province"] == "Prince Edward Island"){
            $prov = "Prince Edward Island";
        }
        else if($row["province"] == "NS" || $row["province"] == "Nova Scotia"){
            $prov = "Nova Scotia";
        }
        else if($row["province"] == "NL" || $row["province"] == "Newfoundland and Labrador"){
            $prov = "Newfoundland and Labrador";
        }
        else if($row["province"] == "NT" || $row["province"] == "Northwest Territories"){
            $prov = "Northwest Territories";
        }
        else if($row["province"] == "NU" || $row["province"] == "Nunavut"){
            $prov = "Nunavut";
        }
        else{
             $prov = "Yukon";
        }
        return $prov;
    }

    static function getUserInfo($id){
        $userSQL = 'SELECT first_name, last_name, date_created, screen_name, profile_pic FROM users WHERE user_id = "' . $id . '";';
        $result = mysqli_query($GLOBALS["con"], $userSQL);
        $row = mysqli_fetch_array($result);
        return $row;
    }

    static function getUserIdFromTweetId($tweetId){
        $userFromTweetSQL = 'SELECT user_id FROM tweets WHERE tweet_id = "' .$tweetId. '";';
        $result = mysqli_query($GLOBALS["con"], $userFromTweetSQL);
        $row = mysqli_fetch_array($result);
        return $row["user_id"];
    }

    static function SearchUser($search){
        $search = mysqli_real_escape_string($GLOBALS["con"], $search);

        $searchSQL = 'SELECT * FROM users WHERE (first_name LIKE "%'.$search.'%") OR (last_name LIKE "%'.$search.'%") OR (screen_name LIKE "%'.$search.'%")';
        $userResult = mysqli_query($GLOBALS["con"], $searchSQL);

        while($row = mysqli_fetch_array($userResult)){
            $currentUser = new User($row["user_id"], $row["screen_name"], $row["password"], $row["first_name"], $row["last_name"], $row["address"], $row["province"], $row["postal_code"], $row["contact_number"], $row["email"], $row["date_created"], $row["profile_pic"], $row["location"], $row["description"], $row["url"]);

            echo '<a href="userpage.php?user_id=' . $currentUser->userId . '">' . $currentUser->firstName . ' ' . $currentUser->lastName . ' @' . $currentUser->userName . '</a>';

            $followSQL = "SELECT * from follows WHERE from_id = '" . $currentUser->userId . "';";
            $followResult = mysqli_query($GLOBALS["con"], $followSQL);
            while($row = mysqli_fetch_array($followResult)){
                if($row["to_id"] == $_SESSION["SESS_MEMBER_ID"]){
                    echo " | Follows You";
                }
            }

            $followingSQL = "SELECT * from follows WHERE to_id = '" . $currentUser->userId . "' AND from_id = '" . $_SESSION["SESS_MEMBER_ID"] . "';";

            $followingResult = mysqli_query($GLOBALS["con"], $followingSQL);

                if(mysqli_num_rows($followingResult)>0){
                    echo " | Following ";
                }
                else{
                    echo '&nbsp;<a href = "Follow_proc.php?user_id=' . $currentUser->userId . '"><input type="button" style = "margin: 0" name="Follow" id="button" value="Follow"/></a>';
                }

            echo "<hr width=\"100%\">";
        }
    }

    static function GetAllMessages(){
        $con = $GLOBALS['con'];
        $sql = "SELECT m.*, u.first_name, u.last_name, u.screen_name FROM messages m INNER JOIN users u ON m.from_id=u.user_id WHERE m.to_id = '" . $_SESSION['SESS_MEMBER_ID'] . "' ORDER BY date_sent desc";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div><a href="userpage.php?user_id='. $row["from_id"] . '">' . $row["first_name"] . " " . $row["last_name"] . '</a> sent you a message!<br>';
                echo '<br>"' . $row["message_text"] . '"<br></div><hr>';
            }
        }
    }

}
