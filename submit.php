<?php
include 'db.php'; // database connection

// PHPMailer Import
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Collect form data
$registration_number      = $_POST['registration_number'];
$student_name             = $_POST['student_name'];
$student_id               = $_POST['student_id'];
$department               = $_POST['department'];
$email                    = $_POST['email'];
$hall_clearance_number    = $_POST['hall_clearance_number'];
$medical_clearance_number = $_POST['medical_clearance_number'];
$finance_clearance        = $_POST['finance_clearance'];
$document_type            = $_POST['document_type'];

// Handle file uploads
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$admit_card = '';
$photo = '';
$signature = '';

// Make file names unique using time()
if (!empty($_FILES['admit_card']['name'])) {
    $admit_card = time().'_'.basename($_FILES['admit_card']['name']);
    move_uploaded_file($_FILES['admit_card']['tmp_name'], $uploadDir.$admit_card);
}
if (!empty($_FILES['photo']['name'])) {
    $photo = time().'_'.basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir.$photo);
}
if (!empty($_FILES['signature']['name'])) {
    $signature = time().'_'.basename($_FILES['signature']['name']);
    move_uploaded_file($_FILES['signature']['tmp_name'], $uploadDir.$signature);
}

// Insert query with mysqli_real_escape_string for security
$registration_number = $conn->real_escape_string($registration_number);
$student_name        = $conn->real_escape_string($student_name);
$student_id          = $conn->real_escape_string($student_id);
$department          = $conn->real_escape_string($department);
$email               = $conn->real_escape_string($email);
$hall_clearance_number = $conn->real_escape_string($hall_clearance_number);
$medical_clearance_number = $conn->real_escape_string($medical_clearance_number);
$finance_clearance   = $conn->real_escape_string($finance_clearance);
$document_type       = $conn->real_escape_string($document_type);
$admit_card          = $conn->real_escape_string($admit_card);
$photo               = $conn->real_escape_string($photo);
$signature           = $conn->real_escape_string($signature);

$sql = "INSERT INTO students 
(registration_number, student_name, student_id, department, email, hall_clearance_number, medical_clearance_number, finance_clearance, document_type, admit_card, photo, signature) 
VALUES 
('$registration_number','$student_name','$student_id','$department','$email','$hall_clearance_number','$medical_clearance_number','$finance_clearance','$document_type','$admit_card','$photo','$signature')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ Application submitted successfully!</h2>";
    echo "<a href='index.php'>Go back</a>";

    // ===== PHPMailer =====
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'younushsheikh1513@gmail.com';   // Gmail
        $mail->Password   = 'fgcw lvgn kwfl zaph';           // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('younushsheikh1513@gmail.com', 'CertiSite');
        $mail->addAddress($email, $student_name);

        $mail->isHTML(true);
        $mail->Subject = 'Application Confirmation';
        $mail->Body    = "প্রিয় $student_name,<br><br>certificate/transcript এর জন্য তোমার application সফলভাবে জমা হয়েছে।<br>পরবর্তী ৭ দিনের মধ্যে তুমি certificate/email পেয়ে যাবে।<br><br>ধন্যবাদ।";

        $mail->send();
        echo "<p>📧 Confirmation email sent successfully!</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ Email could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
    }

} else {
    echo "❌ Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
