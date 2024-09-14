<?php session_start();
error_reporting(0);
// Database Connection
include ('includes/config.php');
//Validating Session
if (strlen($_SESSION['adminID']) == 0) {
    header('location:index.php');
} else {
    //Code For Deletion the user
    if ($_GET['action'] == 'delete') {
        $userID = intval($_GET['said']);
        $query = mysqli_query($con, "delete from user where userID = '$userID'");
        if ($query) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'User record deleted Successfully',
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
                            <h1>Manage Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Manage User</li>
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
                                        <h3 class="card-title">User Details</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Full Name</th>
                                                    <th>Email Address</th>
                                                    <th>Address</th>
                                                    <th>NIC</th>
                                                    <th>Mobile Number</th>
                                                    <th>Reg. Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query = mysqli_query($con, "select * from user");
                                                    $cnt = 1;
                                                    while ($result = mysqli_fetch_array($query)) {
                                                        ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $cnt; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['userName'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['userEmail'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['userAddress'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['userNIC'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['userContact'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $result['userRegDate'] ?>
                                                    </td>
                                                    <th>
                                                        <a href="userEdit.php?said=<?php echo $result['userID']; ?>"
                                                            title="Edit User Details">
                                                            <button style="color:green;" title="Edit User Details"><i
                                                                    class="fas fa-pencil-alt"
                                                                    aria-hidden="true"></i></button>
                                                        </a>
                                                        <button onclick="deleteUser('<?php echo $result['userID']; ?>')"
                                                            style="color:red;" title="Delete this User"><i
                                                                class="fas fa-trash-alt"
                                                                aria-hidden="true"></i></button>

                                                        <!-- <a href="userResetPwd.php?said=<?php echo $result['userID']; ?>"
                                                                    title="Reset User Password">
                                                                    <button style="color:blue;" title="Reset User Password"><i
                                                                            class="fa fa-key" aria-hidden="true"></i></button></a> -->
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
                                                    <th>Full Name</th>
                                                    <th>Email Address</th>
                                                    <th>Address</th>
                                                    <th>NIC</th>
                                                    <th>Mobile Number</th>
                                                    <th>Reg. Date</th>
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

    function deleteUser(userID) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to delete this User?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "userManage.php?action=delete&said=" + userID;
            }
        });
    }
    </script>
</body>

</html>
<?php } ?>