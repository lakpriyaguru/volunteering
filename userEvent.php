<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['ID']) && !isset($_SESSION['Role'])) {
    header('Location: login.php');
    exit();
}

// Include database connection file
include_once('includes/config.php');

// Fetch user data
$ID = $_SESSION['ID'];
$role = $_SESSION['Role'];

// Fetch upcoming events for the user
// $upcomingEventsQuery = "
//     SELECT e.eventID, e.eventName, e.eventDesc, e.eventStart, e.eventEnd, e.eventImg 
//     FROM event e
//     LEFT JOIN participation p ON e.eventID = p.eventID AND p.userID = '$ID'
//     WHERE p.userID = '$ID' AND e.eventStart > NOW() AND e.eventConfirm = 1";
$upcomingEventsQuery = "
    SELECT e.eventID, e.eventName, e.eventDesc, e.eventStart, e.eventEnd, e.eventImg, p.attendanceStatus, p.timestamp 
    FROM event e
    INNER JOIN participation p ON e.eventID = p.eventID
    WHERE p.userID = '$ID' AND p.attendanceStatus = 0 AND e.eventStart > NOW() ORDER BY e.eventStart ASC";
$upcomingEventsResult = mysqli_query($con, $upcomingEventsQuery);

// Fetch participated events for the user
$participatedEventsQuery = "
    SELECT e.eventID, e.eventName, e.eventDesc, e.eventStart, e.eventEnd, e.eventImg, p.attendanceStatus, p.timestamp 
    FROM event e
    INNER JOIN participation p ON e.eventID = p.eventID
    WHERE p.userID = '$ID' AND p.attendanceStatus = 1 ORDER BY e.eventStart DESC";
$participatedEventsResult = mysqli_query($con, $participatedEventsQuery);

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once('includes/header.php'); ?>

<body>
    <?php include_once('includes/navbar.php'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Your Events</li>
                </ol>
            </nav>
            <h1 class="display-4 text-white animated slideInDown mb-4">Your Events</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Event Tabs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <ul class="nav nav-tabs" id="eventTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming"
                        type="button" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming Events</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="participated-tab" data-bs-toggle="tab" data-bs-target="#participated"
                        type="button" role="tab" aria-controls="participated" aria-selected="false">Participated
                        Events</button>
                </li>
            </ul>
            <div class="tab-content" id="eventTabsContent">
                <!-- Upcoming Events Tab -->
                <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                    <div class="row g-4 mt-3">
                        <?php if (mysqli_num_rows($upcomingEventsResult) > 0): ?>
                        <?php while ($event = mysqli_fetch_assoc($upcomingEventsResult)): ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="event-details.php?event_id=<?php echo $event['eventID']; ?>"
                                class="text-decoration-none text-dark">
                                <div class="card">
                                    <img src="uploads/<?php echo htmlspecialchars($event['eventImg']); ?>"
                                        class="card-img-top" alt="Event Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($event['eventName']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($event['eventDesc']); ?></p>
                                        <p class="card-text"><small class="text-muted">Start:
                                                <?php echo htmlspecialchars($event['eventStart']); ?></small></p>
                                        <p class="card-text"><small class="text-muted">End:
                                                <?php echo htmlspecialchars($event['eventEnd']); ?></small></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php endwhile; ?>
                        <?php else: ?>
                        <p class="text-center mt-4">No upcoming events found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Participated Events Tab -->
                <div class="tab-pane fade" id="participated" role="tabpanel" aria-labelledby="participated-tab">
                    <div class="row g-4 mt-3">
                        <?php if (mysqli_num_rows($participatedEventsResult) > 0): ?>
                        <?php while ($event = mysqli_fetch_assoc($participatedEventsResult)): ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="event-details.php?event_id=<?php echo $event['eventID']; ?>"
                                class="text-decoration-none text-dark">
                                <div class="card">
                                    <img src="uploads/<?php echo htmlspecialchars($event['eventImg']); ?>"
                                        class="card-img-top" alt="Event Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($event['eventName']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($event['eventDesc']); ?></p>
                                        <p class="card-text"><small class="text-muted">Start:
                                                <?php echo htmlspecialchars($event['eventStart']); ?></small></p>
                                        <p class="card-text"><small class="text-muted">End:
                                                <?php echo htmlspecialchars($event['eventEnd']); ?></small></p>
                                        <!-- <p class="card-text"><small class="text-muted">Attendance:
                                                <?php echo htmlspecialchars($event['attendanceStatus']); ?></small></p>
                                        <p class="card-text"><small class="text-muted">Signed up on:
                                                <?php echo htmlspecialchars($event['timestamp']); ?></small></p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <p class="text-center mt-4">No participated events found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Tabs End -->

    <?php include_once('includes/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>