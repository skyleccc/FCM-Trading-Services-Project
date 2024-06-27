<?php
require '../Controllers/accessDatabase.php';

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
    $numberOfFiles = ($withBlueprint == 1) ? count($_FILES['blueprint']['name']) : 0; // Get number of files uploaded

    // Handle file upload
    if (isset($_FILES['blueprint'])) {
        $upload_dir = '/home/cjakosalem/web/Projectfolder/FCM-Trading-Services-Project/DB/Uploads';
    
        // Ensure upload directory exists and is writable
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                die("Failed to create upload directory.");
            }
        }
    
        // Loop through each file
        for ($i = 0; $i < $numberOfFiles; $i++) {
            $file_name = $_FILES['blueprint']['name'][$i];
            $file_tmp = $_FILES['blueprint']['tmp_name'][$i];
            $file_target = $upload_dir . '/' . basename($file_name); // Use basename() for security
    
            // Check if file already exists to prevent overwriting
            if (file_exists($file_target)) {
                echo "File already exists: $file_name<br>";
            } else {
                if (move_uploaded_file($file_tmp, $file_target)) {
                    echo "File uploaded successfully: $file_name<br>";
                } else {
                    echo "Failed to upload file: $file_name<br>";
                }
            }
        }
    }
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO quotation_request (clientName, location, siteInformation, servicetype, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, contact, withBlueprint, numberOfFiles) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $requestername, $location, $siteinfo, $servicetype, $startdate, $datecomplete, $projdetails, $areaofwork, $budget_constraints, $specialrequests, $contact, $withBlueprint, $numberOfFiles);

    if ($stmt->execute()) {
        echo "New records created successfully";
        // Redirect to success page after form submission
        header("Location: index.html");
        exit(); // Ensure script stops execution after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCM Trading Services</title>
    <link rel="icon" href="../WebsitePictures/fcmlogo.png">
    <link rel="stylesheet" href="../CSS/general_style.css">
    <link rel="stylesheet" href="../CSS/forms.css">
    <script src="../JS/forms_script.js"></script>
    <script src="../JS/button_for_quotationThing.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     document.addEventListener("DOMContentLoaded", function() {
    const blueprintCheckbox = document.getElementById('blueprint-add');
    const blueprintInput = document.getElementById('blueprint');
    const submitButton = document.querySelector('button[type="submit"]');

    blueprintCheckbox.addEventListener('change', toggleSubmitButton);
    blueprintInput.addEventListener('change', toggleSubmitButton);

    function toggleSubmitButton() {
        const filesAttached = blueprintInput.files.length > 0;
        if (blueprintCheckbox.checked && !filesAttached) {
            submitButton.disabled = true;
            submitButton.style.opacity = '0.5'; // Example: Adjust opacity for visual indication
            submitButton.style.cursor:not-allowed
        } else {
            submitButton.disabled = false;
            submitButton.style.opacity = '1'; // Restore normal opacity if button is enabled
        }
        displayFileList();
    }

    function displayFileList() {
        const fileList = blueprintInput.files;
        const list = document.getElementById('list');
        list.innerHTML = ''; // Clear the list first

        for (let i = 0; i < fileList.length; i++) {
            const listItem = document.createElement('li');
            listItem.textContent = fileList[i].name;
            list.appendChild(listItem);
        }
    }

    // Initial check
    toggleSubmitButton();
});

function displayAttach(){
    var div = document.getElementById('attach-blueprint');
    var div2 = document.getElementById('attachment');
    var attachments = document.getElementById('blueprint');

    attachments.value = "";

    if(div.style.display == "block"){
        div.style.display = "none";
        div2.style.display = "none";
    }else{
        div.style.display = "block";
    }
}

function displayFileList(){
    var div = document.getElementById('attachment');
    var files = document.getElementById('blueprint').files;
    var list = document.getElementById('list');

    while(list.firstChild){
        list.removeChild(list.firstChild);
    }

    for(let i = 0; i<files.length; i++){
        let li = document.createElement("li");
        li.appendChild(document.createTextNode(files[i].name));
        list.appendChild(li);
    }

    div.style.display = "block";
}

    </script>
</head>
<body>
    <div id="navigationBar">
        <div id="navigationBar_logo">
            <img src="../WebsitePictures/fcmlogowhite.png" alt="FCM Logo">
        </div>
        <div id="navigationBar_features" class="h100-w50">
            <a href="../Pages/index.html#homePage_intro" class="h100-w20 hoverable flex-centermiddle">Home</a>
            <a href="../Pages/index.html#homePage_statistics" class="h100-w20 hoverable flex-centermiddle">Trusted Clients</a>
            <a href="../Pages/index.html#homePage_projects" class="h100-w20 hoverable flex-centermiddle">Our Works</a>
            <a href="../Pages/index.html#homePage_quotations" class="h100-w20 hoverable flex-centermiddle">Quotation Form</a>
            <a href="../Pages/login.html" class="h100-w20 hoverable flex-centermiddle">Admin</a>
        </div>
        <div id="navigationBar_button">
            <button class="square-button" onclick="location.href='quotations.html'">Request Quotation</button>
        </div>
    </div>
    <div id="homePage">
        <div class="header-box">
            <div class="header-text h75-w100">
                <h1 class="quotations">Quotation<br>Request Form</h1>
            </div>
            <div class="content-text h25-w100 flex-centermiddle">
                We designed 100+ commercial & residential projects in Cebu & across the Philippines. Providing Construction & Renovation services to everyone.
            </div>
        </div>
        <div class="quotationscontainer">
            <form id="quotationForm"action="quotations.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="requester">Requested By:</label>
                    <input type="text" id="requester" name="requestername" placeholder="Enter Name / Business Here" required>
                </div>
                <div class="form-group_two">
                    <div class="input-group">
                    <label for="loc">Location:</label>
                    <input type="text" id="loc" name="location" placeholder="Enter Location Here" required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                    <label for="site" class="siteinfo">Site Information:</label>
                    <input type="text" id="site" name="siteinfo" placeholder="Type Here..." required>
                    </div>
                </div>
                <div class="form-group_three">
                    <div class="input-group">
                        <label for="servicetype">Service Type:</label>
                        <div>
                            <select id="servicetype" title="Service Type" name="servicetype" required>
                                <option selected value="" disabled>-</option>
                                <option value="Construction">Construction</option>
                                <option value="Renovation">Renovation</option>
                            </select>
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="startdate" class="siteinfo">Start Date:</label>
                        <input type="date" id="startdate" name="startdate" placeholder="Type Here..." required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="datecomplete" class="siteinfo">Date of Completion:</label>
                        <input type="date" id="datecomplete" name="datecomplete" placeholder="Type Here..." required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="details">Project Details:</label>
                    <textarea type="textarea" id="details" name="projdetails" placeholder="Type Here..." required></textarea>
                    <p>Input detailed Information regarding your project to give you a more accurate quote.</p>
                </div>
                <div class="form-group_two">
                    <div class="input-group">
                        <label for="areaofwork">Area of Work:</label>
                        <input type="number" id="areaofwork" name="areaofwork" placeholder="Enter area (sqm.) here..." required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="constraints" class="siteinfo">Budget Constraints:</label>
                        <input type="number" id="constraints" name="budget_constraints" placeholder="Type Here..." required>
                    </div>
                </div>
                <div class="form-group">
                        <label for="specialrequests">Special Requests:</label>
                        <textarea type="textarea" id="specialrequests" name="specialrequests" placeholder="Type Here..."></textarea>
                        <p>Input detailed Information regarding your special requests to give you a more accurate quote.</p>
                </div>
                <div class="form-group">
                    <label for="contact">Email / Contact Number:</label>
                    <input type="text" id="contact" name="contact" placeholder="Enter contact information here..." required>
                </div>
                <div class="form-group_two">
                    <div class="input-group">
                        <label for="blueprint-add" class="toggle">
                            <input id="blueprint-add" class="toggle-checkbox" type="checkbox" name="blueprint-add" onclick="displayAttach();">
                            <div class="toggle-switch"></div>
                            <span class="toggle-label">With Blueprint/Floor Plan</span>
                        </label>
                    </div>
                    <div class="space"></div>
                    
                        <div class="input-group" id="attach-blueprint">
                            <label for="blueprint" class="labelforupload"><i class="fa-solid fa-upload"> ADD BLUEPRINT</i></label>
                            <input type="file" id="blueprint" name="blueprint[]" onchange="displayFileList();" multiple>
                        </div>
                    
                </div>
                
                <div id="attachment" class="w100">
                    <div class="bold">
                        Attached Files:
                    </div>
                    <div id="attached-filelist">
                        <ul id="list">
                        </ul>
                    </div>
                </div>
                <button type="submit" name="submit" class="disabled-button" disabled>Request for Quotation</button>
            </form>
        </div>
    </div>
</body>
</html>
