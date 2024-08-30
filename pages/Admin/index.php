<?php
include('db.php');
include('function/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['adminlogin'];
	$password = $_POST['password'];

	// Validate credentials
	$sql = "SELECT * FROM admin WHERE adminlogin = ?";
	if ($stmt = mysqli_prepare($db, $sql)) {
		mysqli_stmt_bind_param($stmt, "s", $adminlogin);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			// Verify password
			if (password_verify($password, $row['password'])) {
				// Start session and set session variables
				session_start();
				$_SESSION['adminlogin'] = $username;
				$_SESSION['admin_id'] = $row['id'];
				// Redirect to admin dashboard or homepage
				header("Location: adminDashboard.php");
				exit();
			} else {
				echo "Invalid password.";
			}
		} else {
			echo "No admin found with that login.";
		}
		mysqli_stmt_close($stmt);
	} else {
		echo "Error preparing the statement: " . mysqli_error($db);
	}
	mysqli_close($db);
}
?>
