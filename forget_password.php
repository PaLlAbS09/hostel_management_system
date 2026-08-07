<?php
session_start();
include 'config/dbcon.php'; // Ensure this points to your database connection file

$error = '';
$success = '';
$step = 1;

// Handle Form Submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // STEP 1: Verify Email exists in the database
    if (isset($_POST['verify_email'])) {
        $email = trim($_POST['email']);
        
        // Check if email exists in the users table
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['reset_email'] = $email; // Store email temporarily in session
            $step = 2; // Move to password reset form
        } else {
            $error = "No account found with that email address.";
        }
    }
    
    // STEP 2: Update the Password
    if (isset($_POST['update_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_SESSION['reset_email'];
        
        if (empty($new_password) || empty($confirm_password)) {
            $error = "Please fill in all fields.";
            $step = 2;
        } elseif ($new_password !== $confirm_password) {
            $error = "Passwords do not match!";
            $step = 2;
        } else {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->execute([$hashed_password, $email]);
            
            $success = "Password reset successfully! You can now log in.";
            unset($_SESSION['reset_email']); 
            $step = 1;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Hostel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f4f6f9; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-card { 
            width: 100%; 
            max-width: 420px; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.08); 
            background: #fff; 
            text-align: center; 
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3 class="mb-4">Reset Password</h3>
        
       
        <?php if($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
            <a href="login.php" class="btn btn-primary w-100 mt-3">Go to Login</a>
        <?php endif; ?>

        
        <?php if(!$success && $step == 1): ?>
            <p class="text-muted mb-4">Enter your email address to verify your account.</p>
            <form method="POST">
                <div class="form-group mb-3 text-start">
                    <label class="form-label fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@example.com">
                </div>
                <button type="submit" name="verify_email" class="btn btn-dark w-100 mb-3 py-2">Verify Email</button>
                <a href="login.php" class="text-decoration-none text-danger" style="font-size: 14px;">Cancel & Return to Login</a>
            </form>
        <?php endif; ?>

        
        <?php if(!$success && $step == 2): ?>
            <p class="text-muted mb-4">Create a new password for <br><strong><?= htmlspecialchars($_SESSION['reset_email']) ?></strong></p>
            <form method="POST">
                <div class="form-group mb-3 text-start">
                    <label class="form-label fw-bold">New Password</label>
                    <input type="password" name="new_password" class="form-control" required placeholder="Enter new password">
                </div>
                <div class="form-group mb-4 text-start">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm new password">
                </div>
                <button type="submit" name="update_password" class="btn btn-success w-100 py-2">Update Password</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>