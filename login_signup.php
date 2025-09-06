<?php
// Secure session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (session_status() === PHP_SESSION_NONE) session_start();

include 'db.php';

$message = "";

// ================== SIGN UP ==================
if(isset($_POST['signup'])){
    $registration_number = $conn->real_escape_string($_POST['registration_number']);
    $name = htmlspecialchars($conn->real_escape_string($_POST['name']));
    $department = htmlspecialchars($conn->real_escape_string($_POST['department']));
    $email = $conn->real_escape_string($_POST['email']);
    $session_field = $conn->real_escape_string($_POST['session']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password){
        $message = "❌ Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (registration_number, name, department, email, session, password, role) VALUES (?, ?, ?, ?, ?, ?, 'student')");
        $stmt->bind_param("ssssss", $registration_number, $name, $department, $email, $session_field, $hashed_password);

        if($stmt->execute()){
            $message = "✅ Account created successfully! You can now login.";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// ================== LOGIN ==================
if(isset($_POST['login'])){
    $registration_number = $conn->real_escape_string($_POST['login_registration_number']);
    $password = $_POST['login_password'];

    $stmt = $conn->prepare("SELECT registration_number, password, role FROM users WHERE registration_number=?");
    $stmt->bind_param("s", $registration_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            $_SESSION['user'] = $row['registration_number'];
            $_SESSION['role'] = $row['role'];

            if($row['role'] === 'admin'){
                header("Location: admin.php");
            } else {
                header("Location: home.php");
            }
            exit();
        } else {
            $message = "❌ Invalid password!";
        }
    } else {
        $message = "❌ Account not found!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login / Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: powderblue; font-family: Arial,sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; }
.card { padding:30px; border-radius:15px; background:white; width:450px; text-align:center; box-shadow:0px 4px 10px rgba(0,0,0,0.3); }
.btn-custom { background:green; color:white; font-weight:bold; width:100%; margin-bottom:10px; }
.btn-custom:hover { background:darkgreen; }
.form-switch { cursor:pointer; color:blue; margin-top:5px; }
.text-red { color:red; }
</style>
<script>
function showSignup(){ document.getElementById('loginForm').style.display='none'; document.getElementById('signupForm').style.display='block'; }
function showLogin(){ document.getElementById('signupForm').style.display='none'; document.getElementById('loginForm').style.display='block'; }
</script>
</head>
<body>
<div class="card">
<h3>University Portal</h3>
<?php if($message!=""){ echo "<p class='text-red'>$message</p>"; } ?>

<!-- Login Form -->
<form id="loginForm" method="POST" style="display:block; text-align:left;">
<label>Registration Number</label>
<input type="text" name="login_registration_number" class="form-control" required>
<label>Password</label>
<input type="password" name="login_password" class="form-control" required>
<button type="submit" name="login" class="btn btn-custom">Login</button>
<div class="form-switch" onclick="showSignup()">Don't have an account? Sign Up</div>
</form>

<!-- Sign Up Form -->
<form id="signupForm" method="POST" style="display:none; text-align:left;">
<label>Registration Number</label>
<input type="text" name="registration_number" class="form-control" required>
<label>Name</label>
<input type="text" name="name" class="form-control" required>
<label>Department</label>
<input type="text" name="department" class="form-control" required>
<label>Email</label>
<input type="email" name="email" class="form-control" required>
<label>Session</label>
<input type="text" name="session" class="form-control" required>
<label>Password</label>
<input type="password" name="password" class="form-control" required>
<label>Confirm Password</label>
<input type="password" name="confirm_password" class="form-control" required>
<button type="submit" name="signup" class="btn btn-custom">Sign Up</button>
<div class="form-switch" onclick="showLogin()">Already have an account? Login</div>
</form>
</div>
</body>
</html>









