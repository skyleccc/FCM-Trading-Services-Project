<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestId = $_POST['requestId'];
    $action = $_POST['action'];
    
    if ($action === 'approve') {
        $sql = "UPDATE quotation_request SET status = 'approved' WHERE requestid = ?";
    } elseif ($action === 'decline') {
        $sql = "UPDATE quotation_request SET status = 'declined' WHERE requestid = ?";
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        exit;
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $requestId);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => ucfirst($action) . ' successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
