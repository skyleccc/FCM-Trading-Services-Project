<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

$id = $_GET['id'];

// Phase Table
$sql = "SELECT phase.*, project.deadlineDate FROM phase, project WHERE project.projectid = ? AND phase.projectid = project.projectid";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Phase Progress SQL
$sql2 = "SELECT ROUND((SUM(isFinished)/COUNT(isFinished))*100, 0) AS progressRate FROM project, client, phase, building WHERE project.projectid = ? AND project.clientid = client.clientid AND project.buildingID = building.buildingID AND project.projectid=phase.projectid";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();

// Header Text
$sql3 = "SELECT project.projectname, building.buildingaddress, client.clientname, client.clientcontact, project.projecttype, project.workarea, DATE_FORMAT(project.deadlineDate, '%M %d, %Y') AS deadlineDate FROM project, client, building WHERE client.clientid= project.clientid AND project.buildingID = building.buildingID AND project.projectid = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $id);
$stmt3->execute();
$result3 = $stmt3->get_result();

if ($result2->num_rows > 0) {
    $res2_row = $result2->fetch_assoc();
    $progressRate = $res2_row["progressRate"];
}

if ($result3->num_rows > 0) {
    $row = $result3->fetch_assoc();
    $clientname = $row['clientname'];
    $projectname = $row['projectname'];
    $buildingaddress = $row['buildingaddress'];
    $clientcontact = $row['clientcontact'];
    $worktype = $row['projecttype'];
    $workArea = $row['workarea'];
    $deadlineDate = $row['deadlineDate'];
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
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <div class="container-fluid" style="height: 100%">
        <div class="row">
            <div class="col-2 p-1 first border bg light">
                <?php include '../../../Components/adminNavBar.php'; ?>
            </div>
            <div class="col-7 p-3 second border bg light">
                <div class="col container img-cont rounded">
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

                <div class="row p-3 border bg light rounded" style="font-size: 20px; font-weight: bold;">
                    <div class="col" style="margin-top: 10px;">Project Tasks:</div>
                    <button class="button-style" id="addphase" style="width: 30px; height: 50px;"><span class="material-symbols-outlined" style="font-size: 50px; position: relative; top: -10%; left: -600%; font-size: 50px;">add_circle</span></button>
                    <div class="col-sm-3" style="height: 30px;">
                        <div class="row" style="background-color: rgb(19, 171, 19); width: 210px; height: 50px;">
                            <div class="col" style="background-color: rgb(19, 171, 19); font-size: 1vw; color: white; display:flex; justify-content: center">
                                <div class="col" style="background-color: rgb(19, 171, 19); font-size: 1.2vw; color: white; margin: auto;">Progress:</div>
                                <div id="progressNum" class="col" style="background-color: rgb(19, 171, 19); font-size: 1.5vw; color: white; margin-left: 15px; margin-top: auto; margin-bottom: auto;"><?php echo htmlspecialchars($progressRate ?? '0') ?>%</div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div id="phase-list" class="ex1">
                        <?php require 'phaselist.php'; ?>
                    </div>
                </div>
            </div>

            <div class="col-3 third p-3 border bg light">
                <div class="col p-3 border bg light">
                    <div class="col" style="color: green; font-size: 1.7vw; font-weight: bolder; display: flex; justify-content: center; padding: 15px">Project Details</div>
                    <div class="col details p-3">
                        <div class="row a">
                            <div class="col projectname">Project Name:</div>
                            <div class="col data1"><?php echo htmlspecialchars($projectname); ?></div>
                        </div>
                        <div class="row b">
                            <div class="col client">Client Name:</div>
                            <div class="col data2"><?php echo htmlspecialchars($clientname); ?></div>
                        </div>
                        <div class="row c">
                            <div class="col contact-info">Contact:</div>
                            <div class="col data3"><?php echo htmlspecialchars($clientcontact); ?></div>
                        </div>
                        <div class="row d">
                            <div class="col worktype">Work Type:</div>
                            <div class="col data4"><?php echo htmlspecialchars($worktype); ?></div>
                        </div>
                        <div class="row e">
                            <div class="col location">Location:</div>
                            <div class="col data5"><?php echo htmlspecialchars($buildingaddress); ?></div>
                        </div>
                        <div class="row f">
                            <div class="col workarea">Area of Work:</div>
                            <div class="col data6"><?php echo htmlspecialchars($workArea ?? '0'); ?> sqm.</div>
                        </div>
                        <div class="row g">
                                <div class="col blueprints">Blueprints:</div>
                                <div class="col data7">
                                    <?php
                                    $dirPath = "../../../AttachedFiles/Blueprints/projectBlueprints/blueprint-" . $id;

                                    if (is_dir($dirPath)) {
                                        $files = scandir($dirPath);
                                        $hasFiles = false;

                                        echo "<ul>"; // Start the list

                                        foreach ($files as $file) {
                                            if ($file !== '.' && $file !== '..') {
                                                $filePath = $dirPath . '/' . $file;
                                                if (is_file($filePath)) {
                                                    $hasFiles = true; // Set to true when a file is found
                                                    echo "<li><a href='" . htmlspecialchars($filePath) . "' target='_blank'>" . htmlspecialchars($file) . "</a></li>";
                                                }
                                            }
                                        }

                                        echo "</ul>"; // End the list

                                        if (!$hasFiles) {
                                            echo "No blueprints attached.";
                                        }
                                    } else {
                                        echo "No blueprints attached.";
                                    }
                                    ?>
                                </div>
                            </div>

                        <div class="row h">
                            <div class="col deadline">Deadline:</div>
                            <div class="col data2"><?php echo htmlspecialchars($deadlineDate ?? 'No Deadline'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require '../../../Components/PhaseModals/addPhaseModal.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../../JS/phase_script.js"></script>
</body>
</html>
