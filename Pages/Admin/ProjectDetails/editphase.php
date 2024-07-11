<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link rel="icon" href="fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style>
    body{
        background-color: rgb(235, 242, 246);
    }
    .row, .col{
        border-radius: 10px;
        background: #fbfbfb;
    }

    .col-sm-2{
        font-family: Helvetica;
        font-weight: bolder;
    }
    .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    }

    .centered {
        position: absolute;
        top: 40%;
        left: 40%;
        transform: translate(6%, -50%);
    }
    
    .container {
        position: relative;
        text-align: center;
        color: white;
    }
    
    div.ex3 {
        overflow: auto;
        height: 347px;
        width: 100%;
    }
    div.ex2 {
        overflow: auto;
        height: 180px;
        width: 100%;
    }
    div.ex1 {
        overflow: auto;
        height: 625px;
        width: 100%;
    }

    .icon-container {
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            background: none;
            padding: 0; 
    }
    .button-style {
            margin: auto;
            text-decoration: none;
            color: rgb(52, 173, 46);
            border: none;
            background: none;
            display: block;
    }
</style>  
</head>
  
  <body>
    <?php
        require 'projectpage.php';
        // Navigation Bar for Admin Dashboard
        include '../../../Components/PhaseModals/editPhaseModal.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../../JS/phase_script.js"></script>
</body>
</html>