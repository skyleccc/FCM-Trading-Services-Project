<?php
$directory = '../../AttachedFiles/Blueprints/quotationRequestBlueprints/';
$requesterID = $_GET['id'];  // Assuming you're passing the requester ID via GET
$dir = $directory . 'blueprint-' . $requesterID;

$files = [];
if (is_dir($dir)) {
    $fileIterator = new DirectoryIterator($dir);
    foreach ($fileIterator as $fileinfo) {
        if ($fileinfo->isFile()) {
            $files[] = $fileinfo->getFilename();
        }
    }
}

header('Content-Type: application/json');
echo json_encode($files);
?>