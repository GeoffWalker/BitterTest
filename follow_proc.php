<?php

session_start();
include('connect.php');

$sql = 'INSERT INTO follows (from_id, to_id) VALUES ("' . $_SESSION["SESS_MEMBER_ID"] . '", "' . $_GET["user_id"] .'");';

$result = mysqli_query($con, $sql);

$msg = "User followed. Troll away!";
header("location:index.php?msg=$msg");

?>