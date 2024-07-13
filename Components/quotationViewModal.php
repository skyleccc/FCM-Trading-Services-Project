<?php 
echo'
<div class="col modalblock">
        <div id="myModal" class="popup"style="display: block;">
            <div class="quotationscontainer">
            <div class="ex1 border bg light rounded">
                <form id="quotationForm" class="p-3" action="../../../Models/QuotationReqs/fileUpload.php" method="post" enctype="multipart/form-data">
                <div style="font-size: 20px; font-weight: bold; text-align: center; color: black">Enter a new Project
                <span class="close">&times;</span>
                </div><br>
                <div class="form-group">
            <label for="requester">Requested By:</label>
            <input type="text" id="requester" name="requestername" value="'.htmlspecialchars($clientname['clientname'] ?? '').'" disabled>
        </div>
        <div class="form-group_two">
            <div class="input-group">
            <label for="loc">Location:</label>
            <input type="text" id="loc" name="location" value="'.htmlspecialchars($location['location'] ?? '').'" disabled>
            </div>
            <div class="space"></div>
            <div class="input-group">
            <label for="site" class="siteinfo">Site Information:</label>
            <input type="text" id="site" name="siteinfo" value="'.htmlspecialchars($siteinformation['siteinformation'] ?? '').'" disabled>
            </div>
        </div>
        <div class="form-group_three">
            <div class="input-group">
                <label for="servicetype">Service Type:</label>
                <div>
                    <select id="servicetype" title="Service Type" name="servicetype" disabled>
                        <option selected value="'.($project['servicetype'] ?? '').'">'.($servicetype['servicetype'] ?? '').'</option>
                        <option value="Construction">Construction</option>
                        <option value="Renovation">Renovation</option>
                    </select>
                </div>
            </div>
            <div class="space"></div>
            <div class="input-group">
                <label for="startdate" class="siteinfo">Start Date:</label>
                <input type="date" id="startdate" name="startdate" value="'.htmlspecialchars($startdate['startdate'] ?? '');'" disabled>
            </div>
            <div class="space"></div>
            <div class="input-group">
                <label for="datecomplete" class="siteinfo">Date of Completion:</label>
                <input type="date" id="datecomplete" name="datecomplete" value="'.htmlspecialchars($completedate['completedate'] ?? '').'" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="details">Project Details:</label>
            <textarea type="textarea" id="details" name="projdetails" disabled>'.($projectdetails['projectdetails'] ?? '').'</textarea>
        </div>
        <div class="form-group_two">
            <div class="input-group">
                <label for="areaofwork">Area of Work:</label>
                <input type="number" id="areaofwork" name="areaofwork" value="'.htmlspecialchars($workarea['workarea'] ?? '').'" disabled> 
            </div>
            <div class="space"></div>
            <div class="input-group">
                <label for="constraints" class="siteinfo">Budget Constraints:</label>
                <input type="number" id="constraints" name="budget_constraints" value="'.htmlspecialchars($budgetconstraints['budgetconstraints'] ?? '').'" disabled>
            </div>
        </div>
        <div class="form-group">
                <label for="specialrequests">Special Requests:</label>
                <textarea type="textarea" id="specialrequests" name="specialrequests" disabled>'.($specialrequests['specialrequests'] ?? '').'</textarea>
        </div>
        <div class="form-group">
            <label for="contact">Email / Contact Number:</label>
            <input type="text" id="contact" name="contact" value="'.htmlspecialchars($contact['contact'] ?? '').'" disabled>
        </div>
        <div class="form-group_two">
            <div class="input-group">
                <label for="blueprint-add" class="toggle">
                    <input id="blueprint-add" class="toggle-checkbox" type="checkbox" name="blueprint-add" onclick="displayAttach();" disabled>
                    <div class="toggle-switch"></div>
                    <span class="toggle-label">With Blueprint/Floor Plan</span>
                </label>
            </div>
            <div class="space"></div>
            <div class="input-group" id="attach-blueprint">
                <label for="blueprint" class="labelforupload"><i class="fa-solid fa-upload"> ADD BLUEPRINT</i></label>
                <input type="file" id="blueprint" name="blueprint[]" onchange="displayFileList();" multiple>
            </div>
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
                <div class="row" style="width: 100%">
                    <div class="col"><button type="submit" class="addfinal approve-btn" data-id="<?php htmlspecialchars($row2["requestid"]) ?>" name="submit" >Approve Quotation</button></div>
                    <div class="col"><button class="addfinal2 decline-btn" data-id="<?php htmlspecialchars($row2["requestid"]) ?>"name="submit" >Decline Quotation</button></div>
                </div>
            </div>
    </form>
';
?>