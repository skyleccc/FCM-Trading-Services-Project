<?php

require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientName = $_POST['clientName'];
    $clientContact = isset($_POST['clientContact']) && $_POST['clientContact'] !== '' ? $_POST['clientContact'] : null;
    $clientEmail = isset($_POST['clientEmail']) && $_POST['clientEmail'] !== '' ? $_POST['clientEmail'] : null;

    $addClientSQL = "INSERT INTO client (clientName, clientContact, clientEmail) VALUES (?,?,?)";
    $stmt = $conn->prepare($addClientSQL);

    // Dynamically build the types string and values array
    $types = "sss";
    $values = [$clientName, $clientContact, $clientEmail];

    // Prepare bind_param arguments
    $bind_names[] = $types;
    for ($i = 0; $i < count($values); $i++) {
        $bind_name = 'bind' . $i;
        $$bind_name = $values[$i];
        $bind_names[] = &$$bind_name;
    }

    // Call bind_param with dynamically created arguments
    call_user_func_array([$stmt, 'bind_param'], $bind_names);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'You do not have access.';
}
?>