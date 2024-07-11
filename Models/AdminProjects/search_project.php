<?php

require '../../Controllers/accessDatabase.php'; 

$searchQuery = '';

if (isset($_POST['query'])) {
    $searchQuery = $_POST['query']; // Get the query from the POST request
    $sql = "SELECT project.projectid, project.projectname, building.buildingaddress, project.clientid, client.clientname 
            FROM project 
            JOIN client ON client.clientid = project.clientid
            JOIN building ON building.buildingid = project.buildingid
            WHERE project.projectname LIKE ? 
            OR building.buildingaddress LIKE ? 
            OR client.clientname LIKE ?";
            
    $stmt = $conn->prepare($sql);
    $likeQuery = "%" . $searchQuery . "%";
    $stmt->bind_param("sss", $likeQuery, $likeQuery, $likeQuery); // Bind the parameters
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT project.projectid, project.projectname, project.buildingaddress, project.clientid, client.clientname 
            FROM project 
            JOIN client ON client.clientid = project.clientid";
    $result = $conn->query($sql);
}

require '../../Pages/Admin/ProjectsList/projectlist.php';

$conn->close();

?>