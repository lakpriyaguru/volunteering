<?php
require_once ("includes/config.php");
// code   username availablity
if (!empty($_POST["email"])) {
	$email = $_POST["email"];
	$query = mysqli_query($con, "select adminEmail from admin where adminEmail = '$email'");
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		echo "<span style='color:red'> Email already exists. Try with another Email.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else {
		echo "<span style='color:green'> Email available for Registration.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}
?>