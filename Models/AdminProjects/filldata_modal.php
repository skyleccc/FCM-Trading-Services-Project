<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $projectId = intval($_GET['id']);
    $project = getProjectById($projectId);
    if (!$project) {
        echo "Order ID does not exist.";
        exit();
    }
} else {
    echo "Invalid order ID.";
    exit();
}

function getProjectById($id) {
    global $conn;
    $editProjectSQL = $conn->prepare("SELECT project.*, clientName, clientContact, clientEmail, buildingaddress  FROM project, client, building WHERE client.clientid = project.clientid AND building.buildingid = project.buildingid AND project.projectid = ?");
    $editProjectSQL->bind_param("i", $id);
    $editProjectSQL->execute();
    $editResult = $editProjectSQL->get_result();

    if ($editResult->num_rows > 0) {
        return $editResult->fetch_assoc();
    } else {
        return null;
    }
}

?>