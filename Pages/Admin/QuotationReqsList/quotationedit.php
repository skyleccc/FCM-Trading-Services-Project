<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';
require '../../../Models/AdminProjects/filldata_modal.php';
$sql = "SELECT clientName, location, siteInformation, servicetype, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, contact, withBlueprint, numberOfFiles FROM quotation_request";

$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link rel="icon" href="../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
  
<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            // Navigation Bar for Admin Dashboard
            include '../../../Components/adminNavBar.php'
            ?>
            <div class="col-sm-10 p-3 border bg-light">
                <div style="font-size: 23px;">
                </div>
                <div class="row p-3 border bg-light">   
                    <div class="col-sm-12">
                        <div class="container">
                            <img src="../../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
                        </div>
                        <div class="col p-2 addbtn">
                            <div class="row p-3 border bg-light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col" style="margin: 10px; font-size: 2vw;">Projects List</div>
                                <div class="col-sm-3" style="margin: 10px;">
                                   <button class="button-style" id="myBtn" style="background-color: rgb(19, 171, 19);width: 200px; height: 50px; font-weight: lighter; margin-left:37%;"><div class="col" style="background-color: rgb(19, 171, 19); font-size: 1.4vw; color: white;">
                                    <span class="material-symbols-outlined" style="font-size: 30px; color: white;">note_add</span> Add A Project
                                    </div></button> 
                                </div><br><br>
                                <div class="ex1"><div class="row projrow">
                                    <div class="container">
                                        <div class="row" style="color: black">
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '
                                                        <div class="quotationscontainer">
                                                        <form id="quotationForm" action="../Models/QuotationReqs/fileUpload.php" method="post" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="requester">Requested By:</label>
                                                            <input type="text" id="requester" name="requestername" placeholder="Enter Name / Business Here" value="<?php echo htmlspecialchars($requestername); ?>" required>
                                                        </div>
                                                        <div class="form-group_two">
                                                            <div class="input-group">
                                                                <label for="loc">Location:</label>
                                                                <input type="text" id="loc" name="location" placeholder="Enter Location Here" value="<?php echo htmlspecialchars($location); ?>" required>
                                                            </div>
                                                            <div class="space"></div>
                                                            <div class="input-group">
                                                                <label for="site" class="siteinfo">Site Information:</label>
                                                                <input type="text" id="site" name="siteinfo" placeholder="Type Here..." value="<?php echo htmlspecialchars($siteinfo); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group_three">
                                                            <div class="input-group">
                                                                <label for="servicetype">Service Type:</label>
                                                                <select id="servicetype" title="Service Type" name="servicetype" required>
                                                                    <option value="Construction" <?php echo htmlspecialchars($servicetype); ?>>Construction</option>
                                                                    <option value="Renovation" <?php echo htmlspecialchars($servicetype); ?>>Renovation</option>
                                                                </select>
                                                            </div>
                                                            <div class="space"></div>
                                                            <div class="input-group">
                                                                <label for="startdate" class="siteinfo">Start Date:</label>
                                                                <input type="date" id="startdate" name="startdate" placeholder="Type Here..." value="<?php echo htmlspecialchars($startdate); ?>" required>
                                                            </div>
                                                            <div class="space"></div>
                                                            <div class="input-group">
                                                                <label for="datecomplete" class="siteinfo">Date of Completion:</label>
                                                                <input type="date" id="datecomplete" name="datecomplete" placeholder="Type Here..." value="<?php echo htmlspecialchars($datecomplete); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="details">Project Details:</label>
                                                            <textarea type="textarea" id="details" name="projdetails" placeholder="Type Here..." required><?php echo htmlspecialchars($projdetails); ?></textarea>
                                                            <p>Input detailed Information regarding your project to give you a more accurate quote.</p>
                                                        </div>
                                                        <div class="form-group_two">
                                                            <div class="input-group">
                                                                <label for="areaofwork">Area of Work:</label>
                                                                <input type="number" id="areaofwork" name="areaofwork" placeholder="Enter area (sqm.) here..." value="<?php echo htmlspecialchars($areaofwork); ?>" required>
                                                            </div>
                                                            <div class="space"></div>
                                                            <div class="input-group">
                                                                <label for="constraints" class="siteinfo">Budget Constraints:</label>
                                                                <input type="number" id="constraints" name="budget_constraints" placeholder="Type Here..." value="<?php echo htmlspecialchars($budget_constraints); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="specialrequests">Special Requests:</label>
                                                            <textarea type="textarea" id="specialrequests" name="specialrequests" placeholder="Type Here..."><?php echo htmlspecialchars($specialrequests); ?></textarea>
                                                            <p>Input detailed Information regarding your special requests to give you a more accurate quote.</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contact">Email / Contact Number:</label>
                                                            <input type="text" id="contact" name="contact" placeholder="Enter contact information here..." value="<?php echo htmlspecialchars($contact); ?>" required>
                                                        </div>
                                                        <div class="form-group_two">
                                                            <div class="input-group">
                                                                <label for="blueprint-add" class="toggle">
                                                                    <input id="blueprint-add" class="toggle-checkbox" type="checkbox" name="blueprint-add" <?php echo htmlspecialchars($withBlueprint);>
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
                                                    ';
                                                }
                                            } else {
                                                echo '<p>No projects found</p>'; // edit add something nga pwede mupakita kung way projects
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div></div>
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <?php
                    // Edit Project Modal
                    require '../../../Components/ProjectsModals/editProjectModal.php';
                ?>
                
        </div>   
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="../../../JS/projects_script.js"></script>
</body>
</html>