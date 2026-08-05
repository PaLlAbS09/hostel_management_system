<?php 
include '../config/auth.php'; 
include '../config/dbcon.php'; 
include '../includes/header.php'; 
include '../includes/nav.php'; 

$query = "SELECT students.*, rooms.room_number 
          FROM students 
          LEFT JOIN rooms ON students.room_id = rooms.id 
          ORDER BY students.id DESC"; 
$students = $pdo->query($query)->fetchAll(); 
?>
<div class="page-wrapper">     
    <div class="container-fluid">         
        <div class="d-flex justify-content-between mb-3">             
            <h4 class="card-title">Hostel Students</h4>             
            <a href="add.php" class="btn btn-primary">Register Student</a>         
        </div>         
        <?php if (isset($_SESSION['success'])): ?>             
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>         
        <?php endif; ?>         
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
                            <?php foreach ($students as $student): ?>                                 
                                <tr>                                     
                                    <td><?= htmlspecialchars($student['email'] ?? '') ?></td>                                     
                                    <td><?= htmlspecialchars($student['student_name'] ?? '') ?></td>                                     
                                    <td><?= htmlspecialchars($student['room_number'] ?? 'Unassigned') ?></td>                                     
                                    <td><?= htmlspecialchars($student['phone'] ?? '') ?></td>                                     
                                    <td>                                         
                                        <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-warning">Edit</a>                                         
                                        <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>                                     
                                    </td>                                 
                                </tr>                             
                            <?php endforeach; ?>                             
                            <?php if(empty($students)): ?>                                 
                                <tr><td colspan="5" class="text-center text-danger">No students found.</td></tr>                             
                            <?php endif; ?>                         
                        </tbody>                     
                    </table>                 
                </div>             
            </div>         
        </div>     
    </div> 
</div>
<?php include '../includes/footer.php'; ?>