<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$requestid = $_POST['requestid'];

// Fetch client details from quotation_request to insert into the client table
$sqlFetch = "SELECT clientName, clientContact, clientEmail FROM quotation_request WHERE requestid=?";
$queryFetch = $conn->prepare($sqlFetch);
$queryFetch->bind_param('i', $requestid);
$queryFetch->execute();
$queryResult = $queryFetch->get_result();

if ($queryResult && $queryResult->num_rows > 0) {
    $row = $queryResult->fetch_assoc();
    $clientName = $row['clientName'];
    $clientContact = isset($row['clientContact']) ? $row['$clientContact'] : null;
    $clientEmail = isset($row['clientEmail']) ? $row['clientEmail'] : null;

    // Insert new client into the client table
    $sqlInsert = "INSERT INTO client (clientName, clientContact, clientEmail) VALUES ($clientName, $clientContact, $clientEmail)";
    $queryInsert = $conn->prepare($sqlInsert);
    $queryInsert->bind_param('sss', $clientName, $clientContact, $clientEmail);

    if($queryInsert->execute()){
        $clientID = $queryInsert->insert_id;
        echo json_encode(['client_id' => $clientID]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Failed to Add Client', 'client_id' => null]);
    }
   
} else {
    echo json_encode(['success' => false, 'message' => 'Request not found', 'client_id' => null]);
}

$conn->close();
?>
