<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (session_status() === PHP_SESSION_NONE) session_start();

// Clear all session data
session_unset();
session_destroy();

// Redirect to login page
header("Location: login_signup.php");
exit();


