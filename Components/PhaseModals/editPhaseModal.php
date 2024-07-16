<?php
include '../../../Controllers/accessDatabase.php';

$redirectAfter = "Location: ../../Pages/Admin/ProjectDetails/projectpage.php";

$phaseId = isset($_GET['phaseid']) ? $_GET['phaseid'] : null;
$projID = $_GET['id'];

if ($phaseId) {
    $stmt = $conn->prepare("SELECT phasetitle, phasedescription, expectedfinishdate, actualfinishdate, project.deadlineDate FROM phase, project WHERE phase.phaseID = ? AND project.projectID = phase.projectID");
    $stmt->bind_param("i", $phaseId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $phasetitle = $row['phasetitle'];
        $phasedescription = $row['phasedescription'];
        $expectedfinishdate = $row['expectedfinishdate'];
        $actualfinishdate = $row['actualfinishdate'];
        $projectDeadlineDate = $row['deadlineDate'];
    } else {
        echo "Phase not found.";
        exit();
    }
} 

echo '
<div class="col modalblock">
                <div id="myEditModal" class="popup" style="display: block">
                    <div class="quotationscontainer" style="height: 70%;">
                        <div class="row" style="height: 300px;">
                            <div class="container p-3 border bg-light rounded">
                                <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Edit Phase Details<span class="close" onclick="closeModal();">&times;</span>
                                        </div><br>
                                            <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                                                <div class="col-sm ex2" style="border: solid; border-color: green; border-radius: 8px; height: 400px; color: green;">
                                                <form class="form" action="/../../../Models/AdminPhases/phase_edit.php?id='.$projID.'&phaseid='.$phaseId.'" method="POST" id="addProjectForm">
                                                        <div id="scrollform">
                                                         <input type="hidden" name="id" value="'.$phaseId.'">  
                                                            <div class="form-group">
                                                                <label for="project">Phase Title:</label>
                                                                <input type="text" id="phasetitle" name="phasetitle" value="' . htmlspecialchars($phasetitle) . '"  required>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="description">Phase Description:</label>
                                                                <textarea id="phasedescription" name="phasedescription" required>' . htmlspecialchars($phasedescription) . '</textarea>
                                                            </div>
                                                          
                                                            <div class="form-group_three">
                                                                <div class="input-group">
                                                                    <label for="projectDeadline" class="siteinfo">Expected Finish Date:</label>
                                                                    <input type="date" id="expectedfinishdate" name="expectedfinishdate" value="' . htmlspecialchars($expectedfinishdate) . '"min="2020-12-31" max="'.htmlspecialchars($projectDeadlineDate).'">
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="startdate" class="siteinfo">Actual Finish Date:</label>
                                                                    <input type="date" id="actualfinishdate" name="actualfinishdate" value="' . htmlspecialchars($actualfinishdate) . '" min="2020-12-31" max="9999-12-31">
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                </div>
                                            </div>
                                            <button id="addfinal">Apply Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>   
            </div>
    ';
?>

<style>
    body{
        background-color: rgb(235, 242, 246);
    }
    .row, .col{
        border-radius: 10px;
        background: #fbfbfb;
    }

    .col-sm-2{
        font-family: Helvetica;
        font-weight: bolder;
    }
    .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    }

    .centered {
        position: absolute;
        top: 40%;
        left: 40%;
        transform: translate(6%, -50%);
    }
    
    .container {
        position: relative;
        text-align: center;
        color: white;
    }
    
    div.ex3 {
        overflow: auto;
        height: 347px;
        width: 100%;
    }
    div.ex2 {
        overflow: auto;
        height: 180px;
        width: 100%;
    }
    div.ex1 {
        overflow: auto;
        height: 625px;
        width: 100%;
    }

    .icon-container {
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            background: none;
            padding: 0; 
    }
    .button-style {
            margin: auto;
            text-decoration: none;
            color: rgb(52, 173, 46);
            border: none;
            background: none;
            display: block;
    }
</style> 