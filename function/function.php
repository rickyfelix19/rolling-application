<?php
// Establishing the connection
$db = mysqli_connect("localhost", "root", "", "cafetaria");

// Function for getting the IP address
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   
        // Check IP from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   
        // To check IP is passed from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Function to change customer's PIN
function changeCustomerPin($customer_id, $new_pin) {
    global $db;
    $query = "UPDATE customers SET pin_number = '$new_pin' WHERE customer_id = '$customer_id'";
    mysqli_query($db, $query);
}

// Function to add a new customer
function addCustomer($name, $phone, $pin) {
    global $db;
    $query = "INSERT INTO customers (customer_name, customer_phone, pin_number) VALUES ('$name', '$phone', '$pin')";
    mysqli_query($db, $query);
}

// Function to change merchant's password
function changeMerchantPassword($merchant_id, $new_password) {
    global $db;
    $query = "UPDATE merchants SET password = '$new_password' WHERE merchant_id = '$merchant_id'";
    mysqli_query($db, $query);
}

// Function to add a new merchant
function addMerchant($name, $phone, $password) {
    global $db;
    $query = "INSERT INTO merchants (merchant_name, merchant_phone, password) VALUES ('$name', '$phone', '$password')";
    mysqli_query($db, $query);
}

// Function to change admin password
function changeAdminPassword($admin_id, $new_password) {
    global $db;
    $query = "UPDATE admin SET password = '$new_password' WHERE admin_id = '$admin_id'";
    mysqli_query($db, $query);
}

// Function to add a new admin
function addAdmin($name, $email, $password) {
    global $db;
    $query = "INSERT INTO admin (admin_name, admin_email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($db, $query);
}



// Function to add a stamp to a customer
function addStamp($customer_id, $merchant_id, $stamp_count = 1) {
    global $db;
    $date_earned = date('Y-m-d H:i:s');
    $query = "INSERT INTO stamp (customer_id, merchant_id, date_earned, stamp_count) 
              VALUES ('$customer_id', '$merchant_id', '$date_earned', '$stamp_count')";
    mysqli_query($db, $query);
}

// Function to update the number of stamps (e.g., if stamps are cumulative)
function updateStamp($stamp_id, $new_stamp_count) {
    global $db;
    $query = "UPDATE stamp SET stamp_count = '$new_stamp_count' WHERE stamp_id = '$stamp_id'";
    mysqli_query($db, $query);
}

// Function to get the total number of stamps a customer has with a particular merchant
function getTotalStamps($customer_id, $merchant_id) {
    global $db;
    $query = "SELECT SUM(stamp_count) as total_stamps FROM stamp 
              WHERE customer_id = '$customer_id' AND merchant_id = '$merchant_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_stamps'];
}

// Function to get all stamp records for a customer with a specific merchant
function getStampsByCustomerAndMerchant($customer_id, $merchant_id) {
    global $db;
    $query = "SELECT * FROM stamp WHERE customer_id = '$customer_id' AND merchant_id = '$merchant_id'";
    $result = mysqli_query($db, $query);
    $stamps = [];
    while($row = mysqli_fetch_assoc($result)) {
        $stamps[] = $row;
    }
    return $stamps;
}

// Function to get all stamps for a specific customer
function getAllStampsByCustomer($customer_id) {
    global $db;
    $query = "SELECT * FROM stamp WHERE customer_id = '$customer_id'";
    $result = mysqli_query($db, $query);
    $stamps = [];
    while($row = mysqli_fetch_assoc($result)) {
        $stamps[] = $row;
    }
    return $stamps;
}

// Additional functions like getMerchantStamps or getStampDetails can be added similarly...
?>




// Other functions (getPro, getCatPro, getBrandPro, getBrands, getCats) remain the same...
