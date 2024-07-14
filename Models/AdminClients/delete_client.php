<?php

require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clientID"])){
    $clientID = $_POST["clientID"];

    $deleteClientQuery = "DELETE FROM client WHERE clientID = ?";
    $stmt = $conn->prepare($deleteClientQuery);
    $stmt->bind_param("i", $clientID);

    if($stmt->execute()){
        echo 'Successful';
    }else{
        echo 'Error: '.$conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>