<?php

if(isset($_POST["txtName"])){
    
    $name = $_POST["txtName"];
    $email = $_POST["txtEmail"];
    echo "Name: $name<br>" . "Email: $email<br>";
    
    //these are defined as constants
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'productsdemo');

    global $con;
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
              
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    
    $sql = "select * from products";
    if ($result = mysqli_query($con, $sql))
    {
        echo "Rows found: " . mysqli_num_rows($result) . "<BR>";
        $products = "";
        while ($row = $result -> fetch_object()){
      //while ($row = mysqli_fetch_assoc($result)){
          //echo $row['ID'] . " " . $row['description'] . "<br>";
            echo "ID: " . $row->ID . " Description: " . $row->Description . "<BR>";
            
        }
    }
}

?>