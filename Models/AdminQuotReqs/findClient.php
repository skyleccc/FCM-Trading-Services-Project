<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientName = $_POST['clientname'];

    $findClientSQL = "SELECT * FROM client WHERE clientName = ?";
    $findClientQuery = $conn->prepare($findClientSQL);
    $findClientQuery->bind_param('s', $clientName);
    $findClientQuery->execute();
    $findClientResult = $findClientQuery->get_result();

    if ($findClientResult->num_rows > 0) {
        $data = $findClientResult->fetch_assoc();
        echo json_encode(['success' => true, 'exists' => true, 'client_id' => $data['clientID'], 'client_name' => $data['clientName'], 'client_contact' => $data['clientContact'], 'client_email' => $data['clientEmail']]);
    } else {
        echo json_encode(['success' => true, 'exists' => false, 'message' => 'No client found', 'client_id' => null]);
    }

    // Close the statement and connection
    $findClientQuery->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'exists' => false, 'message' => 'Unauthorized access']);
}
?>
