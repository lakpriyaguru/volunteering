<?php
session_start();

include_once ('includes/config.php');

// Ensure the connection is successful
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

//get current date and time
$currentDate = date('Y-m-d H:i:s');

// Fetch event data
$sql = "SELECT * FROM event WHERE eventApproval = 'Approved' AND eventStart >= '$currentDate'";
$result = mysqli_query($con, $sql);
$events = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
} else {
    //display event not found in the table
    echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'No Events Found!',
                    text: 'There are no events available at the moment.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'index.php';
                });
            });
        </script>";
}

// Close the database connection
mysqli_close($con);
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
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <?php foreach ($events as $event):
                    $percentage = round(($event['eventConfirm'] / $event['eventNeed']) * 100);
                    ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card d-flex justify-content-center">
                            <!-- Added justify-content-center class -->
                            <img src="uploads/<?php echo htmlspecialchars($event['eventImg']); ?>"
                                class="card-img-top mx-auto" alt="<?php echo htmlspecialchars($event['eventName']); ?>"
                                style="width: 75%; height: 75%;" />

                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($event['eventName']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($event['eventDesc']); ?></p>
                                <div class="causes-press bg-light p-3 pt-2">
                                    <div class="d-flex justify-content-between">
                                        <p class="text-dark">
                                            <?php echo htmlspecialchars($event['eventNeed']); ?> <small
                                                class="text-body">Needed</small>
                                        </p>
                                        <p class="text-dark">
                                            <?php echo htmlspecialchars($event['eventConfirm']); ?> <small
                                                class="text-body">Confirmed</small>
                                        </p>
                                    </div>

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            aria-valuenow="<?php echo htmlspecialchars($event['eventConfirm']); ?>"
                                            aria-valuemin="0"
                                            aria-valuemax="<?php echo htmlspecialchars($event['eventNeed']); ?>"
                                            style="width: <?php echo $percentage; ?>%;">
                                            <span><?php echo $percentage; ?>%</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="event-details.php?event_id=<?php echo htmlspecialchars($event['eventID']); ?>"
                                    class="btn btn-primary">More Details</a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
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
        $(document).ready(function () {
            $('.event-carousel').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>