<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'funds_for_celestia';

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if we received the payment ID and status
if (isset($_POST['id']) && isset($_POST['status'])) {
    $payment_id = $_POST['id'];
    $payment_status = $_POST['status'];

    // Update payment status in the database
    $sql = "UPDATE payments SET payment_status = '$payment_status' WHERE id = '$payment_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Payment status updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
