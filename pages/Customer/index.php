<?php
// Include the function.php for database interaction functions
include('function/function.php');
include ('db.php') ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mobile = $_POST['phonenumber'];
    $pin = $_POST['pinnumber'];

    if (isset($_POST['submit'])) {
        // Handle login logic here
        // Example: check credentials in the database and start a session
        echo "Login functionality to be implemented.";
    } elseif (isset($_POST['register'])) {
        // Redirect to the registration page or handle registration logic
        header('Location: customerRegister.php');
        exit();
    }
}

// Include the HTML file
include 'index.html';
?>
