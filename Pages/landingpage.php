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
    <div id="navigationBar">
        <div id="navigationBar_logo">
            <img src="../WebsitePictures/fcmlogowhite.png" alt="FCM Logo">
        </div>
        <div id="navigationBar_features" class="h100-w50">
            <a href="../Pages/index.html#homePage_intro" class="h100-w20 hoverable flex-centermiddle">Home</a>
            <a href="../Pages/index.html#homePage_statistics" class="h100-w20 hoverable flex-centermiddle">Trusted Clients</a>
            <a href="../Pages/index.html#homePage_projects" class="h100-w20 hoverable flex-centermiddle">Our Works</a>
            <a href="../Pages/index.html#homePage_quotations" class="h100-w20 hoverable flex-centermiddle">Quotation Form</a>
            <a href="../Pages/login.html" class="h100-w20 hoverable flex-centermiddle">Admin</a>
        </div>
        <div id="navigationBar_button">
            <button class="square-button" onclick="location.href='quotations.html'">Request Quotation</button>
        </div>
    </div>
    <div id="homePage">
        <h1 class="login">&nbsp</h1>
        <div class="content-text h25-w100 flex-centermiddle">
            <h1>You Have Successfully Submitted a Quotation Request</h1>
        </div>
            <div class="form-group-landingpage">
                <button class="square-button" onclick="location.href='index.php#homePage_intro'">Return to Home Page</button>
            </div>
        </div>
    </div>
</body>
</html>