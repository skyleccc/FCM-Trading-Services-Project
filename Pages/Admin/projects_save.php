<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "fcmDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

    $clientid = null;
    $temp = $conn->prepare("SELECT clientid FROM client WHERE clientname = ?");
    $temp->bind_param("s", $clientname);
    $temp->execute();
    $temp->store_result();

    if ($temp->num_rows > 0) {
        $temp->bind_result($existing_clientid);
        $temp->fetch();
        $clientid = $existing_clientid;
    } else {
        $temp->close();
        $temp = $conn->prepare("INSERT INTO client (clientname, clientContact) VALUES (?, ?)");
        $temp->bind_param("ss", $clientname, $clientContact);
        if ($temp->execute()) {
            $clientid = $temp->insert_id;
        } else {
            $temp->error;
        }
    }

    $buildingid = null;
    $temp = $conn->prepare("SELECT buildingid FROM building WHERE buildingaddress = ?");
    $temp->bind_param("s", $buildingaddress);
    $temp->execute();
    $temp->store_result();

    if ($temp->num_rows > 0) {
        $temp->bind_result($existing_buildingid);
        $temp->fetch();
        $buildingid = $existing_buildingid;
    } else {
        $temp->close();
        $temp = $conn->prepare("INSERT INTO building (buildingaddress, workarea, blueprint) VALUES (?, ?, ?)");
        $temp->bind_param("sss", $buildingaddress, $workarea, $blueprint);
        if ($temp->execute()) {
            $buildingid = $temp->insert_id;
        } else {
            $temp->error;
        }
    }

    if ($clientid !== null && $buildingid !== null) {
        $temp = $conn->prepare("INSERT INTO project (projectname, clientid, buildingid, projectScope, projecttype, projectDetails, specialRequests, deadlineDate, startdate, completiondate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $temp->bind_param("ssssssssss", $projectname, $clientid, $buildingid, $projectScope, $projecttype, $projectDetails, $specialRequests, $deadlineDate, $startdate, $completiondate);

        if ($temp->execute()) {
            header('Location: projects.php');
            exit;
        } else {
            $temp->error;
        }
    }

    $temp->close();
    $conn->close();
}
?>
