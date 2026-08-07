<?php 
session_start(); 
if (isset($_SESSION['student_id'])) { 
    header("Location: student_dashboard/index.php"); 
    exit(); 
}
?>
<!DOCTYPE html> 
<html dir="ltr"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hostel Management System - Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html { height: 100%; margin: 0; background-color: #f4f6f9; }
        .auth-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            padding: 20px 0;
        }
        .student-auth-box {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            background: #ffffff;
            max-width: 500px;
            width: 100%;
            padding: 40px;
            margin: 0 auto;
        }
    </style>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
</head> 
<body>
    <div class="auth-wrapper d-flex justify-content-center align-items-center">
        <div class="student-auth-box">
            <div class="text-center mb-4">
                <img src="assets/images/logo-icon-nav.png" alt="logo" width="70">
                <h2 class="mt-3 text-primary fw-bold">Student Registration</h2>
            </div>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <form id="studentRegisterForm" action="./Authentication/student_registration_process.php" method="POST">
                <div class="form-group mb-3">
                    <label class="text-dark fw-bold">Full Name <span class="text-danger">*</span></label>
                    <input class="form-control" name="name" id="name" type="text" placeholder="Enter your full name" required>
                </div>
                
                <div class="form-group mb-3">
                    <label class="text-dark fw-bold">Email <span class="text-danger">*</span></label>
                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group mb-3">
                    <label class="text-dark fw-bold">Phone Number <span class="text-danger">*</span></label>
                    <input class="form-control" name="phone" id="phone" type="text" placeholder="Enter your phone number" required pattern="[0-9]+">
                </div>

                <div class="form-group mb-3">
                    <label class="text-dark fw-bold">Password <span class="text-danger">*</span></label>
                    <input class="form-control" name="password" id="password" type="password" placeholder="Create a password" required minlength="6">
                </div>
                
                <div class="form-group mb-4">
                    <label class="text-dark fw-bold">Confirm Password <span class="text-danger">*</span></label>
                    <input class="form-control" name="confirm_password" id="confirm_password" type="password" placeholder="Confirm your password" required minlength="6">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2 fs-5">REGISTER</button>
                
                <div class="text-center mt-4 pt-3 border-top">
                    <span class="text-muted">Already have an account?</span> 
                    <a href="student_login.php" class="text-primary fw-bold text-decoration-none">Login here</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentRegisterForm').on('submit', function(e) {
                let password = $('#password').val();
                let confirmPassword = $('#confirm_password').val();
                
                if (password.length < 6) {
                    alert('Password must be at least 6 characters long.');
                    e.preventDefault();
                    return false;
                }
                if (password !== confirmPassword) {
                    alert('Passwords do not match. Please try again.');
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body> 
</html>