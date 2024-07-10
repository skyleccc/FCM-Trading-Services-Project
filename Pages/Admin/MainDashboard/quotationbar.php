<?php

    // File Redirect: 
    $redirectTo = "#";
    $sql = "SELECT requestid, serviceType, clientName, Location FROM quotation_request WHERE status='pending'"; 
    $result3 = $conn->query($sql);

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            echo '
            <a href="'. $redirectTo . htmlspecialchars($row["projectid"]) . '"  class="row p-1 border bg light" style="margin-top: 25px;  text-decoration: none">
            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 35px; height: 80px; color: rgb(41, 157, 41);">.</div>
                <div class="col p-1 ">
                    <div id="clientname" style="font-weight: bold;text-align: center; color: black;">' . htmlspecialchars($row["clientname"]  ?? '') . '</div>
                    <div id="buildingaddress" style="font-weight: lighter; text-align: center; font-size: 13px; color: black;">' . htmlspecialchars($row["buildingaddress"]  ?? '') . '</div>
                    <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                </div>
            </a>';
        }
    } else {
        echo '<p>No projects found</p>';
    }
?> 