<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$requestid = $_POST['requestid'];

// Fetch client details from quotation_request to insert into the client table
$sqlFetch = "SELECT clientName, contact FROM quotation_request WHERE requestid='$requestid'";
$result = $conn->query($sqlFetch);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $clientName = $row['clientName'];
    $clientDetails = $row['contact']; // Adjust this field name as per your database schema

    // Insert new client into the client table
    $sqlInsert = "INSERT INTO client (clientName, clientContact) VALUES ('$clientName', '$clientDetails')";
    if ($conn->query($sqlInsert) === TRUE) {
        
        // Update the quotation_request status to 'approved'
        $sqlUpdate = "UPDATE quotation_request SET status='approved' WHERE requestid='$requestid'";
        if ($conn->query($sqlUpdate) === TRUE) {
            echo 'success';
        } else {
            echo 'error: ' . $conn->error; // Add error details
        }
    } else {
        echo 'error: ' . $conn->error; // Add error details
    }
} else {
    echo 'error: ' . $conn->error; // Add error details
}

$conn->close();
?>
