<?php
session_start();
// Database Connection
include ('includes/config.php');
//Validating Session
if (strlen($_SESSION['adminID']) == 0) {
    header('location:index.php');
} else {
    // Code for Add New Admin

    if (isset($_POST['submit'])) {
        $userName = $_POST['userName'];
        $paymentMethod = $_POST['paymentMethod'];
        $amount = $_POST['amount'];
        $validFrom = $_POST['validFrom'];
        $validTo = $_POST['validTo'];



        $queryUserID = mysqli_query($con, "SELECT userID FROM user WHERE userName = '$userName'");

        // Check if query executed successfully
        if ($queryUserID) {
            // Fetch the result row
            $row = mysqli_fetch_assoc($queryUserID);

            // Check if a row was found
            if ($row) {
                // Retrieve the schoolID
                $userID = $row['userID'];
            }
        }



        $query = mysqli_query($con, "INSERT INTO payment(userID, amount, paymentMethod, validFrom, validTo) VALUES ('$userID', '$amount', '$paymentMethod', '$validFrom', '$validTo')");
        if ($query) {
            echo "<script>alert('Payment details added successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'paymentAdd.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
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




        <!--script>
      function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
          url: "userAvailability.php",
          data: 'email=' + $("#email").val(),
          type: "POST",
          success: function (data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
          },
          error: function () { }
        });
      }
    </script-->






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
                                <h1>Add Payment</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Add Payment</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-8">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Fill the Info</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form name="user" method="post">
                                        <div class="card-body">
                                            <!-- Username-->

                                            <!-- user Full Name--->


                                        <div class="form-group">
                                            <label for="text">Parent Name</label>
                                            <select class="form-control" id="userName" name="userName">
                                                <?php
                                                $queryUserName = mysqli_query($con, "SELECT u.* FROM user u");
                                                while ($rowSchool = mysqli_fetch_array($queryUserName)) {
                                                    echo "<option value='" . $rowSchool['userName'] . "'>" . $rowSchool['userName'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="text">Payment Method</label>
                                            <select class="form-control" id="paymentMethod" name="paymentMethod">
                                                <option value='Cash' selected>Cash</option>"
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="text">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount"
                                                placeholder="Enter Amount" required>
                                        </div>

                                        <!-- Sub admin Email---->
                                            <div class="form-group">
                                                <label for="text">Valid from</label>
                                                <input type="date" class="form-control" id="validFrom" name="validFrom"
                                                    placeholder="Enter Valid From Date" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="text">Valid to</label>
                                                <input type="date" class="form-control" id="validTo" name="validTo"
                                                    placeholder="Enter Valid To Date" required>
                                            </div>








                                            <!---Password--->



                                    </div>
                                    <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="submit"
                                                id="submit">Submit</button>
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
<?php } ?>