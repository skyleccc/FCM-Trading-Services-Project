<?php
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header("Location: /Pages/login.php");
        exit;
    }
    
?>