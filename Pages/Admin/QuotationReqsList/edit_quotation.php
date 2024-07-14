<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT requestid, serviceType, clientName, Location FROM quotation_request WHERE status='pending'";
$sql2 = $conn->prepare("SELECT requestid, clientname, location, siteinformation, servicetype, startdate, completedate, projectdetails, workarea, budgetconstraint, specialrequests, contact, withblueprint, numberoffiles, status FROM quotation_request WHERE requestid = ?");
$sql2->bind_param("i", $id);
$sql2->execute();
$result2 = $sql2->get_result();

$result = $conn->query($sql);
$row2 = $result2->fetch_assoc();

$requestID = $row2['requestid'];
$clientname = $row2['clientname'];
$location = $row2['location'];
$siteinformation = $row2['siteinformation'];
$servicetype = $row2['servicetype'];
$startdate = $row2['startdate'];
$completedate = $row2['completedate'];
$projectdetails = $row2['projectdetails'];
$workarea = $row2['workarea'];
$budgetconstraint = $row2['budgetconstraint'];
$specialrequests = $row2['specialrequests'];
$contact = $row2['contact'];
$withblueprint = $row2['withblueprint'];
$numberoffiles = $row2['numberoffiles'];
$status = $row2['status'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/quotationreqs_styles.css">
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> 
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include '../../../Components/adminNavBar.php'
            ?>
            <div class="col-sm-10 p-3 border bg light">
                <div style="font-size: 23px;">
                   
                </div>
                <div class="row p-3 border bg light">   
                    <div class="col-sm-12">
                        <div class="container">
                            <img src="../../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
                        </div>
                        <div class="col p-2 addbtn">
                            <div class="row p-3 border bg light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col" style="margin: 10px; font-size: 2vw;">Quotation Requests List</div>
                                <div class="col-sm-4" style="margin: 10px;">
                                   <!-- <button class="button-style" id="myBtn" style="background-color: rgb(19, 171, 19);width: 280px; height: 50px;    font-weight: lighter; margin-left:32%;"><div class="col" style="background-color: rgb(19, 171, 19); font-size: 1.2vw; color: white;">
                                    <span class="material-symbols-outlined" style="font-size: 30px; color: white;">note_add</span> Add A Quotation Request
                                    </div></button>  -->
                                    </div><br><br>

                                <div class="ex1"><div class="row projrow">
                                <div class="container">
                                <div class="row" style="color: black">
                                        
                                        
                                                
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo
                                                        '
                                                        <div class="col-sm-4 border bg light proj_cont" style="margin-top: 1%;">
                                        
                                                        <div class="row" style="color: black">
                                                        <div class="col-sm-10">
                                                            <a href="quotationedit.php?id=' . htmlspecialchars($row["requestid"]) . '" class="row p-2" style="margin: auto; text-decoration: none;">
                                                                <div class="row" style="margin: auto; margin-top: 3%;">
                                                                    <div class="col p-1">
                                                                        <div style="font-weight: bold;text-align: center;font-size: 1.6vw; color: black;">' . htmlspecialchars($row["Location"]) . '</div>
                                                                        <div style="font-weight: lighter; text-align: center; font-size: 1vw; color: black;" >' . htmlspecialchars($row["clientName"]) . '</div>
                                                                        <div style="font-weight: lighter; text-align: center; font-size: 1.2vw; color:#40ce55" >' . htmlspecialchars($row["serviceType"]) . '</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col" style="margin-top: 10px;">
                                                                    <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 100%;color: rgb(255, 255, 255);"> Progress</div>
                                                                    <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 100%; color: rgb(255, 251, 251); margin-top: 5px;"> Deadline</div>
                                                                </div>
                                                            </a>
                                                            </div>
                                                            
                                                            <div class="col-sm-2 border bg-light">
                                                                <button class="button-style approve-btn" data-id="' . htmlspecialchars($row["requestid"]) . '" style="margin-top: 8px;">
                                                                    <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                                                        <span class="material-symbols-outlined" style="font-size: 1.5vw;">check_circle</span>
                                                                    </div>
                                                                </button>
                                                                <button class="button-style decline-btn" data-id="' . htmlspecialchars($row["requestid"]) . '" style="margin-top: 8px; margin-bottom: 10px;">
                                                                        <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                                                            <span class="material-symbols-outlined"  style="font-size: 1.5vw;">cancel</span>

                                                                        </div>
                                                                    </button>

                                                            </div>
                                                            </div>
                                                            </div>
                                                    ';
                                                        }
                                                    } else {
                                                        echo '<p>No projects found</p>';
                                                    }
                                            ?>
                                       
                                       </div>
                                        </div>
                                    </div>
                                
                                </div>
                        <br><br><br></div>
                        </div>
                    </div>
                </div>
            </div>
                                                    
            <div class="col modalblock">
                <div id="myModal" class="popup"style="display: block;">
                    <div class="quotationscontainer">
                    <div class="ex1 border bg light rounded">
                    <form id="quotationForm" class="p-3" action="../../../Models/AdminQuotReqs/quotationedit.php?id=<?php echo $requestID; ?>" method="post" enctype="multipart/form-data">
                        <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">
                        <span class="material-symbols-outlined editdone">edit</span>
                        Enter a new Project
                        <span class="close">&times;</span>
                        </div><br>
                        <div class="form-group">
                    <label for="requester">Requested By:</label>
                    <input type="text" id="requester" name="requestername" value="<?php echo htmlspecialchars($clientname); ?>" required>
                </div>
                <div class="form-group_two">
                    <div class="input-group">
                    <label for="loc">Location:</label>
                    <input type="text" id="loc" name="location" value="<?php echo htmlspecialchars($location); ?>" required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                    <label for="site" class="siteinfo">Site Information:</label>
                    <input type="text" id="site" name="siteinfo" value="<?php echo htmlspecialchars($siteinformation); ?>" required>
                    </div>
                </div>
                <div class="form-group_three">
                    <div class="input-group">
                        <label for="servicetype">Service Type:</label>
                        <div>
                            <select id="servicetype" title="Service Type" name="servicetype" required>
                                <option selected value="<?php echo htmlspecialchars($servicetype); ?>"><?php echo htmlspecialchars($servicetype); ?></option>
                                <option value="Construction">Construction</option>
                                <option value="Renovation">Renovation</option>
                            </select>
                        </div>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="startdate" class="siteinfo">Start Date:</label>
                        <input type="date" id="startdate" name="startdate" value="<?php echo htmlspecialchars($startdate); ?>" required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="datecomplete" class="siteinfo">Date of Completion:</label>
                        <input type="date" id="datecomplete" name="datecomplete" value="<?php echo htmlspecialchars($completedate); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="details">Project Details:</label>
                    <textarea type="textarea" id="details" name="projdetails" required><?php echo htmlspecialchars($projectdetails); ?></textarea>
                </div>
                <div class="form-group_two">
                    <div class="input-group">
                        <label for="areaofwork">Area of Work:</label>
                        <input type="number" id="areaofwork" name="areaofwork" value="<?php echo htmlspecialchars($workarea); ?>" required> 
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="constraints" class="siteinfo">Budget Constraints:</label>
                        <input type="number" id="constraints" name="budget_constraints" value="<?php echo htmlspecialchars($budgetconstraint); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                        <label for="specialrequests">Special Requests:</label>
                        <textarea type="textarea" id="specialrequests" name="specialrequests" required><?php echo htmlspecialchars($specialrequests); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="contact">Email / Contact Number:</label>
                    <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required>
                </div>
                <div class="form-group_two">
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
                            <?php
                                $arrFiles = array();
                                $dirPath = "../../../AttachedFiles/Blueprints/quotationRequestBlueprints/blueprint-" . $id;
                                
                                if (is_dir($dirPath)) {
                                    $files = scandir($dirPath);
                                    $hasFiles = false;
                                    
                                    foreach ($files as $file) {
                                        $filePath = $dirPath . '/' . $file;
                                        if (is_file($filePath)) {
                                            $hasFiles = true; // Set to true when a file is found
                                            echo "<li><a href='" . $filePath . "' target='_blank'>" . $file . "</a></li>";
                                        }
                                    }
                                    
                                    if (!$hasFiles) { // Correct condition to check if no files were found
                                        echo "No blueprints available.";
                                    }
                                } else {
                                    echo "No blueprints attached.";
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                </div>
                    <button type="submit" id="addfinal">Apply Changes</button>
                </div>
            </form>


 
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="../../../JS/request_script.js"></script>
</body>
</html>
