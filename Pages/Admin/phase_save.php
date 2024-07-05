<?php
require '../../Controllers/accessDatabase.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phasetitle = $_POST['phasetitle'];
    $phasedescription = $_POST['phasedescription'];
    $expectedfinishdate = $_POST['expectedfinishdate'];
    $actualfinishdate = $_POST['actualfinishdate'];

        $temp = $conn->prepare("INSERT INTO phase (phasetitle, phasedescription, expectedfinishdate, actualfinishdate) VALUES (?, ?, ?, ?)");
        $temp->bind_param("ssss", $phasetitle, $phasedescription, $expectedfinishdate, $actualfinishdate);

        if ($temp->execute()) {
            header('Location: projectpage.php');
            exit;
        } else {
            $temp->error;
        }

    $temp->close();
    $conn->close();
}
?>
