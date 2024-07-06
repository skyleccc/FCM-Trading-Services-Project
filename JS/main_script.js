$('.edit-btn').click(function() {
    var id = $(this).data('id');
    window.location.href = 'projectedit.php?id=' + id;
});

$('.delete-btn').click(function() {
    var id = $(this).data('id');
    if (confirm('Are you sure you want to delete this project?')) {
        fetch('../../../Models/AdminMain/delete_project', {
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