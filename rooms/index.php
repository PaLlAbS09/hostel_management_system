<?php 
include '../config/auth.php'; 
include '../config/dbcon.php'; 
include '../includes/header.php'; 
include '../includes/nav.php'; 

$query = "SELECT * FROM rooms ORDER BY id DESC"; 
$rooms = $pdo->query($query)->fetchAll(); 
?>
<div class="page-wrapper">     
    <div class="container-fluid">         
        <div class="d-flex justify-content-between mb-3">             
            <h4 class="card-title">Manage Rooms</h4>             
            <a href="add.php" class="btn btn-primary">Add New Room</a>         
        </div>         
        <?php if (isset($_SESSION['success'])): ?>             
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>         
        <?php endif; ?>         
        <div class="card">             
            <div class="card-body">                 
                <table class="table table-bordered table-striped no-wrap">                     
                    <thead class="bg-dark text-white">                         
                        <tr>                             
                            <th>ID</th>                             
                            <th>Room No.</th>                             
                            <th>Seater</th>                             
                            <th>Fees</th>                             
                            <th>Actions</th>                         
                        </tr>                     
                    </thead>                     
                    <tbody>                         
                        <?php foreach ($rooms as $room): ?>                             
                            <tr>                                 
                                <td><?= $room['id'] ?></td>                                 
                                <td><?= htmlspecialchars($room['room_no']) ?></td>                                 
                                <td><?= htmlspecialchars($room['seater']) ?></td>                                 
                                <td>$<?= htmlspecialchars($room['fees']) ?></td>                                 
                                <td>                                     
                                    <a href="edit.php?id=<?= $room['id'] ?>" class="btn btn-sm btn-warning">Edit</a>                                     
                                    <a href="delete.php?id=<?= $room['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>                                 
                                </td>                             
                            </tr>                         
                        <?php endforeach; ?>                         
                        <?php if (empty($rooms)): ?>                             
                            <tr>                                 
                                <td colspan="5" class="text-center text-danger">No rooms found.</td>                             
                            </tr>                         
                        <?php endif; ?>                     
                    </tbody>                 
                </table>             
            </div>         
        </div>     
    </div>     
<?php include '../includes/footer.php'; ?>