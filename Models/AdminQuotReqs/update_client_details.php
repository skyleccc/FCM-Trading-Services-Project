<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $clientID = $_POST['clientid'];
    $clientContact = $_POST['clientcontact'];
    $clientEmail = $POST_['clientemail'];

    $updateClientSQL = "UPDATE client SET clientContact = ?, clientEmail = ? WHERE clientID = ?";
    $updateClientQuery = $conn->prepare($updateClientSQL);
    $updateClientQuery->bind_param('ssi', $clientContact, $clientEmail, $clientID);
    
    if($updateClientQuery->execute()){
        echo json_encode(['success' => true, 'message' => 'Contact updated.']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Update failed.']);
    }

}else{
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
}
?>
