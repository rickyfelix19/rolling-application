<?php

class Database {
    private $host = "localhost";
    private $db_name = "cafetaria";
    private $username = "root";
    private $password = "";
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

class Customer {
    private $conn;
    private $table_name = "customers";  // Assume you have a 'customers' table

    public $id;
    public $fullname;
    public $mobile;
    public $pin
    

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch customer by name
    public function getCustomerByName($fullname) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE full_name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $fullname);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Reset PIN for customer
    public function resetCustomerPin($fullname, $new_pin) {
        // Ensure the new PIN is exactly 6 digits
        if (strlen($new_pin) !== 6 || !ctype_digit($new_pin)) {
            return false; // Invalid PIN format
        }
    
        // Assuming you store a PIN in the database (e.g., in a 'pin_number' column)
        $query = "UPDATE " . $this->table_name . " SET pin_number = :new_pin WHERE fullname = :fullname";
        $stmt = $this->conn->prepare($query);
    
        // Bind the parameters
        $stmt->bindParam(':new_pin', $new_pin);
        $stmt->bindParam(':name', $fullname);
    
        // Execute the query and return true if successful, false otherwise
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function register() {
        // Insert query
        $query = "INSERT INTO " . $this->table_name . " (fullname, mobile, id, pin) 
                  VALUES (:fullname, :mobile,:id, :pin)";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->pin = htmlspecialchars(strip_tags($this->pin));

        // Bind values
        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':mobile', $this->mobile);
        $stmt->bindParam(':id', $this->id);
      
        $stmt->bindParam(':pin', $this->pin);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

// Usage Example

// Initialize Database
$database = new Database();
$db = $database->getConnection();

// Initialize Customer class
$customer = new Customer($db);

// Example: Resetting a customer's PIN
if (isset($_POST['reset_pin'])) {
    $customerName = $_POST['reset_pin'];
    $newPin = $customer->resetCustomerPin($customerName);
    if ($newPin !== false) {
        echo "New PIN for " . $customerName . ": " . $new_pin;
    } else {
        echo "Failed to reset PIN for " . $customerName;
    }
}


// Function to change merchant's password
class Merchant {
    // Database connection and table name
    private $conn;
    private $table_name = "merchants"; // Assuming your table name is 'merchants'

    // Merchant properties
    public $id;
    public $store_name;
    public $username;
    public $password;
    

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new merchant
    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (fullname, username, password, ) VALUES (:fullname, username, :password, )";
        
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->store_name = htmlspecialchars(strip_tags($this->fullname));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
       
        // Bind parameters
        $stmt->bindParam(':store_name', $this->fullname);
        $stmt->bindParam(':username', $this->ausername);
        $stmt->bindParam(':password', $this->password);
       

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get merchant details by ID
    public function getMerchantById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind ID parameter
        $stmt->bindParam(':id', $id);

        // Execute and fetch
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['id'];
            $this->store_name = $row['fullname'];
            $this->username = $row['username'];
            $this->password = $row['password'];
          
            return true;
        }
        return false;
    }

    // Update merchant details
    public function updateMerchant() {
        $query = "UPDATE " . $this->table_name . " SET fullname = :fullname, username = :username, password = :password WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->merchant_name = htmlspecialchars(strip_tags($this->merchant_name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind parameters
        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':id', $this->id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

 
}

// Example usage
$database = new Database();
$db = $database->getConnection();

$merchant = new Merchant($db);

// Register a new merchant
$merchant->store_name = "New Store";
$merchant->username = "admin@example.com";
$merchant->password = "securepassword";
if ($merchant->register()) {
    echo "Merchant registered successfully!";
} else {
    echo "Failed to register merchant.";
}

// Fetch merchant details
$merchantId = 1;
if ($merchant->getMerchantById($merchantId)) {
    echo "Merchant Name: " . $merchant->store_name;
}

// Update merchant details
$merchant->id = 1;
$merchant->store_name = "Updated Store";
$merchant->username = "admin_updated@example.com";
$merchant->password = "newpassword";
if ($merchant->updateMerchant()) {
    echo "Merchant updated successfully!";
}



// Function to change admin password
function changeAdminPassword($admin_id, $new_password) {
    global $db;
    $query = "UPDATE admin SET password = '$new_password' WHERE admin_id = '$admin_id'";
    mysqli_query($db, $query);
}

// Function to add a new admin
function addAdmin($fullname, $username, $password) {
    global $db;
    $query = "INSERT INTO admin (admin_fullname, admin_username, password) VALUES ('$fullname', '$username', '$password')";
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




