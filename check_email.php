<?php
include ('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $userType = $_POST['userType'];

    if ($userType == 'volunteer') {
        $query = "SELECT * FROM user WHERE userEmail='$email'";
    } else if ($userType == 'organization') {
        $query = "SELECT * FROM organization WHERE orgEmail='$email'";
    }

    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }
}

mysqli_close($con);
?>