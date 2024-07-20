<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buildingaddress = $_POST['buildingaddress'];

    if ($conn) {
        // Prepare and execute the query
        $findBuildingSQL = "SELECT * FROM building WHERE buildingaddress = ?";
        $findBuildingQuery = $conn->prepare($findBuildingSQL);

        if ($findBuildingQuery) {
            $findBuildingQuery->bind_param('s', $buildingaddress);
            $findBuildingQuery->execute();
            $findBuildingResult = $findBuildingQuery->get_result();

            if ($findBuildingResult->num_rows > 0) {
                $data = $findBuildingResult->fetch_assoc();
                echo json_encode([
                    'success' => true,
                    'message' => 'Building found.',
                    'building_id' => $data['buildingID']
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'message' => 'Building not found.',
                    'building_id' => null
                ]);
            }

            $findBuildingQuery->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Query preparation failed']);
        }

        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
}
?>