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
    <div class="container-xxl py-5">
        <div class="container">
            <div class="owl-carousel event-carousel wow fadeInUp" data-wow-delay="0.1s">
                <!-- Example Event Card 1 -->
                <div class="card">
                    <img src="img/courses-1.jpg" class="card-img-top" alt="Event 1">
                    <div class="card-body">
                        <h5 class="card-title">Event 1</h5>
                        <p class="card-text">Event 1 details...</p>
                        <div class="causes-progress bg-light p-3 pt-2">
                            <div class="d-flex justify-content-between">
                                <p class="text-dark">
                                    100 <small class="text-body">Needed</small>
                                </p>
                                <p class="text-dark">
                                    90 <small class="text-body">Confirmed</small>
                                </p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <span>90%</span>
                                </div>
                            </div>
                        </div>
                        <a href="event-details.php?event_id=1" class="btn btn-primary">More Details</a>
                    </div>
                </div>
                <!-- Example Event Card 2 -->
                <div class="card">
                    <img src="img/courses-2.jpg" class="card-img-top" alt="Event 2">
                    <div class="card-body">
                        <h5 class="card-title">Event 2</h5>
                        <p class="card-text">Event 2 details...</p>
                        <div class="causes-progress bg-light p-3 pt-2">
                            <div class="d-flex justify-content-between">
                                <p class="text-dark">
                                    100 <small class="text-body">Needed</small>
                                </p>
                                <p class="text-dark">
                                    90 <small class="text-body">Confirmed</small>
                                </p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <span>90%</span>
                                </div>
                            </div>
                        </div>
                        <a href="event-details.php?event_id=2" class="btn btn-primary">More Details</a>
                    </div>
                </div>
                <!-- Example Event Card 3 -->
                <div class="card">
                    <img src="img/courses-3.jpg" class="card-img-top" alt="Event 2">
                    <div class="card-body">
                        <h5 class="card-title">Event 3</h5>
                        <p class="card-text">Event 3 details...</p>
                        <div class="causes-progress bg-light p-3 pt-2">
                            <div class="d-flex justify-content-between">
                                <p class="text-dark">
                                    100 <small class="text-body">Needed</small>
                                </p>
                                <p class="text-dark">
                                    90 <small class="text-body">Confirmed</small>
                                </p>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <span>90%</span>
                                </div>
                            </div>
                        </div>
                        <a href="event-details.php?event_id=2" class="btn btn-primary">More Details</a>
                    </div>
                </div>
                <!-- Add more event cards as needed -->
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
    <script>
    $(document).ready(function() {
        $('.event-carousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
    </script>
</body>

</html>