<?php 
include '../config/auth.php'; 
include '../config/dbcon.php'; 

$total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn() ?: 0; 
$total_rooms = $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn() ?: 0; 


$total_capacity = $pdo->query("SELECT SUM(capacity) FROM rooms")->fetchColumn() ?: 0;
$available_beds = $total_capacity - $total_students;


$total_revenue = $pdo->query("SELECT SUM(fee) FROM students")->fetchColumn() ?: 0;


$recent_students = $pdo->query("
    SELECT students.student_name, students.checkin_date, rooms.room_number 
    FROM students 
    LEFT JOIN rooms ON students.room_id = rooms.id 
    ORDER BY students.id DESC 
    LIMIT 5
")->fetchAll();

include '../includes/header.php'; 
include '../includes/nav.php'; 
?>

<div class="page-wrapper">     
    <div class="page-breadcrumb mb-4">         
        <div class="row">             
            <div class="col-12 align-self-center">                 
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                    Good Morning, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?>!
                </h3>             
                <p class="text-muted">Here is what is happening in your hostel today.</p>
            </div>         
        </div>     
    </div>     
    
    <div class="container-fluid">         
        
    
        <div class="card-group mb-4 shadow-sm">             
            
            
            <div class="card border-right">                 
                <div class="card-body">                     
                    <div class="d-flex d-lg-flex d-md-block align-items-center">                         
                        <div>                             
                            <h2 class="text-dark mb-1 font-weight-medium"><?= $total_students ?></h2>                             
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Registered Students</h6>                         
                        </div>                         
                        <div class="ml-auto mt-md-3 mt-lg-0">                             
                            <span class="opacity-7 text-primary"><i data-feather="users" class="feather-icon"></i></span>                         
                        </div>                     
                    </div>                 
                </div>             
            </div>             
            
          
            <div class="card border-right">                 
                <div class="card-body">                     
                    <div class="d-flex d-lg-flex d-md-block align-items-center">                         
                        <div>                             
                            <h2 class="text-dark mb-1 font-weight-medium"><?= $total_rooms ?></h2>                             
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Rooms</h6>                         
                        </div>                         
                        <div class="ml-auto mt-md-3 mt-lg-0">                             
                            <span class="opacity-7 text-info"><i data-feather="grid" class="feather-icon"></i></span>                         
                        </div>                     
                    </div>                 
                </div>             
            </div>

           
            <div class="card border-right">                 
                <div class="card-body">                     
                    <div class="d-flex d-lg-flex d-md-block align-items-center">                         
                        <div>                             
                            <h2 class="text-dark mb-1 font-weight-medium"><?= $available_beds ?></h2>                             
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Available Beds</h6>                         
                        </div>                         
                        <div class="ml-auto mt-md-3 mt-lg-0">                             
                            <span class="opacity-7 text-success"><i data-feather="check-circle" class="feather-icon"></i></span>                         
                        </div>                     
                    </div>                 
                </div>             
            </div>

          
            <div class="card">                 
                <div class="card-body">                     
                    <div class="d-flex d-lg-flex d-md-block align-items-center">                         
                        <div>                             
                            <h2 class="text-dark mb-1 font-weight-medium">$<?= number_format($total_revenue, 2) ?></h2>                             
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Monthly Revenue</h6>                         
                        </div>                         
                        <div class="ml-auto mt-md-3 mt-lg-0">                             
                            <span class="opacity-7 text-success"><i data-feather="dollar-sign" class="feather-icon"></i></span>                         
                        </div>                     
                    </div>                 
                </div>             
            </div>

        </div> 
        
        <div class="row">
            
            <!-- Recent Activity Table -->
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Recently Registered Students</h4>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Room No.</th>
                                        <th>Check-in Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($recent_students)): ?>
                                        <?php foreach($recent_students as $rs): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($rs['student_name']) ?></td>
                                                <td><span class="badge bg-secondary"><?= htmlspecialchars($rs['room_number'] ?? 'Unassigned') ?></span></td>
                                                <td><?= date('d M, Y', strtotime($rs['checkin_date'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No students registered yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Quick Actions</h4>
                        
                        <a href="../students/add.php" class="btn btn-primary w-100 mb-3 text-start d-flex justify-content-between align-items-center p-3 rounded">
                            <span><i class="fas fa-user-plus me-2"></i> Register New Student</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        
                        <a href="../rooms/add.php" class="btn btn-info w-100 mb-3 text-start d-flex justify-content-between align-items-center p-3 rounded text-white">
                            <span><i class="fas fa-bed me-2"></i> Add New Room</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>

                        <a href="../reports/occupancy_report.php" class="btn btn-success w-100 mb-3 text-start d-flex justify-content-between align-items-center p-3 rounded">
                            <span><i class="fas fa-chart-pie me-2"></i> View Occupancy</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>

                        <a href="../reports/revenue_report.php" class="btn btn-warning w-100 text-start d-flex justify-content-between align-items-center p-3 rounded text-dark">
                            <span><i class="fas fa-file-invoice-dollar me-2"></i> Revenue Report</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div> 

    </div> 
</div> 

<?php include '../includes/footer.php'; ?>