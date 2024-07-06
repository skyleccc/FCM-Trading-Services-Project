<?php

// File Redirects
$addPhase = "../../Models/AdminProjectPage/phase_save.php";

echo'
<div class="col modalblock">
    <div id="myModal" class="popup">
        <div class="quotationscontainer" style="height: 70%;">
            <div class="row" style="height: 300px;">
                <div class="container p-3 border bg-light rounded">
                    <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Enter a New Phase<span class="close">&times;</span>
                    </div><br>
                    <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                        <div class="col-sm ex2" style="border: solid; border-color: green; border-radius: 8px; height: 400px; color: green;">
                            <form class="form" action="'.$addPhase.'" method="POST" id="addProjectForm">
                                <div id="scrollform">
                                    <div class="form-group">
                                        <label for="project">Phase Title:</label>
                                        <input type="text" id="phasetitle" name="phasetitle" placeholder="Enter Name of Project Here" required>
                                    </div>
                                        
                                    <div class="form-group">
                                        <label for="description">Phase Description:</label>
                                        <textarea id="phasedescription" name="phasedescription" placeholder="Type Here..." required></textarea>
                                    </div>
                                        
                                    <div class="form-group_three">
                                        <div class="input-group">
                                            <label for="projectDeadline" class="siteinfo">Expected Finish Date:</label>
                                            <input type="date" id="expectedfinishdate" name="expectedfinishdate">
                                        </div>
                                        <div class="space"></div>
                                        <div class="input-group">
                                            <label for="startdate" class="siteinfo">Actual Finish Date:</label>
                                            <input type="date" id="actualfinishdate" name="actualfinishdate">
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <button id="addfinal">Add Phase</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
'

?>