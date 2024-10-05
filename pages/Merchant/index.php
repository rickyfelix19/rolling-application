<?php
// Include the functions file
include('function/function.php');
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username= $_POST['storename'];
    $password = $_POST['password'];

    // Validate inputs
    if (!empty($username) && !empty($password)) {
        // Check the merchant's credentials
        $query = "SELECT * FROM merchants WHERE store_name='$username' AND merchant_password='$password'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            // Successful login
            echo "<script>alert('Login successful!');</script>";
            // Redirect to a merchant's dashboard or home page
            // header("Location: merchant_dashboard.php");
        } else {
            // Invalid credentials
            echo "<script>alert('Invalid Store Name or Password. Please try again.');</script>";
        }
    } else {
        // Missing data
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>
