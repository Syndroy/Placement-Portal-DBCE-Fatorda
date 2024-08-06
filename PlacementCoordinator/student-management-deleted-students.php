<?php
require "../conn.php";
require "../restrict.php";
include "./tpo-utility-functions.php";
global $conn;

if (!isset($_SESSION)) {
    session_start();
}


$studentSearch = false;
$d_studentSearch = false;

if (isset($_POST["d_student-search-button"])) {
    $d_sname = !empty($_POST['d_sname']) ? $_POST['d_sname'] : null;
    $d_departments = !empty($_POST['d_departments']) ? $_POST['d_departments'] : [];
    $d_gender = !empty($_POST['d_gender']) ? $_POST['d_gender'] : null;

    $d_studentsResult = fetchStudents(true, $d_sname, $d_departments, $d_gender);
    $d_studentSearch = true;
} else {
    $d_studentsResult = fetchStudents(true);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/student-management.css">
    <title>Student Management</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./dashboard.html"><a href="./student-management.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a></a>
                        Student Management</h2>
                </div>
                <h3>Deleted Students</h3>
                <div class="form-adjust">
                <form action="" method="post">
                    <div class="inputbox">
                            <label for="">Student Name:</label>
                            <input type="text" name="d_sname" placeholder="Enter Student Name">
                        </div>

                        <div class="departmentbox">
                            <label for="">Department:</label>
                            <div class="Checkbox">
                                <?php
                                $fetchDepartmentQuery = "SELECT Dept_name as dname FROM department;";
                                $fetchDepartment = $conn->prepare($fetchDepartmentQuery);
                                $fetchDepartment->execute();
                                $result = $fetchDepartment->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    echo '<div>
                                            <input name="d_departments[]" value="' . htmlspecialchars($row["dname"]) . '" type="checkbox">
                                            <label for="">' . htmlspecialchars($row["dname"]) . '</label>
                                          </div>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="inputbox">
                            <label for="">Gender:</label>
                            <select name="d_gender" id="">
                                <option value="" selected>Select</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="search-button-container">
                            <button name="d_student-search-button" class="search-button">Search</button>
                        </div>
                    </form>
                </div>
                <div class="sections">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Class</th>
                            <th>Details</th>
                        </tr>
                        <?php
                        while ($student = $d_studentsResult->fetch_assoc()) {
                            echo '<tr>
                                <td>' . htmlspecialchars($student["fname"]) . ' ' . htmlspecialchars($student["lname"]) . '</td>
                                <td>' . htmlspecialchars($student["dname"]) . '</td>
                                <td>' . htmlspecialchars($student["cname"]) . '</td>
                                <td><a href="student-management-view-student.php?semail='.$student["semail"].'">View more</a></td>
                            </tr>';
                        }
                        ?>
                       
                    </table>
                </div>

            </div>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>