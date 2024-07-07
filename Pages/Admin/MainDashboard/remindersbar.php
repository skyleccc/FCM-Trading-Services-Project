<?php

    // File Redirect
    $redirectTo = "../ProjectDetails/projectpage.php?id=";

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            echo '
            <a href="'. $redirectTo . htmlspecialchars($row["projectid"]) . '"  class="row p-1 border bg light" style="margin-top: 25px;">
            <div class="col-sm-4 rounded" style="background-color:rgb(212, 43, 34); width: 35px; height: 80px; color: rgb(212, 43, 34);">.</div>
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