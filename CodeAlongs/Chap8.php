<?php
// chapter 8 - errors and exceptions
try{
    if (!mysqli_connect("DB", "bad_user", "bad_password", "mySchema")){
        throw new Exception("Error connecting to database.");
    }
    
}
catch (Exception $ex) {
        error_log("error in file " . $ex->getFile() . " on line #" . $ex->getLine() . " Details: " . $ex->getMessage(), 0);
        echo "cannot connect to database";
}

?>