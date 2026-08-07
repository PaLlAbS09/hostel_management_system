<?php 
session_start(); 

if (isset($_SESSION['user_id'])) { 
    header("Location: dashboard/index.php"); 
    exit(); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('assets/images/big/auth-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .main-container {
            width: 100%;
            max-width: 900px;
            padding: 20px;
        }
        .main-title {
            color: #343a40;
            font-weight: 800;
            text-align: center;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 10px rgba(255,255,255,0.7);
        }
        .panel-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 50px 30px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            border: 2px solid #343a40;
        }
        .panel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1 class="main-title display-4">Hostel Management</h1>
        
        <div class="row justify-content-center g-4">
            <!-- Admin Panel Card -->
            <div class="col-md-6 col-lg-5">
                <div class="panel-card">
                    <h2 class="mb-4 text-dark fw-bold">Admin Panel</h2>
                    <p class="text-muted mb-5">Manage rooms, students, reports, and system settings.</p>
                    <a href="login.php" class="btn btn-dark w-100 py-3 fs-5 fw-bold shadow-sm">Login Admin</a>
                </div>
            </div>
            
            <!-- Student Panel Card -->
            <div class="col-md-6 col-lg-5">
                <div class="panel-card" style="border-color: #0d6efd;">
                    <h2 class="mb-4 text-primary fw-bold">Student Panel</h2>
                    <p class="text-muted mb-5">Access your room details, fees, and personal profile.</p>
                    <a href="student_login.php" class="btn btn-primary w-100 py-3 fs-5 fw-bold shadow-sm">Login Student</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>