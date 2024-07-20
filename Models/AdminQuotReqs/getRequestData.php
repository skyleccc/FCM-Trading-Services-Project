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

    $requestID = isset($requestData['requestID']) ? $requestData['requestID'] : null;
    $clientName = isset($requestData['clientName']) ? $requestData['clientName'] : null;
    $location = isset($requestData['location']) ? $requestData['location'] : null;
    $siteInformation = isset($requestData['siteInformation']) ? $requestData['siteInformation'] : null;
    $serviceType = isset($requestData['serviceType']) ? $requestData['serviceType'] : null;
    $startDate = isset($requestData['startDate']) ? $requestData['startDate'] : null;
    $completeDate = isset($requestData['completeDate']) ? $requestData['completeDate'] : null;
    $projectDetails = isset($requestData['projectDetails']) ? $requestData['projectDetails'] : null;
    $workArea = isset($requestData['workArea']) ? $requestData['workArea'] : null;
    $budgetConstraint = isset($requestData['budgetConstraint']) ? $requestData['budgetConstraint'] : null;
    $specialRequests = isset($requestData['specialRequests']) ? $requestData['specialRequests'] : null;
    $clientContact= isset($requestData['clientContact']) ? $requestData['clientContact'] : null;
    $clientEmail = isset($requestData['clientEmail']) ? $requestData['clientEmail'] : null;

    echo json_encode([
        // Request Data
        'requestID' => $requestID,
        'clientName' => $clientName,
        'location' => $location,
        'siteInformation' => $siteInformation,
        'projectType' => $serviceType,
        'startDate' => $startDate,
        'completeDate' => $completeDate,
        'projectDetails' => $projectDetails,
        'workArea' => $workArea,
        'budgetConstraint' => $budgetConstraint,
        'specialRequests' => $specialRequests,
        'clientContact' => $clientContact,
        'clientEmail' => $clientEmail,
    ]);

}else{
    echo json_encode(['success' => false, 'message' => 'Request not found', 'request_id' => null]);
}

$findRequestQuery->close();
$conn->close();
}else{
    echo json_encode(['success' => false, 'message' => 'Unauthorized access', 'request_id' => null]);
}

?>
