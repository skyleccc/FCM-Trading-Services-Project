<?php

// Model Requirement: "Models/AdminProjects/edit_project.php"

// File Redirect
$editProject = "../../../Models/AdminProjects/edit_project.php";

echo'
<div class="col modalblock">
    <div id="myModal" class="popup" style="display: block">
        <div class="quotationscontainer">
            <div class="row" style="height: 100%;">
                <div class="container p-3 border bg-light rounded">
                    <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Edit Project Details<span class="close" onclick="closeModal()">&times;</span>
                    </div><br>
                    <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                        <div class="col-sm ex2" style="border: solid; border-color: green; border-radius: 8px; height: 670px; color: green;">
                            <form class="form" action="'.$editProject.'?id='.$projectId.'" method="POST" id="addProjectForm">
                                <input type="hidden" name="id" value="'.$projectId.'">        
                                    <div id="scrollform">
                                        <div class="form-group">
                                            <label for="project">Project Name:</label>
                                            <input type="text" id="projectname" name="projectname" value="'.htmlspecialchars($project['projectName'] ?? '').'" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="client">Client: (Not Editable)</label>
                                        <input type="text" id="clientname" name="clientname" value="'.htmlspecialchars($project['clientName'] ?? '').'" disabled>
                                    </div>
                                        <div class="form-group_two">
                                            <div class="input-group">
                                                <label for="clientEmail">Client\'s Email Address: (Not Editable)</label>
                                                <input type="text" id="clientEmail" name="clientEmail" value="'.htmlspecialchars($project['clientEmail'] ?? '').'" disabled>
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="clientContact">Client\'s Contact Number: (Not Editable)</label>
                                                <input type="text" id="clientContact" name="clientContact" value="'.($project['clientContact'] ?? '').'" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group_two">
                                            <div class="form-group">
                                                <label for="projectScope">Project Scope:</label>
                                                <input type="text" id="projectScope" name="projectScope" value="'.($project['projectScope'] ?? '').'" required>
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="servicetype">Service Type:</label>
                                                <div>
                                                    <select id="servicetype" title="Service Type" name="servicetype" required>
                                                        <option value="" disabled>-</option>
                                                        <option value="Construction"'; echo ($project['projectType']=="Construction") ? 'selected':''; echo'>Construction</option>
                                                        <option value="Renovation" '; echo ($project['projectType']=="Renovation") ? 'selected':''; echo'>Renovation</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group_two">
                                            <div class="form-group">
                                                <label for="building">Location: (Not Editable)</label>
                                                <input type="text" id="buildingaddress" name="buildingaddress" value="'.($project['buildingaddress'] ?? '').'" disabled>
                                            </div>
                                            
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="workarea">Work Area:</label>
                                                <input type="text" id="workarea" name="workarea" value="'.($project['workArea'] ?? '').'" required>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                        <label for="budgetConstraint">Budget Constraint:</label>
                                        <input type="number" placeholder="Enter Budget Limit Here" id="budgetConstraint" name="budgetConstraint" value="'.htmlspecialchars($project['budgetConstraint'] ?? '').'" required>
                                    </div>          
                                        <div class="form-group">
                                            <label for="description">Project Description:</label>
                                            <textarea id="projectDetails" name="projectDetails" required>'.($project['projectDetails'] ?? '').'</textarea>
                                        </div>
                                        <div class="form-group" style="height: 100px;">
                                            <label for="description">Special Requests:</label>
                                            <textarea id="specialRequests" name="specialRequests">'.($project['specialRequests'] ?? '').'</textarea>
                                        </div>
                                        <div class="form-group_three">
                                            <div class="input-group">
                                                <label for="projectDeadline" class="siteinfo">Project Deadline:</label>
                                                <input type="date" id="deadlineDate" name="deadlineDate" value="'.($project['deadlineDate'] ?? '').'" min="2020-12-31" max="9999-12-31">
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="startdate" class="siteinfo">Start Date of Project:</label>
                                                <input type="date" id="startdate" name="startdate" value="'.($project['startDate'] ?? '').'" min="2020-12-31" max="9999-12-31">
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="datecomplete" class="siteinfo">Completion Date of Project:</label>
                                                <input type="date" id="completiondate" name="completiondate" value="'.($project['completionDate'] ?? '').'" min="2020-12-31" max="9999-12-31">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="attach-blueprint">
                                                <label for="blueprint">Blueprints: </label>
                                                <div class="input-group" id="bprint-upload">
                                                    <input type="file" id="blueprint" name="blueprint"> 
                                                    <label for="blueprint[]" class="labelforupload"><i class="fa-solid fa-upload"></i> Attach Files Here</label>
                                                </div>
                                                <div id="attachment" class="w100">
                                                    <div class="bold">
                                                        Attached Files:
                                                    </div>
                                                    <div id="attached-filelist">
                                                        <ul id="list">
                                                        </ul>
                                                        </div>
                                                    </div>
                                            </div>
                        </div>
                            <button id="addfinal">Apply Changes</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>   
</div>
'
?>