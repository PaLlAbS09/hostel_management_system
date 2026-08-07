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
    <title>Hostel Management System - Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background-color: #f4f6f9;
        }

        .auth-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        }

        .student-auth-box {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            background: #ffffff;
            max-width: 450px;
            width: 100%;
            padding: 40px;
            margin: 0 15px;
        }
    </style>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
</head>

<body>
    <div class="auth-wrapper d-flex justify-content-center align-items-center">
        <div class="student-auth-box">
            <div class="text-center mb-4">

                <img src="assets/images/logo-icon-nav.png" alt="logo" width="70">
                <h2 class="mt-3 text-primary fw-bold">Student Login</h2>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>


            <form id="studentLoginForm" action="./Authentication/student_login_process.php" method="POST">
                <div class="form-group mb-3">
                    <label class="text-dark fw-bold" for="email">Student Email</label>
                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter your registered email" required>
                </div>

                <div class="form-group mb-4">
                    <label class="text-dark fw-bold" for="pwd">Password</label>
                    <input class="form-control" name="password" id="pwd" type="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fs-5">LOGIN</button>

                <div class="text-center mt-3">
                    <a href="student_forget_password.php" class="text-danger text-decoration-none">Forgot password?</a>
                </div>

                <div class="text-center mt-4 pt-3 border-top">
                    <span class="text-muted">New student?</span>
                    <a href="student_registration.php" class="text-primary fw-bold text-decoration-none">Register here</a>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentLoginForm').on('submit', function(e) {
                let email = $('#email').val().trim();
                let password = $('#pwd').val().trim();
                let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

                if (email === '' || password === '') {
                    alert('Both Email and Password are required.');
                    e.preventDefault();
                    return false;
                }
                if (!emailPattern.test(email)) {
                    alert('Please enter a valid email address.');
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body>

</html>