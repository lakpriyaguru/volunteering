<?php
include_once ('config.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch event details based on event ID from URL parameter
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $sql = "SELECT e.*, o.orgName FROM event e INNER JOIN organization o ON e.orgID = o.orgID WHERE e.eventID = $event_id AND e.eventApproval = 1";
    $result = $conn->query($sql);
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Volunteering - Platform for Volunteers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
</head>

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
                            <a href="" class="btn btn-primary">Participate</a>
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

</body>

</html>

<?php
$conn->close();
?>