<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script defer src="../FontAwesome/JS/all.js"></script>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>Dashboard</title>
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="header-container">
                <div class="left-part">
                    <img src="../Assets/dbce-logo.jpeg" alt="" class="logo">
                    <h2>Placement Portal - Don Bosco College of Engineering</h2>
                </div>
                <ul class="right-part">
                    <li>Contact Us</li>
                    <div class="notifications">
                        <div class="dot">.</div><i class="fa-solid fa-bell"></i>
                    </div>
                    <li class="profile-container">
                        <span>Gavin</span>
                        <img src="../Assets/profile.jpg" alt="">
                    </li>
                </ul>
            </div>
        </header>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading">Dashboard</h2>
                <div class="sections">
                    <h3>Performance and Metrics</h3>
                    <div class="sub-sections performance">
                        <div class="right1"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i>
                        </div>
                        <p>Total Applications : 5</p>
                        <p>Interviews Attended : 3</p>
                        <p>Rejections : 3</p>
                    </div>
                </div>

                <div class="sections">
                    <h3>My Applications</h3>
                    <div class="sub-sections companies">
                        <div class="right1"><a href="./my-applications.php"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i></a>
                        </div>
                        <div class="sub-table">
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>Associate Developer</p>
                            </div>
                            <hr>
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>Software Analyst</p>
                            </div>
                            <hr>
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>UI/UX Designer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sections">
                    <h3>Job Opportunities</h3>
                    <div class="sub-sections companies">
                        <div class="right1"><i class=" fa-solid fa-chevron-right fa-2x" style="color: #000000;"></i>
                        </div>
                        <div class="sub-table">
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>Associate Developer</p>
                            </div>
                            <hr>
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>Software Analyst</p>
                            </div>
                            <hr>
                            <div class="sub-table-row">
                                <img src="../Assets/dbce-logo.jpeg" alt="">
                                <p>UI/UX Designer</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <footer>
            <div class="footer-container">
                <div class="left-footer-part">
                    <h4>Address</h4>
                    <p>Don Bosco College of Engineering, Fatorda, Margao, Goa - 403602<br>Tel No.: (0832)
                        2744111/2744112<br>E-mail : dbcefatorda@dbcegoa.ac.in</p>
                </div>
                <div class="right-footer-part">
                    <h4>Follow us</h4>
                    <div class="social-icons-list">
                        <a href="https://www.linkedin.com/school/don-bosco-college-of-engineering-fatorda-goa/"><i
                                class="ico fa-brands fa-square-facebook fa-3x"></i></a>
                        <a href="https://www.instagram.com/dbce_fatorda/"><i
                                class="ico fa-brands fa-square-instagram fa-3x"></i></a>
                        <a
                            href="https://www.facebook.com/p/Don-Bosco-College-of-EngineeringFatorda-Goa-100063749630574/"><i
                                class="ico fa-brands fa-linkedin fa-3x"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>