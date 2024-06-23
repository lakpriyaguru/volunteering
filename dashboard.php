<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

// Include database connection file
include_once ('includes/config.php');

// Fetch user data from the database
$userID = $_SESSION['userID'];
$query = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard - Volunteering Platform</title>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php include_once ('includes/navbar.php'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Dashboard</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Dashboard Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h1 class="display-6 mb-0">Welcome, <?php echo htmlspecialchars($user['userName']); ?></h1>
                        </div>
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <img src="img/team-1.jpg" alt="User Image" class="rounded-circle" width="150"
                                    height="150">
                            </div>
                            <div class="row mb-3 text-center">
                                <p><strong>User ID:</strong> <?php echo htmlspecialchars($user['userID']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['userEmail']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($user['userAddress']); ?>
                                </p>
                                <p><strong>NIC:</strong> <?php echo htmlspecialchars($user['userNIC']); ?></p>
                                <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['userContact']); ?>
                                </p>
                                <p><strong>Number of Events
                                        Participated:</strong><?php echo htmlspecialchars($user['userNoOfEvents']); ?>
                                </p>
                                <p><strong>Joined on:</strong> <?php echo htmlspecialchars($user['userRegDate']); ?>
                                </p>
                            </div>
                            <div class="text-center mt-4">
                                <a class="btn btn-success">View Participated Events</a>
                                <a href="user/editUser.php?userID=<?php echo htmlspecialchars($user['userID']); ?>"
                                    class="btn btn-primary">Edit Details</a>
                                <a class="btn btn-danger"
                                    onclick="deleteAcc('<?php echo htmlspecialchars($user['userID']); ?>')">Delete
                                    Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard End -->


    <?php include_once ('includes/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        function deleteAcc(userID) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete your Account?. This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "dashboard.php?action=delete&said=" + userID;
                }
            });
        }
    </script>
</body>

</html>