<?php
//this file will handle the file uploading and return the user back to the edit_photo page.
session_start();
include('includes/user.php');

user::updateProfPic($_SESSION["SESS_MEMBER_ID"]);

?>
