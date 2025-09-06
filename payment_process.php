<?php
include 'db.php'; // DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $method = $_POST['payment_method'];
    $amount = $_POST['amount'];
    $trx_id = $_POST['trx_id'];

    // Save payment info in database
    $sql = "INSERT INTO payments (payment_method, amount, trx_id, payment_date)
            VALUES ('$method', '$amount', '$trx_id', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Payment recorded successfully!";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>
