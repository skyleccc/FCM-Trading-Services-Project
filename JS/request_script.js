document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    var span2 = document.getElementsByClassName("edit")[0];

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

    if (span2) {
        span2.onclick = function() {
            var id = $(this).data('id');
            window.location.href = `edit_quotation.php` + '?id=' + id;
        }
    }


    
    $('.approve-btn').click(function() {
        var id = $(this).data('id');
        console.log('Approve button clicked for ID:', id); // Debugging line
        if (confirm('Are you sure you want to approve this quotation?')) {
            fetch('../../../Models/AdminQuotReqs/quotationapprove.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'requestid=' + id,
            })
            .then(response => response.text())
            .then(data => {
                console.log('Response from approve:', data); // Debugging line
                if (data === 'success') {
                    alert('Project approved!');
                    window.location.href = 'quotationreqs.php';
                } else {
                    alert('Failed to approve the request.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to approve the request.');
            });
        }
    });

    $('.decline-btn').click(function() {
        var id = $(this).data('id');
        console.log('Decline button clicked for ID:', id); // Debugging line
        if (confirm('Are you sure you want to decline this project?')) {
            fetch('../../../Models/AdminQuotReqs/quotationdecline.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'requestid=' + id,
            })
            .then(response => response.text())
            .then(data => {
                console.log('Response from decline:', data); // Debugging line
                if (data === 'success') {
                    alert('Project declined!');
                    window.location.href = 'quotationreqs.php';
                } else {
                    alert('Failed to decline the request.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to decline the request.');
            });
        }
    });
    
});

$(document).ready(function() {

    // Handle form submission
    $('form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(response) {
                alert('Form submitted successfully!');
                $('#myModal').hide();
                window.location.href = 'quotationreqs.php';
            },
            error: function(xhr, status, error) {
                alert('Form submission failed: ' + error);
            }
        });
    });
});

$(document).ready(function() {
    // Approve button click handler
    $('.approve-btn').click(function(e) {
        e.preventDefault();
        var requestId = $(this).data('id');
        processRequest(requestId, 'approve');
    });

    // Decline button click handler
    $('.decline-btn').click(function(e) {
        e.preventDefault();
        var requestId = $(this).data('id');
        processRequest(requestId, 'decline');
    });

    function processRequest(requestId, action) {
        $.ajax({
            url: '../../../Models/QuotationReqs/processRequest.php',
            type: 'POST',
            data: { requestId: requestId, action: action },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = 'quotationreqs.php';
                } else {
                    alert(response.message);
                }   
            }
        });
    }
});