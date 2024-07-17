<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

// Include database connection file
include_once ('includes/config.php');

// Get the eventID from the URL
$eventID = $_GET['eventID'];

// Fetch event details
$eventQuery = "SELECT * FROM event WHERE eventID = '$eventID'";
$eventResult = mysqli_query($con, $eventQuery);
$event = mysqli_fetch_assoc($eventResult);

// Fetch participating volunteers
$volunteersQuery = "SELECT p.*, u.* FROM participation p JOIN user u ON p.userID = u.userID WHERE eventID = '$eventID'";
$volunteersResult = mysqli_query($con, $volunteersQuery);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once ('includes/header.php'); ?>

<body>
    <?php include_once ('includes/navbar.php'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="orgEvent.php">Manage Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Event</li>
                </ol>
            </nav>
            <h1 class="display-4 text-white animated slideInDown mb-4">View Event</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h1 class="display-6 mb-0">Event Details</h1>
                        </div>
                        <div class="card-body p-5">
                            <h2><?php echo htmlspecialchars($event['eventName']); ?></h2>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($event['eventDesc']); ?></p>
                            <p><strong>Start:</strong> <?php echo htmlspecialchars($event['eventStart']); ?></p>
                            <p><strong>End:</strong> <?php echo htmlspecialchars($event['eventEnd']); ?></p>
                            <p><strong>Volunteer Count Needed:</strong>
                                <?php echo htmlspecialchars($event['eventNeed']); ?></p>
                            <p><strong>Volunteer Count Confirmed:</strong>
                                <?php echo htmlspecialchars($event['eventConfirm']); ?></p>
                            <p><strong>Approval Status:</strong>
                                <?php echo htmlspecialchars($event['eventApproval']); ?></p>

                            <h3 class="mt-5">Participating Volunteers</h3>
                            <?php if (mysqli_num_rows($volunteersResult) > 0) { ?>
                            <table id="volunteersTable" class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>NIC No.</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                        <th>Timestamp</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($volunteer = mysqli_fetch_assoc($volunteersResult)) {
                                            $attendanceStatus = $volunteer['attendanceStatus']; // Fetch the current status from the database
                                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($volunteer['userName']); ?></td>
                                        <td><?php echo htmlspecialchars($volunteer['userNIC']); ?></td>
                                        <td><?php echo htmlspecialchars($volunteer['userEmail']); ?></td>
                                        <td><?php echo htmlspecialchars($volunteer['userContact']); ?></td>
                                        <td><?php echo htmlspecialchars($volunteer['timestamp']); ?></td>
                                        <td>
                                            <button
                                                class="btn btn-sm <?php echo $attendanceStatus ? 'btn-success' : 'btn-danger'; ?> toggle-attendance"
                                                data-userid="<?php echo $volunteer['userID']; ?>"
                                                data-status="<?php echo $attendanceStatus; ?>">
                                                <?php echo $attendanceStatus ? 'Present' : 'Absent'; ?>
                                            </button>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-3">
                                <!-- Center pagination -->
                                <nav aria-label="Page navigation">
                                    <ul id="pagination" class="pagination justify-content-center">
                                        <!-- Pagination links will be dynamically generated -->
                                    </ul>
                                </nav>
                            </div>

                            <?php } else { ?>
                            <p>No volunteers found for this event.</p>
                            <?php } ?>
                            <a href="orgEvent.php" class="btn btn-primary mt-4">Back to Events</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once ('includes/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- DataTables and Buttons Extensions -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.2/css/buttons.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/buttons/2.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.2/js/buttons.print.min.js"></script>



    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
    $(document).ready(function() {
        $('.toggle-attendance').on('click', function() {
            var $button = $(this);
            var userID = $button.data('userid');
            var currentStatus = $button.data('status');
            var newStatus = currentStatus ? 0 : 1; // Toggle the status
            var eventID = <?php echo $eventID; ?>;

            $.ajax({
                url: 'toggle_attendance.php',
                type: 'POST',
                data: {
                    userID: userID,
                    status: newStatus,
                    eventID: eventID
                },
                success: function(response) {
                    $button.data('status', newStatus);
                    $button.text(newStatus ? 'Present' : 'Absent');
                    $button.removeClass('btn-success btn-danger').addClass(newStatus ?
                        'btn-success' : 'btn-danger');
                },
                error: function() {
                    alert('Error toggling attendance');
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#volunteersTable').DataTable({
            paging: true,
            pageLength: 10, // Display 10 records per page
            searching: true, // Disable built-in search (will implement custom search)
            ordering: true, // Disable ordering (you can enable if needed)
            info: true, // Disable showing info
            lengthChange: true // Disable page length change

        });
    });
    </script>
</body>

</html>