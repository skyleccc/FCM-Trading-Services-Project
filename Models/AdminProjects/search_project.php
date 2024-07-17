<?php

require '../../Controllers/accessDatabase.php'; 

$searchQuery = '';
$sort = '';


if(isset($_POST['query']) || isset($_POST['sort'])){
    $sort = $_POST['sort'];
    $searchQuery = $_POST['query'];

    // Define the base SQL query with placeholders for LIKE conditions
    $sql = "SELECT project.projectid, project.projectname, project.projecttype, building.buildingaddress, project.clientid, client.clientname, 
    DATE_FORMAT(project.deadlineDate, '%M %d, %Y') AS deadlineDate, project.isComplete, 
    DATE_FORMAT(project.completionDate, '%M %d, %Y') AS completionDate 
    FROM project 
    JOIN client ON client.clientid = project.clientid 
    JOIN building ON building.buildingid = project.buildingid 
    WHERE (project.projectname LIKE ? 
    OR building.buildingaddress LIKE ? 
    OR client.clientname LIKE ?)";

    // Add sorting condition based on the dropdown selection
    switch ($sort) {
    case 'ongoing':
    $sql .= " AND project.isComplete = 0";
    break;
    case 'completed':
    $sql .= " AND project.isComplete = 1";
    break;
    case 'all':
    default:
    // No additional condition for 'all'
    break;
    }

    // Add the ORDER BY clause
    $sql .= " ORDER BY project.isComplete ASC, 
    CASE WHEN project.isComplete = 0 THEN project.deadlineDate ELSE project.completionDate END ASC";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $likeQuery = "%" . $searchQuery . "%";
    $stmt->bind_param("sss", $likeQuery, $likeQuery, $likeQuery); // Bind the parameters
    $stmt->execute();
    $result = $stmt->get_result();

    require '../../Pages/Admin/ProjectsList/projectlist.php';

    $conn->close();
}else{
    echo '<script>console.log("Error.")</script>';
}



?>
