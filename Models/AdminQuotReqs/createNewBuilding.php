<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buildingaddress'])) {
        $buildingaddress = $_POST['buildingaddress'];

        $createBuildingSQL = "INSERT INTO building (buildingaddress) VALUES (?)";
        $createBuildingQuery = $conn->prepare($createBuildingSQL);

        if ($createBuildingQuery === false) {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement']);
            exit;
        }

        $createBuildingQuery->bind_param('s', $buildingaddress);

        if ($createBuildingQuery->execute()) {
            $buildingID = $createBuildingQuery->insert_id;
            echo json_encode(['success' => true, 'buildingID' => $buildingID]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add building']);
        }

        $createBuildingQuery->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing building address']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
}
?>
