<?php
include('function.php'); // Assuming you have a function.php file for database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['merchant'])) {
        $merchantName = $_POST['merchant'];
        // Handle merchant selection logic here
        echo "Selected Merchant: " . $merchantName;
    }

    if (isset($_POST['reset_pin'])) {
        $customerName = $_POST['reset_pin'];
        // Handle PIN reset logic here
        echo "Resetting PIN for: " . $customerName;
    }
}
?>
