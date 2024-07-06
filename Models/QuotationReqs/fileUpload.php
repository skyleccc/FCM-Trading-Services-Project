<?php

$allowed_ext = array('jpg', 'jpeg', 'png', 'svg', 'webp', 'apng', 'avif', 'ico', 'cur', 'bmp', 'jfif', 'pdf');

// Check if form data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Validate files
    $validFiles = 0;
    $invalidFiles = [];

    if (isset($_FILES['blueprint'])) {
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
    }

    // Check if all files are valid
    if (!empty($invalidFiles)) {
        echo '<script>alert("The following files are invalid: ' . implode(", ", $invalidFiles) . '"); window.history.back();</script>';
        exit(); // Stop further execution
    } else {
        // Proceed with database insertion and file upload if all files are valid
        $stmt = $conn->prepare("INSERT INTO quotation_request (clientName, location, siteInformation, servicetype, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, contact, withBlueprint, numberOfFiles) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $requestername, $location, $siteinfo, $servicetype, $startdate, $datecomplete, $projdetails, $areaofwork, $budget_constraints, $specialrequests, $contact, $withBlueprint, $validFiles);

        if ($stmt->execute()) {
            // Retrieve the last inserted ID
            $quotationRequestId = $stmt->insert_id;

            // Handle file upload
            if ($validFiles > 0) {
                $upload_dir = 'D:\College\IM2\FCM-Trading-Services-Project\AttachedFiles\Blueprints\blueprint-' . $quotationRequestId;

                // Create upload directory if it does not exist
                if (!is_dir($upload_dir)) {
                    if (!mkdir($upload_dir, 0755, true)) {
                        die("Failed to create upload directory.");
                    }
                }

                for ($i = 0; $i < count($_FILES['blueprint']['name']); $i++) {
                    $file_name = $_FILES['blueprint']['name'][$i];
                    $file_tmp = $_FILES['blueprint']['tmp_name'][$i];
                    $file_target = $upload_dir . '/' . basename($file_name); // Use basename() for security

                    if (!move_uploaded_file($file_tmp, $file_target)) {
                        echo "Failed to upload file: $file_name<br>";
                    }
                }
            }

            echo "New records created successfully";
            // Redirect to success page after form submission
            header("Location: landingpage.php");
            exit(); // Ensure script stops execution after redirection
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>
