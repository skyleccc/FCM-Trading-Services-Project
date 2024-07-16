<?php
header('Content-Type: application/json');

require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$input = json_decode(file_get_contents('php://input'), true);
$phaseID = $input['phaseID'];
$isFinished = $input['isFinished'];

// $sqlCheckFinish = "SELECT actualFinishDate FROM phase WHERE phaseID = ?";
// $checkFinishQuery = $conn->prepare($sqlCheckFinish);
// $checkFinishQuery->bind_param('i', $isFinished);
// $resultFinishQuery = $checkFinishQuery->execute();

if($isFinished == 1){
    $sql = "UPDATE phase SET isFinished = ?, actualFinishDate = CURRENT_TIMESTAMP() WHERE phaseID = ?";
}else{
    $sql = "UPDATE phase SET isFinished = ?, actualFinishDate = NULL WHERE phaseID = ?";
}

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('ii', $isFinished, $phaseID);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating record: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
}

$conn->close();
?>