var modal = document.getElementById("myModal");
var btn = document.getElementById("addphase");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$('.delete-btn').click(function() {
var id = $(this).data('id');
console.log('Phase ID:', id); // Log the phase ID being sent

if (confirm('Are you sure you want to delete this Phase?')) {
fetch('/../pages/admin/phases/delete_phase.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'phaseid=' + id,
})
.then(response => response.text())
.then(data => {
    console.log('Response:', data); // Log the response from the server
    if (data === 'success') {
        alert('Phase deleted successfully!');
        location.reload();
    } else {
        alert('Failed to delete the Phase.');
    }
})
.catch(error => {
    console.error('Error:', error);
    alert('Failed to delete the Phase.');
});
}
});