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
        // Get the request data
        $requestData = $findRequestResult->fetch_assoc();

        // Check database if there is client with same name
        $findClientSQL = "SELECT * FROM client WHERE clientName = ?";
        $findClientQuery = $conn->prepare($findClientSQL);
        $findClientQuery->bind_param('s', $requestData['clientName']);
        $findClientQuery->execute();
        $findClientResult = $findClientQuery->get_result();

        if($findClientResult->num_rows > 0){
            // If found, then return the client details
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
    echo json_encode(['success' => false, 'message' => 'Request not found', 'client_id' => null]);
}

$findRequestQuery->close();
if (isset($findClientQuery)) $findClientQuery->close();
$conn->close();
}else{
    echo json_encode(['success' => false, 'message' => 'Unauthorized access', 'client_id' => null]);
}

?>