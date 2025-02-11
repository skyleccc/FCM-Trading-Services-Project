<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT project.projectid, project.projectname, building.buildingaddress, project.clientid, client.clientname FROM project, client, phase, building WHERE project.projectid = $id AND project.clientid = client.clientid AND project.buildingID = building.buildingID AND project.projectid=phase.projectid " ; // Adjust table name as needed  
$sql2 = "SELECT phase.phaseTitle, phase.phaseDescription, project.projectname, phase.phaseID, phase.* FROM phase, project WHERE phase.projectid = project.projectid AND project.projectid = $id "; 
$sql3 = "SELECT project.projectname, building.buildingaddress, client.clientname FROM project, client, building WHERE client.clientid= project.clientid  AND project.buildingID = building.buildingID AND project.projectid = $id" ;

$result = $conn->query($sql2);
$result2 = $conn->query($sql); // edit nga ang query kay mu check ra if close na ang deadline (para nis calendar reminders)
$result3 = $conn->query($sql3); // edit nga ang query kay para sa mga quotation requests rani (atm projects ni siya)

$clientname = "";
$projectname = "";
$buildingaddress = "";
if ($result3->num_rows > 0) {
    $row = $result3->fetch_assoc();
    $clientname = $row['clientname'];
    $projectname = $row['projectname'];
    $buildingaddress = $row['buildingaddress'];
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link rel="stylesheet" href="../../../CSS/projectpage_styles.css">
    <link rel="icon" href="fcmicon.png">
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
            <div class="col-10 p-3 border bg light">
                <div class="row border bg light">
                    <div class="col-8 p-3 row">
                        <div class="container container-img rounded" >
                            <div class="row">
                                <div class="col">
                                    <div class="centered" style="font-size: 1.5vw; left: 4%; top: 50%; color: green; border: solid; padding: 10px; border-radius: 10px;"><?php echo htmlspecialchars($projectname); ?></div>
                                </div>
                                <div class="col">
                                    <div class="centered clientname" style="font-weight: bolder; font-size: 2vw; color: black"><?php echo htmlspecialchars($clientname); ?></div>
                                    <div class="centered buildingaddress" style="color:black; margin-top: 30px; font-size: 1.4vw;"><?php echo htmlspecialchars($buildingaddress); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col p-2">
                            <div class="row p-3 border bg light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col" style="margin-top: 10px;">Ongoing Projects</div>
                                <button class="button-style" id="addphase" style="width: 30px; height: 50px;"><span class="material-symbols-outlined"style="font-size: 50px; position: relative; top: -10%;  left: -600%;  font-size: 50px;" sys_getloadavg >add_circle</span></button>
                                <div class="col-sm-3" style="height: 30px;">
                                    <div class="row" style="background-color: rgb(19, 171, 19); width: 210px; height: 50px;">
                                        <div class="col" style="background-color: rgb(19, 171, 19); font-size: 1vw; color: white;">Progress:</div>
                                        <div class="col" style="background-color: rgb(19, 171, 19); font-size: 2vw; color: white;">30%</div>
                                    </div>
                                </div>
                                    <br><br>
                                <div class="ex1">


                                        <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<div class="row">
                                                    <div class="col-sm-11">
                                                        <div class="row p-2 border bg light" style="margin: auto;">
                                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 65px; height: 80px; color: rgb(41, 157, 41);">
                                                                <input type="checkbox" style="width: 40px; height: 70px; margin-top: 10%; accent-color: rgb(41, 157, 41);">
                                                            </div>
                                                            <div class="col p-1 ">
                                                            <div id="clientname" style="font-weight: bold;text-align: center;font-size: 1.6vw; color: black;">' . htmlspecialchars($row["phaseTitle"] ?? '') . '</div>
                                                            <div id="address" style="font-weight: lighter; text-align: center; font-size: 1vw; color: black;">' . htmlspecialchars($row["phaseDescription"] ?? '') . '</div>
                                                            <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 1.2vw; color:#40ce55;">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                                                            </div>
                                                            <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 160px; height: 80px; padding-top: 13px ;">
                                                                <div style="color: white; font-size: 15px; font-weight: lighter; ">Deadline:</div>
                                                                <div style=" color: white">' . htmlspecialchars($row["expectedFinishDate"] ?? '') . '</div>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                        <div class="col-sm-1">
                                                            <button class="button-style edit-btn" data-id="' . htmlspecialchars($row["phaseid"] ?? '') . '" style="margin-top: 7px">
                                                                <div class="row border bg-light rounded icon-container">
                                                                    <span class="material-symbols-outlined" style="font-size: 2vw;">edit</span>
                                                                </div>
                                                            </button>
                                                            <button class="button-style delete-btn" data-id="' . htmlspecialchars($row["phaseid"] ?? '') . '" style="margin-top: 10px">
                                                            <div class="row border bg-light rounded icon-container">
                                                                <span class="material-symbols-outlined" style="font-size: 2vw;">delete</span>
                                                            </div>
                                                        </button>
                                                        </div>
                                                </div>';
                                                }
                                            } else {
                                                echo '<p>No projects found</p>'; // edit add something nga pwede mupakita kung way projects
                                            }
                                        ?>

                                
                           
</div>
                                   
                                
                        <br><br><br></div>
                    </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="row">
                            
                            <div class="container p-3 border bg-light rounded">
                                <div style="font-size: 20px; font-weight: bold;color: black">Calendar Reminders</div><br>
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
                                </div>
                                <div class="ex2">
                                <div class="div" style="width: 90%; margin: auto;">
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
                            </div>
                        </div><br>
                        <div class="row">
                                <div class="col p-3 border bg light" style="font-weight: bold;">
                                    <div style="text-align: center; font-size: 30px;">Quotation Requests</div>
                                    <div style="text-align: center; color: grey; font-weight: lighter;">Check and validate within 7 Days</div><br>
                                    <div class="col">
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
                                </div><br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    require '../../../Components/PhaseModals/addPhaseModal.php';
                ?>

            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../../JS/phase_script.js">

    </script>
</body>
</html>