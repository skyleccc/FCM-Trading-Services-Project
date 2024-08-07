<?php
session_start();
if(isset($_SESSION['loggedin'])){
    header("Location: /Pages/Admin/MainDashboard/main.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCM Trading Services</title>

    <link rel="icon" href="../WebsitePictures/fcmlogo.png">
    <link rel="stylesheet" href="../CSS/general_style.css">
    <link rel="stylesheet" href="../CSS/forms.css">
    <script src="../JS/index_script.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php 
    // NAVIGATION BAR
    include '../Components/navigationBar.php'
    ?>
    <div id="homePage">
        <h1 class="login">Login</h1>
        <div class="logincontainer">
            <form action="../Controllers/adminLogin.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter Username Here...">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password Here...">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" id="login-button">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>