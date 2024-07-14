<?php

header('Content-Type: application/json');
require '../../Controllers/accessDatabase.php';

if (isset($_GET['clientID'])) {
    $clientID = $conn->real_escape_string($_GET['clientID']);
    
    $query = "SELECT clientName, clientContact, clientEmail FROM client WHERE clientID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $clientID);
    $stmt->execute();
    $result = $stmt->get_result();
    $clientData = $result->fetch_assoc();
    
    if ($clientData) {
        echo json_encode($clientData);
    } else {
        echo json_encode(['error' => 'Client not found']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'Client ID not provided']);
}

$conn->close();
?>