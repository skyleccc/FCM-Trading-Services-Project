<?php
$clientListQuery = "SELECT c.*, p.projectID, p.completionDate AS latestProjectDate
FROM client c
LEFT JOIN (
    SELECT clientID, projectID, completionDate
    FROM project
    WHERE (clientID, COALESCE(completionDate, NOW())) IN (
        SELECT clientID, MAX(COALESCE(completionDate, NOW())) AS latestProjectDate
        FROM project
        GROUP BY clientID
    )
) p ON c.clientID = p.clientID
ORDER BY c.clientID ASC";

$clientListResult = $conn->query($clientListQuery);

if($clientListResult->num_rows > 0){
    while($clientListRow = $clientListResult->fetch_assoc()){
        // Checks if client has no projects or ongoing projects
        $clientListProj = ($clientListRow["projectID"] != NULL) ? "Project Ongoing" : "No Projects";

        echo'
            <div class="client box">
                <div class="client-details h100-w50" data-id="'.$clientListRow["clientID"].'">
                    <div class="client-name flex-centermiddle">'.htmlspecialchars($clientListRow["clientName"]).'</div>
                    <div class="client-contact flex-centermiddle">'.htmlspecialchars($clientListRow["clientContact"]).'</div>
                </div>
                <div class="last-project h100-w25">
                    <div><b>Last Project:</b></div>
                    <div>'.htmlspecialchars($clientListRow["latestProjectDate"] ?? $clientListProj).'</div>
                </div>
                <div class="action-buttons h100-w25">
                    <button type="button edit-btn" data-id="'.$clientListRow["clientID"].'" class="btn btn-primary">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                    <button type="button delete-btn" data-id="'.$clientListRow["clientID"].'" class="btn btn-danger">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
        ';
    }
}
?>