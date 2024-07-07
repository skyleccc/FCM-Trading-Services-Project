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
        <h1 class="login">&nbsp</h1>
        <div class="content-text h25-w100 flex-centermiddle">
            <h1>Incorrect Password or Email!</h1>
        </div>
            <div class="form-group-landingpage">
                <div class="h100-w50">
                    <button class="square-button" onclick="location.href='login.php'">Return to Login Page</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>