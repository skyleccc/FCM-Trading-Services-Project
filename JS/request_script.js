document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    var span2 = document.getElementsByClassName("edit")[0];

    if (btn) {
        btn.onclick = function() {
            modal.style.display = "block";
        }
    }

    if (span) {
        span.onclick = function() {
            window.location.href = `quotationreqs.php`;
        }
    }

    if (span2) {
        span2.onclick = function() {
            var id = $(this).data('id');
            window.location.href = `edit_quotation.php` + '?id=' + id;
        }
    }


    
    $('.approve-btn').click(function() {
        var id = $(this).data('id');
        console.log('Approve button clicked for ID:', id); // Debugging line
        if (confirm('Are you sure you want to approve this quotation?')) {
            let projectName, clientName, buildingID, clientContact, clientEmail, location, siteInformation, projectType, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, newClientID, projectID;

            fetch('../../../Models/AdminQuotReqs/getRequestData.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'requestid=' + id,
            })
            .then(response => response.json())
            .then(data => {
                if(data.success === false){
                    alert(data.message);
                    return;
                }
                console.log('Response from request: ', data);
                clientName = data.clientName;
                clientContact = data.clientContact;
                clientEmail = data.clientEmail;
                location = data.location;
                siteInformation = data.siteInformation;
                projectType = data.projectType;
                startDate = data.startDate;
                completeDate = data.completeDate;
                projectDetails = data.projectDetails;
                workArea = data.workArea;
                budgetConstraint = data.budgetConstraint;
                specialRequests = data.specialRequests;

                return fetch('../../../Models/AdminQuotReqs/findClient.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'clientname=' + encodeURIComponent(clientName),
                });
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response from approve:', data); // Debugging line
    
                if (data.success === false) {
                    alert(data.message);
                    return;
                }
                
                // Create New Client
                if (data.client_id === null) {
                    if (confirm('Client does not exist. Do you want to create a new client?')) {
                        fetch('../../../Models/AdminQuotReqs/createNewClient.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'requestid=' + id,
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Response from create:', data);

                            if(data.success === false){
                                alert(data.message);
                                return;
                            }

                            // Enter Create New Building
                            if(data.client_id != null){
                                newClientID = data.client_id;
                                return fetch('../../../Models/AdminQuotReqs/createNewBuilding.php',{
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: 'buildingaddress=' + location,
                                });
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success === false) {
                                alert(data.message);
                                cancelClientCreation(newClientID);
                                return;
                            }
                            buildingID = data.buildingID;

                            // Create Project Name
                            projectName = prompt("Please enter the project name:");
                            if (projectName == null || projectName == "") {
                                alert("Process is cancelled. No action taken.");
                                cancelBuildingCreation(buildingID);
                                cancelClientCreation(newClientID);
                                return;
                            } else {
                                // Set Project Scope
                                projectScope = prompt("Please enter the scope of the project:");
                                if (projectScope == null || projectScope == "") {
                                    alert("Process is cancelled. No action taken.");
                                    cancelBuildingCreation(buildingID);
                                    cancelClientCreation(newClientID);
                                    return;
                                }else{
                                    // Create Project
                                    let POST_VAL = appendPostValues(projectName, newClientID, buildingID, siteInformation, projectType, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, projectScope);

                                    fetch('../../../Models/AdminQuotReqs/add_to_project.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                        },
                                        body: POST_VAL.toString(),
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success === false) {
                                            alert(data.message);
                                            throw new Error(data.message); // Stop further execution
                                        }
                                        projectID = data.projectid;

                                        // Only after projectID is assigned, call copyFilesToProjects
                                        return copyFilesToProjects(id, projectID);
                                    })
                                    .then(() => {
                                        return fetch('../../../Models/AdminQuotReqs/quotationapprove.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                            },
                                            body: 'requestid=' + id,
                                        });
                                    })
                                    .then(() => {
                                        alert('Project approved and added to the project list!');
                                        window.location.href = 'quotationreqs.php';
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        alert('Failed to approve the request.');
                                    });
                                }
                            }
                        })
                    } else {
                        alert('No action taken.');
                    }
                } else {
                    var msg = 'Client already exists. Do you want to use existing details?\n\n' +
                    'Client ID: ' + (data.client_id || 'No Client ID') + '\n' +
                    'Client Name: ' + (data.client_name || 'No Client Name') + '\n' +
                    'Client Number: ' + (data.client_contact || 'No Contact Number') + '\n' +
                    'Client Email: ' + (data.client_email || 'No Client Email');
                    if (confirm(msg)) {
                        clientID = data.client_id;
                        if(data.client_contact != clientContact || data.client_email != clientEmail){
                            var updateContact = 'Client has updated his/her contacts. Switch to new?\n\n';
                            if(data.client_contact != clientContact){
                                updateContact += 'Old Contact Number: ' + (data.client_contact || 'No Contact Number') + '\n' +
                                'New Contact Number: ' + (clientContact || 'No Contact Number') + '\n';
                            }
                            if(data.client_email != clientEmail){
                                updateContact += 'Old Email: ' + (data.client_email || 'No Client Email') + '\n' +
                                'New Email: ' + (clientEmail || 'No Client Email') + '\n';
                            }
                            if(confirm(updateContact)){
                                // Update Client Contact
                               updateClientContact(clientID, clientContact, clientEmail);
                               fetch('../../../Models/AdminQuotReqs/findBuilding.php',{
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: "buildingaddress="+location,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.success === true){
                                    if(data.building_id == null){
                                        // BuildingID not found, therefore create
                                        fetch('../../../Models/AdminQuotReqs/createNewBuilding.php',{
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                            },
                                            body: 'buildingaddress=' + location,
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            buildingID = data.buildingID;
                                        })
                                    }else{
                                        // BuildingID found
                                        buildingID = data.building_id;
                                        
                                        // Create Project Name
                                        projectName = prompt("Please enter the project name:");
                                        if (projectName == null || projectName == "") {
                                            alert("Process is cancelled. No action taken.");
                                            cancelBuildingCreation(buildingID);
                                            cancelClientCreation(newClientID);
                                            return;
                                        }else {
                                            // Set Project Scope
                                            projectScope = prompt("Please enter the scope of the project:");
                                            if (projectScope == null || projectScope == "") {
                                                alert("Process is cancelled. No action taken.");
                                                cancelBuildingCreation(buildingID);
                                                cancelClientCreation(newClientID);
                                                return;
                                            }else{
                                                // Create Project
                                                let POST_VAL = appendPostValues(projectName, clientID, buildingID, siteInformation, projectType, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, projectScope);
            
                                                fetch('../../../Models/AdminQuotReqs/add_to_project.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded',
                                                    },
                                                    body: POST_VAL.toString(),
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success === false) {
                                                        alert(data.message);
                                                        throw new Error(data.message); // Stop further execution
                                                    }
                                                    projectID = data.projectid;
            
                                                    // Only after projectID is assigned, call copyFilesToProjects
                                                    return copyFilesToProjects(id, projectID);
                                                })
                                                .then(() => {
                                                    return fetch('../../../Models/AdminQuotReqs/quotationapprove.php', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/x-www-form-urlencoded',
                                                        },
                                                        body: 'requestid=' + id,
                                                    });
                                                })
                                                .then(() => {
                                                    alert('Project approved and added to the project list!');
                                                    window.location.href = 'quotationreqs.php';
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    alert('Failed to approve the request.');
                                                });
                                            }
                                        }
                                    }
                                }else{
                                    alert("Error was noticed. Process is canceled.");
                                }
                            })
                                
                            }else{
                                fetch('../../../Models/AdminQuotReqs/findBuilding.php',{
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: "buildingaddress="+location,
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if(data.success === true){
                                        if(data.building_id == null){
                                            // BuildingID not found, therefore create
                                            fetch('../../../Models/AdminQuotReqs/createNewBuilding.php',{
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded',
                                                },
                                                body: 'buildingaddress=' + location,
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                buildingID = data.buildingID;
                                            })
                                        }else{
                                            // BuildingID found
                                            buildingID = data.building_id;
                                            
                                            // Create Project Name
                                            projectName = prompt("Please enter the project name:");
                                            if (projectName == null || projectName == "") {
                                                alert("Process is cancelled. No action taken.");
                                                cancelBuildingCreation(buildingID);
                                                cancelClientCreation(newClientID);
                                                return;
                                            }else {
                                                // Set Project Scope
                                                projectScope = prompt("Please enter the scope of the project:");
                                                if (projectScope == null || projectScope == "") {
                                                    alert("Process is cancelled. No action taken.");
                                                    cancelBuildingCreation(buildingID);
                                                    cancelClientCreation(newClientID);
                                                    return;
                                                }else{
                                                    // Create Project
                                                    let POST_VAL = appendPostValues(projectName, clientID, buildingID, siteInformation, projectType, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, projectScope);
                
                                                    fetch('../../../Models/AdminQuotReqs/add_to_project.php', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/x-www-form-urlencoded',
                                                        },
                                                        body: POST_VAL.toString(),
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.success === false) {
                                                            alert(data.message);
                                                            throw new Error(data.message); // Stop further execution
                                                        }
                                                        projectID = data.projectid;
                
                                                        // Only after projectID is assigned, call copyFilesToProjects
                                                        return copyFilesToProjects(id, projectID);
                                                    })
                                                    .then(() => {
                                                        return fetch('../../../Models/AdminQuotReqs/quotationapprove.php', {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/x-www-form-urlencoded',
                                                            },
                                                            body: 'requestid=' + id,
                                                        });
                                                    })
                                                    .then(() => {
                                                        alert('Project approved and added to the project list!');
                                                        window.location.href = 'quotationreqs.php';
                                                    })
                                                    .catch(error => {
                                                        console.error('Error:', error);
                                                        alert('Failed to approve the request.');
                                                    });
                                                }
                                            }
                                        }
                                    }else{
                                        alert("Error was noticed. Process is canceled.");
                                    }
                                })
                            }
                        }else{
                            fetch('../../../Models/AdminQuotReqs/findBuilding.php',{
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: "buildingaddress="+location,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.success === true){
                                    if(data.building_id == null){
                                        // BuildingID not found, therefore create
                                        fetch('../../../Models/AdminQuotReqs/createNewBuilding.php',{
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                            },
                                            body: 'buildingaddress=' + location,
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            buildingID = data.buildingID;
                                        })
                                    }else{
                                        // BuildingID found
                                        buildingID = data.building_id;
                                        
                                        // Create Project Name
                                        projectName = prompt("Please enter the project name:");
                                        if (projectName == null || projectName == "") {
                                            alert("Process is cancelled. No action taken.");
                                            cancelBuildingCreation(buildingID);
                                            cancelClientCreation(newClientID);
                                            return;
                                        }else {
                                            // Set Project Scope
                                            projectScope = prompt("Please enter the scope of the project:");
                                            if (projectScope == null || projectScope == "") {
                                                alert("Process is cancelled. No action taken.");
                                                cancelBuildingCreation(buildingID);
                                                cancelClientCreation(newClientID);
                                                return;
                                            }else{
                                                // Create Project
                                                let POST_VAL = appendPostValues(projectName, newClientID, buildingID, siteInformation, projectType, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, projectScope);
            
                                                fetch('../../../Models/AdminQuotReqs/add_to_project.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded',
                                                    },
                                                    body: POST_VAL.toString(),
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success === false) {
                                                        alert(data.message);
                                                        throw new Error(data.message); // Stop further execution
                                                    }
                                                    projectID = data.projectid;
            
                                                    // Only after projectID is assigned, call copyFilesToProjects
                                                    return copyFilesToProjects(id, projectID);
                                                })
                                                .then(() => {
                                                    return fetch('../../../Models/AdminQuotReqs/quotationapprove.php', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/x-www-form-urlencoded',
                                                        },
                                                        body: 'requestid=' + id,
                                                    });
                                                })
                                                .then(() => {
                                                    alert('Project approved and added to the project list!');
                                                    window.location.href = 'quotationreqs.php';
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    alert('Failed to approve the request.');
                                                });
                                            }
                                        }
                                    }
                                }else{
                                    alert("Error was noticed. Process is canceled.");
                                }
                            })
                        }
                    }else{
                        // change name of client
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to approve the request.');
            });
        }
    });

    $('.decline-btn').click(function() {
        var id = $(this).data('id');
        console.log('Decline button clicked for ID:', id); // Debugging line
        if (confirm('Are you sure you want to decline this project?')) {
            fetch('../../../Models/AdminQuotReqs/quotationdecline.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'requestid=' + id,
            })
            .then(response => response.text())
            .then(data => {
                console.log('Response from decline:', data); // Debugging line
                if (data === 'success') {
                    alert('Project declined!');
                    window.location.href = 'quotationreqs.php';
                } else {
                    alert('Failed to decline the request.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to decline the request.');
            });
        }
    });
    
});

function clientNameValidator(){
    
}

function copyFilesToProjects(requestID, projectID) {
    fetch('../../../Models/AdminQuotReqs/copy_bp_files.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'requestid': requestID,
            'projectid': projectID,
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response:', data);
        if (Array.isArray(data)) {
            data.forEach(item => {
                if (item.success) {
                    console.log(item.message);
                } else {
                    console.error(item.message);
                }
            });
        } else {
            console.error('Unexpected response format:', data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function updateClientContact(clientID, clientContact, clientEmail){
    var contUpdate = new URLSearchParams;
    contUpdate.append('clientid', clientID);
    contUpdate.append('clientcontact', clientContact);
    contUpdate.append('clientemail', clientEmail);
    fetch('../../../Models/AdminQuotReqs/update_client_details.php',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: contUpdate.toString(),
    })
}

function appendPostValues(projectName, clientID, buildingID, siteInformation, projectType, startDate, completeDate, projectDetails, workArea, budgetConstraint, specialRequests, projectScope){
    const params = new URLSearchParams();
    params.append('projectname', projectName);
    params.append('clientid', clientID);
    params.append('buildingid', buildingID);
    params.append('siteinformation', siteInformation);
    params.append('projecttype', projectType);
    params.append('startdate', startDate);
    params.append('deadlinedate', completeDate);
    params.append('projectdetails', projectDetails);
    params.append('workarea', workArea);
    params.append('budgetconstraint', budgetConstraint);
    params.append('specialrequests', specialRequests);
    params.append('projectscope', projectScope);

    return params;
}

function cancelBuildingCreation(buildingID){
    fetch('../../../Models/AdminQuotReqs/deleteBuilding.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'buildingid=' + buildingID,
    })
}

function cancelClientCreation(clientID){
    fetch('../../../Models/AdminClients/delete_client.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'clientID=' + clientID,
    })
}

let fileUrls = [];

document.addEventListener('DOMContentLoaded', function() {
    fetchExistingFiles();
});

function fetchExistingFiles() {
    const requesterID = new URLSearchParams(window.location.search).get('id');
    fetch(`../../../Models/AdminQuotReqs/listFiles.php?id=${requesterID}`)
        .then(response => response.json())
        .then(files => {
            const listElement = document.getElementById('list');
            const noFilesText = document.getElementById('no-files-text');
            listElement.innerHTML = ''; // Clear existing list items

            if (files.length === 0) {
                noFilesText.style.display = 'block';
            } else {
                noFilesText.style.display = 'none';

                files.forEach(file => {
                    const listItem = document.createElement('li');
                    const previewDiv = document.createElement('div');
                    previewDiv.classList.add('preview');

                    const fileUrl = `../../../AttachedFiles/Blueprints/quotationRequestBlueprints/blueprint-${requesterID}/${file}`;
                    fileUrls.push(fileUrl);

                    const fileLink = document.createElement('a');
                    fileLink.textContent = file;
                    fileLink.classList.add('filename');
                    fileLink.href = fileUrl;
                    fileLink.target = '_blank';

                    previewDiv.appendChild(fileLink);
                    listItem.appendChild(previewDiv);
                    listElement.appendChild(listItem);
                });
            }
        })
        .catch(error => console.error('Error fetching existing files:', error));
}

function displayFileList() {
    const fileInput = document.getElementById('blueprint');
    const fileList = fileInput.files;
    const listElement = document.getElementById('list');
    const noFilesText = document.getElementById('no-files-text');

    // Clear any previously displayed new files
    const newFileItems = document.querySelectorAll('.new-file');
    newFileItems.forEach(item => listElement.removeChild(item));

    if (fileList.length === 0) {
        noFilesText.style.display = 'block';
    } else {
        noFilesText.style.display = 'none';

        for (let i = 0; i < fileList.length; i++) {
            const file = fileList[i];
            const listItem = document.createElement('li');
            listItem.classList.add('new-file');
            const previewDiv = document.createElement('div');
            previewDiv.classList.add('preview');

            const fileUrl = URL.createObjectURL(file);
            fileUrls.push(fileUrl);

            const fileLink = document.createElement('a');
            fileLink.textContent = file.name;
            fileLink.classList.add('filename');
            fileLink.href = fileUrl;
            fileLink.target = '_blank';

            previewDiv.appendChild(fileLink);
            previewDiv.appendChild(document.createTextNode(" (Apply Changes to Save)"));
            listItem.appendChild(previewDiv);
            listElement.appendChild(listItem);
        }
    }
}

// Revoke all created URLs when the window is unloaded
window.addEventListener('unload', () => {
    fileUrls.forEach(url => URL.revokeObjectURL(url));
});