<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "fcmDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$projectid = $_POST['projectid'];
$sql = "DELETE FROM project WHERE projectid='$projectid'";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>