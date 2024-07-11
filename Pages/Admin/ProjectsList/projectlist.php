<?php

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-sm-4 border bg-light proj_cont" style="margin-top: 1%;"> 
                <div class="row">
                    <div class="col-sm-10">
                        <a href="../ProjectDetails/projectpage.php?id=' . htmlspecialchars($row["projectid"] ?? '') . '" class="row p-2" style="margin: auto; text-decoration: none;">
                            <div class="row" style="margin: auto; margin-top: 3%;">
                                <div class="col p-1">
                                    <div id="clientname" style="font-weight: bold;text-align: center;font-size: 1.6vw; color: black;">' . htmlspecialchars($row["clientname"] ?? '') . '</div>
                                    <div id="address" style="font-weight: lighter; text-align: center; font-size: 1vw; color: black;">' . htmlspecialchars($row["buildingaddress"] ?? '') . '</div>
                                    <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 1.2vw; color:#40ce55;">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                                </div>
                            </div>
                            <div class="col" style="margin-top: 10px;">
                                <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 100%;color: rgb(255, 255, 255);"> Progress</div>
                                <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 100%; color: rgb(255, 251, 251); margin-top: 5px;">' . htmlspecialchars($row["deadlineDate"] ?? '') . '</div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-sm-2 border bg-light">
                        <button class="button-style edit-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 8px;">
                            <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 1.5vw;">edit</span>
                            </div>
                        </button>
                        <button class="button-style delete-btn" data-id="' . htmlspecialchars($row["projectid"] ?? '') . '" style="margin-top: 8px; margin-bottom: 10px;">
                            <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 1.5vw;">delete</span>
                            </div>
                        </button>
                    </div>
                    
                </div>
            </div>';
    }
} else {
    echo '<p>No projects found</p>';
}

?>