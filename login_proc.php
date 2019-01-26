<?php 
session_start();
include("includes/User.php");

User::userLogin($_POST["username"], $_POST["password"]);

?>