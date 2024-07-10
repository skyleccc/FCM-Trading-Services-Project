<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$redirectAfter = "Location: ../../Pages/Admin/QUotationReqsList/quotationreqs.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projectname'])) {
    $requestername = isset($_POST['requestername']) ? $_POST['requestername'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $siteinfo = isset($_POST['siteinfo']) ? $_POST['siteinfo'] : '';
    $servicetype = isset($_POST['servicetype']) ? $_POST['servicetype'] : '';
    $startdate = isset($_POST['startdate']) ? $_POST['startdate'] : '';
    $datecomplete = isset($_POST['datecomplete']) ? $_POST['datecomplete'] : '';
    $projdetails = isset($_POST['projdetails']) ? $_POST['projdetails'] : '';
    $areaofwork = isset($_POST['areaofwork']) ? $_POST['areaofwork'] : '';
    $budget_constraints = isset($_POST['budget_constraints']) ? $_POST['budget_constraints'] : '';
    $specialrequests = isset($_POST['specialrequests']) ? $_POST['specialrequests'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $withBlueprint = isset($_POST['blueprint-add']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO quotation_request (clientName, location, siteInformation, servicetype, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, contact, withBlueprint, numberOfFiles) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $requestsername, $location, $siteinfo, $servicetype, $startdate, $datecomplete, $projdetails, $areaofwork, $budget_constraints, $specialrequests, $contact, $withBlueprint, $validFiles);

    if ($save->execute()) {
        header($redirectAfter);
        exit();
    } else {
        echo "Error updating project: " . $conn->error;
        exit();
    }
}
?>
