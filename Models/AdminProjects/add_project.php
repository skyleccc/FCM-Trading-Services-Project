<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // FORM POST VARIABLES
    $projectname = $_POST['projectname'];
    $clientname = $_POST['clientname'];
    $clientContact = $_POST['clientContact'];
    $projectScope = $_POST['projectScope'];
    $projecttype = $_POST['servicetype'];
    $buildingaddress = $_POST['buildingaddress'];
    $workarea = $_POST['workarea'];
    $projectDetails = $_POST['projectDetails'];
    $specialRequests = $_POST['specialRequests'];
    $deadlineDate = nullChecker($_POST['deadlineDate']);
    $startdate = nullChecker($_POST['startdate']);
    $completiondate = nullChecker($_POST['completiondate']);
    $budgetConstraint = isset($_POST['budgetConstraint']) ? $_POST['budgetConstraint'] : null;
    $clientEmail = nullChecker($_POST['clientEmail']);
    $clientContact = nullChecker($_POST['clientContact']);


    if(isset($_POST['id'])){
        
        $clientID = $_POST['id'];
        $clientDetails = getClientDetails($clientID, $conn);
        if($clientDetails){
            $buildingID = checkBuildingAddress($buildingaddress, $clientID, $conn);
            if(!empty($buildingID)){
                if(insertAllData($clientID, $buildingID, $projectname, $projecttype, $projectDetails, $startdate, $deadlineDate, $budgetConstraint, $workarea, $specialRequests, $projectScope, $conn)){
                    echo '<script>console.log("Inserted Project. Same Client Same buildingID")</script>';
                }else{
                    echo '<script>console.log("Failed to insert (Same Client, Same Building).")</script>';
                }
            }else{
                $sqlCreateBuilding = "INSERT INTO building (buildingaddress) VALUES (?)";
                $createBuildingQuery = $conn->prepare($sqlCreateBuilding);
                $createBuildingQuery->bind_param("s", $buildingaddress);
                if($createBuildingQuery->execute()){
                    $newBuildingID = $createBuildingQuery->insert_id;
                    if(insertAllData($clientID, $newBuildingID, $projectname, $projecttype, $projectDetails, $startdate, $deadlineDate, $budgetConstraint, $workarea, $specialRequests, $projectScope, $conn)){
                        echo '<script>console.log("Inserted Project. Same Client Diff buildingID")</script>';
                    }else{
                        echo '<script>console.log("Failed to insert (Same Client, Diff Building).")</script>';
                    }
                }else{
                    echo '<script>console.log("Failed to create buildingID.")</script>';
                }
            }
        }else{
            echo '<script>console.log("Client ID not found.")</script>';
        }
    }else{
        $sqlCreateClient = "INSERT INTO client (clientName, clientContact, clientEmail) VALUES (?,?,?)";
        $createClientQuery = $conn->prepare($sqlCreateClient);
        $createClientQuery->bind_param("sss", $clientname, $clientContact, $clientEmail);
        if($createClientQuery->execute()){
            $newClientID = $createClientQuery->insert_id;

            $sqlCreateBuilding = "INSERT INTO building (buildingaddress) VALUES (?)";
            $createBuildingQuery = $conn->prepare($sqlCreateBuilding);
            $createBuildingQuery->bind_param("s", $buildingaddress);
            if($createBuildingQuery->execute()){
                $newBuildingID = $createBuildingQuery->insert_id;
                if(insertAllData($newClientID, $newBuildingID, $projectname, $projecttype, $projectDetails, $startdate, $deadlineDate, $budgetConstraint, $workarea, $specialRequests, $projectScope, $conn)){
                    echo '<script>console.log("Inserted Project. New Client New Building")</script>';
                    header("Location: /Pages/Admin/ProjectDetails/projectpage.php");
                }else{
                    echo '<script>console.log("Failed to insert. (New Client, New Building").")</script>';
                }
            }else{
                echo '<script>console.log("Failed to create buildingID.")</script>';
            }

        }else{
            echo '<script>console.log("Failed to Create Client ID")</script>';
        }
    }
}else{
    echo '<script>alert("Unauthorized access!")</script>';
}



function nullChecker($var){
    if(empty($var) || $var == ''){
        return NULL;
    }else{
        return $var;
    }
}

function getClientDetails($clientID, $conn){
    $sqlCheckClient = "SELECT * FROM client WHERE clientid= ?";
    $checkClientQuery = $conn->prepare($sqlCheckClient);
    $checkClientQuery->bind_param("i", $clientID);
    $checkClientQuery->execute();
    $result = $checkClientQuery->get_result();
    
    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }else{
        return null;
    }
}

function checkBuildingAddress($buildingaddress, $clientID, $conn){
    $sqlCheckAddress = "SELECT building.buildingid, building.buildingaddress, client.clientID, project.projectID FROM building, project, client WHERE buildingaddress = $buildingaddress AND client.clientid = $clientID AND project.buildingid = building.buildingID AND project.clientid = client.clientid;";
    $checkAddressQuery = $conn->prepare($sqlCheckAddress);
    $checkAddressQuery->bind_param("si", $buildingaddress, $clientID);
    $checkAddressQuery->execute();
    $result = $checkAddressQuery->get_result();

    if($result->num_rows > 0){
        $getRow = $result->fetch_assoc();
        return $getRow["buildingid"];
    }else{
        return null;
    }
}

function insertAllData($clientID, $buildingID, $projectname, $projecttype, $projectDetails, $startdate, $deadlineDate, $budgetconstraint, $workarea, $specialRequests, $projectScope, $conn){
    $INSERT_SQL = "INSERT INTO project (clientID, buildingID, projectName, projectType, projectDetails, startDate, deadlineDate, budgetConstraint, workArea, specialRequests, projectScope) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $INSERT_QUERY  = $conn->prepare($INSERT_SQL);
    $INSERT_QUERY->bind_param("iisssssssss", $clientID, $buildingID, $projectname ,$projecttype, $projectDetails, $startdate, $deadlineDate, $budgetconstraint, $workarea, $specialRequests, $projectScope);
    if($INSERT_QUERY->execute()){
        $newProjectID = $INSERT_QUERY->insert_id;
        if(handleFiles($newProjectID)){
            header("Location: /Pages/Admin/ProjectDetails/projectpage.php?id=".$newProjectID);
        }else{
            echo '<script>console.log("Failed to Handle Files.")</script>';
            return null;
        }
    }else{
        return 1;
    }
}

function handleFiles($projectID){
    // Handle multiple blueprint file uploads
    if (isset($_FILES['blueprint']) && !empty(array_filter($_FILES['blueprint']['name']))) {
        $uploadFile_dir = '../../AttachedFiles/Blueprints/projectBlueprints/blueprint-' . $projectID;

        // Create upload directory if it does not exist
        if (!is_dir($uploadFile_dir)) {
            mkdir($uploadFile_dir, 0755, true);
        }else{
            return null;
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
                return null;
            }
        }
    }else{
        return 1;
    }
}
?>