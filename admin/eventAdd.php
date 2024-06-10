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
        $eventName = $_POST['eventName'];
        $eventDesc = $_POST['eventDesc'];
        $eventStart = $_POST['eventStart'];
        $eventEnd = $_POST['eventEnd'];
        $eventNeed = $_POST['eventNeed'];
        $orgName = $_POST['orgName'];



        $queryOrgID = mysqli_query($con, "SELECT orgID FROM organization WHERE orgName = '$orgName'");

        // Check if query executed successfully
        if ($queryOrgID) {
            // Fetch the result row
            $row = mysqli_fetch_assoc($queryOrgID);

            // Check if a row was found
            if ($row) {
                // Retrieve the schoolID
                $orgID = $row['orgID'];
            }
        }


        $query = mysqli_query($con, "INSERT INTO event(eventName, eventDesc, eventStart, eventEnd, eventNeed, orgID) VALUES ('$eventName', '$eventDesc', '$eventStart', '$eventEnd', '$eventNeed', '$orgID')");
        if ($query) {
            echo "<script>alert('Event details added successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'eventManage.php'; </script>";
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
                                <h1>Add Event</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Add Event</li>
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
                                            <label for="text">Organization Name</label>
                                            <select class="form-control" id="orgName" name="orgName">
                                                <?php
                                                $queryOrg = mysqli_query($con, "SELECT * FROM organization");
                                                while ($rowOrg = mysqli_fetch_array($queryOrg)) {
                                                    if ($rowOrg['orgName'] == $result['orgName']) {
                                                        echo "<option value='" . $rowOrg['orgName'] . "'>" . $rowOrg['orgName'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $rowOrg['orgName'] . "'>" . $rowOrg['orgName'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputFullname">Event Name</label>
                                            <input type="text" class="form-control" id="eventName" name="eventName"
                                                placeholder="Enter Event Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tet">Event Description</label>
                                            <input type="text" class="form-control" id="eventDesc" name="eventDesc"
                                                placeholder="Enter Event Description" required>
                                        </div>
                                        <!-- Sub admin Email---->
                                            <div class="form-group">
                                                <label for="eventStart">Start Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="eventStart"
                                                    name="eventStart" placeholder="Enter Event Start Date & Time" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="eventStart">End Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="eventEnd"
                                                    name="eventEnd" placeholder="Enter Event End Date & Time" required>
                                            </div>


                                            <div class="form-group">
                                                <label for="text">Required # of Volunteers</label>
                                                <input type="number" class="form-control" id="eventNeed" name="eventNeed"
                                                    placeholder="Enter Required # of Volunteers" required>
                                            </div>

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