<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCM Trading Services</title>
<<<<<<<< HEAD:Pages/Admin/ProjectsList/addprojects.php
    <link rel="icon" href="../../../WebsitePictures/fcmlogowhite.png">
========
    <link rel="icon" href="../../WebsitePictures/fcmlogowhite.png">
>>>>>>>> ac77bee5262ae29cab7060defd866ab409c8c99a:Pages/Admin/projects/addprojects.php
    <link rel="stylesheet" href="../../../CSS/general_style.css">
    <link rel="stylesheet" href="../../../CSS/forms.css">
    <script src="../../../JS/forms_script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <div id="navigationBar">
        <div id="navigationBar_logo">
            <img src="../../../WebsitePictures/fcmlogowhite.png" alt="FCM Logo">
        </div>
        <div id="navigationBar_features" class="h100-w50">
            <a href="/./index.html#homePage_intro" class="h100-w20 hoverable flex-centermiddle">Home</a>
            <a href="/./index.html#homePage_statistics" class="h100-w20 hoverable flex-centermiddle">Trusted Clients</a>
            <a href="/./index.html#homePage_projects" class="h100-w20 hoverable flex-centermiddle">Our Works</a>
            <a href="/./index.html#homePage_quotations" class="h100-w20 hoverable flex-centermiddle">Quotation Form</a>
            <a href="/./IM2/Dashboard/login.html" class="h100-w20 hoverable flex-centermiddle">Admin</a>
        </div>
        <div id="navigationBar_button">
            <button class="square-button" onclick="location.href='/./IM2/Dashboard/quotations.html'">Request Quotation</button>
        </div>
    </div>
    <div id="homePage">
        <div class="header-box">
            <div class="header-text h75-w100">
                <h1 class="quotations">Add<br>Project Form</h1>
            </div>
            <div class="content-text h25-w100 flex-centermiddle">
                We designed 100+ commercial & residential projects in Cebu & across the Philippines. Providing Construction & Renovation services to everyone.
            </div>
        </div>
        <div class="quotationscontainer">
            <form action="" method="get">
                <div class="form-group">
                    <label for="project">Project Name:</label>
                    <input type="text" id="project" name="projectname" placeholder="Enter Name of Project Here" required>
                </div>
                <div class="form-group_two">
                    <div class="input-group">
                        <label for="client">Client:</label>
                        <input type="text" id="client" name="clientname" placeholder="Enter Name of Client Here" required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="assignedContractor">Assigned Contractor:</label>
                        <input type="text" id="assngnedContractor" name="contractorName" placeholder="Enter Name of Contractor Here" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="building">Building:</label>
                    <input type="text" id="building" name="buildingName" placeholder="Enter Name of Building" required>
                </div>
                <div class="form-group">
                    <label for="projectScope">Project Scope:</label>
                    <input type="text" id="projectScope" name="projectScope" placeholder="Enter the Scope of the Project" required>
                </div>
                <div class="form-group_three">
                    <div class="input-group">
                        <label for="projectDeadline" class="siteinfo">Project Deadline:</label>
                        <input type="date" id="projectDeadline" name="deadline" required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="start_date" class="siteinfo">Start Date of Project:</label>
                        <input type="date" id="startdate" name="startdate" required>
                    </div>
                    <div class="space"></div>
                    <div class="input-group">
                        <label for="date_of_completion" class="siteinfo">Completion Date of Project:</label>
                        <input type="date" id="datecomplete" name="datecomplete" placeholder="Type Here..." required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Project Description:</label>
                    <textarea type="textarea" id="description" name="projectDescription" placeholder="Type Here..." required></textarea>
                </div>
                
                <button>Add Project</button>
            </form>
        </div>
    </div>
</body>
</html>