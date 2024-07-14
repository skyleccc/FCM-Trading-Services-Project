document.addEventListener('DOMContentLoaded', function() {
    // Get all elements with class "client-details" and "last-project"
    const clientDetailDivs = document.querySelectorAll('.client-details');
    const lastProjectDivs = document.querySelectorAll('.last-project');

    // Function to handle click event
    function handleClick(event) {
        // Find the closest element with the data-id attribute
        const targetElement = event.target.closest('[data-id]');
        const clientId = targetElement.getAttribute('data-id');
        
        // Replace with your PHP file URL
        const phpFileUrl = 'clientsdetail.php';

        // Prepare POST data
        const postData = new FormData();
        postData.append('clientid', clientId);

        // Fetch data from PHP script
        fetch(phpFileUrl, {
            method: 'POST',
            body: postData
        })
        .then(response => response.text())
        .then(data => {
            // Update client-summary div with fetched data
            const clientSummary = document.getElementById('client-summary');
            clientSummary.classList.remove("flex-centermiddle");
            clientSummary.innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Add click event listener to each client-details and last-project div
    clientDetailDivs.forEach(clientDetails => {
        clientDetails.addEventListener('click', handleClick);
    });

    lastProjectDivs.forEach(lastProject => {
        lastProject.addEventListener('click', handleClick);
    });

    const searchInput = document.getElementById('search');
    searchInput.addEventListener('keyup', function() {
        let query = this.value.trim(); // Trim whitespace

        // Send AJAX request to search_client.php
        fetch('../../../Models/Clients/search_client.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'query=' + encodeURIComponent(query)
        })
        .then(response => response.text())
        .then(data => {
            // Update the client_list div with search results
            const clientList = document.getElementById('client_list');
            clientList.innerHTML = data;

            // Re-attach event listeners to new elements
            const newClientDetailDivs = clientList.querySelectorAll('.client-details');
            const newLastProjectDivs = clientList.querySelectorAll('.last-project');

            newClientDetailDivs.forEach(clientDetails => {
                clientDetails.addEventListener('click', handleClick);
            });

            newLastProjectDivs.forEach(lastProject => {
                lastProject.addEventListener('click', handleClick);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    });
});