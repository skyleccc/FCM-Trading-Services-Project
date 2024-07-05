<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCM Dashboard</title>
    <link rel="icon" href="fcmicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style>
    body{
        background-color: rgb(235, 242, 246);
    }
    .row, .col{
        border-radius: 10px;
        background: #fbfbfb;
    }

    .col-sm-2{
        font-family: Helvetica;
        font-weight: bolder;
    }
    .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    }

    .centered {
        position: absolute;
        top: 40%;
        left: 40%;
        transform: translate(6%, -50%);
    }
    
    .container {
        position: relative;
        text-align: center;
        color: white;
    }
    
    div.ex3 {
        overflow: auto;
        height: 347px;
        width: 100%;
    }
    div.ex2 {
        overflow: auto;
        height: 180px;
        width: 100%;
    }
    div.ex1 {
        overflow: auto;
        height: 625px;
        width: 100%;
    }

    .icon-container {
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            background: none;
            padding: 0; 
    }
    .button-style {
            margin: auto;
            text-decoration: none;
            color: rgb(52, 173, 46);
            border: none;
            background: none;
            display: block;
    }
</style>  
</head>
  
  <body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include '../../Models/adminNavBar.php'
            ?>
            <div class="col-sm-10 p-3 border bg light">
                <div style="font-size: 23px;">
                   <div class="col" style=" border-bottom-style: solid; border-color: green;" >Home</div>
                </div>
                <div class="row p-3 border bg light">
                    <div class="col-sm-8">
                        <div class="container">
                            <img src="../../WebsitePictures/fcmbanner2.png" alt="fcm logo" class="rounded" style="width: 840px; margin:auto;">
                            <div class="row-sm=12">
                                <div class="col">
                                    <div class="centered" style="font-size: 3vw; left: 4%; top: 50%; color: green; border: solid; padding: 10px; border-radius: 10px;">Roof Repair</div>
                                </div>
                                <div class="col">
                                    <div class="centered" style="font-weight: bolder; font-size: 2vw; text-align: left; left:50%; color: black">Mendero Medical Center</div>
                                    <div class="centered" style="color:black; margin-top: 30px; font-size: 1.4vw; left:67.5% ">Consolacion City, Cebu</div>
                                </div>
                            </div>
                        </div>
                        <div class="col p-2">
                            <div class="row p-3 border bg light rounded" style="font-size: 20px; font-weight: bold;">
                                <div class="col" style="margin-top: 10px;">Ongoing Projects</div>
                                <div class="col-sm-3" style="height: 30px;">
                                    <div class="row" style="background-color: rgb(19, 171, 19); width: 200px; height: 50px;">
                                        <div class="col" style="background-color: rgb(19, 171, 19); font-size: 1vw; color: white;">Progress:</div>
                                        <div class="col" style="background-color: rgb(19, 171, 19); font-size: 2vw; color: white;">30%</div>
                                    </div>
                                </div>
                                    <br><br>
                                <div class="ex1">


                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="row p-2 border bg light" style="margin: auto;">
                                                <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 65px; height: 80px; color: rgb(41, 157, 41);">
                                                    <input type="checkbox" style="width: 40px; height: 70px; margin-top: 10%; accent-color: rgb(41, 157, 41);">
                                                </div>
                                                <div class="col p-1 ">
                                                    <div style="font-weight: bold;text-align: center; color: black;">Mendero Medical Center</div>
                                                    <div style="font-weight: lighter; text-align: center; font-size: 13px; color: black;" >Consolacion City</div>
                                                    <div style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55" >Roof Repair</div>
                                                </div>
                                                <div class="col-sm-4 rounded" style="background-color:rgb(227, 38, 38); width: 160px; height: 80px; padding-top: 13px ;">
                                                    <div style="color: white; font-size: 15px; font-weight: lighter; ">Deadline:</div>
                                                    <div style=" color: white">May 15, 2024</div>
                                                </div>
                                            </div>
                                        </div>
    
                                            <div class="col-sm-1">
                                                <button class="button-style" style="margin-top: 7px">
                                                    <div class="row border bg-light rounded icon-container">
                                                        <span class="material-symbols-outlined" style="font-size: 2vw;">edit</span>
                                                    </div>
                                                </button>
                                                <button class="button-style" style="margin-top: 10px">
                                                    <div class="row border bg-light rounded icon-container">
                                                        <span class="material-symbols-outlined" style="font-size: 2vw;">delete</span>
                                                    </div>
                                                </button>
                                            </div>
                                       
                                    </div>


                            </div>
                                   
                                
                        <br><br><br></div>
                    </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="row">
                            
                            <div class="container p-3 border bg-light rounded">
                                <div style="font-size: 20px; font-weight: bold;color: black">Calendar Reminders</div><br>
                                <div class="row g-2 calendar" id="calendarcolor" style="text-align: center;">
                                    <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Sun</div>
                                        <br>11</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Mon</div>
                                        <br>12</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Tue</div>
                                        <br>13</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: rgb(221, 30, 30); border-radius: 8px; color: rgb(221, 30, 30);">
                                        <div style="font-weight: bold; font-size: 18px;">Wed</div>
                                        <br>14</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Thu</div>
                                        <br>15</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Fri</div>
                                        <br>16</div>
                                        <div class="col-sm p-2" style="border: solid; border-color: green; border-radius: 8px; color: green;">
                                        <div style="font-weight: bold; font-size: 18px;">Sat</div>
                                        <br>17</div>
                                </div>
                                <div class="ex2">
                                <div class="div" style="width: 90%; margin: auto;">
                                <div class="row p-1 border bg light" style="margin-top: 25px;">
                                    <div class="col-sm-4 rounded" style="background-color:rgb(212, 43, 34); width: 35px; height: 80px; color: rgb(212, 43, 34);">.</div>
                                    <div class="col p-1 ">
                                        <div style="font-weight: bold;text-align: center; color: black;">Mendero Medical Center</div>
                                        <div style="font-weight: lighter; text-align: center; font-size: 13px; color:black" >Consolacion City</div>
                                        <div style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55" >Roof Repair</div>
                                    </div>
                                </div>
                                <div class="row p-1 border bg light" style="margin-top: 15px;">
                                    <div class="col-sm-4 rounded" style="background-color:rgb(212, 43, 34); width: 35px; height: 80px; color: rgb(212, 43, 34);">.</div>
                                    <div class="col p-1 ">
                                        <div style="font-weight: bold;text-align: center; color: black;">Mendero Medical Center</div>
                                        <div style="font-weight: lighter; text-align: center; font-size: 13px; color:black" >Consolacion City</div>
                                        <div style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55" >Roof Repair</div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div><br>
                        <div class="row">
                                <div class="col p-3 border bg light" style="font-weight: bold;">
                                    <div style="text-align: center; font-size: 30px;">Quotation Requests</div>
                                    <div style="text-align: center; color: grey; font-weight: lighter;">Check and validate within 7 Days</div><br>
                                    <div class="col">
                                        <div class="ex3">
                                            <div class="div" style="width: 90%; margin: auto;">
                                        <div class="row p-1 border bg light" style="margin-top: 25px;">
                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 35px; height: 80px; color: rgb(41, 157, 41);">.</div>
                                            <div class="col p-1 ">
                                                <div style="font-weight: bold;text-align: center; color: black;">Mendero Medical Center</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 13px; color: black;" >Consolacion City</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55" >Roof Repair</div>
                                            </div>
                                        </div>
                                        <div class="row p-1 border bg light" style="margin-top: 15px;">
                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 35px; height: 80px; color: rgb(41, 157, 41);">.</div>
                                            <div class="col p-1 ">
                                                <div style="font-weight: bold;text-align: center; color: black;">Mendero Medical Center</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 13px; color: black;" >Consolacion City</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55" >Roof Repair</div>
                                            </div>
                                        </div>
                                        <div class="row p-1 border bg light" style="margin-top: 15px;">
                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 35px; height: 80px; color: rgb(41, 157, 41);">.</div>
                                            <div class="col p-1 ">
                                                <div style="font-weight: bold;text-align: center; color: black;">Mendero Medical Center</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 13px; color: black;" >Consolacion City</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55" >Roof Repair</div>
                                            </div>
                                        </div>
                                        <div class="row p-1 border bg light" style="margin-top: 15px;">
                                            <div class="col-sm-4 rounded" style="background-color:rgb(41, 157, 41); width: 35px; height: 80px; color: rgb(41, 157, 41);">.</div>
                                            <div class="col p-1 ">
                                                <div style="font-weight: bold;text-align: center; color: black;">Mendero Medical Center</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 13px; color: black;" >Consolacion City</div>
                                                <div style="font-weight: lighter; text-align: center; font-size: 16px; color:#40ce55" >Roof Repair</div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div><br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>