<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require '../../Controllers/accessDatabase.php';
    require '../../Controllers/loginCheck.php';

    $requestID = $_POST['requestid'];
    $projectID = $_POST['projectid'];

    $src = "../../AttachedFiles/Blueprints/quotationRequestBlueprints/blueprint-" . $requestID;
    $dest = "../../AttachedFiles/Blueprints/projectBlueprints/blueprint-" . $projectID;

    $response = [];

    if (!is_dir($src)) {
        // If the source directory does not exist, return a success response indicating no files were copied
        $response[] = ['success' => true, 'message' => "Source directory $src does not exist, no files copied"];
        echo json_encode($response);
        exit;
    }

    if (!is_dir($dest) && !mkdir($dest, 0777, true)) {
        $response[] = ['success' => false, 'message' => "Failed to create destination directory $dest"];
        echo json_encode($response);
        exit;
    }

    // Proceed with copying files if the source directory exists
    $files = clean_scandir($src);

    foreach ($files as $file) {
        $sourceFile = "$src/$file";
        $destinationFile = "$dest/$file";

        if (!file_exists($destinationFile)) {
            if (copy($sourceFile, $destinationFile)) {
                $response[] = ['success' => true, 'message' => "Copied $file to $destinationFile"];
            } else {
                $response[] = ['success' => false, 'message' => "Failed to copy $file to $destinationFile"];
            }
        } else {
            $response[] = ['success' => false, 'message' => "$file already exists at $dest"];
        }
    }

    echo json_encode($response);
    exit;
}

function clean_scandir($dir) {
    $files = scandir($dir);
    if ($files === false) {
        return [];
    }
    return array_values(array_diff($files, ['..', '.']));
}

?>
