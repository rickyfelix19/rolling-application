<?php
include('funtion/function.php'); // Assuming you have a function.php file for database connection
include('db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['merchant'])) {
        $merchantName = $_POST['merchant'];
        // Handle merchant selection logic here
        echo "Selected Merchant: " . $merchantName;
    }

    if (isset($_POST['reset_password'])) {
        $merchantName = $_POST['reset_password'];
        // Handle password reset logic here
        echo "Resetting password for: " . $merchantName;
    }
}
?>
