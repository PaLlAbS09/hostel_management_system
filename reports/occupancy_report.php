<?php  
include '../config/auth.php';  
include '../config/dbcon.php';  
include '../includes/header.php';  
include '../includes/nav.php';  


$occupancy_report = $pdo->query("     
    SELECT rooms.room_number, rooms.block_floor, rooms.capacity, COUNT(students.id) as occupied_beds      
    FROM rooms      
    LEFT JOIN students ON rooms.id = students.room_id      
    GROUP BY rooms.id     
    ORDER BY rooms.block_floor ASC, rooms.room_number ASC 
")->fetchAll(); 
?>
<div class="container mt-4 mb-5">     
    <div class="d-flex justify-content-between align-items-center mb-3">         
        <h2 class="text-secondary m-0">Room Occupancy Report</h2>         
        <a href="revenue_report.php" class="btn btn-outline-primary">Switch to Revenue Report</a>     
    </div>          
    
    <table class="table table-bordered mt-3 shadow-sm">         
        <thead class="table-dark">             
            <tr>                 
                <th>Block / Floor</th>                 
                <th>Room Number</th>                 
                <th>Total Capacity</th>                 
                <th>Occupied Beds</th>                 
                <th>Available Beds</th>                 
                <th>Status</th>             
            </tr>         
        </thead>         
        <tbody>             
            <?php foreach($occupancy_report as $row):                  
                $available = $row['capacity'] - $row['occupied_beds'];                 
                $status = ($available == 0) ? '<span class="badge bg-danger">Full</span>' : '<span class="badge bg-success">Available</span>';             
            ?>             
            <tr>                 
                <td><?= htmlspecialchars($row['block_floor']) ?></td>                 
                <td><strong><?= htmlspecialchars($row['room_number']) ?></strong></td>                 
                <td><?= $row['capacity'] ?></td>                 
                <td><?= $row['occupied_beds'] ?></td>                 
                <td><?= $available ?></td>                 
                <td><?= $status ?></td>             
            </tr>             
            <?php endforeach; ?>         
        </tbody>     
    </table> 
</div> 
<?php include '../includes/footer.php'; ?>