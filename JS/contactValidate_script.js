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