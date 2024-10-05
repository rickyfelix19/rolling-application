<?php
// Include the function.php for database interaction functions
include ('db.php');
include('function/function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $mobile = $_POST['phonenumber'];
    $pin = $_POST['pinnumber'];

    if (isset($_POST['submit'])) {
        // Add a new customer
        addNewCustomer($fullname, $mobile, $pin);
        echo "Customer registered successfully.";
    } elseif (isset($_POST['login'])) {
        // Implement login functionality here
        echo "Login functionality to be implemented.";
    }
}

// Include the HTML file
include 'customerRegister.html';
?>
