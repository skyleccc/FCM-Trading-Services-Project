<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

$clientID = $_POST['clientid'];

$clientDetailQuery = "SELECT c.*, COUNT(p.projectID) AS numProjects, latest_project.projectID AS latestProjectID, DATE_FORMAT(latest_project.completionDate, '%d %m %y') AS latestProjectDate, p.projectName FROM client c LEFT JOIN project p ON c.clientID = p.clientID LEFT JOIN ( SELECT clientID, projectID, completionDate FROM project WHERE clientID = $clientID AND completionDate IS NULL ) latest_project ON c.clientID = latest_project.clientID WHERE c.clientID = $clientID GROUP BY c.clientID ORDER BY latest_project.completionDate ASC;";

$clientProjQuery = "SELECT projectName, projectType, DATE_FORMAT(completionDate, '%M %d, %Y') AS completionDate FROM project, client WHERE client.clientID = project.clientID AND client.clientID = $clientID ORDER BY completionDate ASC;";

$clientDetailResult = ($conn->query($clientDetailQuery))->fetch_assoc();
$clientCurrProj = ($clientDetailResult["latestProjectID"] != NULL) ? $clientDetailResult['projectName'] : "No current projects";

$clientProjResult = $conn->query($clientProjQuery);

echo '

            <div class="h40-w100">
                <div class="detail-header">Client Details:</div>
                <hr>
                <div><b>Name:</b> '.htmlspecialchars($clientDetailResult['clientName']).'</div>
                <div><b>Contact Number:</b> '.htmlspecialchars($clientDetailResult['clientContact'] ?? 'No Contact #').'</div>
                <div><b>Email Address:</b> '.htmlspecialchars($clientDetailResult['clientEmail'] ?? 'No Email').'</div>
                <div><b>Number of Projects:</b> '.htmlspecialchars($clientDetailResult['numProjects'] ?? '0').'</div>
                <div><b>Current Project:</b> '.$clientCurrProj.'</div>
                <hr>
            </div>
            <div id="recent-projects" class="h60-w100">
                <div class="detail-header" class="h10-w100">Recent Projects: </div>
                <div id="project-tab" class="h90-w100">
';               

if($clientProjResult->num_rows > 0){
    while($clientProjRow = $clientProjResult->fetch_assoc()){
        $clientProjStatus = ($clientProjRow["completionDate"] != NULL) ? "finished" : "ongoing";
        $clientProj = ($clientProjRow["completionDate"] != NULL) ? "Completed<br>".$clientProjRow["completionDate"] : "Ongoing";
        echo'
            <div class="project flex-centermiddle">
                <div class="h100-w60 flex-centermiddle text-center">
                    <span><b>'.htmlspecialchars($clientProjRow["projectName"]).'</b><br></span>
                    <span style="color: #299d29">'.htmlspecialchars($clientProjRow["projectType"]).'</span>
                </div>
                <div class="h100-w40 flex-centermiddle text-center '.$clientProjStatus.'">
                    <b>'.$clientProj.'</b>
                </div>
            </div>
        ';
    }
}else{
    echo '<div class="flex-centermiddle" style="margin-top: 10px;">No projects found.</div>';
}

echo '                   
                </div>
            </div>
';

?>