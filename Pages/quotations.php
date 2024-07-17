<?php
require '../Controllers/accessDatabase.php';
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
    <script src="../JS/quotationreq_script.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php 
    // NAVIGATION BAR
    include '../Components/navigationBar.php'
    ?>
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
            <form id="quotationForm"action="../Models/QuotationReqs/fileUpload.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
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
                        <label for="datecomplete" class="siteinfo">Deadline:</label>
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
                <div class="form-group_two">
                    <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Enter contact information here..." >
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                    <label for="contact">Contact Number:</label>
                    <input type="text" id="contact" name="contact" placeholder="Enter contact information here..." >
                    </div>
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