<?php  
include './config/auth.php'; 
include './config/dbcon.php'; 

// We define a base path variable to fix the broken images/CSS for files in the root folder
$base_path = './'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hostel Management System - Search</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Fixed Path for Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">

    <!-- Included the same CSS from your header to fix the broken layout -->
    <style>
        body { background-color: #f4f6f9; margin: 0; overflow-x: hidden; }
        .topbar { position: fixed; width: 100%; height: 64px; background: #fff; z-index: 50; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); }
        .topbar .navbar { padding: 0; height: 100%; }
        .navbar-header { width: 250px; text-align: center; background: #fff; flex-shrink: 0; }
        ul.navbar-nav { list-style: none; margin: 0; padding: 0; display: flex; align-items: center; }
        .left-sidebar { position: fixed; width: 250px; height: 100vh; top: 64px; background: #fff; z-index: 20; box-shadow: 1px 0 5px rgba(0, 0, 0, 0.05); padding-top: 15px; }
        #sidebarnav { list-style: none; padding: 0; margin: 0; }
        #sidebarnav .sidebar-link { display: flex; align-items: center; padding: 12px 20px; color: #5f6368; text-decoration: none; font-weight: 500; transition: 0.2s; }
        #sidebarnav .sidebar-link:hover { background: #f0f2f5; color: #000; }
        #sidebarnav .sidebar-link i { margin-right: 10px; width: 20px; text-align: center; }
        .nav-small-cap { font-size: 12px; font-weight: 700; color: #a1aab2; padding: 12px 20px; text-transform: uppercase; }
        .list-divider { border-top: 1px solid #eef1f3; margin: 10px 0; }
        .page-wrapper { margin-left: 250px; padding-top: 84px; padding-left: 20px; padding-right: 20px; min-height: 100vh; }
        .dropdown-toggle::after { display: none !important; }
        .dropdown-menu { border: none; border-radius: 12px; padding: 10px 0; min-width: 200px; margin-top: 10px !important; }
        .logout-btn { background-color: #fff0f0; color: #e63946 !important; border-radius: 8px; font-weight: 600; padding: 10px 15px; width: auto; margin: 5px 10px; display: flex; align-items: center; transition: all 0.3s ease; }
        .logout-btn:hover { background-color: #e63946; color: #ffffff !important; box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3); transform: translateY(-1px); }
    </style>
</head>

<body>
    <!-- TOP NAVIGATION (Fixed image paths) -->
    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md px-3">
            <div class="navbar-header" data-logobg="skin6">
                <a class="navbar-brand" href="dashboard/index.php">
                    <b class="logo-icon">
                        <img src="assets/images/logo-icon-nav.png" alt="homepage" class="dark-logo" />
                    </b>
                    <span class="logo-text ms-2">
                        <img src="assets/images/logo-text-navigation.png" alt="homepage" class="dark-logo" />
                    </span>
                </a>
            </div>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto align-items-center">
                    <form action="search.php" method="GET" class="d-flex me-4 mb-0">
                        <input type="text" name="q" class="form-control form-control-sm" placeholder="Search students..." required style="border-radius: 4px 0 0 4px;">
                        <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 0 4px 4px 0;">Search</button>
                    </form>

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fw-bold">Welcome, <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Admin' ?></span>
                                <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown" style="position: absolute; right: 0;">
                                <li><a class="dropdown-item py-2" href="change_password.php"><i class="fas fa-key text-muted me-2"></i> Change Password</a></li>
                                <li><hr class="dropdown-divider my-2"></li>
                                <li><a class="dropdown-item logout-btn" href="Authentication/logout.php"><i class="fa-solid fa-arrow-right-from-bracket me-3"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- SIDEBAR NAVIGATION (Fixed Links) -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="dashboard/index.php" aria-expanded="false"><i class="fas fa-home me-2"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Features</span></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="rooms/index.php" aria-expanded="false"><i class="fas fa-bed me-2"></i><span class="hide-menu">Manage Rooms</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="students/index.php" aria-expanded="false"><i class="fas fa-users me-2"></i><span class="hide-menu">Hostel Students</span></a></li>
                </ul>
            </nav>
        </div>
    </aside>

<?php
$results = []; 
if (isset($_GET['q'])) {     
    $searchTerm = "%" . $_GET['q'] . "%";     
    
    // UPDATED QUERY: Uses new schema and links to the rooms table
    $stmt = $pdo->prepare("         
        SELECT students.*, rooms.room_number 
        FROM students 
        LEFT JOIN rooms ON students.room_id = rooms.id 
        WHERE students.student_name LIKE ?          
        OR students.email LIKE ?          
        OR students.phone LIKE ?          
        OR rooms.room_number LIKE ?     
    ");     
    
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);     
    $results = $stmt->fetchAll(); 
}
?>

<div class="page-wrapper">     
    <div class="container-fluid">         
        <h4 class="card-title mb-3">Search Students</h4>                  
        
        <div class="card p-4 shadow-sm mb-4">             
            <form method="GET" class="d-flex">                 
                <input type="text" name="q" class="form-control me-2" placeholder="Search by name, email, phone, or room no..." required value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">                 
                <button type="submit" class="btn btn-primary">Search</button>             
            </form>         
        </div>         
        
        <?php if (isset($_GET['q'])): ?>             
            <h5 class="mb-3 text-dark">Results for "<?= htmlspecialchars($_GET['q']) ?>"</h5>                          
            <div class="card">                 
                <div class="card-body">                     
                    <div class="table-responsive">                         
                        <table class="table table-bordered table-striped no-wrap">                             
                            <thead class="bg-dark text-white">                                 
                                <tr>                                     
                                    <th>Email</th>                                     
                                    <th>Name</th>                                     
                                    <th>Room No</th>                                     
                                    <th>Contact (Phone)</th>                                     
                                    <th>Actions</th>                                 
                                </tr>                             
                            </thead>                             
                            <tbody>                                 
                                <?php foreach($results as $res): ?>                                     
                                    <tr>                                         
                                        <td><?= htmlspecialchars($res['email']) ?></td>                                         
                                        <td><?= htmlspecialchars($res['student_name']) ?></td>                                         
                                        <td><?= htmlspecialchars($res['room_number'] ?? 'Unassigned') ?></td>                                         
                                        <td><?= htmlspecialchars($res['phone']) ?></td>                                         
                                        <td>                                             
                                            <a href="./students/edit.php?id=<?= $res['id'] ?>" class="btn btn-sm btn-warning">Edit</a>                                         
                                        </td>                                     
                                    </tr>                                 
                                <?php endforeach; ?>                                 
                                <?php if(empty($results)): ?>                                     
                                    <tr><td colspan="5" class="text-center text-danger">No students found matching your search.</td></tr>                                 
                                <?php endif; ?>                             
                            </tbody>                         
                        </table>                     
                    </div>                 
                </div>             
            </div>         
        <?php endif; ?>     
    </div> 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>