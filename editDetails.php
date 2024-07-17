<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

// Include database connection file
include_once ('includes/config.php');

// Fetch user data from the database
$ID = $_SESSION['ID'];
$role = $_SESSION['Role'];

// Fetch user data from the database
if ($role == 'volunteer') {
    $query = "SELECT * FROM user WHERE userID = '$ID'";
} else if ($role == 'organization') {
    $query = "SELECT * FROM organization WHERE orgID = '$ID'";
}
$result = mysqli_query($con, $query);
$result = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($role == 'volunteer') {
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $userAddress = $_POST['userAddress'];
        $userNIC = $_POST['userNIC'];
        $userContact = $_POST['userContact'];

        $updateQuery = "UPDATE user SET userName='$userName', userEmail='$userEmail', userAddress='$userAddress', userNIC='$userNIC', userContact='$userContact' WHERE userID='$ID'";

    } else if ($role == 'organization') {
        $orgRegNo = $_POST['orgRegNo'];
        $orgName = $_POST['orgName'];
        $orgEmail = $_POST['orgEmail'];
        $orgAddress = $_POST['orgAddress'];
        $orgContact = $_POST['orgContact'];
        $orgDesc = $_POST['orgDesc'];

        $updateQuery = "UPDATE organization SET orgRegNo='$orgRegNo', orgName='$orgName', orgEmail='$orgEmail', orgAddress='$orgAddress', orgContact='$orgContact', orgDesc='$orgDesc' WHERE orgID='$ID'";
    }

    if (mysqli_query($con, $updateQuery)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your details have been updated.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    
                }).then(function() {
                    window.location = 'dashboard.php';
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

// Close the database connection
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
                </ol>
            </nav>
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
                            <?php if ($role == 'volunteer') { ?>
                                <form method="POST" action="">
                                    <div class="form-group mb-3">
                                        <label for="userName">Name</label>
                                        <input type="text" class="form-control" id="userName" name="userName"
                                            value="<?php echo htmlspecialchars($result['userName']); ?>" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="userEmail">Email</label>
                                        <input type="email" class="form-control" id="userEmail" name="userEmail"
                                            value="<?php echo htmlspecialchars($result['userEmail']); ?>" required readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="userAddress">Address</label>
                                        <input type="text" class="form-control" id="userAddress" name="userAddress"
                                            value="<?php echo htmlspecialchars($result['userAddress']); ?>" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="userNIC">NIC</label>
                                        <input type="text" class="form-control" id="userNIC" name="userNIC"
                                            value="<?php echo htmlspecialchars($result['userNIC']); ?>" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="userContact">Contact</label>
                                        <input type="text" class="form-control" id="userContact" name="userContact"
                                            value="<?php echo htmlspecialchars($result['userContact']); ?>" required>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            <?php } else if ($role == 'organization') { ?>
                                    <form method="POST" action="">
                                        <div class="form-group mb-3">
                                            <label for="orgNIC">Registration No.</label>
                                            <input type="text" class="form-control" id="orgRegNo" name="orgRegNo"
                                                value="<?php echo htmlspecialchars($result['orgRegNo']); ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="orgName">Name</label>
                                            <input type="text" class="form-control" id="orgName" name="orgName"
                                                value="<?php echo htmlspecialchars($result['orgName']); ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="orgEmail">Email</label>
                                            <input type="email" class="form-control" id="orgEmail" name="orgEmail"
                                                value="<?php echo htmlspecialchars($result['orgEmail']); ?>" required readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="orgAddress">Address</label>
                                            <input type="text" class="form-control" id="orgAddress" name="orgAddress"
                                                value="<?php echo htmlspecialchars($result['orgAddress']); ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="orgContact">Contact</label>
                                            <input type="text" class="form-control" id="orgContact" name="orgContact"
                                                value="<?php echo htmlspecialchars($result['orgContact']); ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="orgDesc">Description</label>
                                            <input type="text" class="form-control" id="orgDesc" name="orgDesc"
                                                value="<?php echo htmlspecialchars($result['orgDesc']); ?>" required>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Details End -->

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

</body>

</html>