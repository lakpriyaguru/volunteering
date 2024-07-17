<?php
session_start();

include_once ('includes/config.php');

// Ensure the connection is successful
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $event_id = mysqli_real_escape_string($con, $_POST['event_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    // Example validation (you may have more complex validation logic)
    if (empty($event_id) || empty($user_id)) {
        echo "error";
        exit;
    }

    // Check if user already participated
    $sql_check_participation = "SELECT * FROM participation WHERE userID = $user_id AND eventID = $event_id";
    $result_check_participation = mysqli_query($con, $sql_check_participation);
    if (mysqli_num_rows($result_check_participation) > 0) {
        echo "already_participated";
        exit;
    }

    // Insert participation record
    $sql_insert_participation = "INSERT INTO participation (userID, eventID) VALUES ($user_id, $event_id)";
    if (mysqli_query($con, $sql_insert_participation)) {
        // Update eventConfirm count in event table
        $sql_update_event_confirm = "UPDATE event SET eventConfirm = eventConfirm + 1 WHERE eventID = $event_id";
        if (mysqli_query($con, $sql_update_event_confirm)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}

mysqli_close($con);
?>