<?php
include '../../../Controllers/accessDatabase.php';

$redirectAfter = "Location: ../../Pages/Admin/ProjectDetails/projectpage.php";

$phaseId = isset($_GET['phaseid']) ? $_GET['phaseid'] : null;
$projID = $_GET['id'];

if ($phaseId) {
    $stmt = $conn->prepare("SELECT phasetitle, phasedescription, expectedfinishdate, actualfinishdate FROM phase WHERE phaseId = ?");
    $stmt->bind_param("i", $phaseId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $phasetitle = $row['phasetitle'];
        $phasedescription = $row['phasedescription'];
        $expectedfinishdate = $row['expectedfinishdate'];
        $actualfinishdate = $row['actualfinishdate'];
    } else {
        echo "Phase not found.";
        exit();
    }
}

echo '
<div class="col modalblock">
                <div id="myModal" class="popup" style="display: block">
                    <div class="quotationscontainer" style="height: 70%;">
                        <div class="row" style="height: 300px;">
                            <div class="container p-3 border bg-light rounded">
                                <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Edit Phase Details<span class="close">&times;</span>
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
                                                                    <input type="date" id="expectedfinishdate" name="expectedfinishdate" value="' . htmlspecialchars($expectedfinishdate) . '">
                                                                </div>
                                                                <div class="space"></div>
                                                                <div class="input-group">
                                                                    <label for="startdate" class="siteinfo">Actual Finish Date:</label>
                                                                    <input type="date" id="actualfinishdate" name="actualfinishdate" value="' . htmlspecialchars($actualfinishdate) . '">
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