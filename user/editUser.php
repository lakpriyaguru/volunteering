<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

// Include database connection file
include_once ('../includes/config.php');

// Fetch user data from the database
$userID = $_SESSION['userID'];
$query = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userAddress = $_POST['userAddress'];
    $userNIC = $_POST['userNIC'];
    $userContact = $_POST['userContact'];

    // Update user data in the database
    $updateQuery = "UPDATE user SET userName='$userName', userEmail='$userEmail', userAddress='$userAddress', userNIC='$userNIC', userContact='$userContact' WHERE userID='$userID'";

    if (mysqli_query($con, $updateQuery)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your details have been updated.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = '../dashboard.php';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error updating your details.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Edit Details - Volunteering Platform</title>
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
    <link href="../lib/animate/animate.min.css" rel="stylesheet" />
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include_once ('../includes/navbar.php'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Edit Details</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Edit Details Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h1 class="display-6 mb-0">Edit Your Details</h1>
                        </div>
                        <div class="card-body p-5">
                            <form method="POST" action="">
                                <div class="form-group mb-3">
                                    <label for="userName">Name</label>
                                    <input type="text" class="form-control" id="userName" name="userName"
                                        value="<?php echo htmlspecialchars($user['userName']); ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="userEmail">Email</label>
                                    <input type="email" class="form-control" id="userEmail" name="userEmail"
                                        value="<?php echo htmlspecialchars($user['userEmail']); ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="userAddress">Address</label>
                                    <input type="text" class="form-control" id="userAddress" name="userAddress"
                                        value="<?php echo htmlspecialchars($user['userAddress']); ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="userNIC">NIC</label>
                                    <input type="text" class="form-control" id="userNIC" name="userNIC"
                                        value="<?php echo htmlspecialchars($user['userNIC']); ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="userContact">Contact</label>
                                    <input type="text" class="form-control" id="userContact" name="userContact"
                                        value="<?php echo htmlspecialchars($user['userContact']); ?>" required>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Details End -->

    <?php include_once ('../includes/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

</body>

</html>