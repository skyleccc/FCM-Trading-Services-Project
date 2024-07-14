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
                    alert('Failed to approve the request.');
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
            url: '../../../Models/QuotationReqs/processRequest.php',
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
            listElement.innerHTML = ''; // Clear existing list items

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
        })
        .catch(error => console.error('Error fetching existing files:', error));
}

function displayFileList() {
    const fileInput = document.getElementById('blueprint');
    const fileList = fileInput.files;
    const listElement = document.getElementById('list');

    // Clear any previously displayed new files
    const newFileItems = document.querySelectorAll('.new-file');
    newFileItems.forEach(item => listElement.removeChild(item));

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

// Revoke all created URLs when the window is unloaded
window.addEventListener('unload', () => {
    fileUrls.forEach(url => URL.revokeObjectURL(url));
});