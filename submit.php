<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "college_details"; // Database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data from the POST request
$name = $_POST['name'];
$college_id = $_POST['COLLEGE_ID'];
$amount = $_POST['amount'];

// Default payment status is 'Pending' when submitted
$payment_status = 'Pending';

// Insert data into the database
$sql = "INSERT INTO submissions (name, college_id, amount, payment_status) 
        VALUES ('$name', '$college_id', '$amount', '$payment_status')";

// Check if the insertion was successful
if ($conn->query($sql) === TRUE) {
    echo "Form submitted successfully. You will be redirected to the payment options.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
