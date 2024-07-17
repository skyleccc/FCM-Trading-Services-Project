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
                                            <label for="editprojectname">Project Name:</label>
                                            <input type="text" id="editprojectname" name="projectname" value="'.htmlspecialchars($project['projectName'] ?? '').'" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="editclientname">Client: (Not Editable)</label>
                                        <input type="text" id="editclientname" name="clientname" value="'.htmlspecialchars($project['clientName'] ?? '').'" disabled>
                                    </div>
                                        <div class="form-group_two">
                                            <div class="input-group">
                                                <label for="editclientEmail">Client\'s Email Address: (Not Editable)</label>
                                                <input type="text" id="editclientEmail" name="clientEmail" value="'.htmlspecialchars($project['clientEmail'] ?? 'No Email').'" disabled>
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="editclientContact">Client\'s Contact Number: (Not Editable)</label>
                                                <input type="text" id="editclientContact" name="clientContact" value="'.($project['clientContact'] ?? 'No Contact').'" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group_two">
                                            <div class="form-group">
                                                <label for="editprojectScope">Project Scope:</label>
                                                <input type="text" id="editprojectScope" name="projectScope" value="'.($project['projectScope'] ?? '').'" required>
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="editservicetype">Service Type:</label>
                                                <div>
                                                    <select id="editservicetype" title="Service Type" name="servicetype" required>
                                                        <option value="" disabled>-</option>
                                                        <option value="Construction"'; echo ($project['projectType']=="Construction") ? 'selected':''; echo'>Construction</option>
                                                        <option value="Renovation" '; echo ($project['projectType']=="Renovation") ? 'selected':''; echo'>Renovation</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group_two">
                                            <div class="form-group">
                                                <label for="editbuilding">Location: (Not Editable)</label>
                                                <input type="text" id="editbuilding" name="buildingaddress" value="'.($project['buildingaddress'] ?? '').'" disabled>
                                            </div>
                                            
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="editworkarea">Work Area:</label>
                                                <input type="text" id="editworkarea" name="workarea" value="'.($project['workArea'] ?? '').'" required>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                        <label for="editbudgetConstraint">Budget Constraint:</label>
                                        <input type="number" placeholder="Enter Budget Limit Here" id="editbudgetConstraint" name="budgetConstraint" value="'.htmlspecialchars($project['budgetConstraint'] ?? '').'" required>
                                    </div>          
                                        <div class="form-group">
                                            <label for="editprojectDetails">Project Description:</label>
                                            <textarea id="editprojectDetails" name="projectDetails" required>'.($project['projectDetails'] ?? '').'</textarea>
                                        </div>
                                        <div class="form-group" style="height: 100px;">
                                            <label for="editspecialRequests">Special Requests:</label>
                                            <textarea id="editspecialRequests" name="specialRequests">'.($project['specialRequests'] ?? '').'</textarea>
                                        </div>
                                        <div class="form-group_three">
                                            <div class="input-group">
                                                <label for="editdeadlineDate" class="siteinfo">Project Deadline:</label>
                                                <input type="date" id="editdeadlineDate" name="deadlineDate" value="'.($project['deadlineDate'] ?? '').'" min="2020-12-31" max="9999-12-31">
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="editstartdate" class="siteinfo">Start Date of Project:</label>
                                                <input type="date" id="editstartdate" name="startdate" value="'.($project['startDate'] ?? '').'" min="2020-12-31" max="9999-12-31">
                                            </div>
                                            <div class="space"></div>
                                            <div class="input-group">
                                                <label for="editcompletiondate" class="siteinfo">Completion Date of Project:</label>
                                                <input type="date" id="completiondate" name="completiondate" value="'.($project['completionDate'] ?? '').'" min="2020-12-31" max="9999-12-31">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="editattach-blueprint">
                                                <label for="blueprint">Blueprints: </label>
                                                <div class="input-group bprint-upload">
                                                    <label for="editblueprint" class="labelforupload"><i class="fa-solid fa-upload"> ADD BLUEPRINT</i></label>
                                                    <input type="file" id="editblueprint" name="blueprint[]" onchange="displayFileList();" multiple>
                                                </div>
                                                <div id="editattachment" class="w100">
                                                    <div class="bold">
                                                        Attached Files:
                                                    </div>
                                                    <div id="editattached-filelist">
                                                        <ul id="editlist">
                                                        </ul>
                                                        </div>
                                                    </div>
                                            </div>
                        </div>
                            <button id="editfinal">Apply Changes</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>   
</div>
'
?>