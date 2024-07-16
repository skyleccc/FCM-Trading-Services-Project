<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT project.projectid, project.projectname, project.projecttype, building.buildingaddress, project.clientid, client.clientname, DATE_FORMAT(project.deadlineDate, '%M %d, %Y') AS deadlineDate FROM project JOIN client ON client.clientid = project.clientid JOIN building ON building.buildingid = project.buildingid";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/projects_style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> 
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    
    <style>

body {
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
  text-decoration: none;    
}

#calendar {
  max-width: 1100px;
  height: 1000px;
  margin: 0 auto;
  text-decoration: none;
  color: black;
}

.fc-header-toolbar {
    background-color: #f0f0f0;
  }

  /* Change the font color of the day numbers */
  .fc-daygrid-day-number {
    color: green;
  }

  /* Change the event background color */
  .fc-event {
    background-color: green;
    border: none;
  }

  .calendar{
    background-color: c2f0c2;
  }

  
</style>

</head>
<script src='index.global.js'></script>

<script>


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        timeZone: 'local',
        editable: true,
        selectable: true,
        select: function(info) {
            var start = info.start;
            var end = info.end;
            $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
            $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
            $('#event_entry_modal').modal('show');
        },
        // eventClick: function(info) {
        //     alert(info.event.id);
        // },
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: 'fetch_phases.php',
                dataType: 'json',
                success: function(response) {
                    var events = [];
                    var result = response.data;
                    console.log(result);
                    $.each(result, function(i, item) {
                        events.push({
                            id: result[i].event_id,
                            title: result[i].title,
                            start: result[i].start,
                            end: result[i].end,
                            color: result[i].color,
                            url: result[i].url
                        });
                    });
                    successCallback(events);
                },
                error: function(xhr, status) {
                    alert('Failed to fetch events');
                    failureCallback();
                }
            });
        },
        eventLimit: true,
        eventLimitClick: 'popover'
    });

    calendar.render();

});


</script>
  
<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            // Navigation Bar for Admin Dashboard
            include '../../../Components/adminNavBar.php'
            ?>
            <div class="col-sm-10 p-3 border bg-light">
                <div style="font-size: 23px;">
                    <!-- Content here -->
                </div>
                <div class="row p-3 border bg-light">   
                    <div class="col-sm-12">
                        <div class="container">
                            <img src="../../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
                        </div>

                        <div class="col p-3 border bg light calendar">
                            <div id='calendar'></div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        // Add Project Modal
        require "../../../Components/ProjectsModals/addProjectModal.php";
    ?>

</body>
</html>
