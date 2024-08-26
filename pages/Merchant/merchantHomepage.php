<?php
include('function/function.php');
include ('db.php');

// Assuming the form sends a POST request with a 'merchant' field
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merchants = $_POST['merchant'];

    // Fetch data related to the selected merchant
    $query = "SELECT fullname, phonenumber, stamp_number, collection_date FROM stamps WHERE merchant='$merchants'";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "<h2>Stamp Collection for $merchants</h2>";
        echo "<table border='1'>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Stamp Number</th>
                    <th>Date Collection</th>
                    <th>Reset Pin Number</th>
                </tr>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $i++ . "</td>
                    <td>" . $row['fullname'] . "</td>
                    <td>" . $row['phonenumber'] . "</td>
                    <td>" . $row['stamp_number'] . "</td>
                    <td>" . $row['collection_date'] . "</td>
                    <td><button>Reset PIN</button></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Error fetching data: " . mysqli_error($db);
    }
}
?>
