<?php  
include '../config/auth.php';  
include '../config/dbcon.php';  
include '../includes/header.php';  
include '../includes/nav.php';  


$query = "SELECT MAX(fee) as highest_fee,                   
                 MIN(fee) as lowest_fee,                   
                 AVG(fee) as average_fee,                   
                 SUM(fee) as total_revenue            
          FROM students"; 

$stmt = $pdo->query($query); 
$revenue_stats = $stmt->fetch(PDO::FETCH_ASSOC); 
?>
<div class="container mt-4 mb-5">     
    <div class="d-flex justify-content-between align-items-center mb-4">         
        <h2 class="text-secondary">Fee & Revenue Report</h2>                        
        <a href="occupancy_report.php" class="btn btn-outline-primary">Switch to Occupancy Report</a>     
    </div>     
    <div class="row">         
        <div class="col-md-6 mb-4">             
            <div class="card bg-success text-white p-4 shadow-sm h-100">                 
                <h5 class="text-uppercase mb-3">Highest Monthly Fee</h5>                 
                <h2>$<?= number_format($revenue_stats['highest_fee'] ?: 0, 2) ?></h2>             
            </div>         
        </div>         
        <div class="col-md-6 mb-4">             
            <div class="card bg-danger text-white p-4 shadow-sm h-100">                 
                <h5 class="text-uppercase mb-3">Lowest Monthly Fee</h5>                 
                <h2>$<?= number_format($revenue_stats['lowest_fee'] ?: 0, 2) ?></h2>             
            </div>         
        </div>         
        <div class="col-md-6 mb-4">             
            <div class="card bg-warning text-dark p-4 shadow-sm h-100">                 
                <h5 class="text-uppercase mb-3">Average Collection</h5>                 
                <h2>$<?= number_format($revenue_stats['average_fee'] ?: 0, 2) ?></h2>             
            </div>         
        </div>         
        <div class="col-md-6 mb-4">             
            <div class="card bg-primary text-white p-4 shadow-sm h-100">                 
                <h5 class="text-uppercase mb-3">Total Monthly Revenue</h5>                 
                <h2>$<?= number_format($revenue_stats['total_revenue'] ?: 0, 2) ?></h2>             
            </div>         
        </div>     
    </div> 
</div> 
<?php include '../includes/footer.php'; ?>