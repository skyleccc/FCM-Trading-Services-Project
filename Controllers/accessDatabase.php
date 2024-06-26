<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "fcm_trading_services";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    
    if(!$conn){
        die("Connection Failed: ". mysqli_connect_error());
    }

?>