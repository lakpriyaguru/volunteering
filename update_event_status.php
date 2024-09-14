<?php
// Include database connection
include_once ('includes/config.php');


// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $eventID = isset($_POST['eventID']) ? intval($_POST['eventID']) : 0;
    $status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : '';

    if ($eventID > 0 && !empty($status)) {
        // Update the event status in the database
        $query = "UPDATE event SET eventApproval = ? WHERE eventID = ?";
        
        // Prepare statement
        if ($stmt = mysqli_prepare($con, $query)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, 'si', $status, $eventID);

            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo 'Success';
            } else {
                echo 'Error executing query: ' . mysqli_stmt_error($stmt);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo 'Error preparing statement: ' . mysqli_error($con);
        }
    } else {
        echo 'Invalid input';
    }

    // Close connection
    mysqli_close($con);
} else {
    echo 'Invalid request method';
}
?>