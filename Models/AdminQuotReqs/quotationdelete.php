<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$requestid = $_POST['requestid'];
$sql = "DELETE FROM quotation_request WHERE requestid='$requestid'";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>