<?php

// File Redirects
$homeView = "/Pages/Admin/main/main.php";
$calendarView = "#";
$projectsView = "/Pages/Admin/projects.php";
$quotreqsView = "/Pages/Admin/quotationreqs.php";

echo '
<div class="col-sm-2 p-4 border bg-light"><img src="/WebsitePictures/fcmlogo.png" alt="fcm logo" style="width: 180px;"><br><br>
    <a href="'.$homeView.'" style="text-decoration: none; color: black;"><div><span class="material-symbols-outlined">home</span> Home</div><br></a>
    <a href="'.$calendarView.'" style="text-decoration: none; color: black;"><div><span class="material-symbols-outlined">calendar_month</span> Calendar</div><br></a>
    <a href="'.$projectsView.'" style="text-decoration: none; color: black;"><div><span class="material-symbols-outlined">inbox</span> Projects</div><br></a>
    <a href="'.$quotreqsView.'" style="text-decoration: none; color: black;"><div><span class="material-symbols-outlined">request_quote</span>Quotation Requests</div><br></a>
</div>
'

?>