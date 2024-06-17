<?php session_start();
// Database Connection
include ('includes/config.php');
//Validating Session
if (strlen($_SESSION['adminID']) == 0) {
    header('location:index.php');
} else {
    // Code for Update  driver Details
    if (isset($_POST['update'])) {



        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $nic = $_POST['nic'];
        $mobilenumber = $_POST['mobilenumber'];


        $userID = intval($_GET['said']);

        $query = mysqli_query($con, "update user set userName='$fullname', userEmail='$email', userAddress = '$address', userNIC = '$nic', userContact = '$mobilenumber' where userID = '$userID'");
        if ($query) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'User details edited Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location = 'userManage.php';
                        });
                    });
                </script>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong. Please try again.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                </script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <title>Volunteering | Volunteer Management System</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!--Function Email Availabilty---->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <?php include_once ("includes/navbar.php"); ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php include_once ("includes/sidebar.php"); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Edit User Details</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Edit User Details</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <?php
                $said = intval($_GET['said']);
                $query = mysqli_query($con, "select * from user where userID = '$said'");
                $cnt = 1;
                while ($result = mysqli_fetch_array($query)) {
                    ?>
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-8">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Update the Info</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form name="user" method="post">
                                            <div class="card-body">
                                                <!-- Username-->

                                                <div class="form-group">
                                                    <label for="exampleInputFullname">Full Name</label>
                                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                                        placeholder="Enter User Full Name"
                                                        value="<?php echo $result['userName']; ?>">
                                                </div>
                                                <!-- Sub user Email---->
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email Address</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Enter Email Address"
                                                        value="<?php echo $result['userEmail']; ?>" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        placeholder="Enter Address"
                                                        value="<?php echo $result['userAddress']; ?>">
                                                </div>


                                                <div class="form-group">
                                                    <label for="text">NIC Number</label>
                                                    <input type="text" class="form-control" id="nic" name="nic"
                                                        placeholder="Enter NIC Number" pattern="[0-9]{9}|[0-9]{12}"
                                                        title="9 digits without (X or V) OR 12 digits"
                                                        value="<?php echo $result['userNIC']; ?>">
                                                </div>

                                                <!-- Sub user Contact Number---->
                                                <div class="form-group">
                                                    <label for="text">Mobile Number</label>
                                                    <input type="text" class="form-control" id="mobilenumber"
                                                        name="mobilenumber" placeholder="Enter email" pattern="[0-9]{10}"
                                                        title="10 numeric characters only"
                                                        value="<?php echo $result['userContact']; ?>">
                                                </div>






                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary" name="update"
                                                    id="update">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card -->



                                </div>
                                <!--/.col (left) -->

                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
                <?php include_once ('includes/footer.php'); ?>

            </div>
            <!-- ./wrapper -->

            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- bs-custom-file-input -->
            <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="dist/js/demo.js"></script>
            <!-- Page specific script -->
            <script>
                $(function () {
                    bsCustomFileInput.init();
                });
            </script>
        </body>

        </html>
    <?php }
} ?>