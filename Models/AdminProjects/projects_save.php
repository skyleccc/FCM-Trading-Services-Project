<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectname = $_POST['projectname'];
    $clientname = $_POST['clientname'];
    $clientContact = $_POST['clientContact'];
    $projectScope = $_POST['projectScope'];
    $projecttype = $_POST['servicetype'];
    $buildingaddress = $_POST['buildingaddress'];
    $workarea = $_POST['workarea'];
    $projectDetails = $_POST['projectDetails'];
    $specialRequests = $_POST['specialRequests'];
    $deadlineDate = $_POST['deadlineDate'];
    $startdate = $_POST['startdate'];
    $completiondate = $_POST['completiondate'];

    // Client ID retrieval or insertion
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
            echo $temp->error;
        }
    }

    // Building ID retrieval or insertion
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
        $temp = $conn->prepare("INSERT INTO building (buildingaddress, workarea) VALUES (?, ?)");
        $temp->bind_param("ss", $buildingaddress, $workarea);
        if ($temp->execute()) {
            $buildingid = $temp->insert_id;
        } else {
            echo $temp->error;
        }
    }

    if ($clientid !== null && $buildingid !== null) {
        $temp = $conn->prepare("INSERT INTO project (projectname, clientid, buildingid, projectScope, projecttype, projectDetails, specialRequests, deadlineDate, startdate, completiondate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $temp->bind_param("ssssssssss", $projectname, $clientid, $buildingid, $projectScope, $projecttype, $projectDetails, $specialRequests, $deadlineDate, $startdate, $completiondate);

        if ($temp->execute()) {
            $projectID = $temp->insert_id; // Get the newly inserted project ID
            
            // Handle multiple blueprint file uploads
            if (isset($_FILES['blueprint']) && !empty(array_filter($_FILES['blueprint']['name']))) {
                $uploadFile_dir = '../../AttachedFiles/Blueprints/projectBlueprints/blueprint-' . $projectID;
            
                // Create upload directory if it does not exist
                if (!is_dir($uploadFile_dir)) {
                    mkdir($uploadFile_dir, 0755, true);
                }
            
                // Loop through each uploaded file
                foreach ($_FILES['blueprint']['error'] as $key => $error) {
                    if ($error === UPLOAD_ERR_OK) {
                        $blueprint_filename = uniqid() . '-' . basename($_FILES['blueprint']['name'][$key]);
                        $blueprint_target = $uploadFile_dir . DIRECTORY_SEPARATOR . $blueprint_filename;
            
                        if (move_uploaded_file($_FILES['blueprint']['tmp_name'][$key], $blueprint_target)) {
                            echo "File uploaded successfully: $blueprint_filename<br>";
                        } else {
                            echo "Failed to upload file: $blueprint_filename<br>";
                        }
                    } else {
                        echo "Error uploading file: " . $_FILES['blueprint']['name'][$key] . " - Error code: $error<br>";
                    }
                }
            }
            

            $redirectAfter = "Location: ../../Pages/Admin/ProjectDetails/projectpage.php?id=" . $projectID;
            header($redirectAfter);
            exit;
        } else {
            echo "Error: " . $temp->error;
        }
    }

    echo "Number of files: " . count($_FILES['blueprint']['name']) . "<br>";

    $temp->close();
    $conn->close();
}
?>
