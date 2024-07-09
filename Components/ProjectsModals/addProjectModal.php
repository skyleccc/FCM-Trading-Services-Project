<?php

// Model Requirement: "Models/AdminProjects/project_save.php"

// File Redirects
$addProject = "../../../Models/AdminProjects/projects_save.php";


echo'
<div class="col modalblock">
    <div id="myModal" class="popup">
        <div class="quotationscontainer">
            <div class="row" style="height: 100%;">
                <div class="container p-3 border bg-light rounded">
                    <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Enter a new Project<span class="close">&times;</span></div><br>
                    <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                        <div class="col-sm ex2" style="border: solid; border-color: green; border-radius: 8px; height: 670px; color: green;">
                            <form class="form" action="'.$addProject.'" method="POST" id="addProjectForm">
                                <div id="scrollform">
                                    <div class="form-group">
                                        <label for="project">Project Name:</label>
                                        <input type="text" id="projectname" name="projectname" placeholder="Enter Name of Project Here" required>
                                    </div>
                                    <div class="form-group_two">
                                        <div class="input-group">
                                            <label for="client">Client:</label>
                                            <input type="text" id="clientname" name="clientname" placeholder="Enter Name of Client Here" required>
                                        </div>
                                        <div class="space"></div>
                                        <div class="input-group">
                                            <label for="assignedContractor">Client\'s Contact Number:</label>
                                            <input type="text" id="clientContact" name="clientContact" placeholder="Enter Name of Contractor Here" required>
                                        </div>
                                    </div>
                                    <div class="form-group_two">
                                    <div class="form-group">
                                        <label for="projectScope">Project Scope:</label>
                                        <input type="text" id="projectScope" name="projectScope" placeholder="Enter the Scope of the Project" required>
                                    </div>
                                        <div class="space"></div>
                                        <div class="input-group">
                                            <label for="type">Type of Work:</label>
                                            <input type="text" id="projecttype" name="projecttype" placeholder="Enter Type of Work Here" required>
                                        </div>
                                    </div>

                                    <div class="form-group_two">
                                    <div class="form-group">
                                        <label for="building">Location:</label>
                                        <input type="text" id="buildingaddress" name="buildingaddress" placeholder="Enter Name of Building" required>
                                        </div>
                                        
                                        <div class="space"></div>
                                        <div class="input-group">
                                            <label for="building">Work Area:</label>
                                            <input type="text" id="workarea" name="workarea" placeholder="Enter Name of Building" required>
                                            

                                            <label for="blueprint">Blueprints</label>
                                            <input type="file" id="blueprint" name="blueprint" placeholder="Type Here...">
                                            <label for="blueprint" class="labelforupload">
                                                <i class="fa-solid fa-upload"></i> Attach Files Here
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description">Project Description:</label>
                                        <textarea id="projectDetails" name="projectDetails" placeholder="Type Here..." required></textarea>
                                    </div>
                                    <div class="form-group" style="height: 100px;">
                                        <label for="description">Special Requests:</label>
                                        <textarea id="specialRequests" name="specialRequests" placeholder="Type Here..."></textarea>
                                    </div>
                                    <div class="form-group_three">
                                        <div class="input-group">
                                            <label for="projectDeadline" class="siteinfo">Project Deadline:</label>
                                            <input type="date" id="deadlineDate" name="deadlineDate">
                                        </div>
                                        <div class="space"></div>
                                        <div class="input-group">
                                            <label for="startdate" class="siteinfo">Start Date of Project:</label>
                                            <input type="date" id="startdate" name="startdate">
                                        </div>
                                        <div class="space"></div>
                                        <div class="input-group">
                                            <label for="datecomplete" class="siteinfo">Completion Date of Project:</label>
                                            <input type="date" id="completiondate" name="completiondate" placeholder="Type Here...">
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <button id="addfinal">Add Project</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
'
?>