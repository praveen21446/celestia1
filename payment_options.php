<?php
// Fetch the payment ID from the URL
$payment_id = $_GET['id'];

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

// Fetch the payment data based on the payment ID
$sql = "SELECT * FROM payments WHERE id = '$payment_id'";
$result = $conn->query($sql);
$payment_data = $result->fetch_assoc();
$conn->close();

$amount = $payment_data['amount'];
$upiId = '9346163612@ptsbi'; // Predefined UPI ID
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Options</title>
</head>
<body>
    <h2>Select Payment Method for Payment ID: <?php echo $payment_id; ?></h2>
    
    <!-- Payment Options -->
    <button onclick="openPhonePe()">Pay with PhonePe</button>
    <button onclick="openGPay()">Pay with Google Pay</button>
    <button onclick="openPaytm()">Pay with Paytm</button>

    <script>
        function openPhonePe() {
            const phonePeUrl = `phonepe://upi/pay?pa=<?php echo $upiId; ?>&am=<?php echo $amount; ?>`;
            window.location.href = phonePeUrl;
            updatePaymentStatus('Successful');
        }

        function openGPay() {
            const gpayUrl = `https://pay.google.com/gp/p2p/send?pa=<?php echo $upiId; ?>&amount=<?php echo $amount; ?>`;
            window.location.href = gpayUrl;
            updatePaymentStatus('Successful');
        }

        function openPaytm() {
            const paytmUrl = `paytm://upi/payment?pa=<?php echo $upiId; ?>&am=<?php echo $amount; ?>`;
            window.location.href = paytmUrl;
            updatePaymentStatus('Successful');
        }

        function updatePaymentStatus(status) {
            // Send AJAX request to update payment status in the database
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_payment_status.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`id=<?php echo $payment_id; ?>&status=${status}`);
        }
    </script>
</body>
</html>
