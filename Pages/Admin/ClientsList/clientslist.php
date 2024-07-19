<?php
require '../../../Controllers/accessDatabase.php';

$clientListQuery = "WITH LatestProjects AS ( SELECT p.clientID, p.projectID, p.projectName, p.isComplete, CASE WHEN p.isComplete = 1 THEN p.completionDate ELSE NULL END AS projectStatus, ROW_NUMBER() OVER ( PARTITION BY p.clientID ORDER BY CASE WHEN p.isComplete = 1 THEN p.completionDate ELSE p.deadlineDate END DESC, p.projectID DESC ) AS rn FROM project p ) SELECT c.*, lp.projectID, lp.projectName, lp.projectStatus FROM client c LEFT JOIN LatestProjects lp ON c.clientID = lp.clientID AND lp.rn = 1 ORDER BY c.clientID";

$clientListResult = $conn->query($clientListQuery);

if($clientListResult->num_rows > 0){
    while($clientListRow = $clientListResult->fetch_assoc()){
        // Checks if client has no projects or ongoing projects
        $clientListProj = ($clientListRow["projectID"] != NULL) ? "Project Ongoing" : "No Projects";
        $clientContact = ($clientListRow['clientContact'] == "") ? $clientListRow['clientEmail'] : $clientListRow['clientContact'];
        $clientContactDisplay = (!isset($clientListRow['clientEmail']) && !isset($clientListRow['clientContact'])) ? "No Contact" : $clientContact;


        echo'
            <div class="client box">
                <div class="client-details h100-w50" data-id="'.$clientListRow["clientID"].'">
                    <div class="client-name flex-centermiddle">'.htmlspecialchars($clientListRow["clientName"]).'</div>
                    <div class="client-contact flex-centermiddle">'.htmlspecialchars($clientContactDisplay).'</div>
                </div>
                <div class="last-project h100-w25" data-id="'.$clientListRow["clientID"].'">
                    <div><b>Last Project:</b></div>
                    <div>'.htmlspecialchars($clientListRow["projectStatus"] ?? $clientListProj).'</div>
                </div>
                <div class="action-buttons h100-w25">
                    <button type="button edit-btn" data-id="'.$clientListRow["clientID"].'" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editClientModal">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button type="button delete-btn" data-id="'.$clientListRow["clientID"].'" class="btn btn-danger delete-btn">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
        ';
    }
}else{
    echo '<div class="client box">No clients found.</div>';
}
?>