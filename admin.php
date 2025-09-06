<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (session_status() === PHP_SESSION_NONE) session_start();

include 'db.php';

// Only admin access
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin'){
    echo "❌ Access Denied. Admins only.";
    exit();
}

// Fetch all student applications
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<style>
body { font-family: Arial,sans-serif; margin:20px; background:#f4f6f9; }
h2 { text-align:center; }
table { border-collapse:collapse; width:100%; background:white; }
th, td { border:1px solid #ccc; padding:10px; text-align:center; }
th { background:#2c3e50; color:white; }
tr:nth-child(even) { background:#f9f9f9; }
a { color:blue; text-decoration:none; }
</style>
</head>
<body>
<h2>📑 Student Applications - Admin Panel</h2>
<table>
<tr>
<th>Reg. No</th><th>Name</th><th>Student ID</th><th>Dept</th><th>Email</th><th>Hall Clearance</th><th>Medical Clearance</th><th>Finance Clearance</th><th>Doc Type</th><th>Admit Card</th><th>Photo</th><th>Signature</th>
</tr>
<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
        <td>".htmlspecialchars($row['registration_number'])."</td>
        <td>".htmlspecialchars($row['student_name'])."</td>
        <td>".htmlspecialchars($row['student_id'])."</td>
        <td>".htmlspecialchars($row['department'])."</td>
        <td>".htmlspecialchars($row['email'])."</td>
        <td>".htmlspecialchars($row['hall_clearance_number'])."</td>
        <td>".htmlspecialchars($row['medical_clearance_number'])."</td>
        <td>".htmlspecialchars($row['finance_clearance'])."</td>
        <td>".htmlspecialchars($row['document_type'])."</td>
        <td><a href='uploads/".$row['admit_card']."' target='_blank'>View</a></td>
        <td><a href='uploads/".$row['photo']."' target='_blank'>View</a></td>
        <td><a href='uploads/".$row['signature']."' target='_blank'>View</a></td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='12'>No students found.</td></tr>";
}
?>
</table>
<br>
<a href="logout.php">Logout</a>
</body>
</html>



