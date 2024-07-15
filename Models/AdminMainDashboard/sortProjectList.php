<?php
require '../../Controllers/accessDatabase.php';

$sort = $_GET['sort'] ?? 'deadlineDate';
$allowed_sorts = ['progressRate', 'deadlineDate', 'startDate'];

if (!in_array($sort, $allowed_sorts)) {
    $sort = 'deadlineDate';
}

$sortProg = "SELECT 
        project.projectid, 
        project.projectname, 
        building.buildingaddress, 
        project.clientid, 
        client.clientname, 
        DATE_FORMAT(project.deadlineDate, '%M %d, %Y') AS deadlineDate,
        (SELECT ROUND((SUM(phase.isFinished)/COUNT(phase.isFinished))*100, 0) 
         FROM phase 
         WHERE phase.projectid = project.projectid) AS progressRate
    FROM 
        project
    JOIN 
        client ON client.clientid = project.clientid
    JOIN 
        building ON project.buildingid = building.buildingid
    ORDER BY
        $sort DESC";


$query = $conn->prepare("$sortProg");
$query->execute();
$result = $query->get_result();

require '../../Pages/Admin/MainDashboard/projectlist.php';

$query->close();
$conn->close();

?>