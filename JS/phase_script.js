var modal = document.getElementById("myModal");
var modalEdit = document.getElementById("myEditModal");
var btn = document.getElementById("addphase");
const spans = document.querySelectorAll(".close");

// $_GET VALUES
const urlParams = new URLSearchParams(window.location.search);
const projectid = urlParams.get('id');

btn.onclick = function() {
    modal.style.display = "block";
}


spans.forEach(function(span) {
    span.onclick = function() {
        modal.style.display = "none";
        modalEdit.style.display = "none";
    }
});

window.onclick = function(event) {
    if (event.target == modal || event.target == modalEdit) {
        modal.style.display = "none";
        modalEdit.style.display = "none";
    }
}

function closeModal(){
    window.location.href = `projectpage.php?id=` + projectid;
}


document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const projectid = urlParams.get('id');

    // Function to update the project's isComplete status
    function updateProjectCompletionStatus(projectID) {
        fetch('../../../Models/AdminProjects/project_completion_checker.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ projectID: projectID })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Project completion status updated successfully');
            } else {
                console.error('Error updating project completion status:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Event delegation for checkbox changes within the phase list
    document.addEventListener('change', function(event) {
        if (event.target.matches('input[type="checkbox"][data-id]')) {
            const phaseID = event.target.getAttribute('data-id');
            const isFinished = event.target.checked ? 1 : 0;

            fetch('../../../Models/AdminPhases/phase_checker.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    phaseID: phaseID,
                    isFinished: isFinished
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Phase status updated successfully');
                    // Update the project completion status
                    updateProjectCompletionStatus(projectid);
                    // Update the phase list content
                    updatePhaseList();
                    // Reattach event listeners after updating phase list
                    reattachEventListeners();
                    // Update the progress bar
                    updateProgressBar();
                } else {
                    console.error('Error updating phase status:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Function to update the phase list content
    function updatePhaseList() {
        fetch('phaselist.php?id=' + projectid)
            .then(response => response.text())
            .then(html => {
                document.getElementById('phase-list').innerHTML = html;
            })
            .then(() => {
                reattachEventListeners();
            })
            .catch(error => console.error('Error fetching phase list:', error));
    }

    // Function to reattach event listeners after updating phase list
    function reattachEventListeners() {
        // Reattach click event listeners to edit buttons
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                var phaseid = this.getAttribute('data-id');
                window.location.href = '/../Pages/Admin/ProjectDetails/editphase.php?id=' + projectid + '&phaseid=' + phaseid;
            });
        });

        // Reattach click event listeners to delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                var phaseid = this.getAttribute('data-id');
                console.log('Phase ID:', phaseid); // Log the phase ID being sent

                if (confirm('Are you sure you want to delete this Phase?')) {
                    fetch('/../Models/AdminPhases/delete_phase.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'phaseid=' + phaseid,
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log('Response:', data); // Log the response from the server
                        if (data === 'success') {
                            alert('Phase deleted successfully!');
                            location.reload();
                        } else {
                            alert('Failed to delete the Phase.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete the Phase.');
                    });
                }
            });
        });
    }

    // Function to update the progress bar
    function updateProgressBar() {
        fetch('../../../Models/AdminPhases/progress_updater.php?id=' + projectid, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let progressRate = data.progressRate;
                if(progressRate == null){
                    progressRate = 0;
                }
                document.getElementById('progressNum').textContent = `${progressRate}%`;
            } else {
                console.error('Error fetching progress rate:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Initial update of phase list and progress bar on page load
    updatePhaseList();
    updateProgressBar();
});
