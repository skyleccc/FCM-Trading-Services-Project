<?php
    $dbhost = "127.0.0.1";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "fcmDB";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    
    if(!$conn){
        die("Connection Failed: ". mysqli_connect_error());
    }

?>