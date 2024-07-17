<?php
session_start();

include_once ('includes/config.php');

// Ensure the connection is successful
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch event details based on event ID from URL parameter
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $sql = "SELECT e.*, o.orgName FROM event e INNER JOIN organization o ON e.orgID = o.orgID WHERE e.eventID = $event_id AND e.eventApproval = 'Approved'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        echo "Event not found";
        exit; // Stop execution if event not found
    }
} else {
    echo "Event ID not provided";
    exit; // Stop execution if event ID not provided
}

// Check if user has already participated
$user_id = $_SESSION['ID'];
$sql_check_participation = "SELECT * FROM participation WHERE userID = $user_id AND eventID = $event_id";
$result_check_participation = mysqli_query($con, $sql_check_participation);
$already_participated = mysqli_num_rows($result_check_participation) > 0;
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once ('includes/header.php'); ?>

<body>
    <?php include_once ('includes/spinner.php'); ?>
    <?php include_once ('includes/navbar.php'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Events</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Events</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Events List Start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($event['eventName']); ?></h5>
                        <img src="uploads/<?php echo htmlspecialchars($event['eventImg']); ?>" class="card-img-top mb-3"
                            alt="Event Photo">
                        <p class="card-text"><?php echo htmlspecialchars($event['eventDesc']); ?></p>
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item">Start Date:
                                <?php echo htmlspecialchars($event['eventStart']); ?>
                            </li>
                            <li class="list-group-item">End Date: <?php echo htmlspecialchars($event['eventEnd']); ?>
                            </li>
                            <li class="list-group-item">Needed Volunteers:
                                <?php echo htmlspecialchars($event['eventNeed']); ?>
                            </li>
                            <li class="list-group-item">Confirmed Volunteers:
                                <?php echo htmlspecialchars($event['eventConfirm']); ?>
                            </li>
                            <li class="list-group-item">Organizer: <?php echo htmlspecialchars($event['orgName']); ?>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <a href="javascript:history.back()" class="btn btn-secondary me-2">Go Back</a>
                            <?php if ($already_participated): ?>
                                <button class="btn btn-primary" disabled>Already Participated</button>
                            <?php elseif ($_SESSION['Role'] != 'organization'): ?>
                                <?php if ($event['eventConfirm'] >= $event['eventNeed']): ?>
                                    <button class="btn btn-primary" disabled>Event Full</button>
                                <?php else: ?>
                                    <a href="#" onclick="participate()" class="btn btn-primary">Participate</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events List End -->

    <?php include_once ('includes/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/parallax/parallax.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Initialize Owl Carousel -->
    <script>
        function participate() {
            var event_id = <?php echo $event_id; ?>;
            var user_id = <?php echo $_SESSION['ID']; ?>;
            var event_need = <?php echo $event['eventNeed']; ?>;
            var event_confirm = <?php echo $event['eventConfirm']; ?>;
            event_confirm = event_confirm + 1;

            if (event_confirm > event_need) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Event is full. Please try another event.',
                });
                return;
            }

            Swal.fire({
                title: 'Confirm Participation',
                text: 'Are you sure you want to participate in this event?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, participate',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "participate.php",
                        data: {
                            event_id: event_id,
                            user_id: user_id
                        },
                        success: function (response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Participation successful',
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        window.location.href = "event-details.php?event_id=" + event_id;
                                    }
                                });
                            } else if (response == "already_participated") {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Oops...',
                                    text: 'You have already participated in this event.',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Participation failed. Please try again later.',
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>

<?php
mysqli_close($con);
?>