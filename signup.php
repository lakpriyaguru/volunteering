<?php
session_start();

include ('includes/config.php');

// signup logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['userType'];
    if ($userType == 'volunteer') {
        $userName = mysqli_real_escape_string($con, $_POST['userName']);
        $userNIC = mysqli_real_escape_string($con, $_POST['userNIC']);
        $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
        $userPassword = md5($_POST['userPassword']);
        $userContactNo = mysqli_real_escape_string($con, $_POST['userContactNo']);
        $userAddress = mysqli_real_escape_string($con, $_POST['userAddress']);

        $query = "INSERT INTO user(userName, userNIC, userEmail, userPassword, userContact, userAddress) VALUES ('$userName', '$userNIC', '$userEmail', '$userPassword', '$userContactNo', '$userAddress')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Success!',
                    text: 'You have successfully signed up as a volunteer. Please login to continue.',
                    icon: 'success',
                    delay: 2000
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                })
            });
        </script>";
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
        }
    } else if ($userType == 'organization') {
        $orgName = mysqli_real_escape_string($con, $_POST['orgName']);
        $orgRegNo = mysqli_real_escape_string($con, $_POST['orgRegNo']);
        $orgEmail = mysqli_real_escape_string($con, $_POST['orgEmail']);
        $orgPassword = md5($_POST['orgPassword']);
        $orgPhone = mysqli_real_escape_string($con, $_POST['orgContact']);
        $orgAddress = mysqli_real_escape_string($con, $_POST['orgAddress']);
        $orgDesc = mysqli_real_escape_string($con, $_POST['orgDesc']);

        $query = "INSERT INTO organization(orgName, orgRegNo, orgEmail, orgPassword, orgContact, orgAddress, orgDesc) VALUES('$orgName', '$orgRegNo', '$orgEmail', '$orgPassword', '$orgPhone', '$orgAddress', '$orgDesc')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Success!',
                    text: 'You have successfully signed up as an organization. Please login to continue.',
                    icon: 'success',
                    delay: 2000
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                })
            });
        </script>";
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
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
            <h1 class="display-4 text-white animated slideInDown mb-4">Sign Up</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Sign Up</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Signup Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <h1 class="display-6 text-center mb-5">Sign Up</h1>
                        <div class="mb-3">
                            <label for="userType" class="form-label">I am signing up as</label>
                            <select id="userType" class="form-select" onchange="showForm()" name="userType"
                                form="signupForm">
                                <option value="volunteer">Volunteer</option>
                                <option value="organization">Organization</option>
                            </select>
                        </div>
                        <div id="volunteerForm">
                            <form id="signupForm" method="post" action="">
                                <input type="hidden" name="userType" value="volunteer">
                                <div class="mb-3">
                                    <label for="userName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="userName" name="userName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="userNIC" class="form-label">NIC No.</label>
                                    <input type="text" class="form-control" id="userNIC" name="userNIC" required>
                                </div>
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                                    <span id="userEmailError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="userPassword" name="userPassword"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="userContactNo" class="form-label">Contact No.</label>
                                    <input type="tel" class="form-control" id="userContactNo" name="userContactNo"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="userAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="userAddress" name="userAddress"
                                        required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary py-2" name="signup">Sign Up as
                                        Volunteer</button>
                                </div>
                            </form>
                        </div>

                        <div id="organizationForm" style="display: none;">
                            <form id="signupForm" method="post" action="">
                                <input type="hidden" name="userType" value="organization">
                                <div class="mb-3">
                                    <label for="orgName" class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" id="orgName" name="orgName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgRegNo" class="form-label">Registration Number</label>
                                    <input type="text" class="form-control" id="orgRegNo" name="orgRegNo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="orgEmail" name="orgEmail" required>
                                    <span id="orgEmailError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="orgPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="orgPassword" name="orgPassword"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgContact" class="form-label">Contact No.</label>
                                    <input type="tel" class="form-control" id="orgContact" name="orgContact" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="orgAddress" name="orgAddress" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgDesc" class="form-label">About the Organization</label>
                                    <input type="text" class="form-control" id="orgDesc" name="orgDesc" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary py-2" name="signup">Sign Up as
                                        Organization</button>
                                </div>
                            </form>
                        </div>

                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="login.php" class="text-primary">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Signup End -->

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
        function showForm() {
            var userType = document.getElementById("userType").value;
            if (userType === "volunteer") {
                document.getElementById("volunteerForm").style.display = "block";
                document.getElementById("organizationForm").style.display = "none";
            } else {
                document.getElementById("volunteerForm").style.display = "none";
                document.getElementById("organizationForm").style.display = "block";
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#userEmail, #orgEmail').on('blur', function () {
                var email = $(this).val();
                var userType = $('#userType').val();
                var errorSpan = userType === 'volunteer' ? '#userEmailError' : '#orgEmailError';
                var submitButton = userType === 'volunteer' ? '#volunteerForm button[type="submit"]' :
                    '#organizationForm button[type="submit"]';

                if (email) {
                    $.ajax({
                        url: 'check_email.php',
                        type: 'POST',
                        data: {
                            email: email,
                            userType: userType
                        },
                        success: function (response) {
                            if (response == 'exists') {
                                $(errorSpan).text(
                                    'Email already registered. Please use a different email.'
                                );
                                $(submitButton).prop('disabled', true);
                            } else {
                                $(errorSpan).text('');
                                $(submitButton).prop('disabled', false);
                            }
                        }
                    });
                } else {
                    $(errorSpan).text('');
                    $(submitButton).prop('disabled', false);
                }
            });
        });
    </script>


</body>

</html>