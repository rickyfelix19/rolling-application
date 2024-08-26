<?php
include('function/function.php');
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get form data
	$fullname = $_POST['fullname'];
	$username = $_POST['storename'];
	$password = $_POST['password'];

	// Hash the password for security
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// Assuming you have a way to identify the merchant (e.g., by session ID or a hidden input field with merchant ID)
	$merchant_id = $_SESSION['merchant_id']; // Example

	// Update merchant settings in the database
	$sql = "UPDATE merchants SET fullname = ?, storename = ?, password = ? WHERE id = ?";

	// Prepare statement
	if ($stmt = mysqli_prepare($db, $sql)) {
		// Bind variables to the prepared statement
		mysqli_stmt_bind_param($stmt, "sssi", $fullname, $username, $hashed_password, $merchant_id);

		// Attempt to execute the prepared statement
		if (mysqli_stmt_execute($stmt)) {
			echo "Settings updated successfully.";
			// Redirect to the homepage or a confirmation page
			// header("Location: merchantHomepage.html");
		} else {
			echo "Error: Could not execute the query: $sql. " . mysqli_error($db);
		}

		// Close statement
		mysqli_stmt_close($stmt);
	} else {
		echo "Error: Could not prepare the query: $sql. " . mysqli_error($db);
	}

	// Close connection
	mysqli_close($db);
}
?>
