<?php
// Include the function.php for database interaction functions
include ('db.php');
include('function/function.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $fullname = $_POST['fullname'];
        $mobile = $_POST['phonenumber'];
        $pin = $_POST['pinnumber'];

        // Assuming you want to change the customer's PIN and add a new customer
        addNewCustomer($fullname, $mobile, $pin);
        
        echo "User settings updated successfully.";
    }
}

// Include the HTML file
include 'customerSettings.html';
?>
