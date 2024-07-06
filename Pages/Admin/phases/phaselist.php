<?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<div class="row">
                                                    <div class="col-sm-11">
                                                        <div class="row p-2 border bg light" style="margin: auto;">
                                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 65px; height: 80px; color: rgb(41, 157, 41);">
                                                                <input type="checkbox" style="width: 40px; height: 70px; margin-top: 10%; accent-color: rgb(41, 157, 41);">
                                                            </div>
                                                            <div class="col p-1 ">
                                                            <div id="clientname" style="font-weight: bold;text-align: center;font-size: 1.6vw; color: black;">' . htmlspecialchars($row["phaseTitle"] ?? '') . '</div>
                                                            <div id="address" style="font-weight: lighter; text-align: center; font-size: 1vw; color: black;">' . htmlspecialchars($row["phaseDescription"] ?? '') . '</div>
                                                            <div id="projectname" style="font-weight: lighter; text-align: center; font-size: 1.2vw; color:#40ce55;">' . htmlspecialchars($row["projectname"] ?? '') . '</div>
                                                            </div>
                                                            <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 160px; height: 80px; padding-top: 13px ;">
                                                                <div style="color: white; font-size: 15px; font-weight: lighter; ">Deadline:</div>
                                                                <div style=" color: white">' . htmlspecialchars($row["expectedFinishDate"] ?? '') . '</div>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                        <div class="col-sm-1">
                                                            <button class="button-style" style="margin-top: 7px">
                                                                <div class="row border bg-light rounded icon-container">
                                                                    <span class="material-symbols-outlined" style="font-size: 2vw;">edit</span>
                                                                </div>
                                                            </button>
                                                            <button class="button-style delete-btn" data-id="' . htmlspecialchars($row["phaseid"] ?? '') . '" style="margin-top: 10px">
                                                            <div class="row border bg-light rounded icon-container">
                                                                <span class="material-symbols-outlined" style="font-size: 2vw;">delete</span>
                                                            </div>
                                                        </button>
                                                        </div>
                                                </div>';
                                                }
                                            } else {
                                                echo '<p>No projects found</p>'; // edit add something nga pwede mupakita kung way projects
                                            }
                                        ?>