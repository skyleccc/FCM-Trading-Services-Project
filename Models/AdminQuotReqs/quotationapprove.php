<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$requestid = $_POST['requestid'];

$requesterQuery = "SELECT clientName, contact FROM quotation_request WHERE requestid='$requestid'";
$requesterResult = $conn->query($requesterQuery);

if ($requesterResult && $requesterResult->num_rows > 0) {
    $row = $requesterResult->fetch_assoc();
    $requesterName = $row['clientName'];
    $requesterContact = $row['contact'];

    // Check if there are clients with the same name as the requester
    $clientQuery = "SELECT COUNT(*) as clientCount FROM client WHERE clientName='$requesterName'";
    $clientResult = $conn->query($clientQuery);

    if ($clientResult) {
        $clientRow = $clientResult->fetch_assoc();
        $clientCount = $clientRow['clientCount'];

        if ($clientCount > 0) {
            echo '<script>alert("Client already exists.");</script>';
        } else {
            
            // Insert client information into client table
            $insertClientQuery = "INSERT INTO client (clientName, clientContact) VALUES ('$requesterName', '$requesterContact')";
            
            if ($conn->query($insertClientQuery) === TRUE) {
                // Update quotation_request status to approved
                $updateQuery = "UPDATE quotation_request SET status='approved' WHERE requestid='$requestid'";

                if ($conn->query($updateQuery) === TRUE) {
                    echo 'success';
                } else {
                    echo 'error: ' . $conn->error; // Add error details
                }
            } else {
                echo 'error: ' . $conn->error; // Add error details
            }
        }
    } else {
        echo 'error: ' . $conn->error; // Add error details
    }
} else {
    echo 'error: Requester information not found.';
}

$conn->close();
?>
