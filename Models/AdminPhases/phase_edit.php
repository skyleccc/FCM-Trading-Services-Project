<?php
include '../../Controllers/accessDatabase.php';

$redirectAfter = "Location: ../../Pages/Admin/ProjectDetails/projectpage.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $phaseId = $_POST['id'];
    $phasetitle = $_POST['phasetitle'];
    $phasedescription = $_POST['phasedescription'];
    $expectedfinishdate = $_POST['expectedfinishdate'];
    $actualfinishdate = $_POST['actualfinishdate'];

    $save = $conn->prepare("UPDATE phase SET phasetitle = ?, phasedescription = ?, expectedfinishdate = ?, actualfinishdate = ? WHERE phaseId = ?");
    $save->bind_param("ssssi", $phasetitle, $phasedescription, $expectedfinishdate, $actualfinishdate, $phaseId);

    if ($save->execute()) {
        $save->close();
        $conn->close();
        header($redirectAfter);
        exit();
    } else {
        echo "Error updating phase: " . $conn->error;
        exit();
    }
}
?>
