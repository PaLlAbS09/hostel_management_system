<?php  
session_start(); 
if(isset($_SESSION['user_id'])) {     
    header("Location: ./dashboard/index.php");     
    exit(); 
}
?>
<!DOCTYPE html> 
<html dir="ltr"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hostel Management System</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f4f6f9;
        }
        .main-wrapper, .auth-wrapper {
            min-height: 100vh;
        }
        .auth-wrapper {
            background-size: cover !important; 
        }
        .auth-box {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            max-width: 900px; 
            width: 100%;
            margin: 0 15px;
        }
        .modal-bg-img {
            background-size: cover;
            background-position: center center;
            min-height: 400px;
        }
    </style>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png"> 
</head>
<body>     
    <div class="main-wrapper">         
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">             
            <div class="auth-box row">                 
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/hostel-img.jpg);"></div>                 
                <div class="col-lg-5 col-md-7 bg-white">                     
                    <div class="p-3">                         
                        <div class="text-center">                             
                            <img src="assets/images/adimg.jpg" alt="wrapkit" width="60">                         
                        </div>                         
                        <h2 class="mt-3 text-center">Admin Registration</h2>                                                  
                        <?php if(isset($_SESSION['error'])): ?>                             
                            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>                         
                        <?php endif; ?>                         
                        
                        <form class="mt-4" id="registerForm" action="./Authentication/registration_process.php" method="POST">                             
                            <div class="row">                                 
                                <div class="col-lg-12">                                     
                                    <div class="form-group">                                         
                                        <label class="text-dark">Full Name <span class="text-danger">*</span></label>                                         
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name" required>                                     
                                    </div>                                 
                                </div>                                 
                                <div class="col-lg-12">                                     
                                    <div class="form-group">                                         
                                        <label class="text-dark">Email <span class="text-danger">*</span></label>                                         
                                        <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email" required>                                     
                                    </div>                                 
                                </div>                                 
                                <div class="col-lg-12">                                     
                                    <div class="form-group">                                         
                                        <label class="text-dark">Password <span class="text-danger">*</span></label>                                         
                                        <input class="form-control" name="password" id="password" type="password" placeholder="Create password" required minlength="6">                                     
                                    </div>                                 
                                </div>                                 
                                <div class="col-lg-12">                                     
                                    <div class="form-group">                                         
                                        <label class="text-dark">Confirm Password <span class="text-danger">*</span></label>                                         
                                        <input class="form-control" name="confirm_password" id="confirm_password" type="password" placeholder="Confirm password" required minlength="6">                                     
                                    </div>                                 
                                </div>                                 
                                <div class="col-lg-12 text-center">                                     
                                    <button type="submit" class="btn btn-block btn-dark">REGISTER</button>                                 
                                </div>                                 
                                <div class="col-lg-12 text-center mt-3">                                     
                                    <a href="login.php" class="text-danger">Already have an account? Login</a>                                 
                                </div>                             
                            </div>                         
                        </form>                     
                    </div>                 
                </div>             
            </div>         
        </div>     
    </div> 
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    
    <!-- Client Side Authentication/Validation -->
    <script>
    $(document).ready(function() {
        $('#registerForm').on('submit', function(e) {
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