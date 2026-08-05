<?php 
include '../config/auth.php'; 
include '../config/dbcon.php'; 

$total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn(); 
$total_rooms = $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn(); 

include '../includes/header.php'; 
include '../includes/nav.php'; 
?>
<div class="page-wrapper">     
    <div class="page-breadcrumb">         
        <div class="row">             
            <div class="col-7 align-self-center">                 
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h3>             
            </div>         
        </div>     
    </div>     
    <div class="container-fluid">         
        <div class="card-group">             
            <div class="card border-right">                 
                <div class="card-body">                     
                    <div class="d-flex d-lg-flex d-md-block align-items-center">                         
                        <div>                             
                            <div class="d-inline-flex align-items-center">                                 
                                <h2 class="text-dark mb-1 font-weight-medium"><?= $total_students ?></h2>                             
                            </div>                             
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Registered Students</h6>                         
                        </div>                         
                        <div class="ml-auto mt-md-3 mt-lg-0">                             
                            <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>                         
                        </div>                     
                    </div>                 
                </div>             
            </div>             
            <div class="card border-right">                 
                <div class="card-body">                     
                    <div class="d-flex d-lg-flex d-md-block align-items-center">                         
                        <div>                             
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><?= $total_rooms ?></h2>                             
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Rooms</h6>                         
                        </div>                         
                        <div class="ml-auto mt-md-3 mt-lg-0">                             
                            <span class="opacity-7 text-muted"><i data-feather="grid"></i></span>                         
                        </div>                     
                    </div>                 
                </div>             
            </div>         
        </div>     
    </div>     
<?php include '../includes/footer.php'; ?>