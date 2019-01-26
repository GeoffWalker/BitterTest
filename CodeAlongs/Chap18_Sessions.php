<?php
session_start();

$_SESSION["username"] = "Jimmy";

if (isset($_SESSION["username"])){
   echo $_SESSION["username"] . "<BR>";
}

//$mySession = session_encode();

echo session_encode() . "<BR>";
//echo session_decode($mySession);

echo session_id() . "<BR>";

session_unset(); //removes all the session variables.
session_destroy(); // kills the session completely.

?>
