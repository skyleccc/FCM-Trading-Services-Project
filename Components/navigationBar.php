<?php

// File Redirects
$hrefIntro = "../Pages/index.php#homePage_intro";
$hrefStatistics = "../Pages/index.php#homePage_statistics";
$hrefprojects = "../Pages/index.php#homePage_projects";
$hrefQuotations = "../Pages/index.php#homePage_quotations";
$hrefLogin = "../Pages/login.php";
$hrefRequestQuot = "location.href='../Pages/quotations.php'";

echo'
<div id="navigationBar">
    <div id="navigationBar_logo">
        <img src="../WebsitePictures/fcmlogowhite.png" alt="FCM Logo">
    </div>
    <div id="navigationBar_features" class="h100-w50">
        <a href="'.$hrefIntro.'" class="h100-w20 hoverable flex-centermiddle">Home</a>
        <a href="'.$hrefStatistics.'" class="h100-w20 hoverable flex-centermiddle">Trusted Clients</a>
        <a href="'.$hrefprojects.'" class="h100-w20 hoverable flex-centermiddle">Our Works</a>
        <a href="'.$hrefQuotations.'" class="h100-w20 hoverable flex-centermiddle">Project Form</a>
        <a href="'.$hrefLogin.'" class="h100-w20 hoverable flex-centermiddle">Admin</a>
    </div>
    <div id="navigationBar_button">
        <button class="square-button" onclick="'.$hrefRequestQuot.'">Request Project</button>
    </div>
</div>
'

?>