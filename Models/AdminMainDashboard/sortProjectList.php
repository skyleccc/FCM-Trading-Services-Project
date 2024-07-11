<?php
require '../../Controllers/accessDatabase.php';

$sort = $_GET['sort'] ?? 'deadlineDate';
$allowed_sorts = ['progressRate', 'deadlineDate', 'startDate'];

if (!in_array($sort, $allowed_sorts)) {
    $sort = 'deadlineDate';
}

$query = $conn->prepare("SELECT project.projectid, project.projectname, building.buildingaddress, project.clientid, project.progressrate, client.clientname, DATE_FORMAT(project.deadlineDate, '%M %d, %Y') AS deadlineDate FROM project, client, building WHERE client.clientid=project.clientid AND project.buildingid=building.buildingid ORDER BY project.$sort");
$query->execute();
$result = $query->get_result();

require '../../Pages/Admin/MainDashboard/projectlist.php';

$query->close();
$conn->close();

?>