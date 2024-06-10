<?php session_start();
// Database Connection
include ('includes/config.php');
//Validating Session
if (($_SESSION['adminID']) == 0) {
  header('location:index.php');
} else {
  // Code for Update  Sub Admin Details
  if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobilenumber = $_POST['mobilenumber'];
    $adminID = intval($_SESSION['adminID']);
    $query = mysqli_query($con, "update admin set adminName='$fullname', adminEmail = '$email', adminContact = '$mobilenumber' where adminID='$adminID'");
    if ($query) {
      echo "<script>alert('Profile details updated successfully.');</script>";
      echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
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
                <h1>My Profile</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">My Profile</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <?php
        $adminID = intval($_SESSION['adminID']);
        $query = mysqli_query($con, "select * from admin where adminID ='$adminID'");
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
                    <form name="subadmin" method="post">
                      <div class="card-body">
                        <!-- Username-->

                        <!-- admin Full Name--->
                    <div class="form-group">
                      <label for="exampleInputFullname">Full Name</label>
                      <input type="text" class="form-control" id="fullname" name="fullname"
                        value="<?php echo $result['adminName']; ?>" placeholder="Enter Full Name" required>
                    </div>
                    <!--  admin Email---->
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                            required value="<?php echo $result['adminEmail']; ?>" readonly>
                        </div>
                        <!--  admin Contact Number---->
                        <div class="form-group">
                          <label for="text">Mobile Number</label>
                          <input type="text" class="form-control" id="mobilenumber" name="mobilenumber"
                            placeholder="Enter email" pattern="[0-9]{10}" title="10 numeric characters only" maxlength="10"
                            required value="<?php echo $result['adminContact']; ?>">
                        </div>

                        <!--  admin Profile Reg. Date---->
                        <div class="form-group">
                          <label for="text">Registration Date</label>
                          <input type="text" class="form-control" id="regdate" name="regdate" required
                            value="<?php echo $result['adminRegDate']; ?>" readonly>
                        </div>


                      <?php } ?>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
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