<?php
include('function/function.php');
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['fullname'];
	$password = $_POST['password'];

	// Check if the admin already exists
	$sql_check = "SELECT * FROM admin WHERE fullname = ?";
	if ($stmt_check = mysqli_prepare($db, $sql_check)) {
		mysqli_stmt_bind_param($stmt_check, "s", $username);
		mysqli_stmt_execute($stmt_check);
		mysqli_stmt_store_result($stmt_check);

		if (mysqli_stmt_num_rows($stmt_check) > 0) {
			echo "Admin with this name already exists.";
		} else {
			// Insert new admin into the database
			$sql = "INSERT INTO admin (fullname, password) VALUES (?, ?)";
			if ($stmt = mysqli_prepare($db, $sql)) {
				// Hash the password before storing
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

				// Bind parameters
				mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

				// Execute the statement
				if (mysqli_stmt_execute($stmt)) {
					echo "Admin registered successfully.";
				} else {
					echo "Error: " . mysqli_stmt_error($stmt);
				}

				// Close the statement
				mysqli_stmt_close($stmt);
			} else {
				echo "Error preparing the statement: " . mysqli_error($db);
			}
		}

		// Close the check statement
		mysqli_stmt_close($stmt_check);
	}

	// Close the connection
	mysqli_close($db);
}
?>
