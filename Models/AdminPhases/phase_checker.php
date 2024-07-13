<?php
header('Content-Type: application/json');

require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$input = json_decode(file_get_contents('php://input'), true);
$phaseID = $input['phaseID'];
$isFinished = $input['isFinished'];

$sql = "UPDATE phase SET isFinished = ? WHERE phaseID = ?";
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