<?php


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
                            <select id="userType" class="form-select" onchange="showForm()">
                                <option value="volunteer">Volunteer</option>
                                <option value="organization">Organization</option>
                            </select>
                        </div>
                        <div id="volunteerForm">
                            <form>
                                <div class="mb-3">
                                    <label for="indName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="indName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="indEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="indEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="indPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="indPassword" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary py-2">Sign Up as Volunteer</button>
                                </div>
                            </form>
                        </div>
                        <div id="organizationForm" style="display: none;">
                            <form>
                                <div class="mb-3">
                                    <label for="orgName" class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" id="orgName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="orgEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="orgPassword" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgContact" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="orgContact" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orgPhone" class="form-label">Contact Phone</label>
                                    <input type="tel" class="form-control" id="orgPhone" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary py-2">Sign Up as Organization</button>
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
</body>

</html>