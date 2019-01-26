<?php 
session_start();
include('includes/User.php');
include('includes/Functions.php');

//grab username and email from form
$username = $_POST["username"];
$email = $_POST["email"];

//check that username and password aren't already in database.
$sql = 'SELECT screen_name FROM users WHERE screen_name = "' . $username . '";';
$result = mysqli_query($GLOBALS["con"], $sql);
$sql2 = 'SELECT screen_name FROM users WHERE screen_name = "' . $email . '";';
$result2 = mysqli_query($GLOBALS["con"], $sql);

if(mysqli_num_rows($result) > 0){
    $msg = "Screen name already taken!";
    header("location:signup.php?msg=$msg");
}
else if (mysqli_num_rows($result2) > 0){
    $msg = "That email is already taken!";
    header("location:signup.php?msg=$msg");
}
else
{    
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $uname = $_POST["username"];
    $pword = $_POST["password"];
    $pword = password_hash($pword, PASSWORD_DEFAULT);
    $pword_conf = $_POST["confirm"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $postal = $_POST["postalCode"];
    $url = $_POST["url"];
    $description = $_POST["desc"];
    $location = $_POST["location"];
    
    if (verifyPostal($postal, $province)){
       User::createNewUser($fname, $lname, $uname, $pword, $address, $province, $postal, $phone, $email, $url, $description, $location); 
    }
    else{
        $msg = "Your postal code does not match your province.";
        header("location:signup.php?msg=$msg");
    }
    
}




?>