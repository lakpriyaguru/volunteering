<?php

include_once ('includes/connection.php');

if (isset($_POST['event_id']) && isset($_POST['user_id'])) {
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];
    $sql = "INSERT INTO participation (eventID, userID) VALUES ('$event_id', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();