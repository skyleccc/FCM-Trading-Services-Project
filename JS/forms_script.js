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