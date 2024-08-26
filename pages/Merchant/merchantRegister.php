<?php
include('function/function.php');
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get form data
	$fullname = $_POST['storename']; // Using 'storename' as per the form input name
	$password = $_POST['password'];

	// Hash the password for security
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// Insert merchant into the merchants table
	$sql = "INSERT INTO merchants (fullname, password) VALUES (?, ?)";

	// Prepare statement
	if ($stmt = mysqli_prepare($db, $sql)) {
		// Bind variables to the prepared statement
		mysqli_stmt_bind_param($stmt, "ss", $fullname, $hashed_password);

		// Attempt to execute the prepared statement
		if (mysqli_stmt_execute($stmt)) {
			echo "Registration successful.";
			// Redirect to the login page or another page as needed
			// header("Location: merchantLogin.html");
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
