<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/analysis-and-report-yearly-more-details.css">
    <title>Analysis and Reports</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <h2 class="main-container-heading"><a href="./dashboard.html"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                    Analysis and Reports</h2>
                <h3>Yearly Placement Drive Reports</h3>
                <div class="sections">
                    <div class="form-adjust">
                        <form action="">
                            <div class="datebox">
                                <div>
                                    <label for=""><strong>From:</strong></label>
                                    <input type="date">
                                </div>
                                <div>
                                    <label for=""><strong>To:</strong></label>
                                    <input type="date">
                                </div>
                            </div>

                            <div class="departmentbox">
                                <label for=""><strong>Department</strong></label>
                                <div class="Checkbox">
                                    <div>
                                        <input type="checkbox">
                                        <label for="">ECS</label>
                                    </div>

                                    <div><input type="checkbox">
                                        <label for="">COMP</label>
                                    </div>
                                    <div><input type="checkbox">
                                        <label for="">MECH</label>
                                    </div>
                                    <div><input type="checkbox">
                                        <label for="">CIVIL</label>
                                    </div>

                                </div>

                            </div>
                            <div class="getreportbutton">
                                <a href="./GoogleSheetsReports/StudentsReport.php"><button class="add-button">Get Report</button></a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="sortby-container">
                    <h3><strong>Student Details</strong></h3>
                    <div>
                        <label for=""><strong>Sort-By</strong></label>
                        <select name="" id="">
                            <option value="">Date: Latest to Oldest</option>
                            <option value="">Date: Oldest to Latest</option>
                            <option value="">Department()</option>
                            <option value="">Offered Salary: High to Low</option>
                            <option value="">Offered Salary: Low to High</option>
                        </select>
                    </div>
                </div>
                <div class="sections">

                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Offered Salary</th>
                            <th>Joining Date</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td>Nimish</td>
                            <td>MECH</td>
                            <td>Google</td>
                            <td>30,000</td>
                            <td>2/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Patric</td>
                            <td>MECH</td>
                            <td>Facebook</td>
                            <td>20,000</td>
                            <td>30/3/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Gavin</td>
                            <td>MECH</td>
                            <td>Google</td>
                            <td>50,000</td>
                            <td>12/11/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                        <tr>
                            <td>Stephen</td>
                            <td>MECH</td>
                            <td>Reliance</td>
                            <td>40,000</td>
                            <td>24/5/2024</td>
                            <td><a href="">View more</a></td>
                        </tr>
                    </table>
                    <div class="button-container-1">
                        <div class="dropdown">
                            <button class="download-button">Download</button>
                            <div class="dropdown-content">
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=csv&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as CSV</a>
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=pdf&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as PDF</a>
                                <a href="https://docs.google.com/spreadsheets/d/1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0/export?format=xlsx&id=1wS7cTnPvG7zB5z2of8AsV-jDNu_E0coXZXER_iIxzS0">Download as Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Other Reports:</h3>
                <div class="button-container-2">
                    <a href="./notification-post.php"><button class="add-button">Company Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Student Report</button></a>
                    <a href="./notification-post.php"><button class="add-button">Alumini Report</button></a>
                </div>
            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>