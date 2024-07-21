<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT project.projectid, project.projectname, project.projecttype, building.buildingaddress, project.clientid, client.clientname, DATE_FORMAT(project.deadlineDate, '%M %d, %Y') AS deadlineDate, project.isComplete ,DATE_FORMAT(project.completionDate, '%M %d, %Y') AS completionDate FROM project JOIN client ON client.clientid = project.clientid JOIN building ON building.buildingid = project.buildingid ORDER BY project.isComplete ASC, CASE WHEN project.isComplete = 0 THEN project.deadlineDate ELSE project.completionDate END ASC;";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> 

</head>
  
<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            // Navigation Bar for Admin Dashboard
            include '../../../Components/adminNavBar.php'
            ?>
            <div class="col-sm-10 p-3 border bg-light">
                <div style="font-size: 23px;">
                    <!-- Content here -->
                </div>
                <div class="row p-3 border bg-light">   
                    <div class="col-sm-12">
                        <div class="container">
                            <img src="../../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
                        </div>
                        <div class="col p-2 addbtn">
                            <div class="row p-3 border bg-light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col" style=" font-size: 2vw; display:flex;">
                                    <div class="">
                                        Projects List
                                    </div>
                                    <div class="col-sm-5">
                                        <button class="button-style col" id="myBtn" style="width: 55px !important; height: 50px; font-weight: lighter; padding:0 !important;"><span class="material-symbols-outlined" style="font-size: 30px; color: rgb(19, 171, 19); display:flex; justify-content:center;">note_add</span></button></div>
                                    </div>
                                    <div class="col-sm-7" style="display: flex; ">
                                        <div class="col-sm-4 dropdown" >
                                            <button class="dropbtn" style="margin-left: auto !important;">
                                                <div class="row" style="background-color: rgb(19, 171, 19); color: white; width: 13vw; font-weight: lighter;">
                                                    <div class="col-sm-2 p0"><span class="material-symbols-outlined">arrow_drop_down</span></div>
                                                    <div id="show-descrip" class="col-sm-10" style="font-size: 1.2vw; "> Show: <b>All</b></div>
                                                </div>
                                            </button>
                                            <div id="sort-list" class="dropdown-content">
                                                <a href="#" class="show-by" data-sort="all">All</a>
                                                <a href="#" class="show-by" data-sort="ongoing">Ongoing</a>
                                                <a href="#" class="show-by" data-sort="completed">Completed</a>
                                            </div>
                                        </div>
                                        <input type="text" name="search" id="search" placeholder="Search" class="col"> 
                                    </div>

                                </div>
                                <div class="ex1"><div class="row projrow">
                                    <div class="container">
                                        <div id="results" class="row" style="color: black">
                                            <?php
                                                require 'projectlist.php';
                                            ?>
                                        </div>
                                    </div>
                                </div></div>
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        // Add Project Modal
        require "../../../Components/ProjectsModals/addProjectModal.php";
    ?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="../../../JS/projects_script.js"></script>
    <script src="../../../JS/contactValidate_script.js"></script>
</body>
</html>
