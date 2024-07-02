<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "fcmDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $projectId = intval($_GET['id']);
    $project = getProjectById($projectId);
    if (!$project) {
        echo "Order ID does not exist.";
        exit();
    }
} else {
    echo "Invalid order ID.";
    exit();
}

function getProjectById($id) {
    global $conn;
    $save = $conn->prepare("SELECT project.projectname,project.projectscope ,project.projecttype ,project.projectdetails, project.specialrequests, client.clientname,client.clientcontact, building.buildingaddress, building.workarea, building.blueprint, project.startdate, project.deadlinedate, project.completiondate FROM project, client, building WHERE client.clientid = project.clientid AND building.buildingid = project.buildingid AND project.projectid = ?");
    $save->bind_param("i", $id);
    $save->execute();
    $result = $save->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projectname'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $projectname = $_POST['projectname'];
        $clientname = $_POST['clientname'];
        $clientContact = $_POST['clientContact'];
        $projectScope = $_POST['projectScope'];
        $projecttype = $_POST['projecttype'];
        $buildingaddress = $_POST['buildingaddress'];
        $workarea = $_POST['workarea'];
        $blueprint = $_POST['blueprint'];
        $projectDetails = $_POST['projectDetails'];
        $specialRequests = $_POST['specialRequests'];
        $deadlineDate = $_POST['deadlineDate'];
        $startdate = $_POST['startdate'];
        $completiondate = $_POST['completiondate'];
    
        $save = $conn->prepare("SELECT clientID FROM client WHERE clientname = ?");
        $save->bind_param("s", $clientname);
        $save->execute();
        $result = $save->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $clientID = $row['clientID'];
    
            $save = $conn->prepare("UPDATE client SET clientcontact = ? WHERE clientID = ?");
            $save->bind_param("si", $clientContact, $clientID);
            $save->execute();
        } else {
            $save = $conn->prepare("INSERT INTO client (clientname, clientcontact) VALUES (?, ?)");
            $save->bind_param("ss", $clientname, $clientContact);
            $save->execute();
            $clientID = $save->insert_id;
        }

        $save = $conn->prepare("SELECT buildingid FROM building WHERE buildingaddress = ?");
        $save->bind_param("s", $buildingaddress);
        $save->execute();
        $save->store_result();
    
        if ($save->num_rows > 0) {
            $save->bind_result($existing_buildingid);
            $save->fetch();
            $buildingid = $existing_buildingid;
        } else {
            $save->close();
            $save = $conn->prepare("INSERT INTO building (buildingaddress, workarea, blueprint) VALUES (?, ?, ?)");
            $save->bind_param("sss", $buildingaddress, $workarea, $blueprint);
            if ($save->execute()) {
                $buildingid = $save->insert_id;
            } else {
                echo "Error inserting building: " . $conn->error;
            }
        }
    
        $save = $conn->prepare("UPDATE project SET clientid = ?, buildingid = ?, projectname = ?, projecttype = ?, specialRequests = ?, deadlineDate = ?, startdate = ?, completiondate = ? WHERE projectid = ?");
        $save->bind_param("iissssssi", $clientID, $buildingid, $projectname, $projecttype, $specialRequests, $deadlineDate, $startdate, $completiondate, $projectId);
        if ($save->execute()) {
            header("Location: projects.php");
            exit();
        } else {
            echo "Error updating project: " . $conn->error;
        }
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $projectId = intval($_GET['id']);
    $project = getProjectById($projectId);
    if (!$project) {
        echo "Order ID does not exist.";
        exit();
    }
} else {
    echo "Invalid projcet ID.";
    exit();
}

$sql = "SELECT project.projectid, project.projectname, building.buildingaddress, project.clientid, client.clientname FROM project, client, building WHERE client.clientid = project.clientid AND building.buildingid = project.buildingid";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../CSS/projects_style.css">
    <link rel="icon" href="../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> 
</head>
  
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 p-4 border bg-light"><img src="../../WebsitePictures/fcmlogo.png" alt="fcm logo" style="width: 180px;"><br><br>
                <a href="main.php" style="text-decoration: none; color: black;"><div><span class="material-symbols-outlined">home</span> Home</div><br></a>
                <div><span class="material-symbols-outlined">calendar_month</span> Calendar</div><br>
                <a href="projects.php" style="text-decoration: none; color: black;"><div><span class="material-symbols-outlined">inbox</span> Projects</div><br></a>
                <a href="quotationreqs.php" style="text-decoration: none; color: black;"><div><span class="material-symbols-outlined">request_quote</span>Quotation Requests</div><br></a>
            </div>
            <div class="col-sm-10 p-3 border bg-light">
                <div style="font-size: 23px;">
                </div>
                <div class="row p-3 border bg-light">   
                    <div class="col-sm-12">
                        <div class="container">
                            <img src="../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
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

            <div class="col modalblock">
                <div id="myModal" class="popup" style="display: block">
                    <div class="quotationscontainer">
                        <div class="row" style="height: 100%;">
                            <div class="container p-3 border bg-light rounded">
                                <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Enter a new Project<span class="close">&times;</span>
                                        </div><br>
                                            <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                                                <div class="col-sm ex2" style="border: solid; border-color: green; border-radius: 8px; height: 670px; color: green;">
                                                <form class="form" action="projectedit.php?id=<?php echo $projectId; ?>" method="POST" id="addProjectForm">
                                                <input type="hidden" name="id" value="<?php echo $projectId; ?>">        
                                                <div id="scrollform">
                                                            <div class="form-group">
                                                                <label for="project">Project Name:</label>
                                                                <input type="text" id="projectname" name="projectname" value="<?php echo htmlspecialchars($project['projectname'] ?? ''); ?>" required>
                                                            </div>
                                                            <div class="form-group_two">
                                                                <div class="input-group">
                                                                    <label for="client">Client:</label>
                                                                    <input type="text" id="clientname" name="clientname" value="<?php echo htmlspecialchars($project['clientname'] ?? ''); ?>" required>
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="assignedContractor">Client's Contact Number:</label>
                                                                    <input type="text" id="clientContact" name="clientContact" value="<?php echo htmlspecialchars($project['clientcontact'] ?? ''); ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group_two">
                                                            <div class="form-group">
                                                                <label for="projectScope">Project Scope:</label>
                                                                <input type="text" id="projectScope" name="projectScope" value="<?php echo htmlspecialchars($project['projectscope'] ?? ''); ?>" required>
                                                            </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="type">Type of Work:</label>
                                                                    <input type="text" id="projecttype" name="projecttype" value="<?php echo htmlspecialchars($project['projecttype'] ?? ''); ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group_two">
                                                            <div class="form-group">
                                                                <label for="building">Location:</label>
                                                                <input type="text" id="buildingaddress" name="buildingaddress" value="<?php echo htmlspecialchars($project['buildingaddress'] ?? ''); ?>" required>
                                                                </div>
                                                                
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="building">Work Area:</label>
                                                                    <input type="text" id="workarea" name="workarea" value="<?php echo htmlspecialchars($project['workarea'] ?? ''); ?>" required>
                                                                    

                                                                    <label for="blueprint">Blueprints</label>
                                                                    <input type="file" id="blueprint" name="blueprint" value="<?php echo htmlspecialchars($project['blueprint'] ?? ''); ?>"> 
                                                                    <label for="blueprint" class="labelforupload">
                                                                        <i class="fa-solid fa-upload"></i> Attach Files Here
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="description">Project Description:</label>
                                                                <textarea id="projectDetails" name="projectDetails" required><?php echo htmlspecialchars($project['projectdetails'] ?? ''); ?></textarea>
                                                            </div>
                                                            <div class="form-group" style="height: 100px;">
                                                                <label for="description">Special Requests:</label>
                                                                <textarea id="specialRequests" name="specialRequests"><?php echo htmlspecialchars($project['specialrequests'] ?? ''); ?></textarea>
                                                            </div>
                                                            <div class="form-group_three">
                                                                <div class="input-group">
                                                                    <label for="projectDeadline" class="siteinfo">Project Deadline:</label>
                                                                    <input type="date" id="deadlineDate" name="deadlineDate" value="<?php echo htmlspecialchars($project['deadlinedate'] ?? ''); ?>">
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="startdate" class="siteinfo">Start Date of Project:</label>
                                                                    <input type="date" id="startdate" name="startdate" value="<?php echo htmlspecialchars($project['startdate'] ?? ''); ?>">
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="datecomplete" class="siteinfo">Completion Date of Project:</label>
                                                                    <input type="date" id="completiondate" name="completiondate" value="<?php echo htmlspecialchars($project['completiondate'] ?? ''); ?>" >
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
    <script>

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
        window.location.href = `projects.php`;
        }

    </script>    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script>
    </script>
</body>
</html>