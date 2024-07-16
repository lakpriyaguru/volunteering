<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['ID']) && !isset($_SESSION['Role'])) {
    header('Location: login.php');
    exit();
}

// Include database connection file
include_once ('includes/config.php');

// Fetch user data from the database
$ID = $_SESSION['ID'];
$role = $_SESSION['Role'];

if ($role == 'organization') {
    $query = "SELECT * FROM organization WHERE orgID = '$ID'";
    $result = mysqli_query($con, $query);
    $details = mysqli_fetch_assoc($result);
} else if ($role == 'volunteer') {
    $query = "SELECT * FROM user WHERE userID = '$ID'";
    $result = mysqli_query($con, $query);
    $details = mysqli_fetch_assoc($result);
}

// Delete account
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $query = "DELETE FROM user WHERE userID = '$ID'";
    $result = mysqli_query($con, $query);
    if ($result) {
        session_destroy();
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Account Deleted Successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                });
            });
        </script>";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'deleteOrg') {
    $query = "DELETE FROM organization WHERE orgID = '$ID'";
    $result = mysqli_query($con, $query);
    if ($result) {
        session_destroy();
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Account Deleted Successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
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
            <h1 class="display-4 text-white animated slideInDown mb-4">Dashboard</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Dashboard Start -->
    <?php if ($role == 'volunteer') { ?>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h1 class="display-6 mb-0">Welcome, <?php echo htmlspecialchars($details['userName']); ?>
                            </h1>
                        </div>
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <img src="<?php echo htmlspecialchars($details['userImg']); ?>" alt="User Image"
                                    class="rounded-circle" width="150" height="150">
                            </div>

                            <div class="row mb-3 text-center">
                                <!-- <p><strong>User ID:</strong> <?php echo htmlspecialchars($details['userID']); ?></p> -->
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($details['userEmail']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($details['userAddress']); ?>
                                </p>
                                <p><strong>NIC:</strong> <?php echo htmlspecialchars($details['userNIC']); ?></p>
                                <p><strong>Contact:</strong> <?php echo htmlspecialchars($details['userContact']); ?>
                                </p>
                                <p><strong>Number of Events
                                        Participated:</strong><?php echo htmlspecialchars($details['userNoOfEvents']); ?>
                                </p>
                                <p><strong>Joined on:</strong> <?php echo htmlspecialchars($details['userRegDate']); ?>
                                </p>
                            </div>
                            <div class="text-center mt-4">
                                <a class="btn btn-success">View Participated Events</a>
                                <a href="editDetails.php" class="btn btn-primary">Edit Details</a>
                                <a class="btn btn-danger" onclick="deleteAcc()">Delete
                                    Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else if ($role == 'organization') { ?>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h1 class="display-6 mb-0">Welcome, <?php echo htmlspecialchars($details['orgName']); ?>
                            </h1>
                        </div>
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <img src="<?php echo htmlspecialchars($details['orgImg']); ?>" alt="User Image"
                                    class="rounded-circle" width="150" height="150">
                            </div>
                            <div class="row mb-3 text-center">
                                <p><strong>Registration
                                        No.:</strong><?php echo htmlspecialchars($details['orgRegNo']); ?></p>
                                <p><strong>About:</strong><?php echo htmlspecialchars($details['orgDesc']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($details['orgEmail']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($details['orgAddress']); ?></p>
                                <p><strong>Contact:</strong> <?php echo htmlspecialchars($details['orgContact']); ?></p>
                                <p><strong>Joined on:</strong> <?php echo htmlspecialchars($details['orgRegDate']); ?>
                                </p>
                            </div>
                            <div class="text-center mt-4">
                                <a href="orgEvent.php" class="btn btn-success">Events</a>
                                <a href="editDetails.php" class="btn btn-primary">Edit Details</a>
                                <a class="btn btn-danger" onclick="deleteAccOrg()">Delete
                                    Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>


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
    function deleteAcc() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete your Account?. This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "dashboard.php?action=delete";
            }
        });
    }

    function deleteAccOrg() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete your Account?. This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "dashboard.php?action=deleteOrg";
            }
        });
    }
    </script>
</body>

</html>