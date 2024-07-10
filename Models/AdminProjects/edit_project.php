<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$redirectAfter = "Location: ../../Pages/Admin/MainDashboard/main.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projectname'])) {
    $projectId = $_POST['id'];
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
            exit();
        }
    }

    $save = $conn->prepare("UPDATE project SET clientid = ?, buildingid = ?, projectname = ?, projecttype = ?, specialRequests = ?, deadlineDate = ?, startdate = ?, completiondate = ? WHERE projectid = ?");
    $save->bind_param("iissssssi", $clientID, $buildingid, $projectname, $projecttype, $specialRequests, $deadlineDate, $startdate, $completiondate, $projectId);

    if ($save->execute()) {
        header($redirectAfter);
        exit();
    } else {
        echo "Error updating project: " . $conn->error;
        exit();
    }
}
?>
