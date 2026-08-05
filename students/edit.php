<?php 
include '../config/auth.php'; 
include '../config/dbcon.php'; 

if (!isset($_GET['id'])) {     
    header("Location: index.php");     
    exit(); 
}

$id = $_GET['id']; 
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?"); 
$stmt->execute([$id]); 
$student = $stmt->fetch(); 

if (!$student) {     
    header("Location: index.php");     
    exit(); 
}

$rooms = $pdo->query("SELECT room_no FROM rooms")->fetchAll(); 
$error = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $reg_no = trim($_POST['reg_no']);     
    $first_name = trim($_POST['first_name']);     
    $last_name = trim($_POST['last_name']);     
    $room_no = $_POST['room_no'];     
    $contact_no = trim($_POST['contact_no']);     
    
    if (empty($reg_no) || empty($first_name) || empty($room_no)) {         
        $error = "Registration No, First Name, and Room No are required.";     
    } else {         
        $check = $pdo->prepare("SELECT id FROM students WHERE reg_no = ? AND id != ?");         
        $check->execute([$reg_no, $id]);         
        
        if ($check->rowCount() > 0) {             
            $error = "Registration Number already exists for another student.";         
        } else {             
            $update = $pdo->prepare("UPDATE students SET reg_no=?, first_name=?, last_name=?, room_no=?, contact_no=? WHERE id=?");             
            $update->execute([$reg_no, $first_name, $last_name, $room_no, $contact_no, $id]);             
            $_SESSION['success'] = "Student updated successfully.";             
            header("Location: index.php");             
            exit();         
        }     
    }
}

include '../includes/header.php'; 
include '../includes/nav.php'; 
?>
<div class="page-wrapper">     
    <div class="container-fluid">         
        <h4 class="card-title mb-3">Edit Student</h4>         
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>         
        
        <div class="card p-4 shadow-sm">             
            <form method="POST" id="editStudentForm">                 
                <div class="row">                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Registration No <span class="text-danger">*</span></label>                         
                        <input type="text" name="reg_no" id="reg_no" class="form-control" value="<?= htmlspecialchars($student['reg_no']) ?>" required>                     
                    </div>                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Room Allocated <span class="text-danger">*</span></label>                         
                        <select name="room_no" id="room_no" class="form-control custom-select" required>                             
                            <option value="">Select Room...</option>                             
                            <?php foreach ($rooms as $room): ?>                                 
                                <option value="<?= htmlspecialchars($room['room_no']) ?>" <?= ($room['room_no'] == $student['room_no']) ? 'selected' : '' ?>>                                     
                                    <?= htmlspecialchars($room['room_no']) ?>                                 
                                </option>                             
                            <?php endforeach; ?>                         
                        </select>                     
                    </div>                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">First Name <span class="text-danger">*</span></label>                         
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?= htmlspecialchars($student['first_name']) ?>" required>                     
                    </div>                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Last Name</label>                         
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($student['last_name']) ?>">                     
                    </div>                     
                    <div class="col-md-6 form-group mb-4">                         
                        <label class="text-dark">Contact Number</label>                         
                        <input type="text" name="contact_no" id="contact_no" class="form-control" value="<?= htmlspecialchars($student['contact_no']) ?>" pattern="[0-9]+">                     
                    </div>                 
                </div>                 
                <button type="submit" class="btn btn-warning">Update Student</button>                 
                <a href="index.php" class="btn btn-secondary">Cancel</a>             
            </form>         
        </div>     
    </div>  
    
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#editStudentForm').on('submit', function(e) {
            let regNo = $('#reg_no').val().trim();
            let roomNo = $('#room_no').val();
            let firstName = $('#first_name').val().trim();
            let contactNo = $('#contact_no').val().trim();
            
            if (regNo === '' || roomNo === '' || firstName === '') {
                alert('Please fill out all required fields.');
                e.preventDefault();
                return false;
            }
            
            if (contactNo !== '' && !/^\d+$/.test(contactNo)) {
                alert('Contact Number must contain only numbers.');
                e.preventDefault();
                return false;
            }
        });
    });
    </script>

<?php include '../includes/footer.php'; ?>