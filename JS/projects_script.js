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
    const sortLinks = document.querySelectorAll('.show-by');
    const dataContainer = document.getElementById('results');
    const showDescrip = document.getElementById('show-descrip');

    let currentSort = 'all'; // Default sort value

    // Function to fetch data from the server
    const fetchData = async (query = '', sort = 'all') => {
        try {
            const response = await fetch('../../../Models/AdminProjects/search_project.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ query: query, sort: sort })
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
        updateShowDescrip(currentSort); // Update show description after fetching data
        attachEventListeners();
    };

    // Function to update show description based on current sort
    const updateShowDescrip = (sort) => {
        let description = 'Show: <b>';
        switch (sort) {
            case 'ongoing':
                description += 'Ongoing';
                break;
            case 'completed':
                description += 'Completed';
                break;
            case 'all':
            default:
                description += 'All';
                break;
        }
        description += '</b>';
        showDescrip.innerHTML = description;
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
        fetchData(query, currentSort);
    });

    // Add click event listeners to sort links
    sortLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const sortValue = event.target.getAttribute('data-sort');
            currentSort = sortValue;
            fetchData(searchInput.value.trim(), currentSort);
            updateShowDescrip(currentSort); // Update show description
        });
    });

    attachEventListeners();
});





let fileUrls = [];
let uploadedFiles = new Set(); // Use a Set to keep track of uploaded file names

function previewFileList() {
    const fileInput = document.getElementById('blueprint');
    const fileList = fileInput.files;
    const listElement = document.getElementById('list');

    // Clear any existing list items
    // If you want to keep previously attached files, comment this line
    // listElement.innerHTML = '';

    // Revoke any previously created URLs
    fileUrls.forEach(url => URL.revokeObjectURL(url));
    fileUrls = [];

    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];

        // Check if the file is already uploaded
        if (!uploadedFiles.has(file.name)) {
            const fileUrl = URL.createObjectURL(file);
            fileUrls.push(fileUrl);
            uploadedFiles.add(file.name); // Add the file name to the Set

            const listItem = document.createElement('li');
            const fileLink = document.createElement('a');
            fileLink.textContent = file.name;
            fileLink.classList.add('filename');
            fileLink.href = fileUrl;
            fileLink.target = '_blank'; // Open in a new tab
            fileLink.style.color = 'black';

            listItem.appendChild(fileLink);
            listElement.appendChild(listItem);
        }
    }
}



// Revoke all created URLs when the window is unloaded
window.addEventListener('unload', () => {
    fileUrls.forEach(url => URL.revokeObjectURL(url));
});

document.addEventListener("DOMContentLoaded", function() {
    const blueprintCheckbox = document.getElementById('blueprint-add');
    const blueprintInput = document.getElementById('blueprint');
    const submitButton = document.querySelector('button[type="submit"]');

    blueprintCheckbox.addEventListener('change', toggleSubmitButton);
    blueprintInput.addEventListener('change', toggleSubmitButton);

    function toggleSubmitButton() {
        const filesAttached = blueprintInput.files.length > 0;
        if (blueprintCheckbox.checked && !filesAttached) {
            submitButton.disabled = true;
            submitButton.classList.add('disabled-button');
        } else {
            submitButton.disabled = false;
            submitButton.classList.remove('disabled-button');
        }
        displayFileList();
    }

    function displayFileList() {
        const fileList = blueprintInput.files;
        const list = document.getElementById('list');
        list.innerHTML = ''; // Clear the list first

        for (let i = 0; i < fileList.length; i++) {
            const listItem = document.createElement('li');
            listItem.textContent = fileList[i].name;
            list.appendChild(listItem);
        }
        previewFileList();
    }

    // Initial check
    toggleSubmitButton();
});

function displayAttach(){
    var div = document.getElementById('attach-blueprint');
    var div2 = document.getElementById('attachment');
    var attachments = document.getElementById('blueprint');
    var checkbox = document.getElementById('blueprint-add');
    attachments.value = "";

    if(checkbox.checked){
        div.style.display = "block";
        
    }else{
        div.style.display = "none";
        div2.style.display = "none";
    }
}

function displayFileList(){
    var div = document.getElementById('attachment');
    var files = document.getElementById('blueprint').files;
    var list = document.getElementById('list');

    while(list.firstChild){
        list.removeChild(list.firstChild);
    }

    for(let i = 0; i<files.length; i++){
        let li = document.createElement("li");
        li.appendChild(document.createTextNode(files[i].name));
        list.appendChild(li);
    }

    div.style.display = "block";
}
function toggleSubmitButton() {
    const filesAttached = blueprintInput.files.length > 0;
    if (blueprintCheckbox.checked && !filesAttached) {
        submitButton.disabled = true;
        submitButton.style.opacity = '0.5'; // Example: Adjust opacity for visual indication
    } else {
        submitButton.disabled = false;
        submitButton.style.opacity = '1'; // Restore normal opacity if button is enabled
    }
    displayFileList();
}