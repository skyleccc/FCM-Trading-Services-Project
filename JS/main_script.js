// Function to bind edit and delete button click events
const bindEditDeleteEvents = () => {
    $('.edit-btn').off('click').on('click', function() {
        var id = $(this).data('id');
        window.location.href = 'projectedit.php?id=' + id;
    });

    $('.delete-btn').off('click').on('click', function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this project?')) {
            fetch('../../../Models/AdminProjects/delete_project.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'projectid=' + id,
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
};

document.addEventListener('DOMContentLoaded', () => {
    const sortLinks = document.querySelectorAll('.dropdown-content a');
    const dataContainer = document.getElementById('project-container');

    // Function to fetch data from the server
    const fetchData = async (sort) => {
        try {
            const response = await fetch(`../../../Models/AdminMainDashboard/sortProjectList.php?sort=${sort}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.text();
            updateTable(data);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    // Function to update the table with fetched data
    const updateTable = (data) => {
        dataContainer.innerHTML = data;
        bindEditDeleteEvents(); // Re-bind edit and delete button events after update
    };

    // Add click event listeners to sort links
    sortLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const sort = event.target.getAttribute('data-sort');
            fetchData(sort);
        });
    });

    // Initial binding of edit and delete button events
    bindEditDeleteEvents();
});


function closeModal(){
    window.location.href = `main.php`;
}