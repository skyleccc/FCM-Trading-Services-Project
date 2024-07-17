<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$requesterID = $_GET['id'];

$redirectAfter = "Location: ../../Pages/Admin/QuotationReqsList/quotationreqs.php";
$sql = "UPDATE quotation_request SET clientName = ?, location = ?, siteInformation = ?, serviceType = ?, startDate = ?, completeDate = ?, projectDetails = ?, workArea = ?, budgetConstraint = ?, specialRequests = ?, clientcontact = ?, clientemail = ?  WHERE requestID = ?";
$dataType = "ssssssssisssi";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
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
    $contact = isset($_POST['contact']) ? $_POST['contact'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $withBlueprint = isset($_POST['blueprint-add']) ? 1 : 0;

    $allowed_ext = array('jpg', 'jpeg', 'png', 'svg', 'webp', 'apng', 'avif', 'ico', 'cur', 'bmp', 'jfif', 'pdf');

    // Validate files
    if (isset($_FILES['blueprint']) && $_FILES['blueprint']['error'][0] != UPLOAD_ERR_NO_FILE) {
        $validFiles = 0;
        $invalidFiles = [];
        $dir = '../../AttachedFiles/Blueprints/quotationRequestBlueprints/blueprint-';

        for ($i = 0; $i < count($_FILES['blueprint']['name']); $i++) {
            $file_name = $_FILES['blueprint']['name'][$i];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Validate file extension
            if (!in_array($file_ext, $allowed_ext)) {
                $invalidFiles[] = $file_name;
            } else {
                $validFiles++;
            }
        }

        if (!empty($invalidFiles)) {
            echo '<script>alert("The following files are invalid: ' . implode(", ", $invalidFiles) . '"); window.history.back();</script>';
            exit(); // Stop further execution
        } else {
            $sql = "UPDATE quotation_request SET clientName = ?, location = ?, siteInformation = ?, serviceType = ?, startDate = ?, completeDate = ?, projectDetails = ?, workArea = ?, budgetConstraint = ?, specialRequests = ?, clientcontact = ?, clientemail = ?, withBluePrint = ?, numberOfFiles = ? WHERE requestID = ?";
            $dataType = "ssssssssisssiii";

            if ($validFiles > 0) {
                $uploadFile_dir = $dir . $requesterID;

                // Create upload directory if it does not exist
                if (!is_dir($uploadFile_dir)) {
                    if (!mkdir($uploadFile_dir, 0755, true)) {
                        die("Failed to create upload directory.");
                    }
                }

                for ($i = 0; $i < count($_FILES['blueprint']['name']); $i++) {
                    $file_name = $_FILES['blueprint']['name'][$i];
                    $file_tmp = $_FILES['blueprint']['tmp_name'][$i];
                    $file_target = $uploadFile_dir . '/' . basename($file_name); // Use basename() for security

                    if (!move_uploaded_file($file_tmp, $file_target)) {
                        echo "Failed to upload file: $file_name<br>";
                    }
                }
            }
        }
    }

    $stmt = $conn->prepare($sql);
    // Bind parameters directly to the prepared statement
    if (strpos($sql, 'withBluePrint') !== false) {
        $stmt->bind_param($dataType, $requestername, $location, $siteinfo, $servicetype, $startdate, $datecomplete, $projdetails, $areaofwork, $budget_constraints, $specialrequests, $contact, $email, $withBlueprint, $validFiles, $requesterID);
    } else {
        $stmt->bind_param($dataType, $requestername, $location, $siteinfo, $servicetype, $startdate, $datecomplete, $projdetails, $areaofwork, $budget_constraints, $specialrequests, $contact, $email, $requesterID);
    }

    if ($stmt->execute()) {
        header($redirectAfter);
        exit();
    } else {
        echo "Error updating project: " . $stmt->error;
        exit();
    }
}
?>
