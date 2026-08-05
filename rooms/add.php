<?php  
include '../config/auth.php'; 
include '../config/dbcon.php'; 

$error = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $room_no = trim($_POST['room_no']);     
    $seater = trim($_POST['seater']);     
    $fees = trim($_POST['fees']);     
    
    if (empty($room_no) || empty($seater) || empty($fees)) {         
        $error = "All fields are required.";     
    } else {         
        $stmt = $pdo->prepare("SELECT id FROM rooms WHERE room_no = ?");         
        $stmt->execute([$room_no]);                  
        
        if ($stmt->rowCount() > 0) {             
            $error = "Room Number already exists.";         
        } else {             
            $insert = $pdo->prepare("INSERT INTO rooms (room_no, seater, fees) VALUES (?, ?, ?)");             
            $insert->execute([$room_no, $seater, $fees]);             
            $_SESSION['success'] = "Room added successfully.";             
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
        <div class="row justify-content-center">             
            <div class="col-md-6">                 
                <h4 class="card-title mb-3">Add New Room</h4>                 
                <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>                                  
                
                <div class="card p-4 shadow-sm">                     
                    <form method="POST" id="addRoomForm">                         
                        <div class="form-group mb-3">                             
                            <label class="text-dark">Room Number <span class="text-danger">*</span></label>                             
                            <input type="text" name="room_no" id="room_no" class="form-control" required>                         
                        </div>                         
                        <div class="form-group mb-3">                             
                            <label class="text-dark">Seater (Capacity) <span class="text-danger">*</span></label>                             
                            <input type="number" name="seater" id="seater" class="form-control" required>                         
                        </div>                         
                        <div class="form-group mb-4">                             
                            <label class="text-dark">Fees (Per Month) <span class="text-danger">*</span></label>                             
                            <input type="number" step="0.01" name="fees" id="fees" class="form-control" required>                         
                        </div>                         
                        <button type="submit" class="btn btn-success w-100">Save Room</button>                         
                        <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>                     
                    </form>                 
                </div>             
            </div>         
        </div>     
    </div>
    
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#addRoomForm').on('submit', function(e) {
            let roomNo = $('#room_no').val().trim();
            let seater = $('#seater').val().trim();
            let fees = $('#fees').val().trim();
            
            if (roomNo === '' || seater === '' || fees === '') {
                alert('All fields are required.');
                e.preventDefault();
                return false;
            }
            if (seater <= 0 || fees < 0) {
                alert('Seater must be greater than 0 and Fees cannot be negative.');
                e.preventDefault();
                return false;
            }
        });
    });
    </script>
    
<?php include '../includes/footer.php'; ?>