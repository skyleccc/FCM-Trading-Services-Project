<?php
require '../../../Controllers/accessDatabase.php';
require '../../../Controllers/loginCheck.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT requestid, serviceType, clientName, DATE_FORMAT(dateFiled, '%b. %d, %Y') AS dateFiled, DATE_FORMAT(completeDate, '%b. %d, %Y') AS completeDate, location FROM quotation_request WHERE status='pending' ORDER BY requestID ASC"; // Adjust table name as needed
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="stylesheet" href="../../../CSS/quotationreqs_styles.css">
    <link rel="icon" href="../../../WebsitePictures/fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /> 

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include '../../../Components/adminNavBar.php'
            ?>
            <div class="col-sm-10 border bg light">
                <div style="font-size: 23px;">
                   
                </div>
                <div class="row p-3 border bg light">   
                    <div class="col-sm-12">
                        <div class="container">
                            <img src="../../../WebsitePictures/fcmbanner3.png" alt="fcm logo" class="rounded" style="width: 100%; margin:auto;">
                        </div>
                        <div class="col p-2 addbtn">
                            <div class="row p-3 border bg light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col" style="margin: 10px; font-size: 2vw;">Project Requests List</div>
                                <div class="col-7" style="margin: 10px;">
                                    <!-- <div class="col" style="display: flex">
                                            <div class="col-sm-4 dropdown" >
                                                <button class="dropbtn" style="margin-left: auto !important;">
                                                    <div class="row" style="background-color: rgb(19, 171, 19); color: white; width: 13vw; font-weight: lighter;">
                                                        <div class="col-sm-2 p0"><span class="material-symbols-outlined">arrow_drop_down</span></div>
                                                        <div id="show-descrip" class="col-sm-10" style="font-size: 1.2vw; "> Show: <b>All</b></div>
                                                    </div>
                                                </button>
                                                <div id="sort-list" class="dropdown-content">
                                                    <a href="#" class="show-by" data-sort="all">All</a>
                                                    <a href="#" class="show-by" data-sort="pending">Pending</a>
                                                    <a href="#" class="show-by" data-sort="accepted">Accepted</a>
                                                    <a href="#" class="show-by" data-sort="declined">Declined</a>
                                                </div>
                                            </div>
                                            <input type="text" name="search" id="search" placeholder="Search" class="col"> 
                                        </div> -->

                                   <!-- <button class="button-style" id="myBtn" style="background-color: rgb(19, 171, 19);width: 280px; height: 50px;    font-weight: lighter; margin-left:32%;"><div class="col" style="background-color: rgb(19, 171, 19); font-size: 1.2vw; color: white;">
                                    <span class="material-symbols-outlined" style="font-size: 30px; color: white;">note_add</span> Add A Quotation Request
                                    </div></button>  -->
                                    </div><br><br>

                                <div class="ex1"><div class="row projrow">
                                <div class="container">
                                <div class="row" style="color: black">
                                        
                                        
                                                
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo
                                                        '
                                                        <div class="col-sm-4 border bg light proj_cont" style="margin-top: 1%;">
                                        
                                                        <div class="row" style="color: black">
                                                        <div class="col-sm-10">
                                                            <a href="quotationedit.php?id=' . htmlspecialchars($row["requestid"]) . '" class="row p-2" style="margin: auto; text-decoration: none;">
                                                                <div class="row" style="margin: auto; margin-top: 3%;">
                                                                    <div class="col p-1">
                                                                        <div style="font-weight: bold;text-align: center;font-size: 1.6vw; color: black;">' . htmlspecialchars($row["location"]) . '</div>
                                                                        <div style="font-weight: lighter; text-align: center; font-size: 1vw; color: black;" >' . htmlspecialchars($row["clientName"]) . '</div>
                                                                        <div style="font-weight: lighter; text-align: center; font-size: 1.2vw; color:#40ce55" >' . htmlspecialchars($row["serviceType"]) . '</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col" style="margin-top: 10px;">
                                                                    <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 100%;color: rgb(255, 255, 255);"> Date Filed: '.htmlspecialchars($row['dateFiled'] ?? 'No Date').'</div>
                                                                    <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 100%; color: rgb(255, 251, 251); margin-top: 5px;"> Complete By: '.htmlspecialchars($row['completeDate'] ?? 'No Date').'</div>
                                                                </div>
                                                            </a>
                                                            </div>
                                                            
                                                            <div class="col-sm-2 border bg-light">
                                                                <button class="button-style approve-btn" data-id="' . htmlspecialchars($row["requestid"]) . '" style="margin-top: 8px;">
                                                                    <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                                                        <span class="material-symbols-outlined" style="font-size: 1.5vw;">check_circle</span>
                                                                    </div>
                                                                </button>
                                                                <button class="button-style decline-btn" data-id="' . htmlspecialchars($row["requestid"]) . '" style="margin-top: 8px; margin-bottom: 10px;">
                                                                        <div class="row border bg-light rounded icon-container" style="height: 7vw; display: flex; align-items: center; justify-content: center;">
                                                                            <span class="material-symbols-outlined"  style="font-size: 1.5vw;">cancel</span>

                                                                        </div>
                                                                    </button>

                                                            </div>
                                                            </div>
                                                            </div>
                                                    ';
                                                        }
                                                    } else {
                                                        echo '<p>No projects found</p>';
                                                    }
                                            ?>
                                       
                                       </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HG1PqQtkbfhTXCpFjtnx3vpkTrkFQe+KvhG5MTpH2wPRpEacC4zJxyEilKF8kGmS" crossorigin="anonymous"></script>
    <script src="../../../JS/request_script.js"></script>
</body>
</html>
