<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// $project_id = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;

$sql = "SELECT phase.phaseid, phase.phasetitle, phase.expectedFinishDate, project.projectID, client.clientName FROM phase JOIN project ON phase.projectid = project.projectID JOIN client ON client.clientID = project.clientID WHERE isFinished = 0;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$events = array();

while($row = $result->fetch_assoc()) {
    $events[] = array(
        'event_id' => $row['phaseid'],
        'title' => $row['phasetitle']." - ".$row["clientName"],
        'start' => $row['expectedFinishDate'],
        'end' => $row['expectedFinishDate'],
        'color' => '#378006', // Example color, you can adjust as needed
        'url' => '/Pages/Admin/ProjectDetails/projectpage.php?id='.$row['projectID'] // Example URL, you can adjust as needed
    );
}

echo json_encode(array('data' => $events));
?>
