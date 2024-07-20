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

    if($reqApproveQuery->execute()){
        echo json_encode(['success' => true, 'message' => 'Approve successful']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Approve failed']);
    }
    

}else{
    echo json_encode(['success' => false, 'message' => 'Request not found']);
}

$findRequestQuery->close();
if (isset($reqApproveQuery)) $reqApproveQuery->close();
if (isset($findClientQuery)) $findClientQuery->close();
$conn->close();
}else{
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
}
?>
