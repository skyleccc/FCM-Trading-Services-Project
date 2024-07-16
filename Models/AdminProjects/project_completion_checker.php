<?php
require '../../Controllers/accessDatabase.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $projectID = $input['projectID'];

    if (!$projectID) {
        echo json_encode(['success' => false, 'message' => 'Invalid project ID']);
        exit;
    }

    // Check if all phases of the project are complete
    $query = "SELECT COUNT(*) AS total_phases, 
              SUM(CASE WHEN isFinished = 1 THEN 1 ELSE 0 END) AS finished_phases
              FROM phase 
              WHERE projectID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $projectID);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    $totalPhases = $result['total_phases'];
    $finishedPhases = $result['finished_phases'];

    $isComplete = ($totalPhases == $finishedPhases) ? 1 : 0;
    $completionDate = ($isComplete == 1) ? date('Y-m-d') : NULL;

    // Update the project's isComplete status and completionDate
    $updateQuery = "UPDATE project SET isComplete = ?, completionDate = ? WHERE projectID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('isi', $isComplete, $completionDate, $projectID);
    if ($updateStmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update project completion status']);
    }
}
?>