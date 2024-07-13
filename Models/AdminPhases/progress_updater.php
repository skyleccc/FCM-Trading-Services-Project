<?php
header('Content-Type: application/json');
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';


$sql2 = "SELECT ROUND((SUM(isFinished)/COUNT(isFinished))*100, 0) AS progressRate 
         FROM project, client, phase, building 
         WHERE project.projectid = ? 
         AND project.clientid = client.clientid 
         AND project.buildingID = building.buildingID 
         AND project.projectid=phase.projectid";

$projectId = $_GET['id']; // Replace with your project ID
$stmt = $conn->prepare($sql2);
$stmt->bind_param('i', $projectId);

if ($stmt) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'progressRate' => $row['progressRate']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No data found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error executing query: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
}

$conn->close();

?>