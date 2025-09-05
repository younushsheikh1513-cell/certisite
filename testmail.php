<?php
$to = "receiver@example.com";
$subject = "XAMPP Mail Test";
$message = "Hello, this is a test mail from XAMPP using Gmail SMTP!";
$headers = "From: younushsheikh1513@gmail.com";

if(mail($to, $subject, $message, $headers)){
    echo "✅ Mail sent successfully!";
} else {
    echo "❌ Mail sending failed!";
}
?>
