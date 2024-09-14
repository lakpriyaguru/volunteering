<?php session_start();
error_reporting(0);
// Database Connection
include ('includes/config.php');
//Validating Session
if (strlen($_SESSION['adminID']) == 0) {
    header('location:index.php');
} else {
    //Code For Deletion the child
    if ($_GET['action'] == 'delete') {
        $eventID = intval($_GET['said']);
        $query = mysqli_query($con, "delete from event where eventID = '$eventID'");
        if ($query) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Deleted Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location = 'eventManage.php';
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
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once ("includes/navbar.php"); ?>
        <!-- /.navbar -->

        <?php include_once ("includes/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manage Events</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Manage Event</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Event Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Organization Name</th>
                                                    <th>Event Name</th>
                                                    <th>Description</th>
                                                    <th>Start Date & Time</th>
                                                    <th>End Date & Time</th>
                                                    <th># of Volunteers Required</th>
                                                    <th># of Volunteers Registered</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query = mysqli_query($con, "SELECT e.*, (SELECT orgName FROM organization o WHERE e.orgID = o.orgID) AS orgName FROM event e WHERE e.eventApproval != 'Pending';");
                                                    $cnt = 1;
                                                    while ($result = mysqli_fetch_array($query)) {
                                                        ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $cnt; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['orgName'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['eventName'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['eventDesc'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['eventStart'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['eventEnd'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['eventNeed'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['eventConfirm'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['eventApproval']?>
                                                    </td>
                                                    <th>
                                                        <a href="eventEdit.php?said=<?php echo $result['eventID']; ?>"
                                                            title="Edit Event Details">
                                                            <button style="color:green;" title="Edit Event Details"><i
                                                                    class="fas fa-pencil-alt"
                                                                    aria-hidden="true"></i></button>
                                                        </a>
                                                        <button
                                                            onclick="deleteEvent('<?php echo $result['eventID']; ?>')"
                                                            style="color:red;" title="Delete this Event"><i
                                                                class="fas fa-trash-alt"
                                                                aria-hidden="true"></i></button>
                                                    </th>

                                                </tr>
                                                <?php
                                                        $cnt++; // Increment the count variable in each iteration
                                                    }
                                                    ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Organization Name</th>
                                                    <th>Event Name</th>
                                                    <th>Description</th>
                                                    <th>Start Date & Time</th>
                                                    <th>End Date & Time</th>
                                                    <th># of Volunteers Required</th>
                                                    <th># of Volunteers Registered</th>
                                                    <th>Approved or Declined</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once ('includes/footer.php'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    function deleteEvent(eventID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this Event?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "eventManage.php?action=delete&said=" + eventID;
            }
        });
    }
    </script>
</body>

</html>
<?php } ?>