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
    $save = $conn->prepare("SELECT project.projectname,project.projectscope ,project.projecttype ,project.projectdetails, project.specialrequests, client.clientname,client.clientcontact, building.buildingaddress, project.workarea, building.blueprint, project.startdate, project.deadlinedate, project.completiondate FROM project, client, building WHERE client.clientid = project.clientid AND building.buildingid = project.buildingid AND project.projectid = ?");
    $save->bind_param("i", $id);
    $save->execute();
    $result = $save->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

?>