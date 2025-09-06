<?php
$password = "admin123"; // choose your admin password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo $hashed_password;
?>
