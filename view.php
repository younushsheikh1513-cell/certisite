<?php
include 'db.php'; // database connection

// Fetch all records
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applications - Jatiya Kabi Kazi Nazrul Islam University</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f6f9; }
        h2 { text-align: center; color: #333; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; background: white; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #2c3e50; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        a { color: blue; text-decoration: none; }
    </style>
</head>
<body>
    <h2>📑 Student Applications</h2>

    <table>
        <tr>
            <th>Reg. No</th>
            <th>Name</th>
            <th>Student ID</th>
            <th>Department</th>
            <th>Email</th>
            <th>Hall Clearance</th>
            <th>Medical Clearance</th>
            <th>Finance Clearance</th>
            <th>Document Type</th>
            <th>Admit Card</th>
            <th>Photo</th>
            <th>Signature</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['registration_number']."</td>
                    <td>".$row['student_name']."</td>
                    <td>".$row['student_id']."</td>
                    <td>".$row['department']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['hall_clearance_number']."</td>
                    <td>".$row['medical_clearance_number']."</td>
                    <td>".$row['finance_clearance']."</td>
                    <td>".$row['document_type']."</td>
                    <td><a href='uploads/".$row['admit_card']."' target='_blank'>View</a></td>
                    <td><a href='uploads/".$row['photo']."' target='_blank'>View</a></td>
                    <td><a href='uploads/".$row['signature']."' target='_blank'>View</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No applications found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
