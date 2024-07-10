<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$requestid = $_POST['requestid'];
$sql = "UPDATE quotation_request SET status='approved' WHERE requestid='$requestid'";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error: ' . $conn->error; // Add error details
}

$conn->close();
?>