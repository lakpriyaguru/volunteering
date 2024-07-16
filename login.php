<?php
session_start();

include ('includes/config.php');

if (isset($_POST['login'])) {
    $role = $_POST['role'];
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = md5($_POST['password']);

    if ($role == 'organization') {
        $query = mysqli_query($con, "SELECT orgID, orgName, orgEmail FROM organization WHERE orgEmail='$email' AND orgPassword='$password'");
        $ret = mysqli_fetch_array($query);
        if ($ret) {
            $_SESSION['Role'] = 'organization';
            $_SESSION['ID'] = $ret['orgID'];
            $_SESSION['Name'] = $ret['orgName'];
            header('location:dashboard.php');
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid Credentials. Try Again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
        }
    } else if ($role == 'volunteer') {
        $query = mysqli_query($con, "SELECT userID, userName, userEmail FROM user WHERE userEmail='$email' AND userPassword='$password'");
        $ret = mysqli_fetch_array($query);
        if ($ret) {
            $_SESSION['Role'] = 'volunteer';
            $_SESSION['ID'] = $ret['userID'];
            $_SESSION['Name'] = $ret['userName'];
            header('location:dashboard.php');
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid Credentials. Try Again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
        }
    }
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
            <h1 class="display-4 text-white animated slideInDown mb-4">Login</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Login</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Login Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <h1 class="display-6 text-center mb-5">Login to Your Account</h1>
                        <form method="post">
                            <div class="mb-3">
                                <label for="role" class="form-label">Login as</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>Select your role</option>
                                    <option value="organization">Organization</option>
                                    <option value="volunteer">Volunteer</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <a href="reset.php" class="text-primary">Forgot Password?</a>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-2" name="login">Login</button>
                            </div>
                            <div class="text-center mt-3">
                                <p>Don't have an account? <a href="signup.php" class="text-primary">Sign Up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login End -->

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