<?php
session_start();

include_once ('includes/config.php');

// Ensure the connection is successful
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch event data
$sql = "SELECT * FROM user ORDER BY userNoOfEvents DESC";
$result = mysqli_query($con, $sql);
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    //display event not found in the table
    echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'No Volunteers Found!',
                    text: 'There are no Volunteers available at the moment.',
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
            <h1 class="display-4 text-white animated slideInDown mb-4">Volunteers</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Volunteers</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Volunteers List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <?php foreach ($users as $user): ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card">
                        <img src="uploads/<?php echo htmlspecialchars($user['userImg']); ?>" class="card-img-top"
                            alt="<?php echo htmlspecialchars($user['userName']); ?>"
                            style="width: 75%; height: 75%; display: block; margin: 0 auto;">

                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($user['userName']); ?></h5>
                            <p class="card-text">participated
                                <?php echo htmlspecialchars($user['userNoOfEvents']); ?> events.
                            </p>
                            <!-- <?php echo htmlspecialchars($user['eventParticipated']); ?> -->
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Volunteers List End -->

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
</body>

</html>