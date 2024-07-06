var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var test = document.getElementsByClassName("closeupdate")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

span.onclick = function() {
  window.location.href = `projectedit.php`;
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  
}

document.addEventListener('DOMContentLoaded', (event) => {
  document.querySelectorAll('.edit-btn').forEach(button => {
      button.addEventListener('click', () => {
          const projectId = button.getAttribute('data-id');
          window.location.href = `projectedit.php?id=${projectId}`;
      });
  });

document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', () => {
          const projectId = button.getAttribute('projectid');
          if (confirm('Are you sure you want to delete this project?')) {
              fetch(`delete_project.php?id=${projectId}`, {
                  method: 'GET'
              })
              .then(response => response.text())
              .then(data => {
                  if (data === 'success') {
                      alert('Project deleted successfully');
                      location.reload();
                  } else {
                      alert('Failed to delete project');
                  }
              });
          }
      });
  });
});