document.addEventListener('DOMContentLoaded', function() {
    // Get all elements with class "client-details"
    const clientDetailDivs = document.querySelectorAll('.client-details');

    // Add click event listener to each client-details div
    clientDetailDivs.forEach(clientDetails => {
        clientDetails.addEventListener('click', function() {
            // Get the data-id attribute value
            const clientId = clientDetails.getAttribute('data-id');
            
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
        });
    });
});