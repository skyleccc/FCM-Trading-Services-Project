<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

$sql = "SELECT project.projectid, project.projectname, project.progressrate, building.buildingaddress, project.clientid, client.clientname, DATE_FORMAT(project.deadlineDate, '%M %d, %Y') AS deadlineDate FROM project, client, building WHERE client.clientid=project.clientid AND project.buildingid=building.buildingid"; // Adjust table name as needed
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/dashboard_styles.css">
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
  
  <body>
    <div class="container-fluid">
        <div class="row" style="text-decoration: none">
            <?php
            // Navigation Bar for Admin Dashboard
            include '../../../Components/adminNavBar.php'
            ?>
            <div class="col-sm-10 p-3 border bg light">
                <div class="row p-3 border bg light">
                    <div class="col-sm-8">
                        <div class="container">
                            <img src="../../../WebsitePictures/fcmbanner.png" alt="fcm logo" class="rounded" style="width: 840px; margin:auto;">
                        </div>
                        <div class="col p-2">
                            <div class="row p-3 border bg light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col">Ongoing Projects</div>
                                <div class="col-sm-3 dropdown" style="left:6%">
                                    <button class="dropbtn">
                                        <div class="row" style="background-color: rgb(19, 171, 19); color: white; width: 9vw; font-weight: lighter;">
                                            <div class="col-sm-2 p0"><span class="material-symbols-outlined">arrow_drop_down</span></div>
                                            <div class="col-sm-10" style="font-size: 1.2vw;"> Sort By:</div>
                                        </div>
                                    </button>
                                    <div id="sort-list" class="dropdown-content">
                                        <a href="#" data-sort="progressRate">Progress Rate</a>
                                        <a href="#" data-sort="deadlineDate">Deadline</a>
                                        <a href="#" data-sort="startDate">Start Date</a>
                                      </div>
                                    
                                </div><br><br>

                                <div class="ex1">
                                <div id="project-container" class="container" style="text-decoration: none">
                                <?php
                                    // Projects List
                                    include 'projectlist.php'
                                ?>
                                </div>

                                </div>


                        <br><br><br></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="container p-3 border bg-light rounded">
                                <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Calendar Reminders</div><br>
                                <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                                    <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Sun</div>
                                        <br>11
                                    </div>
                                    <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Mon</div>
                                        <br>12
                                    </div>
                                    <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Tue</div>
                                        <br>13
                                    </div>
                                    <div class="col-sm p-2" style="border: solid; border-color: rgb(221, 30, 30); border-radius: 8px; color: rgb(221, 30, 30);">
                                        <div style="font-weight: bold; font-size: 18px;">Wed</div>
                                        <br>14
                                    </div>
                                    <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Thu</div>
                                        <br>15
                                    </div>
                                    <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Fri</div>
                                        <br>16
                                    </div>
                                    <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Sat</div>
                                        <br>17
                                    </div>
                                </div><br>
                                <div class="ex2">
                                    <div class="div" style="width: 90%; margin: auto;">    
                                    <?php
                                        // Reminders List
                                        include 'remindersbar.php'
                                    ?>                                                                  
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col p-3 border bg light" style="font-weight: bold;">
                                <div style="text-align: center; font-size: 30px;">Quotation Requests</div>
                                <div style="text-align: center; color: grey; font-weight: lighter;">Check and validate within 7 Days</div>
                                <div class="col"></div>
                                <div class="ex3">
                                    <div class="div" style="width: 90%; margin: auto;" >
                                        
                                    <?php
                                    // Navigation Bar for Admin Dashboard
                                    include 'quotationbar.php'
                                    ?>  
                                
                                    </div>
                                </div>
                            </div>
                        </div><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="../../../JS/main_script.js"> </script>
  </body>
</html>