<?php
include 'db.php'; 
$message = "";

if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $message = "❌ Passwords do not match!";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            $message = "✅ Password updated successfully! You can now login.";
        } else {
            $message = "❌ Error updating password: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: powderblue;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
    }
    .card {
      width: 420px;
      padding: 25px;
      background: white;
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
      text-align: center;
    }
    .btn-custom {
      background: green;
      color: white;
      width: 100%;
      font-weight: bold;
    }
    .btn-custom:hover {
      background: darkgreen;
    }
    .back-link {
      margin-top: 15px;
      display: block;
      text-decoration: none;
      color: blue;
    }
    .back-link:hover {
      text-decoration: underline;
    }
    .text-red { color: red; }
  </style>
</head>
<body>
  <div class="card">
    <h3 class="mb-3">Reset Password</h3>
    <?php if($message!=""){ echo "<p class='text-red'>$message</p>"; } ?>
    <form method="POST" style="text-align:left;">
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>New Password</label>
        <input type="password" name="new_password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" required>
      </div>
      <button type="submit" name="reset" class="btn btn-custom">Reset Password</button>
    </form>
    <!-- 🔙 Back to Login -->
    <a href="login_signup.php" class="back-link">🔙 Back to Login</a>
  </div>
</body>
</html>

