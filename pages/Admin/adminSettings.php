<?php
include('function/function.php');
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['fullname'];
	$role = $_POST['adminlogin'];
	$password = $_POST['password'];

	// Update admin details in the database
	$sql = "UPDATE admin SET fullname = ?, password = ? WHERE adminlogin = ?";
	if ($stmt = mysqli_prepare($db, $sql)) {
		// Hash the password before storing
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		// Bind parameters
		mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $role);

		// Execute the statement
		if (mysqli_stmt_execute($stmt)) {
			echo "User settings updated successfully.";
		} else {
			echo "Error updating settings: " . mysqli_stmt_error($stmt);
		}

		// Close the statement
		mysqli_stmt_close($stmt);
	} else {
		echo "Error preparing the statement: " . mysqli_error($db);
	}

	// Close the connection
	mysqli_close($db);
}
?>
