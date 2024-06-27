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