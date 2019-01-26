<?php

//$password = $_SESSION["SESS_USER_PASSWORD"];
$password = "password";
$password2 = "password";
$password = md5($password);
$password2 = md5($password2);
echo $password . "<BR>" . $password2;


// add a salt to the password
$signuppassword = "password";
$loginpassword = "password";
$encryptpassword = password_hash($signuppassword, PASSWORD_DEFAULT);
$verified = password_verify($loginpassword, $encryptpassword);
echo "<BR><BR>Sign-up Password: " . $signuppassword . "<BR>Encrypted Version: " . $encryptpassword . "<BR>Login Password: " . $loginpassword . "<BR>Verified? " . $verified . "<BR><BR>";
       
?>

<form action="chap15_proc.php" method="post" enctype="multipart/form-data">
    Select your image:
    <input type="file" name="pic" accept="image/*" required>
    <input id="button" type="submit" value="submit">
</form>