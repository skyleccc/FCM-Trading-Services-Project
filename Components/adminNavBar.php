

<style>
    <?php include '../../../CSS/admin_page.css'; ?>
</style>

<?php

// File Redirects
$homeView = "../MainDashboard/main.php";
$calendarView = "../Calendar/calendarMain.php";
$projectsView = "../ProjectsList/projects.php";
$clientsView = "../ClientsList/clients.php";
$quotreqsView = "../QuotationReqsList/quotationreqs.php";
$signOut = "../../../Controllers/signOut.php";

$fcmIconPNG = "../../../WebsitePictures/fcmlogo.png";

echo '
            
    
<div class="col-sm-2 p-4" id="sidebar"><img src="'.$fcmIconPNG.'" alt="fcm logo" style="width: 180px;"><br><br>
    <a href="'.$homeView.'" style="text-decoration: none; color: black;"><div class="home"><span class="material-symbols-outlined" >home</span><span>Home</span></div><br></a>
    <a href="'.$calendarView.'" style="text-decoration: none; color: black;"><div class="sched"><span class="material-symbols-outlined" >calendar_month</span><span>Task Calendar</span></div><br></a>
    <a href="'.$projectsView.'" style="text-decoration: none; color: black;"><div class="inbox"><span class="material-symbols-outlined" >inbox</span><span>Projects</span></div><br></a>
    <a href="'.$clientsView.'" style="text-decoration: none; color: black;"><div class="sched"><span class="material-symbols-outlined" >group</span><span>Clients</span></div><br></a>
    <a href="'.$quotreqsView.'" style="text-decoration: none; color: black;"><div class="requestQuote"><span class="material-symbols-outlined" >request_quote</span><span>Project Requests</span></div><br></a>
    <a href="'.$signOut.'" style="text-decoration: none; color: black;"><div class="sched"><span class="material-symbols-outlined" >logout</span><span>Sign Out</span></div><br></a>
</div>
'

?>