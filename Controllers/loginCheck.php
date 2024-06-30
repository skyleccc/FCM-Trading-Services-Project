<?php

    if(!isset($_SESSION['loggedin'])){
        header("Location: /Pages/login.php");
    }
    
?>