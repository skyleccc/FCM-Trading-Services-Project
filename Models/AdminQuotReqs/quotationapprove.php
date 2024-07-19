<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';


if($_SERVER['REQUEST_METHOD'] === "POST"){
// Get the client name from the POST request
$requestID = $_POST['requestid'];

// Check if requestID is in the database
$findRequestSQL = "SELECT * FROM quotation_request WHERE requestID = ?";
$findRequestQuery = $conn->prepare($findRequestSQL);
$findRequestQuery->bind_param('i', $requestID);
$findRequestQuery->execute();
$findRequestResult = $findRequestQuery->get_result();

if($findRequestResult->num_rows > 0){
    // Approve the request
    $reqApproveSQL = "UPDATE quotation_request SET status='approved' WHERE requestID = ?";
    $reqApproveQuery = $conn->prepare($reqApproveSQL);
    $reqApproveQuery->bind_param('i', $requestID);
    $reqApproveQuery->execute();

    if($reqApproveQuery->affected_rows > 0){
        // Get the request data
        $requestData = $findRequestResult->fetch_assoc();

        // If approved, then check database if there is client with same name
        $findClientSQL = "SELECT * FROM client WHERE clientName = ?";
        $findClientQuery = $conn->prepare($findClientSQL);
        $findClientQuery->bind_param('s', $requestData['clientName']);
        $findClientQuery->execute();
        $findClientResult = $findClientQuery->get_result();

        if($findClientResult->num_rows > 0){
            // If found, then return the clientID
            $clientData = $findClientResult->fetch_assoc();
            $clientID = ($clientData['clientID']);
            $clientName = $clientData['clientName'];
            $clientContact = !empty($clientData['clientContact']) ? $clientData['clientContact'] : 'No Contact Number.';
            $clientEmail = !empty($clientData['clientEmail']) ? $clientData['clientEmail'] : 'No Email Address.';
            echo json_encode(['client_id' => $clientID, 'client_name' => $clientName, 'client_contact' => $clientContact, 'client_email' => $clientEmail]);
        }else{
            // If not found, return null
            echo json_encode(['client_id' => null]);
        }
    }else{
        echo json_encode(['success' => false, 'message' => 'Client not found', 'client_id' => null]);
    }

}else{
    echo json_encode(['success' => false, 'message' => 'Request not found', 'client_id' => null]);
}

$findRequestQuery->close();
if (isset($reqApproveQuery)) $reqApproveQuery->close();
if (isset($findClientQuery)) $findClientQuery->close();
$conn->close();
}



// $requestid = $_POST['requestid'];

// $requesterQuery = "SELECT clientName, contact FROM quotation_request WHERE requestid='$requestid'";
// $requesterResult = $conn->query($requesterQuery);

// if ($requesterResult && $requesterResult->num_rows > 0) {
//     $row = $requesterResult->fetch_assoc();
//     $requesterName = $row['clientName'];
//     $requesterContact = $row['contact'];

//     // Check if there are clients with the same name as the requester
//     $clientQuery = "SELECT COUNT(*) as clientCount FROM client WHERE clientName='$requesterName'";
//     $clientResult = $conn->query($clientQuery);

//     if ($clientResult) {
//         $clientRow = $clientResult->fetch_assoc();
//         $clientCount = $clientRow['clientCount'];

//         if ($clientCount > 0) {
//             echo '<script>alert("Client already exists.");</script>';
//         } else {
            
//             // Insert client information into client table
//             $insertClientQuery = "INSERT INTO client (clientName, clientContact) VALUES ('$requesterName', '$requesterContact')";
            
//             if ($conn->query($insertClientQuery) === TRUE) {
//                 // Update quotation_request status to approved
//                 $updateQuery = "UPDATE quotation_request SET status='approved' WHERE requestid='$requestid'";

//                 if ($conn->query($updateQuery) === TRUE) {
//                     echo 'success';
//                 } else {
//                     echo 'error: ' . $conn->error; // Add error details
//                 }
//             } else {
//                 echo 'error: ' . $conn->error; // Add error details
//             }
//         }
//     } else {
//         echo 'error: ' . $conn->error; // Add error details
//     }
// } else {
//     echo 'error: Requester information not found.';
// }

// $conn->close();
?>
