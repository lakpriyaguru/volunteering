<?php
session_start();

if (!isset($_SESSION['ID'])) {
    echo "Unauthorized access.";
    exit();
}

include_once ('includes/config.php');

$userID = $_POST['userID'];
$status = $_POST['status'];
$eventID = $_POST['eventID'];

// Fetch current userNoOfEvents value
$userQuery = "SELECT userNoOfEvents FROM user WHERE userID = $userID";
$userResult = mysqli_query($con, $userQuery);

if (mysqli_num_rows($userResult) > 0) {
    $userData = mysqli_fetch_assoc($userResult);
    $currentEventsCount = $userData['userNoOfEvents'];

    // Update participation table
    $updateParticipationQuery = "UPDATE participation SET attendanceStatus = $status WHERE userID = $userID AND eventID = $eventID";
    if (mysqli_query($con, $updateParticipationQuery)) {
        // Update userNoOfEvents based on attendance status change
        if ($status == 1) {
            $newEventsCount = $currentEventsCount + 1;
        } else if ($status == 0) {
            $newEventsCount = $currentEventsCount - 1;
            if ($newEventsCount < 0) {
                $newEventsCount = 0; // Ensure no negative event count
            }
        }

        // Update user table
        $updateUserQuery = "UPDATE user SET userNoOfEvents = $newEventsCount WHERE userID = $userID";
        if (mysqli_query($con, $updateUserQuery)) {
            echo "Attendance toggled successfully.";
        } else {
            echo "Error updating userNoOfEvents: " . mysqli_error($con);
        }
    } else {
        echo "Error toggling attendance: " . mysqli_error($con);
    }
} else {
    echo "User not found.";
}

mysqli_close($con);
?>