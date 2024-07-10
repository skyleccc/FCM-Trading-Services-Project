
<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

$searchQuery = '';

if (isset($_POST['query'])) {
    $searchQuery = $conn->real_escape_string($_POST['query']); // Escaping special characters
    $sql = "SELECT project.projectid, project.projectname, project.buildingaddress, project.clientid, client.clientname 
            FROM project 
            JOIN client ON client.clientid = project.clientid
            WHERE project.projectname LIKE '%$searchQuery%' 
            OR project.buildingaddress LIKE '%$searchQuery%' 
            OR client.clientname LIKE '%$searchQuery%'";
} else {
    $sql = "SELECT project.projectid, project.projectname, project.buildingaddress, project.clientid, client.clientname 
            FROM project 
            JOIN client ON client.clientid = project.clientid";
}

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
        <div class="ex1" id="results"><div class="row projrow">
            <div class="container">
                <div class="row" style="color: black">
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-sm-4 border bg-light proj_cont" style="margin-top: 1%;"> 
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <a href="../ProjectDetails/projectpage.php?id=' . htmlspecialchars($row["projectid"] ?? '') . '" class="row p-2" style="margin: auto; text-decoration: none;">
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
                                    echo '<p>No projects found</p>';
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
</div>
</div>
    <?php
        // Add Project Modal
        require "../../../Components/ProjectsModals/addProjectModal.php";
    ?>
</body>
</html>
