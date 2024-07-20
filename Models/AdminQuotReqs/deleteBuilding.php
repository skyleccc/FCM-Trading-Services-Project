<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buildingid = $_POST['buildingid'];

    $deleteBuildingSQL = "DELETE FROM building WHERE buildingID = ?";
    $deleteBuildingQuery = $conn->prepare($deleteBuildingSQL);
    $deleteBuildingQuery->bind_param('i', $buildingid);

    if ($deleteBuildingQuery->execute()) {
        echo json_encode(['success' => true, 'message' => 'Building deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete building']);
    }

    $deleteBuildingQuery->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
}
?>
