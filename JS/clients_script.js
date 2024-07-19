$(document).ready(function () {
    let clientID;

    // Function to fetch client details
    function fetchClientDetails(clientID) {
        return fetch(`../../../Models/AdminClients/filldata_modal.php?clientID=${clientID}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error fetching client details:', data.error);
                    throw new Error('Error fetching client details');
                } else {
                    // Populate form fields
                    $('#editClientName').val(data.clientName);
                    $('#editClientContact').val(data.clientContact);
                    $('#editClientEmail').val(data.clientEmail);
                }
            })
            .catch(error => {
                console.error('Error fetching client details:', error);
                throw error;
            });
    }

    // Event listener for modal show event
    $('#editClientModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        clientID = button.data('id');

        // Fetch and fill modal data
        fetchClientDetails(clientID)
            .then(() => {
                // Data successfully fetched and populated in form
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error fetching client details');
            });
    });

    // Event listener for edit button click to set clientID and populate the form
    $(document).on('click', '.edit-btn', function (event) {
        const targetElement = event.target.closest('[data-id]');
        clientID = targetElement.getAttribute('data-id');

        if (clientID) {
            // Fetch client data and populate the form
            fetchClientDetails(clientID)
                .then(() => {
                    // Data successfully fetched and populated in form
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error fetching client details');
                });
        } else {
            console.error("clientID is undefined or null");
        }
    });

    // Event listener for form submission
    $('#editClientForm').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data
        if (!validateFormEdit()) {
            return; // Stop form submission if validation fails
        }
        var formData = new FormData();
        formData.append('clientName', $('#editClientName').val());
        formData.append('clientContact', $('#editClientContact').val());
        formData.append('clientEmail', $('#editClientEmail').val());

        // Send POST request using fetch
        fetch(`../../../Models/AdminClients/edit_client.php?clientID=${clientID}`, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text()) // Use text() if your PHP returns plain text, otherwise use json()
            .then(data => {
                console.log(data); // Debugging line

                try {
                    data = JSON.parse(data); // Parse the JSON if it's actually JSON
                } catch (e) {
                    console.log("Response is not JSON, assuming success message.");
                }

                if (data.error) {
                    alert('Error updating client: ' + data.error);
                } else {

                    // Update client list and optionally close the modal
                    updateClientList();
                    $('#editClientModal').modal('hide');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating client');
            });
    });

    // Event listener for add client form submission
    $('#addClientForm').on('submit', function (e) {
        e.preventDefault();

        if (!validateForm()) {
        return; // Stop form submission if validation fails
    }

        const formData = $(this).serialize();
        const formValues = $(this).serializeArray();
        let clientContact = formValues.find(item => item.name === 'clientContact').value;
        let clientEmail = formValues.find(item => item.name === 'clientEmail').value;

        // Convert empty values to NULL
        clientContact = clientContact === "" ? null : clientContact;
        clientEmail = clientEmail === "" ? null : clientEmail;

        $.ajax({
            type: 'POST',
            url: '/../../../Models/AdminClients/add_client.php', // Adjust this to the correct path
            data: {
                clientName: $('#clientName').val(),
                clientContact: clientContact,
                clientEmail: clientEmail
            },
            success: function (response) {
                updateClientList();
                $('#addClientForm')[0].reset();
                $('#addClientModal').modal('hide');
            },
            error: function (response) {
                alert('Error: ' + response.responseText);
            }
        });
    });

    // Event listener for delete button click
    $(document).on('click', '.delete-btn', function () {
        let clientId = $(this).data('id');
        console.log('Delete button clicked for client ID:', clientId); // Debugging statement

        if (confirm('Are you sure you want to delete this client?')) {
            $.ajax({
                url: '/../../../Models/AdminClients/delete_client.php',
                type: 'POST',
                data: { clientID: clientId },
                success: function (response) {
                    console.log('Delete request successful:', response); // Debugging statement

                    if (response.trim() === 'Successful') {
                        updateClientList();
                    } else {
                        alert('Error: ' + response);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting client:', textStatus); // Debugging statement
                    alert('Error: ' + textStatus);
                }
            });
        }
    });

    // Function to update client list
    function updateClientList() {
        $.ajax({
            url: 'clientslist.php', // Adjust this to the correct path
            success: function (data) {
                $('#client_list').html(data);
                reattachEventListeners();
                updateClientStatistics();
            },
            error: function (response) {
                alert('Error: Could not refresh client list.');
            }
        });
    }

    // Function to reattach event listeners after updating client list
    function reattachEventListeners() {
        const clientDetailDivs = document.querySelectorAll('.client-details');
        const lastProjectDivs = document.querySelectorAll('.last-project');

        function handleClick(event) {
            const targetElement = event.target.closest('[data-id]');
            const clientId = targetElement.getAttribute('data-id');

            const phpFileUrl = 'clientsdetail.php';
            const postData = new FormData();
            postData.append('clientid', clientId);

            fetch(phpFileUrl, {
                method: 'POST',
                body: postData
            })
                .then(response => response.text())
                .then(data => {
                    const clientSummary = document.getElementById('client-summary');
                    clientSummary.classList.remove("flex-centermiddle");
                    clientSummary.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        clientDetailDivs.forEach(clientDetails => {
            clientDetails.addEventListener('click', handleClick);
        });

        lastProjectDivs.forEach(lastProject => {
            lastProject.addEventListener('click', handleClick);
        });
    }

    // Function to update client statistics
    function updateClientStatistics() {
        fetch('/../../../Models/AdminClients/update_statistics.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: ''
        })
            .then(response => response.text())
            .then(data => {
                const clientStatistics = document.getElementById('client-statistics');
                clientStatistics.innerHTML = data;
                reattachEventListeners();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Event listener for search input keyup
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('keyup', function () {
        let query = this.value.trim();

        fetch('../../../Models/AdminClients/search_client.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'query=' + encodeURIComponent(query)
        })
            .then(response => response.text())
            .then(data => {
                const clientList = document.getElementById('client_list');
                clientList.innerHTML = data;
                reattachEventListeners();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
    function validateEmail(email) {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailPattern.test(email);
    }
    
    
    function validateForm() {
        var email = document.getElementById("clientEmail").value;
        var contact = document.getElementById("clientContact").value;
    
        if (email === "" && contact === "") {
            alert("Please enter either an email address or a contact number.");
            return false;
        }
        if (email !== "" && !validateEmail(email)) {
            alert("Please enter a valid email address.");
            return false;
        }
        return true;
    }
    function validateFormEdit() {
        var email = document.getElementById("editClientEmail").value;
        var contact = document.getElementById("editClientContact").value;
    
        if (email === "" && contact === "") {
            alert("Please enter either an email address or a contact number.");
            return false;
        }
        if (email !== "" && !validateEmail(email)) {
            alert("Please enter a valid email address.");
            return false;
        }
        return true;
    }

    // Initial attachment of event listeners
    reattachEventListeners();
});

function goToLink(projectID){
    window.location.href = "../ProjectDetails/projectPage.php?id="+projectID;
}

