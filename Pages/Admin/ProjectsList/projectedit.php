<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';
require '../../../Models/AdminProjects/filldata_modal.php';
$sql = "SELECT project.projectid, project.projectname, building.buildingaddress, project.clientid, client.clientname FROM project, client, building WHERE client.clientid = project.clientid AND building.buildingid = project.buildingid";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link rel="icon" href="../../WebsitePictures/fcmicon.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="../../../JS/projects_script.js"></script>
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
                </div>
                <div class="row p-3 border bg-light">   
                    <div class="col-sm-12">
                        <div class="container">
                            <img src="../../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
                        </div>
                        <div class="col p-2 addbtn">
                            <div class="row p-3 border bg-light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col" style="margin: 10px; font-size: 2vw;">Projects List</div>
                                <div class="col-sm-3" style="margin: 10px;">
                                   <button class="button-style" id="myBtn" style="background-color: rgb(19, 171, 19);width: 200px; height: 50px; font-weight: lighter; margin-left:37%;"><div class="col" style="background-color: rgb(19, 171, 19); font-size: 1.4vw; color: white;">
                                    <span class="material-symbols-outlined" style="font-size: 30px; color: white;">note_add</span> Add A Project
                                    </div></button> 
                                </div><br><br>
                                <div class="ex1"><div class="row projrow">
                                    <div class="container">
                                        <div class="row" style="color: black">
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<div class="col-sm-4 border bg-light proj_cont" style="margin-top: 1%;"> 
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    <a href="projectpage.php?id=' . htmlspecialchars($row["projectid"] ?? '') . '" class="row p-2" style="margin: auto; text-decoration: none;">
                                                                        <div class="row" style="margin: auto; margin-top: 3%;">
                                                                            <div class="col p-1">
                                                                                <div id="clientname" style="font-weight: bold;text-align: center;font-size: 1.6vw; color: black;">' . htmlspecialchars($row["clientname"] ?? '') . '</div>
                                                                                <div id="address" style="font-weight: lighter; text-align: center; font-size: 1vw; color: black;">' . htmlspecialchars($row["buildingaddress"] ?? '') . '</div>
                                                                                <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 1.2vw; color:#40ce55;">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col" style="margin-top: 10px;">
                                                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 100%;color: rgb(255, 255, 255);"> Progress</div>
                                                                            <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 100%; color: rgb(255, 251, 251); margin-top: 5px;"> Deadline</div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                
                                                                <div class="col-sm-2 border bg-light">
                                                                    <button class="button-style edit-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 8px;">
                                                                        <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                                                            <span class="material-symbols-outlined" style="font-size: 1.5vw;">edit</span>
                                                                        </div>
                                                                    </button>
                                                                    <button class="button-style delete-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 8px; margin-bottom: 10px;">
                                                                        <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                                                            <span class="material-symbols-outlined" style="font-size: 1.5vw;">delete</span>
                                                                        </div>
                                                                    </button>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>';
                                                }
                                            } else {
                                                echo '<p>No projects found</p>'; // edit add something nga pwede mupakita kung way projects
                                            }
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

                <?php
                    // Edit Project Modal
                    require '../../../Components/ProjectsModals/editProjectModal.php';
                ?>
        </div>   
    </div>
</body>
</html>