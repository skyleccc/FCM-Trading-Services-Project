<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Models/AdminProjects/filldata_modal.php';

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
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> 
</head>
  
<body>
    <?php
        require 'main.php';
        // Edit Project Modal
        require '../../../Components/ProjectsModals/editProjectModal.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="../../../JS/main_script.js"> </script>
</body>
</html>