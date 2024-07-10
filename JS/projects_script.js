var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

function closeModal(){
    window.location.href = `projects.php`;
}

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const dataContainer = document.getElementById('results');

    // Function to fetch data from the server
    const fetchData = async (query = '') => {
        try {
            const response = await fetch('../../../Models/AdminProjects/search_project.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ query: query })
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.text();
            updateResults(data);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    // Function to update the results with fetched data
    const updateResults = (data) => {
        dataContainer.innerHTML = data;
        attachEventListeners();
    };

    // Function to attach event listeners to buttons
    const attachEventListeners = () => {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                window.location.href = 'projectedit.php?id=' + id;
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this project?')) {
                    fetch('../../../Models/AdminProjects/delete_project.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({ projectid: id })
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'success') {
                            alert('Project deleted successfully!');
                            location.reload();
                        } else {
                            alert('Failed to delete the project.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete the project.');
                    });
                }
            });
        });
    };

    // Add keyup event listener to search input
    searchInput.addEventListener('keyup', (event) => {
        const query = event.target.value.trim();
        fetchData(query);
    });
    attachEventListeners();
});