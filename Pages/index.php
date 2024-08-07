<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCM Trading Services</title>
    <link rel="icon" href="../WebsitePictures/fcmlogo.png">
    <link rel="stylesheet" href="../CSS/general_style.css">
    <link rel="stylesheet" href="../CSS/index_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
    // NAVIGATION BAR
    include '../Components/navigationBar.php'
    ?>
    <div id="homePage" class="section-wrapper">
        <section id="homePage_intro" class="page">
            <div id="intro_text">
                <div class="header">
                    Diversified Services.<br>
                    Unvarying Quality.
                </div>
                <div id="intro_content">
                    We designed 100+ commercial & residential projects in Cebu & across the Philippines. Providing Construction & Renovation services to everyone.
                </div>
                <div id="intro_button">
                    <button class="square-button" onclick="location.href='../Pages/index.php#homePage_projects'">See Our Work</button>
                </div>
            </div>
        </section>
        <section id="homePage_statistics" class="page">
            <div id="statistics_text">
                <div class="h100-w50">
                    <div id="statistics_header" class="header">
                        5+ Years of Trust<br>
                        and Integrity
                    </div>
                    <div id="statistics_content">
                        With our capabilities we have reached these within 5 years.
                    </div>
                </div>
                <div id="statistics_number" class="h100-w50">
                    <div class="h50-w100 flex-centermiddle">
                        <div class="container flex-leftmiddle">
                            <div class="circle_pictureframe">
                                <img src="../WebsitePictures/customer-pic.png" alt="customer-pic.png">
                            </div>
                            <div class="margin">
                                <div class="large bold text-left">50+</div>
                                <div class="bold">Satisfied Clients</div>
                            </div>
                        </div>
                    </div>
                    <div class="h50-w100 flex-centermiddle">
                        <div class="container flex-leftmiddle">
                            <div class="circle_pictureframe">
                                <img src="../WebsitePictures/building-pic.png" alt="building-pic.png">
                            </div>
                            <div class="margin">
                                <div class="large bold text-left">100+</div>
                                <div class="bold">Projects Completed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="statistics_trusted_clients">
                <div class="small-header">
                    OUR TRUSTED CLIENTS
                </div>
                <div id="trusted_clients" class="flex-centermiddle">
                    <div class="box h100-w25">
                        <img src="../WebsitePictures/mendero.png" alt="Mendero Medical Center">
                    </div>
                    <div class="box h100-w25">
                        <img src="../WebsitePictures/jolibee.jpg" alt="Jollibee">
                    </div>
                    <div class="box h100-w25">
                        <img src="../WebsitePictures/yellowcab.svg" alt="Yellow Cab">
                    </div>
                    <div class="box h100-w25">
                        <img src="../WebsitePictures/marialuisa.jpg" alt="Maria Luisa">
                    </div>
                </div>
            </div>
        </section>
        <section id="homePage_projects" class="page">
            <div class="h20-w100 flex-centermiddle headerbox">
                <div class="header text-center">
                    SOME OF OUR WORKS
                </div>
            </div>
            <div class="h80-w100 flex-centermiddle gallery">
                <div class="h100-w33 gallery-box">
                    <div class="h75-w100 img-box flex-centermiddle">
                        <img src="../WebsitePictures/img1.png" alt="Placeholder">
                    </div>
                    <div class="h25-w100 text-box">
                        <div class="text-box-title">
                            Jollibee Carcar
                        </div>
                        <div class="text-box-normal">
                            - Exterior Wall Repaint Project
                        </div>
                    </div>
                </div>
                <div class="h100-w33 gallery-box">
                    <div class="h75-w100 img-box flex-centermiddle">
                        <img src="../WebsitePictures/img2.png" alt="Placeholder">
                    </div>
                    <div class="h25-w100 text-box">
                        <div class="text-box-title">
                             Jollibee Bulacao
                        </div>
                        <div class="text-box-normal">
                            - Glass Installation Project
                        </div>
                    </div>
                </div>
                <div class="h100-w33 gallery-box">
                    <div class="h75-w100 img-box flex-centermiddle">
                        <img src="../WebsitePictures/img3.png" alt="Placeholder">
                    </div>
                    <div class="h25-w100 text-box">
                        <div class="text-box-title">
                            Maria Luisa Residence
                        </div>
                        <div class="text-box-normal">
                            - Balcony Project
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="homePage_quotations" class="page">
            <div class="h80-w100">
                <div class="h30-w100 text-box">
                    <div class="header text-center">
                        Let us help you build. Request Now!
                    </div>
                    <div class="text-center bold">
                        High-level experience in creating spaces that positively impact people's lives.
                    </div>
                </div>
                <div class="h50-w100 flex-centermiddle click-quotation">
                    <div class="h100-w50 image-box2 flex-rightmiddle">
                        <div class="h25-w35">
                            <button class="square-button" onclick="location.href='quotations.php'">Apply for a Project</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="homePage_footer" class="h20-w100">
                    <img src="../WebsitePictures/fcmlogowhite.png" alt="FCM Logo">
                    © 2019 FCM Trading and Services. All rights reserved.
            </div>
        </section>
    </div>
</body>
</html>

