<?php

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="row">
                <div class="col-sm-11">
                    <a href="../ProjectDetails/projectpage.php?id=' . htmlspecialchars($row["projectid"]) . '" class="row p-2 border bg-light" style="margin: auto; text-decoration: none;">
                        <div class="col-1 rounded" style="background-color:rgb(41, 157, 41); height: 80px; color: rgb(255,255,255); display: flex; justify-content: center; align-items: center;">'.htmlspecialchars($row["progressRate"] ?? '0').'%'.'</div>
                        <div class="col-8 p-1 ">
                            <div id="clientname" style="font-weight: bold;text-align: center; color: black;">' . htmlspecialchars($row["clientname"]  ?? '') . '</div>
                            <div id="buildingaddress" style="font-weight: lighter; text-align: center; font-size: 13px; color: black;">' . htmlspecialchars($row["buildingaddress"]  ?? '') . '</div>
                            <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                        </div>
                        <div class="col-3 rounded" style="background-color:rgb(227, 38, 38); height: 80px; padding: 5px ; color: rgb(255, 251, 251); display: flex; justify-content: center; align-items: center;">'.htmlspecialchars($row["deadlineDate"] ?? 'No Deadline').'</div>
                    </a>
                </div>
                <div class="col-sm-1">
                    <button class="button-style edit-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 7px">
                        <div class="row border bg-light rounded icon-container">
                            <span class="material-symbols-outlined" style="font-size: 2vw;">edit</span>
                        </div>
                    </button>
                    <button class="button-style delete-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 10px">
                        <div class="row border bg-light rounded icon-container">
                            <span class="material-symbols-outlined" style="font-size: 2vw;">delete</span>
                        </div>
                    </button>
                </div>
            </div>';
        }
    } else {
        echo '<p>No projects found</p>';
    }
?>