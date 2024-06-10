<?php session_start();
// Database Connection
include ('includes/config.php');
//Validating Session
if (strlen($_SESSION['adminID']) == 0) {
    header('location:index.php');
} else {
    // Code for Update  driver Details
    if (isset($_POST['update'])) {



        $paymentMethod = $_POST['paymentMethod'];
        $amount = $_POST['amount'];
        $validFrom = $_POST['validFrom'];
        $validTo = $_POST['validTo'];

        $paymentID = intval($_GET['said']);

        $query = mysqli_query($con, "update payment set amount='$amount', paymentMethod='$paymentMethod', validFrom = '$validFrom', validTo = '$validTo' where paymentID = '$paymentID'");
        if ($query) {
            echo "<script>alert('Payment details edited successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'paymentManage.php'; </script>";
        } else {
            echo "<script>alert('Something went wron. Please try again.');</script>";
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
                            <h1>Edit Payment Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Payment Details</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
                $said = intval($_GET['said']);
                $query = mysqli_query($con, "SELECT p.*, (SELECT userName FROM user WHERE userID = p.userID) AS userName, (SELECT childName FROM child WHERE userID = (SELECT userID FROM user WHERE userID = p.userID)) AS childName FROM payment p WHERE paymentID = '$said'");
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
                                            <label for="exampleInputFullname">Parent Name</label>
                                            <input type="text" class="form-control" id="parentName" name="parentName"
                                                placeholder="Enter Parent Name"
                                                value="<?php echo $result['userName']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="text">Payment Method</label>
                                            <select class="form-control" id="paymentMethod" name="paymentMethod">
                                                <option value='Cash' selected>Cash</option>"
                                            </select>
                                        </div>
                                        <!-- Sub user Email---->
                                        <div class="form-group">
                                            <label for="text">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount"
                                                placeholder="Enter Amount" value="<?php echo $result['amount']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="text">Valid from</label>
                                            <input type="date" class="form-control" id="validFrom" name="validFrom"
                                                placeholder="Enter Valid From Date"
                                                value="<?php echo $result['validFrom']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="text">Valid to</label>
                                            <input type="date" class="form-control" id="validTo" name="validTo"
                                                placeholder="Enter Valid To Date"
                                                value="<?php echo $result['validTo']; ?>">
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
    $(function() {
        bsCustomFileInput.init();
    });
    </script>
</body>

</html>
<?php }
} ?>