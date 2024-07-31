<?php

function getTpoNotifications()
{
    global $conn;

    $fetchNotificationsQuery = "SELECT ND.Notification_ID as nid, ND.Message AS message, ND.Subject AS subject, ND.Attachment1 AS attach1, ND.Attachment2 AS attach2, ND.Notification_Date AS notidate, ND.Notification_Due_Date as duedate
FROM notificationdetails AS ND
INNER JOIN studentnotifications AS SN ON ND.Notification_ID = SN.Notification_ID
WHERE ND.PC_Email = ?
ORDER BY ND.Notification_Date DESC;";
    $fetchNotifications = $conn->prepare($fetchNotificationsQuery);
    $fetchNotifications->bind_param("s", $_SESSION["user_email"]);
    $fetchNotifications->execute();
    $result = $fetchNotifications->get_result();

    while ($row = $result->fetch_assoc()) {
        $timestamp = $row["notidate"];
        $istTimeZone = new DateTimeZone('Asia/Kolkata');
        $dateTime = new DateTime($timestamp);
        $dateTime->setTimezone($istTimeZone);
        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('h:i:s A');

        echo '<div class="sections">
                    <div class="company-container">
                        <p><strong>Date:</strong> ' . $date . '</p>
                        <p><strong>Time:</strong> ' . $time . '</p>
                    </div>
                    <p><strong>Due Date:</strong> ' . $row["duedate"] . '</p>
                    <p class="subject"><strong>Subject:</strong> ' . $row["subject"] . '</p>
                    <p class= "message"><strong>Message:</strong> ' . $row["message"] . '</p>';

        if ($row['attach1'] != NULL) {
            echo '<a href="../Data/Notifications/' . $row['attach1'] . '" class="attachment-links">Attachment 1</a>';
        }

        if ($row['attach2'] != NULL) {
            echo '<a href="../Data/Notifications/' . $row['attach2'] . '" class="attachment-links">Attachment 2</a>';
        }

        echo '</p>
                    <a href="./notifications-edit.php?nid=' . $row["nid"] . '"><button class="edit-button">Edit</button></a>
                    <form action="" method="post">
                        <input type="number" value="' . $row["nid"] . '" hidden name="nid">
                        <button name="delete_noti" class="delete-button">Delete</button>
                    </form>
                </div>';
    }
}


function getLiveJobListings()
{
    global $conn;
    $fetchJobQuery = "
        SELECT C.C_Name as cname, C.C_Logo clogo, P.J_Due_date duedate, P.J_Position position, J.J_id jid 
        FROM company as C
        INNER JOIN jobposting as J ON J.C_id = C.C_id
        INNER JOIN jobplacements as P ON P.J_id = J.J_id
        WHERE P.J_Due_date >= CURRENT_DATE;
    ";

    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->execute();
    $result = $fetchJob->get_result();

    while ($row = $result->fetch_assoc()) {
        $row["jid"] = (int) $row["jid"];
        $fetchJobDeptQuery = "
            SELECT d.Dept_name dname FROM department as d
            INNER JOIN jobdepartments as jd on d.Dept_id = jd.Dept_id
            WHERE jd.J_id = ?;
        ";
        $fetchJobDept = $conn->prepare($fetchJobDeptQuery);
        $fetchJobDept->bind_param("i", $row["jid"]);
        $fetchJobDept->execute();
        $resultDept = $fetchJobDept->get_result();

        echo '<div class="sections">
                <div class="company-container">
                    <div class="company-logo-container">
                        <img src="../Data/Companies/Company_Logo/' . $row['clogo'] . '" alt="">
                        <p>' . $row['cname'] . '</p>
                    </div>
                    <p><strong>Due Date:</strong> ' . date("d/m/Y", strtotime($row['duedate'])) . '</p>
                </div>
                <p class="position"><strong>Position:</strong> ' . $row['position'] . '</p>
                <p class="department"><strong>Departments </strong>: ';

        while ($rowDept = $resultDept->fetch_assoc()) {
            echo $rowDept["dname"] . " ";
        }

        echo '</p>
               
                <form action="" method="post">
                    <input name="jid" type="hidden" value="'.$row["jid"].'">
                    <button name="delete-listing" class="delete-button">Delete</button>
                </form>
                <a href="./job-live-listing-analysis.php?jid=' . $row["jid"] . '"><button class="analysis-button">Analysis</button></a>
                <a href=""><button class="edit-button">Edit Details</button></a>
            </div>';
    }
}


function getCompletedJobListings()
{
    global $conn;
    $fetchJobQuery = "SELECT c.C_Name as cname, j.J_Due_date as duedate, SUM(ja.placed) as totalplaced
        FROM company as c 
        INNER JOIN jobposting as jp ON jp.C_id=c.C_id
        INNER JOIN jobplacements as j ON jp.J_id=j.J_id
        INNER JOIN jobapplication as ja ON ja.J_id=j.J_id
        WHERE j.J_Due_date < CURRENT_DATE
        GROUP BY c.C_Name, j.J_Due_date;";
    $fetchJob = $conn->prepare($fetchJobQuery);
    $fetchJob->execute();
    $result = $fetchJob->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                        <td>' . $row["duedate"] . '</td>
                        <td>' . $row["cname"] . '</td>
                        <td>' . $row["totalplaced"] . '</td>
                        <td><a href="">View more</a></td>
                    </tr>';
    }
}


function getEligibleStudents()
{
    global $conn;
    $jid = (int) $_GET["jid"];
    $fetchJobEligibleQuery = "SELECT s.S_College_Email as semail,s.S_Fname as sfname,d.Dept_name as dname,ja.J_id as jid,ja.Interest as interest FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
WHERE ja.J_id = ? LIMIT 5;";
    $fetchJobEligible = $conn->prepare($fetchJobEligibleQuery);
    $fetchJobEligible->bind_param("i", $jid);
    $fetchJobEligible->execute();
    $result = $fetchJobEligible->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["sfname"] . '</td>
                <td>' . $row["dname"] . '</td>';
        if ($row['interest'] == 0) {
            echo  '<td>Not Interested</td>';
        } else {
            echo '<td>Interested</td>';
        }

        echo '<td><a href="">View More</a></td>
                <td><button class="remove-button">Remove</button></td>
            </tr>';
    }
}


function getInterestedStudents()
{
    global $conn;
    $jid = (int) $_GET["jid"];
    $fetchJobEligibleQuery = "SELECT s.S_College_Email as semail,ja.placed as placed,s.S_Fname as sfname,d.Dept_name as dname,ja.J_id as jid,ja.Interest as interest,jp.J_Due_date as duedate FROM student as s
INNER JOIN jobapplication as ja ON s.S_College_Email=ja.S_College_Email
INNER JOIN class as c ON c.Class_id=s.S_Class_id
INNER JOIN department as d ON d.Dept_id=c.Dept_id
INNER JOIN jobplacements as jp ON jp.J_id = ja.J_id
WHERE ja.J_id = ? AND ja.Interest = ? LIMIT 5;";
    $inte = 1;
    $fetchJobEligible = $conn->prepare($fetchJobEligibleQuery);
    $fetchJobEligible->bind_param("ii", $jid, $inte);
    $fetchJobEligible->execute();
    $result = $fetchJobEligible->get_result();
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["sfname"] . '</td>
                <td>' . $row["dname"] . '</td>';
        if ($row['placed'] == 0) {
            $retrieved_date = $row['duedate'];
            $date_from_db = new DateTime($retrieved_date);
            $current_date = new DateTime();
            if ($date_from_db > $current_date) {
                echo '<td>Pending</td>';
            } else {
                echo '<td>Rejected</td>';
            }
        } else {
            echo '<td>Placed</td>';
        }

        echo '<td><a href="">View More</a></td>
                <td><button class="remove-button">Remove</button></td>
            </tr>';
    }
}
