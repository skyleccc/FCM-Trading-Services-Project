<?php
require '../../Controllers/accessDatabase.php';

$sort = $_GET['sort'];
$allowed_sorts = ['progressRate', 'deadlineDate', 'clientName'];

if (!in_array($sort, $allowed_sorts)) {
    $sort = 'deadlineDate';
}

$sort_in_project = ['deadlineDate'];
$sort_in_client = ['clientName'];

if(in_array($sort, $sort_in_project)){
    $sortAppend = 'project.'.sortOrder($sort);
}else if(in_array($sort, $sort_in_client)){
    $sortAppend = 'client.'.sortOrder($sort);
}else{
    $sortAppend = sortOrder($sort);
}

function sortOrder($sort){
    $sortDESC = ['progressRate'];
    if(in_array($sort, $sortDESC)){
        return $sort." DESC";
    }else{
        return $sort." ASC";
    }
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
    WHERE
        project.isComplete = 0
    ORDER BY
        $sortAppend";


$query = $conn->prepare($sortProg);
$query->execute();
$result = $query->get_result();

require '../../Pages/Admin/MainDashboard/projectlist.php';

$query->close();
$conn->close();

?>