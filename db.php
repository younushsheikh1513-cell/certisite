<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "certisite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Set charset tso utf8mb4 for security
$conn->set_charset("utf8mb4");

// ❌ REMOVE session_start() and ini_set() from here
?>

