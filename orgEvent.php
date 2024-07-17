<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['ID'])) {
    header('Location: login.php');
    exit();
}

// Include database connection file
include_once ('includes/config.php');

// Fetch user data from the database
$ID = $_SESSION['ID'];
$role = $_SESSION['Role'];

// Fetch events for the organization
$eventsQuery = "SELECT * FROM event WHERE orgID = '$ID'";
$eventsResult = mysqli_query($con, $eventsQuery);

// Handle delete event
if (isset($_GET['delete'])) {
    $eventID = $_GET['delete'];
    $deleteQuery = "DELETE FROM event WHERE eventID = '$eventID'";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'The event has been deleted.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'orgEvent.php';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error deleting the event.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}

// Handle add event
if (isset($_POST['add_event'])) {
    $eventName = $_POST['eventName'];
    $eventDesc = $_POST['eventDesc'];
    $eventStart = $_POST['eventStart'];
    $eventEnd = $_POST['eventEnd'];
    $eventNeed = $_POST['eventNeed'];
    $eventApproval = 'Pending';

    // Handle file upload
    if (isset($_FILES['eventPhoto']) && $_FILES['eventPhoto']['error'] === UPLOAD_ERR_OK) {
        $eventPhoto = $_FILES['eventPhoto'];
        $photoName = $eventPhoto['name'];
        $photoTmpName = $eventPhoto['tmp_name'];
        $photoSize = $eventPhoto['size'];
        $photoError = $eventPhoto['error'];
        $photoType = $eventPhoto['type'];

        $photoExt = explode('.', $photoName);
        $photoActualExt = strtolower(end($photoExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($photoActualExt, $allowed)) {
            if ($photoSize < 5000000) { // 5MB limit
                $photoNewName = uniqid('', true) . "." . $photoActualExt;
                $photoDestination = 'uploads/' . $photoNewName;
                move_uploaded_file($photoTmpName, $photoDestination);

                $insertQuery = "INSERT INTO event (eventName, eventDesc, eventStart, eventEnd, eventNeed, orgID, eventApproval, eventImg) VALUES ('$eventName', '$eventDesc', '$eventStart', '$eventEnd', '$eventNeed', '$ID', '$eventApproval', '$photoNewName')";

                if (mysqli_query($con, $insertQuery)) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function(event) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'The event has been added.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location = 'orgEvent.php';
                            });
                        });
                    </script>";
                } else {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function(event) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error adding the event.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function(event) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Your file is too large.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function(event) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'You cannot upload files of this type.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error uploading your file.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}

// Handle edit event
if (isset($_POST['edit_event'])) {
    $eventID = $_POST['eventID'];
    $eventName = $_POST['eventName'];
    $eventDesc = $_POST['eventDesc'];
    $eventStart = $_POST['eventStart'];
    $eventEnd = $_POST['eventEnd'];
    $eventNeed = $_POST['eventNeed'];
    $eventApproval = 'Pending';

    $updateQuery = "UPDATE event SET eventName='$eventName', eventDesc='$eventDesc', eventStart='$eventStart', eventEnd='$eventEnd', eventNeed='$eventNeed', eventApproval='$eventApproval' WHERE eventID='$eventID'";

    if (mysqli_query($con, $updateQuery)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Updated!',
                    text: 'The event has been updated.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'orgEvent.php';
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(event) {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error updating the event.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}


// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once ('includes/header.php'); ?>

<body>
    <?php include_once ('includes/navbar.php'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Events</li>
                </ol>
            </nav>
            <h1 class="display-4 text-white animated slideInDown mb-4">Manage Events</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Events Table Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h1 class="display-6 mb-0">Your Events</h1>
                        </div>
                        <div class="card-body p-5">
                            <?php if (mysqli_num_rows($eventsResult) > 0) { ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Description</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Volunteer Count</th>
                                            <th>Approval</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($event = mysqli_fetch_assoc($eventsResult)) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($event['eventName']); ?></td>
                                                <td><?php echo htmlspecialchars($event['eventDesc']); ?></td>
                                                <td><?php echo htmlspecialchars($event['eventStart']); ?></td>
                                                <td><?php echo htmlspecialchars($event['eventEnd']); ?></td>
                                                <td><?php echo htmlspecialchars($event['eventNeed']) . ' (Confirmed: ' . htmlspecialchars($event['eventConfirm']) . ')'; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($event['eventApproval']); ?></td>
                                                <td>
                                                    <a href="orgViewEvent.php?eventID=<?php echo $event['eventID']; ?>"
                                                        class="btn btn-info btn-sm">View</a>
                                                    <a href="javascript:void(0);"
                                                        onclick="openEditModal(<?php echo $event['eventID']; ?>, '<?php echo htmlspecialchars(addslashes($event['eventName'])); ?>', '<?php echo htmlspecialchars(addslashes($event['eventDesc'])); ?>', '<?php echo htmlspecialchars($event['eventStart']); ?>', '<?php echo htmlspecialchars($event['eventEnd']); ?>', '<?php echo htmlspecialchars($event['eventNeed']); ?>')"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="javascript:void(0);"
                                                        onclick="confirmDelete(<?php echo $event['eventID']; ?>);"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </td>


                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <p class="text-center">No events found. Click the button below to add a new event.</p>
                            <?php } ?>
                            <div class="text-center mt-4">
                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addEventModal">Add New Event</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events Table End -->

    <!-- Add Event Modal Start -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="orgEvent.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="eventName" name="eventName" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDesc" class="form-label">Event Description</label>
                            <textarea class="form-control" id="eventDesc" name="eventDesc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="eventStart" class="form-label">Event Start</label>
                            <input type="datetime-local" class="form-control" id="eventStart" name="eventStart"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="eventEnd" class="form-label">Event End</label>
                            <input type="datetime-local" class="form-control" id="eventEnd" name="eventEnd" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventNeed" class="form-label">Volunteer Count Needed</label>
                            <input type="number" class="form-control" id="eventNeed" name="eventNeed" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventPhoto" class="form-label">Event Photo</label>
                            <input type="file" class="form-control" id="eventPhoto" name="eventPhoto" accept="image/*"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_event" class="btn btn-primary">Add Event</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Add Event Modal End -->

    <!-- Edit Event Modal Start -->
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="orgEvent.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editEventID" name="eventID">
                        <div class="mb-3">
                            <label for="editEventName" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="editEventName" name="eventName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEventDesc" class="form-label">Event Description</label>
                            <textarea class="form-control" id="editEventDesc" name="eventDesc" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editEventStart" class="form-label">Event Start Date</label>
                            <input type="datetime-local" class="form-control" id="editEventStart" name="eventStart"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editEventEnd" class="form-label">Event End Date</label>
                            <input type="datetime-local" class="form-control" id="editEventEnd" name="eventEnd"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editEventNeed" class="form-label">Number of Volunteers Needed</label>
                            <input type="number" class="form-control" id="editEventNeed" name="eventNeed" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="edit_event" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Event Modal End -->

    <?php include_once ('includes/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        function confirmDelete(eventID) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this event?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'orgEvent.php?delete=' + eventID;
                }
            });
        }
    </script>

    <script>
        function openEditModal(eventID, eventName, eventDesc, eventStart, eventEnd, eventNeed) {
            document.getElementById('editEventID').value = eventID;
            document.getElementById('editEventName').value = eventName;
            document.getElementById('editEventDesc').value = eventDesc;
            document.getElementById('editEventStart').value = eventStart;
            document.getElementById('editEventEnd').value = eventEnd;
            document.getElementById('editEventNeed').value = eventNeed;
            var editEventModal = new bootstrap.Modal(document.getElementById('editEventModal'));
            editEventModal.show();
        }
    </script>

    <script>
        function confirmDelete(eventID) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this event?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'orgEvent.php?delete=' + eventID;
                }
            });
        }
    </script>

</body>

</html>