<?php
require '../../Controllers/accessDatabase.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT project.projectid, project.projectname, building.buildingaddress, project.clientid, client.clientname FROM project, client, building WHERE client.clientid=project.clientid AND project.buildingid=building.buildingid"; // Adjust table name as needed
$result = $conn->query($sql);
$result2 = $conn->query($sql); // edit nga ang query kay mu check ra if close na ang deadline (para nis calendar reminders)
$result3 = $conn->query($sql); // edit nga ang query kay para sa mga quotation requests rani (atm projects ni siya)
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../CSS/dashboard_styles.css">
    <link rel="icon" href="fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>
  
  <body>
    <div class="container-fluid">
        <div class="row">
            <?php
            // Navigation Bar for Admin Dashboard
            include '../../Models/adminNavBar.php'
            ?>
            <div class="col-sm-10 p-3 border bg light">
                <div style="font-size: 23px;">
                   <div class="col" style=" border-bottom-style: solid; border-color: green;" >Home</div>
                </div>
                <div class="row p-3 border bg light">
                    <div class="col-sm-8">
                        <div class="container">
                            <img src="../../WebsitePictures/fcmbanner.png" alt="fcm logo" class="rounded" style="width: 840px; margin:auto;">
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
                                    <div class="dropdown-content">
                                        <a href="#">Name</a>
                                        <a href="#">Deadline</a>
                                        <a href="#">Date Added</a>
                                      </div>
                                    
                                </div><br><br>

                                <div class="ex1">
                                <div class="container">
                                <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<div class="row">
                                                    <div class="col-sm-11">
                                                        <a href="projectpage.php?id=' . htmlspecialchars($row["projectid"]) . '" class="row p-2 border bg-light" style="margin: auto; text-decoration: none;">
                                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 65px; height: 80px; color: rgb(41, 157, 41);">.</div>
                                                            <div class="col p-1 ">
                                                                <div id="clientname" style="font-weight: bold;text-align: center; color: black;">' . htmlspecialchars($row["clientname"]  ?? '') . '</div>
                                                                <div id="buildingaddress" style="font-weight: lighter; text-align: center; font-size: 13px; color: black;">' . htmlspecialchars($row["buildingaddress"]  ?? '') . '</div>
                                                                <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                                                            </div>
                                                            <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 65px; height: 80px; padding-top: 23px ; color: rgb(255, 251, 251);">May</div>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="button-style edit-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 7px">
                                                            <div class="row border bg-light rounded icon-container">
                                                                <span class="material-symbols-outlined" style="font-size: 2vw;">edit</span>
                                                            </div>
                                                        </button>
                                                        <button class="button-style delete-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 10px">
                                                            <div class="row border bg-light rounded icon-container">
                                                                <span class="material-symbols-outlined" style="font-size: 2vw;">delete</span>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>';
                                            }
                                        } else {
                                            echo '<p>No projects found</p>';
                                        }
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
                                        <br>11</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Mon</div>
                                        <br>12</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Tue</div>
                                        <br>13</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: rgb(221, 30, 30); border-radius: 8px; color: rgb(221, 30, 30);">
                                        <div style="font-weight: bold; font-size: 18px;">Wed</div>
                                        <br>14</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Thu</div>
                                        <br>15</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Fri</div>
                                        <br>16</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Sat</div>
                                        <br>17</div>
                                </div><br>
                                <div class="ex2">
                                <div class="div" style="width: 90%; margin: auto;">    
                                    <?php   
                                        if ($result2->num_rows > 0) {
                                            while ($row = $result2->fetch_assoc()) {
                                                echo '
                                                <a href="projectpage.php?id=' . htmlspecialchars($row["projectid"]) . '"  class="row p-1 border bg light" style="margin-top: 25px;">
                                                <div class="col-sm-4 rounded" style="background-color:rgb(212, 43, 34); width: 35px; height: 80px; color: rgb(212, 43, 34);">.</div>
                                                    <div class="col p-1 ">
                                                        <div id="clientname" style="font-weight: bold;text-align: center; color: black;">' . htmlspecialchars($row["clientname"]  ?? '') . '</div>
                                                        <div id="buildingaddress" style="font-weight: lighter; text-align: center; font-size: 13px; color: black;">' . htmlspecialchars($row["buildingaddress"]  ?? '') . '</div>
                                                        <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                                                    </div>
                                                </a>';
                                            }
                                        } else {
                                            echo '<p>No projects found</p>';
                                        }
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
                                    <div class="div" style="width: 90%; margin: auto;">
                                        
                                    <?php   
                                        if ($result3->num_rows > 0) {
                                            while ($row = $result3->fetch_assoc()) {
                                                echo '
                                                <a href="projectpage.php?id=' . htmlspecialchars($row["projectid"]) . '"  class="row p-1 border bg light" style="margin-top: 25px;">
                                                <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 35px; height: 80px; color: rgb(41, 157, 41);">.</div>
                                                    <div class="col p-1 ">
                                                        <div id="clientname" style="font-weight: bold;text-align: center; color: black;">' . htmlspecialchars($row["clientname"]  ?? '') . '</div>
                                                        <div id="buildingaddress" style="font-weight: lighter; text-align: center; font-size: 13px; color: black;">' . htmlspecialchars($row["buildingaddress"]  ?? '') . '</div>
                                                        <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                                                    </div>
                                                </a>';
                                            }
                                        } else {
                                            echo '<p>No projects found</p>';
                                        }
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
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script>
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            window.location.href = 'projectedit.php?id=' + id;
        });

        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this project?')) {
                fetch('delete_project.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'projectid=' + id,
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Project deleted successfully!');
                        location.reload();
                    } else {
                        alert('Failed to delete the project.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete the project.');
                });
            }
        });
    </script>

  </body>
</html>