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


$rooms = $pdo->query("SELECT id, room_number FROM rooms")->fetchAll(); 
$error = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $room_id = $_POST['room_id'];     
    $student_name = trim($_POST['student_name']);     
    $email = trim($_POST['email']);     
    $phone = trim($_POST['phone']);     
    $gender = $_POST['gender'];     
    $fee = trim($_POST['fee']);     
    $checkin_date = $_POST['checkin_date'];     
    $address = trim($_POST['address']);     
    
    if (empty($student_name) || empty($room_id) || empty($email) || empty($phone)) {         
        $error = "Student Name, Room, Email, and Phone are required.";     
    } else {         
        
        $check = $pdo->prepare("SELECT id FROM students WHERE email = ? AND id != ?");         
        $check->execute([$email, $id]);         
        
        if ($check->rowCount() > 0) {             
            $error = "This Email already exists for another student.";         
        } else {             
            $update = $pdo->prepare("UPDATE students SET room_id=?, student_name=?, email=?, phone=?, gender=?, fee=?, checkin_date=?, address=? WHERE id=?");             
            $update->execute([$room_id, $student_name, $email, $phone, $gender, $fee, $checkin_date, $address, $id]);             
            
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
                        <label class="text-dark">Full Name <span class="text-danger">*</span></label>                         
                        <input type="text" name="student_name" id="student_name" class="form-control" value="<?= htmlspecialchars($student['student_name']) ?>" required>                     
                    </div>                     
                    
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Room Allocated <span class="text-danger">*</span></label>                         
                        <select name="room_id" id="room_id" class="form-select" required>                             
                            <option value="">Select Room...</option>                             
                            <?php foreach ($rooms as $room): ?>                                 
                                <option value="<?= htmlspecialchars($room['id']) ?>" <?= ($room['id'] == $student['room_id']) ? 'selected' : '' ?>>                                     
                                    <?= htmlspecialchars($room['room_number']) ?>                                 
                                </option>                             
                            <?php endforeach; ?>                         
                        </select>                     
                    </div>                     
                    
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Email <span class="text-danger">*</span></label>                         
                        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>                     
                    </div>                     
                    
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Phone Number <span class="text-danger">*</span></label>                         
                        <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($student['phone']) ?>" pattern="[0-9]+" required>                     
                    </div>                     
                    
                    <div class="col-md-4 form-group mb-3">                         
                        <label class="text-dark">Gender <span class="text-danger">*</span></label>                         
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="">Select...</option>
                            <option value="Male" <?= ($student['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($student['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= ($student['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                        </select>                     
                    </div>

                    <div class="col-md-4 form-group mb-3">                         
                        <label class="text-dark">Fee (Per Month) <span class="text-danger">*</span></label>                         
                        <input type="number" step="0.01" name="fee" id="fee" class="form-control" value="<?= htmlspecialchars($student['fee']) ?>" required>                     
                    </div>

                    <div class="col-md-4 form-group mb-3">                         
                        <label class="text-dark">Check-in Date <span class="text-danger">*</span></label>                         
                        <input type="date" name="checkin_date" id="checkin_date" class="form-control" value="<?= htmlspecialchars($student['checkin_date']) ?>" required>                     
                    </div>

                    <div class="col-md-12 form-group mb-4">                         
                        <label class="text-dark">Address</label>                         
                        <textarea name="address" id="address" class="form-control" rows="3"><?= htmlspecialchars($student['address']) ?></textarea>                     
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
            let studentName = $('#student_name').val().trim();
            let roomId = $('#room_id').val();
            let email = $('#email').val().trim();
            let phone = $('#phone').val().trim();
            let fee = $('#fee').val().trim();
            
            if (studentName === '' || roomId === '' || email === '' || phone === '') {
                alert('Please fill out all required fields.');
                e.preventDefault();
                return false;
            }
            
            if (phone !== '' && !/^\d+$/.test(phone)) {
                alert('Phone Number must contain only numbers.');
                e.preventDefault();
                return false;
            }

            if (fee < 0) {
                alert('Fee cannot be negative.');
                e.preventDefault();
                return false;
            }
        });
    });
    </script>

<?php include '../includes/footer.php'; ?>