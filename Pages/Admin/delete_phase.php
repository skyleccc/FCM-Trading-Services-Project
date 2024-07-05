<?php
require '../../Controllers/accessDatabase.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phaseid = $_POST['phaseid'];

    // Debugging: Log the received phaseid
    error_log("Received phaseid: " . $phaseid);

    $sql = "DELETE FROM phase WHERE phaseid = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Prepare failed: " . $conn->error);
        echo 'error';
        exit;
    }

    $stmt->bind_param("i", $phaseid);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        error_log("Execute failed: " . $stmt->error);
        echo 'error';
    }

    $stmt->close();
}

$conn->close();
?>
