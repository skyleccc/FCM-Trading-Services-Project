<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$projectid = $_POST['projectid'];
$sql = "DELETE FROM project WHERE projectid='$projectid'";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>