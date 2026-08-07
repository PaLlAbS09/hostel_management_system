<?php
include '../config/student_auth.php';
include '../config/dbcon.php';
$student_id = $_SESSION['student_id'];

$stmt = $pdo->prepare("
    SELECT students.*, rooms.room_number, rooms.block_floor, rooms.capacity, rooms.rent 
    FROM students 
    LEFT JOIN rooms ON students.room_id = rooms.id 
    WHERE students.id = ?
");
$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Hostel Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; }
        .navbar-custom { background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); }
        .profile-card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        .info-label { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: #6c757d; font-weight: 700; }
        .info-value { font-size: 1.1rem; color: #212529; font-weight: 500; margin-bottom: 15px; }
    </style>
</head>
<body>
    <!-- Student Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm mb-5 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-university me-2"></i> Hostel Student Portal
            </a>
            <div class="d-flex align-items-center">
                <span class="navbar-text text-white me-4 fw-bold">
                    <i class="fas fa-user-circle me-1"></i> Hello, <?= htmlspecialchars($student['student_name']) ?>
                </span>
                <a href="../Authentication/student_logout.php" class="btn btn-light btn-sm fw-bold text-primary px-3 rounded-pill">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container">
        <div class="row">
            <!-- Room & Allocation Details -->
            <div class="col-lg-6 mb-4">
                <div class="card profile-card h-100">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-bed me-2"></i> Room Allocation Details</h5>
                    </div>
                    <div class="card-body p-4">
                        <?php if(!empty($student['room_id'])): ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="info-label">Room Number</p>
                                    <p class="info-value text-success fw-bold fs-4"><?= htmlspecialchars($student['room_number']) ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="info-label">Block / Floor</p>
                                    <p class="info-value"><?= htmlspecialchars($student['block_floor']) ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="info-label">Room Type</p>
                                    <p class="info-value"><?= htmlspecialchars($student['capacity']) ?> Seater</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="info-label">Check-in Date</p>
                                    <p class="info-value"><?= !empty($student['checkin_date']) ? date('d M, Y', strtotime($student['checkin_date'])) : 'Not recorded' ?></p>
                                </div>
                                <div class="col-12 mt-3">
                                    <p class="info-label">Monthly Rent / Fee</p>
                                    <p class="info-value text-danger fw-bold fs-4">$<?= htmlspecialchars($student['fee'] ?? $student['rent']) ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list text-muted mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-muted">Room Not Allocated Yet</h5>
                                <p class="text-muted small">Please contact the hostel administrator for room assignment.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Personal Profile Details -->
            <div class="col-lg-6 mb-4">
                <div class="card profile-card h-100">
                    <div class="card-header bg-white border-bottom p-4">
                        <h5 class="mb-0 text-dark fw-bold"><i class="fas fa-address-card me-2"></i> Personal Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="info-label">Full Name</p>
                                <p class="info-value"><?= htmlspecialchars($student['student_name']) ?></p>
                            </div>
                            <div class="col-sm-6">
                                <p class="info-label">Email Address</p>
                                <p class="info-value"><?= htmlspecialchars($student['email']) ?></p>
                            </div>
                            <div class="col-sm-6">
                                <p class="info-label">Phone Number</p>
                                <p class="info-value"><?= htmlspecialchars($student['phone']) ?></p>
                            </div>
                            <div class="col-sm-6">
                                <p class="info-label">Gender</p>
                                <p class="info-value"><?= htmlspecialchars($student['gender'] ?? 'Not updated') ?></p>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <p class="info-label">Permanent Address</p>
                                <p class="info-value"><?= htmlspecialchars($student['address'] ?? 'No address provided') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>