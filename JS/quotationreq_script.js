let fileUrls = [];

function previewFileList() {
    const fileInput = document.getElementById('blueprint');
    const fileList = fileInput.files;
    const listElement = document.getElementById('list');

    // Clear any existing list items
    listElement.innerHTML = '';

    // Revoke any previously created URLs
    fileUrls.forEach(url => URL.revokeObjectURL(url));
    fileUrls = [];

    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];
        const listItem = document.createElement('li');
        listItem.classList.add('file-item'); // Add a specific class
        const previewDiv = document.createElement('div');
        previewDiv.classList.add('preview');

        const fileUrl = URL.createObjectURL(file);
        fileUrls.push(fileUrl);

        const fileLink = document.createElement('a');
        fileLink.textContent = file.name;
        fileLink.classList.add('filename');
        fileLink.href = fileUrl;
        fileLink.target = '_blank';
        fileLink.style.color = 'black';

        // Add any additional text or elements here
        const additionalText = document.createElement('span');
        additionalText.style.marginLeft = '10px';

        previewDiv.appendChild(fileLink);
        previewDiv.appendChild(additionalText);
        listItem.appendChild(previewDiv);
        listElement.appendChild(listItem);
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
function validateEmail(email) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailPattern.test(email);
}

function validateForm() {
    var email = document.getElementById("email").value;
    var contact = document.getElementById("contact").value;

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