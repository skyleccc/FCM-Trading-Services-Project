<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $clientID = $_POST['clientid'];
    $buildingID = $_POST['buildingid'];
    $projectName = $_POST['projectname'];
    $projectType = $_POST['projecttype'];
    $projectDetails = $_POST['projectdetails'];
    $startDate = $_POST['startdate'];
    $deadlineDate = $_POST['deadlinedate'];
    $budgetConstraint = $_POST['budgetconstraint'];
    $workArea = $_POST['workarea'];
    $specialRequests = $_POST['specialrequests'];
    $projectScope = $_POST['projectscope'];

    // Prepare the SQL statement with the VALUES clause
    $createProjSQL = "INSERT INTO project (clientID, buildingID, projectName, projectType, projectDetails, startDate, deadlineDate, budgetConstraint, workArea, specialRequests, projectScope) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $createProjQuery = $conn->prepare($createProjSQL);

    // Bind parameters to the SQL statement
    $createProjQuery->bind_param('iisssssssss', $clientID, $buildingID, $projectName, $projectType, $projectDetails, $startDate, $deadlineDate, $budgetConstraint, $workArea, $specialRequests, $projectScope);

    if($createProjQuery->execute()){
        $projectID = $createProjQuery->insert_id;
        echo json_encode(['success' => true, 'message' => 'Project added', 'projectid' => $projectID]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Add project failed']);
    }

    // Close the statement and the connection
    $createProjQuery->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
}
?>
