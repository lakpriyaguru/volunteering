<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once ('includes/header.php'); ?>

<body>
    <?php include_once ('includes/spinner.php'); ?>

    <?php include_once ('includes/navbar.php'); ?>



    <?php include_once ('includes/carousel.php'); ?>
    <?php include_once ('includes/about.php'); ?>


    <?php include_once ('includes/testimonial.php'); ?>
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