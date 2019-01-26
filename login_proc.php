<?php
session_start();
include("includes/user.php");

user::userLogin($_POST["username"], $_POST["password"]);

?>
