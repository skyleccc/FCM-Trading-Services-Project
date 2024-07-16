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
            modal.style.display = "none";
        }
    }

    function closeModal() {
        window.location.href = `quotationreqs.php`;
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
            fetch('../../../Models/AdminQuotReqs/quotationapprove.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'requestid=' + id,
            })
            .then(response => response.text())
            .then(data => {
                console.log('Response from approve:', data); // Debugging line
                if (data === 'success') {
                    alert('Project approved!');
                    window.location.href = 'quotationreqs.php';
                } else {
                    if (confirm('Client already exists. Do you want to use existing details?')) {
                        alert('Using existing details.');
                        updateUsingExistingClientDetails(id);
                    }else{
                        if(confirm('Do you want to create a new cient?')){
                            alert('Creating new client information');
                            createNewClient(id);
                        }
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
function updateUsingExistingClientDetails(requestId) {
    fetch('../../../Models/AdminQuotReqs/updateUsingExistingClientDetails.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'requestid=' + requestId,
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from updating using existing client details:', data); // Debugging line
        if (data === 'success') {
            alert('Updated using existing client details.');
            window.location.href = 'quotationreqs.php';
        } else {
            alert('Failed to update using existing client details.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update using existing client details.');
    });
}

function createNewClient(requestId) {
    fetch('../../../Models/AdminQuotReqs/createNewClient.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'requestid=' + requestId,
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from creating new client:', data); // Debugging line
        if (data === 'success') {
            alert('New client created and request approved.');
            window.location.href = 'quotationreqs.php';
        } else {
            alert('Failed to create new client.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to create new client.');
    });
}



$(document).ready(function() {
    // Approve button click handler
    $('.approve-btn').click(function(e) {
        e.preventDefault();
        var requestId = $(this).data('id');
        processRequest(requestId, 'approve');
    });

    // Decline button click handler
    $('.decline-btn').click(function(e) {
        e.preventDefault();
        var requestId = $(this).data('id');
        processRequest(requestId, 'decline');
    });

    function processRequest(requestId, action) {
        $.ajax({
            url: 'C:\Users\desktop\School Shit\FCM-Trading-Services-Project\Pages\Admin\QuotationReqsList\processreq.php',
            type: 'POST',
            data: { requestId: requestId, action: action },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = 'quotationreqs.php';
                } else {
                    alert(response.message);
                }   
            }
        });
    }
});

let fileUrls = [];

document.addEventListener('DOMContentLoaded', function() {
    fetchExistingFiles();
});

function fetchExistingFiles() {
    const requesterID = new URLSearchParams(window.location.search).get('id');
    fetch(`listFiles.php?id=${requesterID}`)
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

                    const fileUrl = `../../AttachedFiles/Blueprints/quotationRequestBlueprints/blueprint-${requesterID}/${file}`;
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