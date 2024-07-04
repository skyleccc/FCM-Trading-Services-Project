<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "fcmDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phasetitle = $_POST['phasetitle'];
    $phasedescription = $_POST['phasedescription'];
    $expectedfinishdate = $_POST['expectedfinishdate'];

        $temp = $conn->prepare("INSERT INTO phase (phasetitle, phasedescription, expectedfinishdate) VALUES (?, ?, ?)");
        $temp->bind_param("sss", $phasetitle, $phasedescription, $expectedfinishdate);

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
