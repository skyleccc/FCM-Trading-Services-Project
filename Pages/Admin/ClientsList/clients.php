<?php

require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../CSS/clients_styles.css">
</head>
<body>
    <?php
        // Navigation Bar for Admin Dashboard
        include '../../../Components/adminNavBar.php';
    ?>
    <div class="col middle-box">
        <div class="headers-box h25-w100">
            <div class="col-12">
                <img src="../../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
            </div>
            <div class="col-12 d-flex justify-content-between align-items-center box header">
                <div class="client-header d-flex align-items-center h100-w50">
                    Clients List
                    <div class="add-client">
                        <button type="button" class="add-client" data-toggle="modal" data-target="#addClientModal">
                            <span class="material-symbols-outlined">person_add</span>
                        </button>
                    </div>
                </div>
                <div class="h100-w50">
                    <input type="text" id="search"class="form-control" placeholder="Search">
                </div>
            </div>
        </div>
        <div id="client_list" class="h75-w100">
            <?php
                // Client List
                require 'clientslist.php';
            ?>
        </div>
    </div>
    <div id="client_details" class="col-3 box">
        <div id="client-statistics" class="h40-w100">
            <?php
                $numClientsQuery = "SELECT COUNT(*) AS count FROM client";
                $ongoingClientsQuery = "SELECT COUNT(DISTINCT c.clientID) AS ongoingClientsCount FROM client c JOIN project p ON c.clientID = p.clientID WHERE p.isComplete = 0";
                $mostProjClientQuery = "SELECT c.*, COUNT(p.projectID) AS projectCount FROM client c JOIN project p ON c.clientID = p.clientID GROUP BY c.clientID ORDER BY projectCount DESC LIMIT 1;";
                $mostRecentClientQuery = "SELECT c.*, p.projectID, p.completionDate AS mostRecentProjectDate FROM client c JOIN project p ON c.clientID = p.clientID WHERE (c.clientID, p.completionDate) IN ( SELECT clientID, MAX(completionDate) AS mostRecentProjectDate FROM project GROUP BY clientID ) AND isComplete = '1' ORDER BY p.completionDate DESC LIMIT 1;";

                $numClientsResult = ($conn->query($numClientsQuery))->fetch_assoc();
                $ongoingClientsResult = ($conn->query($ongoingClientsQuery))->fetch_assoc();
                $mostProjClientResult = ($conn->query($mostProjClientQuery))->fetch_assoc();
                $mostRecentClientResult = ($conn->query($mostRecentClientQuery))->fetch_assoc();
            ?>
            <div>
                <span class="header-text"><?php echo htmlspecialchars($numClientsResult["count"] ?? '0') ?></span>
                <span class="text">Number of Clients<br>&nbsp;</span>
            </div>
            <div>
                <span class="header-text"><?php echo htmlspecialchars($ongoingClientsResult["ongoingClientsCount"] ?? '0') ?></span>
                <span class="text">Clients w/ Current Projects</span>
            </div>
            <div>
                <span class="header-name"><?php echo htmlspecialchars($mostProjClientResult["clientName"] ?? 'None') ?></span>
                <span class="text">Client w/ Most Projects<br>&nbsp;</span>
            </div>
            <div>
                <span class="header-name"><?php echo htmlspecialchars($mostRecentClientResult["clientName"] ?? 'None') ?></span>
                <span class="text">Client w/<br>Recent Project Finished</span>
            </div>
        </div>
        <div id="client-summary" class="h60-w100 flex-centermiddle">
            No client selected. Please click a client.
        </div>
    </div>
    <?php
        // Add Client Modal
        require '../../../Components/ClientModals/addClientModal.php';
        // Edit Client Modal
        require '../../../Components/ClientModals/editClientModal.php';
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../../../JS/clients_script.js"></script>
</html>