<?php
require "../conn.php";
require "../restrict.php";
require "../restrict_student.php";
include "./tpo-utility-functions.php";
global $conn;
if (!isset($_SESSION)) {
    session_start();
}
// 0- Pending 1-Error 2-Success
$addError = 0;
$error = "";
if (isset($_POST["add-company"])) {

    $pcEmail = $_SESSION['user_email'];
    $cname = !empty($_POST['cname']) ? $_POST['cname'] : NULL;
    $scope = !empty($_POST['scope']) ? $_POST['scope'] : NULL;
    $location = !empty($_POST['location']) ? $_POST['location'] : NULL;
    $domain = !empty($_POST['domain']) ? $_POST['domain'] : NULL;
    $hrname = !empty($_POST['hrname']) ? $_POST['hrname'] : NULL;
    $hremail = !empty($_POST['hremail']) ? $_POST['hremail'] : NULL;
    $hrcontact = !empty($_POST['hrcontact']) ? $_POST['hrcontact'] : NULL;
    $description = !empty($_POST['description']) ? $_POST['description'] : NULL;
    $link = !empty($_POST['link']) ? $_POST['link'] : NULL;

    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $fileType = mime_content_type($_FILES['clogo']['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        $error = "Invalid file type. Only JPEG, JPG, and PNG files are allowed.";
    }

    $companyInsertQuery = "INSERT INTO `company` (`C_Name`, `C_Domain`, `C_Scope`, `C_Description`, `C_Location`,`C_HR_name`,`C_HR_email`,`C_HR_phone`,`C_PC_Email`,`C_Website`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $companyInsert = $conn->prepare($companyInsertQuery);
    $companyInsert->bind_param("ssssssssss", $cname, $domain, $scope, $description, $location, $hrname, $hremail, $hrcontact, $pcEmail, $link);
    if ($companyInsert->execute()) {
        $companyId = $conn->insert_id;
        $logo = 'C_id_' . $companyId . '.' . pathinfo($_FILES['clogo']['name'], PATHINFO_EXTENSION);

        if (!move_uploaded_file($_FILES['clogo']['tmp_name'], '../Data/Companies/Company_Logo/' . $logo)) {
            die("Error uploading Logo.");
            $addError = 1;
        }

        $companyUpdateQuery = "UPDATE `company` SET `C_Logo` = ? WHERE `C_id` = ?";
        $companyUpdate = $conn->prepare($companyUpdateQuery);
        $companyUpdate->bind_param("si", $logo, $companyId);
        $companyUpdate->execute();
         $addError = 2;
    } else {
        die("Error inserting company details into the database.");
        $addError = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php' ?>
    <link rel="stylesheet" href="./css/company-create.css">
    <title>Create Company</title>
</head>

<body>
    <div id="wrapper">
        <?php include './header.php' ?>

        <div class="container">
            <?php include './sidebar.php' ?>

            <div class="main-container">
                <div class="main-container-header">
                    <h2 class="main-container-heading"><a href="./company.php"><i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i></a>
                        Add Company</h2>
                </div>
                <div class="sections">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="inputbox-1">
                            <div class="inputbox">
                                <label for="">Company Name:</label>
                                <input type="text" name="cname" placeholder="Company Name" required>
                            </div>
                            <div class="inputbox">
                                <label for="">Company Logo: <?php echo " <span style='color:red;'>" . $error . "</span>" ?> </label>
                                <input type="file" name="clogo" placeholder="Company Logo" required accept=".jpeg, .jpg, .png">
                            </div>
                        </div>
                        <div class="inputbox-1">
                            <div class="inputbox">
                                <label for="">Market Scope: </label>
                                <input type="text" name="scope" placeholder="Market Scope">
                            </div>
                            <div class="inputbox">
                                <label for="">Location: </label>
                                <input type="text" name="location" placeholder="Location">
                            </div>
                        </div>
                        <div class="inputbox">
                            <label for="">Domain: </label>
                            <input type="text" name="domain" placeholder="Domain">
                        </div>
                        <div class="inputbox">
                            <label for="">HR: </label>
                            <input type="text" name="hrname" placeholder="Company representative">
                        </div>
                        <div class="inputbox-1">
                            <div class="inputbox">
                                <label for="">HR Email: </label>
                                <input type="text" name="hremail" placeholder="HR Email">
                            </div>
                            <div class="inputbox">
                                <label for="">HR Contact Number: </label>
                                <input type="text" name="hrcontact" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="inputbox">
                            <label for="">Company Website:</label>
                            <input type="text" name="link" placeholder="www.company.com">
                        </div>
                        <div class="inputbox">
                            <label for="">Description:</label>
                            <textarea required class="textarea-message" name="description" id="" placeholder="Description"></textarea>
                        </div>

                        <button class="add-button" name="add-company" type="submit">Add Company</button>

                    </form>
                </div>
            </div>
            <!-- Modals -->
            <div id="error-logo" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>There was an Error</p>
                </div>
            </div>

            <div id="successful" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>The Company has been added successfully</p>
                </div>
            </div>
            <script>
                // Get the modals
                var notInterestedModal = document.getElementById("error-logo");
                var interestedModal = document.getElementById("successful");

                // Get the <span> elements that close the modals
                var closeButtons = document.getElementsByClassName("close");

                // Close the modal when the user clicks on <span> (x)
                for (var i = 0; i < closeButtons.length; i++) {
                    closeButtons[i].onclick = function() {
                        interestedModal.style.display = "none";
                        notInterestedModal.style.display = "none";
                    }
                }

                // Close the modal when the user clicks anywhere outside of the modal
                window.onclick = function(event) {
                    if (event.target == interestedModal) {
                        interestedModal.style.display = "none";
                    } else if (event.target == notInterestedModal) {
                        notInterestedModal.style.display = "none";
                    }
                }

                // Trigger the appropriate modal based on PHP variable
                <?php if ($addError == 2) : ?>
                    interestedModal.style.display = "block";
                <?php elseif ($addError == 1) : ?>
                    notInterestedModal.style.display = "block";
                <?php endif; ?>
            </script>
        </div>

        <?php include './footer.php' ?>
    </div>

</body>

</html>