<?php

    // File Redirect: 
    $redirectTo = "../ProjectDetails/projectpage.php?id=";
    $sql = "SELECT quotation_request.requestid, quotation_request.serviceType, quotation_request.clientName, quotation_request.Location FROM quotation_request WHERE status='pending'";
    $result3 = $conn->query($sql);

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            //make quotation page shit
            echo '
            <a href="../QuotationReqsList/quotationedit.php?id=' . htmlspecialchars($row["requestid"]) . '" class="row p-1 border bg light" style="margin-top: 25px;  text-decoration: none">
            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 35px; height: 80px; color: rgb(41, 157, 41);">.</div>
            <div class="col p-1">
            <div style="font-weight: bold;text-align: center;font-size: 1.3vw; color: black;">' . htmlspecialchars($row["Location"]) . '</div>
            <div style="font-weight: lighter; text-align: center; font-size: 0.9vw; color: black;" >' . htmlspecialchars($row["clientName"]) . '</div>
            <div style="font-weight: lighter; text-align: center; font-size: 0.75vw; color:#40ce55" >' . htmlspecialchars($row["serviceType"]) . '</div>
        </div>
            </a>';
        }
    } else {
        echo '<p>No projects found</p>';
    }
?> 