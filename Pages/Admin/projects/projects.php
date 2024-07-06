<?php
require '../../../Controllers/accessDatabase.php';

$sql = "SELECT project.projectid, project.projectname, project.buildingaddress, project.clientid, client.clientname FROM project, client WHERE client.clientid=project.clientid"; // Adjust table name as needed
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> 
</head>
  
<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            // Navigation Bar for Admin Dashboard
            include '../../../Models/adminNavBar.php'
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
                                                    include 'projectslists.php'
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

            <div class="col modalblock">
                <div id="myModal" class="popup">
                    <div class="quotationscontainer">
                        <div class="row" style="height: 100%;">
                            <div class="container p-3 border bg-light rounded">
                                <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Enter a new Project<span class="close">&times;</span>
                                        </div><br>
                                            <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                                                <div class="col-sm ex2" style="border: solid; border-color: green; border-radius: 8px; height: 670px; color: green;">
                                                <form class="form" action="projects_save.php" method="POST" id="addProjectForm">
                                                        <div id="scrollform">
                                                            <div class="form-group">
                                                                <label for="project">Project Name:</label>
                                                                <input type="text" id="projectname" name="projectname" placeholder="Enter Name of Project Here" required>
                                                            </div>
                                                            <div class="form-group_two">
                                                                <div class="input-group">
                                                                    <label for="client">Client:</label>
                                                                    <input type="text" id="clientname" name="clientname" placeholder="Enter Name of Client Here" required>
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="assignedContractor">Client's Contact Number:</label>
                                                                    <input type="text" id="clientContact" name="clientContact" placeholder="Enter Name of Contractor Here" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group_two">
                                                            <div class="form-group">
                                                                <label for="projectScope">Project Scope:</label>
                                                                <input type="text" id="projectScope" name="projectScope" placeholder="Enter the Scope of the Project" required>
                                                            </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="type">Type of Work:</label>
                                                                    <input type="text" id="projecttype" name="projecttype" placeholder="Enter Type of Work Here" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group_two">
                                                            <div class="form-group">
                                                                <label for="building">Location:</label>
                                                                <input type="text" id="buildingaddress" name="buildingaddress" placeholder="Enter Name of Building" required>
                                                                </div>
                                                                
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="building">Work Area:</label>
                                                                    <input type="text" id="workarea" name="workarea" placeholder="Enter Name of Building" required>
                                                                    

                                                                    <label for="blueprint">Blueprints</label>
                                                                    <input type="file" id="blueprint" name="blueprint" placeholder="Type Here...">
                                                                    <label for="blueprint" class="labelforupload">
                                                                        <i class="fa-solid fa-upload"></i> Attach Files Here
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="description">Project Description:</label>
                                                                <textarea id="projectDetails" name="projectDetails" placeholder="Type Here..." required></textarea>
                                                            </div>
                                                            <div class="form-group" style="height: 100px;">
                                                                <label for="description">Special Requests:</label>
                                                                <textarea id="specialRequests" name="specialRequests" placeholder="Type Here..."></textarea>
                                                            </div>
                                                            <div class="form-group_three">
                                                                <div class="input-group">
                                                                    <label for="projectDeadline" class="siteinfo">Project Deadline:</label>
                                                                    <input type="date" id="deadlineDate" name="deadlineDate">
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="startdate" class="siteinfo">Start Date of Project:</label>
                                                                    <input type="date" id="startdate" name="startdate">
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="datecomplete" class="siteinfo">Completion Date of Project:</label>
                                                                    <input type="date" id="completiondate" name="completiondate" placeholder="Type Here...">
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                </div>
                                            </div>
                                            <button id="addfinal">Add Project</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="/../../js/proj_script.js"> </script>
</body>
</html>