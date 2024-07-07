document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    if (btn) {
        btn.onclick = function() {
            modal.style.display = "block";
        }
    }

    if (span) {
        span.onclick = function() {
            modal.style.display = "none";
        }
    }

    function closeModal() {
        window.location.href = `quotationreqs.php`;
    }

    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        window.location.href = 'quotationedit.php?id=' + id;
    });

    
    $('.delete-btn').click(function() {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this project?')) {
            fetch('../../../Models/AdminQuotReqs/quotationdelete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'requestid=' + id,
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
