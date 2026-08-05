<?php 
include '../config/auth.php'; 
include '../config/dbcon.php'; 

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
        $stmt = $pdo->prepare("SELECT id FROM students WHERE reg_no = ?");         
        $stmt->execute([$reg_no]);         
        
        if ($stmt->rowCount() > 0) {             
            $error = "Student with this Registration Number already exists.";         
        } else {             
            $insert = $pdo->prepare("INSERT INTO students (reg_no, first_name, last_name, room_no, contact_no) VALUES (?, ?, ?, ?, ?)");             
            $insert->execute([$reg_no, $first_name, $last_name, $room_no, $contact_no]);             
            $_SESSION['success'] = "Student registered successfully.";             
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
        <h4 class="card-title mb-3">Register Student</h4>         
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>         
        
        <div class="card p-4 shadow-sm">             
            <form method="POST" id="addStudentForm">                 
                <div class="row">                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Registration No <span class="text-danger">*</span></label>                         
                        <input type="text" name="reg_no" id="reg_no" class="form-control" required>                     
                    </div>                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Room Allocated <span class="text-danger">*</span></label>                         
                        <select name="room_no" id="room_no" class="form-control custom-select" required>                             
                            <option value="">Select Room...</option>                             
                            <?php foreach ($rooms as $room): ?>                                 
                                <option value="<?= htmlspecialchars($room['room_no']) ?>"><?= htmlspecialchars($room['room_no']) ?></option>                             
                            <?php endforeach; ?>                         
                        </select>                     
                    </div>                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">First Name <span class="text-danger">*</span></label>                         
                        <input type="text" name="first_name" id="first_name" class="form-control" required>                     
                    </div>                     
                    <div class="col-md-6 form-group mb-3">                         
                        <label class="text-dark">Last Name</label>                         
                        <input type="text" name="last_name" class="form-control">                     
                    </div>                     
                    <div class="col-md-6 form-group mb-4">                         
                        <label class="text-dark">Contact Number</label>                         
                        <input type="text" name="contact_no" id="contact_no" class="form-control" pattern="[0-9]+">                     
                    </div>                 
                </div>                 
                <button type="submit" class="btn btn-success">Register Student</button>                 
                <a href="index.php" class="btn btn-secondary">Cancel</a>             
            </form>         
        </div>     
    </div>     
    
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#addStudentForm').on('submit', function(e) {
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