function displayAttach(){
    var div = document.getElementById('attach-blueprint');
    var div2 = document.getElementById('attachment');
    var attachments = document.getElementById('blueprint');

    attachments.value = "";

    if(div.value == "off"){
        div.style.display = "none";
        div2.style.display = "none";
    }else{
        div.style.display = "block";
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