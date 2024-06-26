<?php

    if(session_id('loggedin') == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE){
        header("Location: /Pages/login.php");
    }
    
?>