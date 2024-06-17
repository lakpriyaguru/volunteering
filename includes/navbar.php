<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar text-white-50 row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>Faculty of Applied
                Sciences, Wayamba University of Sri Lanka, Kuliyapitiya.
                60200</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@volunteering.com</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-twitter"></i></a>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0">
                Volunteer<span class="text-white">ing</span>
            </h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="events.php" class="nav-item nav-link">Events</a>
                <a href="organizations.php" class="nav-item nav-link">Organizations</a>
                <a href="volunteers.php" class="nav-item nav-link">Volunteers</a>
                <a href="about.php" class="nav-item nav-link">About Us</a>
                <a href="contact.php" class="nav-item nav-link">Contact Us</a>

            </div>
            <?php
            if (!isset($_SESSION['userID'])) {
                echo '
    <div class="d-none d-lg-flex ms-2">
        <a class="btn btn-outline-primary py-2 px-3" href="login.php">
            Login
            <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                <i class="fa fa-arrow-right"></i>
            </div>
        </a>
    </div>';
            } else {
                echo '<div class="d-none d-lg-flex ms-2 dropdown">
        <a class="btn btn-outline-primary py-2 px-3 dropdown-toggle" href="#" role="button"
            id="dropdownMenuLink" data-bs-toggle="dropdown"
            aria-expanded="false">' . $_SESSION['userName'] . '</a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="dashboard.php">Profile</a></li>
            <li><a class="dropdown-item" href="signout.php">Logout</a></li>
        </ul>
    </div>';
            }
            ?>

        </div>
    </nav>
</div>
<!-- Navbar End -->