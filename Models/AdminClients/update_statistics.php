<?php

require '../../Controllers/accessDatabase.php';

$numClientsQuery = "SELECT COUNT(*) AS count FROM client";
$ongoingClientsQuery = "SELECT COUNT(DISTINCT c.clientID) AS ongoingClientsCount FROM client c JOIN project p ON c.clientID = p.clientID WHERE p.completionDate IS NULL";
$mostProjClientQuery = "SELECT c.*, COUNT(p.projectID) AS projectCount FROM client c JOIN project p ON c.clientID = p.clientID GROUP BY c.clientID ORDER BY projectCount DESC LIMIT 1;";
$mostRecentClientQuery = "SELECT c.*, p.projectID, p.completionDate AS mostRecentProjectDate FROM client c JOIN project p ON c.clientID = p.clientID WHERE (c.clientID, p.completionDate) IN ( SELECT clientID, MAX(completionDate) AS mostRecentProjectDate FROM project GROUP BY clientID ) ORDER BY p.completionDate DESC LIMIT 1;";

$numClientsResult = ($conn->query($numClientsQuery))->fetch_assoc();
$ongoingClientsResult = ($conn->query($ongoingClientsQuery))->fetch_assoc();
$mostProjClientResult = ($conn->query($mostProjClientQuery))->fetch_assoc();
$mostRecentClientResult = ($conn->query($mostRecentClientQuery))->fetch_assoc();

?>

<div>
    <span class="header-text"><?php echo htmlspecialchars($numClientsResult["count"] ?? '0') ?></span>
    <span class="text">Number of Clients<br>&nbsp;</span>
</div>
<div>
    <span class="header-text"><?php echo htmlspecialchars($ongoingClientsResult["ongoingClientsCount"] ?? '0') ?></span>
    <span class="text">Clients w/ Current Projects</span>
</div>
<div>
    <span class="header-name"><?php echo htmlspecialchars($mostProjClientResult["clientName"] ?? '0') ?></span>
    <span class="text">Client w/ Most Projects<br>&nbsp;</span>
</div>
<div>
    <span class="header-name"><?php echo htmlspecialchars($mostRecentClientResult["clientName"] ?? '0') ?></span>
    <span class="text">Client w/<br> Most Recent Project</span>
</div>