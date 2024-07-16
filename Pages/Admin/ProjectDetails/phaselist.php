<?php
require '../../../Controllers/accessDatabase.php';
$id = $_GET['id'];
$sql = "SELECT phase.* FROM phase, project WHERE project.projectid = $id AND phase.projectid = project.projectid ORDER BY phase.expectedFinishDate ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $phaseFinished = $row["isFinished"] == 1 ? 'checked' : '';
        echo '<div id="phase-tab" class="row">
        <div class="col-sm-11">
            <div class="row p-2 border bg light" style="margin: auto;">
                <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 65px; height: 80px; color: rgb(41, 157, 41);">
                    <input type="checkbox" data-id="' . htmlspecialchars($row["phaseID"] ?? '') . '" style="width: 40px; height: 70px; margin-top: 10%; accent-color: rgb(41, 157, 41);" '.$phaseFinished.'>
                </div>
                <div class="col p-1 ">
                <div id="clientname" style="font-weight: bold;text-align: center;font-size: 1.6vw; color: black;">' . htmlspecialchars($row["phaseTitle"] ?? '') . '</div>
                <div id="address" style="font-weight: lighter; text-align: center; font-size: 1vw; color: black;">' . htmlspecialchars($row["phaseDescription"] ?? '') . '</div>
                <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 1.2vw; color:#40ce55;">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                </div>
                ';

                if($phaseFinished == ''){
                    echo'
                    <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 160px; height: 80px; padding-top: 13px ;">
                    <div style="color: white; font-size: 15px; font-weight: lighter; ">Deadline:</div>
                    <div style=" color: white">' . htmlspecialchars($row["expectedFinishDate"] ?? 'No Deadline') . '</div>
                    </div>
                    ';
                }else{
                    echo'
                    <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 160px; height: 80px; padding-top: 13px ;">
                    <div style="color: white; font-size: 15px; font-weight: lighter; ">Finished:</div>
                    <div style=" color: white">' . htmlspecialchars($row["actualFinishDate"] ?? '') . '</div>
                    </div>
                    ';
                }

        echo '
            </div>
        </div>

            <div class="col-sm-1">
                <button class="button-style edit-btn" data-id="' . htmlspecialchars($row["phaseID"] ?? '') . '" style="margin-top: 7px">
                    <div class="row border bg-light rounded icon-container">
                        <span class="material-symbols-outlined" style="font-size: 2vw;">edit</span>
                    </div>
                </button>
                <button class="button-style delete-btn" data-id="' . htmlspecialchars($row["phaseID"] ?? '') . '" style="margin-top: 10px">
                <div class="row border bg-light rounded icon-container">
                    <span class="material-symbols-outlined" style="font-size: 2vw;">delete</span>
                </div>
            </button>
            </div>
    </div>';
    }
} else {
    echo '
    <br>
    <br>
    <p>No tasks found. Please add one by clicking the plus button.</p>
    ';
}

?>