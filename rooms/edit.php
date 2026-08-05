<?php  
include '../config/auth.php'; 
include '../config/dbcon.php'; 

if (!isset($_GET['id'])) {     
    header("Location: index.php");     
    exit(); 
}

$id = $_GET['id']; 
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?"); 
$stmt->execute([$id]); 
$room = $stmt->fetch(); 

if (!$room) {     
    header("Location: index.php");     
    exit(); 
}

$error = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $room_no = trim($_POST['room_no']);     
    $seater = trim($_POST['seater']);     
    $fees = trim($_POST['fees']);     
    
    if (empty($room_no) || empty($seater) || empty($fees)) {         
        $error = "All fields are required.";     
    } else {         
        $check = $pdo->prepare("SELECT id FROM rooms WHERE room_no = ? AND id != ?");         
        $check->execute([$room_no, $id]);                  
        
        if ($check->rowCount() > 0) {             
            $error = "Room Number already exists.";         
        } else {             
            $update = $pdo->prepare("UPDATE rooms SET room_no = ?, seater = ?, fees = ? WHERE id = ?");             
            $update->execute([$room_no, $seater, $fees, $id]);             
            $_SESSION['success'] = "Room updated successfully.";             
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
                <h4 class="card-title mb-3">Edit Room</h4>                 
                <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>                                  
                
                <div class="card p-4 shadow-sm">                     
                    <form method="POST" id="editRoomForm">                         
                        <div class="form-group mb-3">                             
                            <label class="text-dark">Room Number <span class="text-danger">*</span></label>                             
                            <input type="text" name="room_no" id="room_no" class="form-control" value="<?= htmlspecialchars($room['room_no']) ?>" required>                         
                        </div>                         
                        <div class="form-group mb-3">                             
                            <label class="text-dark">Seater (Capacity) <span class="text-danger">*</span></label>                             
                            <input type="number" name="seater" id="seater" class="form-control" value="<?= htmlspecialchars($room['seater']) ?>" required>                         
                        </div>                         
                        <div class="form-group mb-4">                             
                            <label class="text-dark">Fees (Per Month) <span class="text-danger">*</span></label>                             
                            <input type="number" step="0.01" name="fees" id="fees" class="form-control" value="<?= htmlspecialchars($room['fees']) ?>" required>                         
                        </div>                         
                        <button type="submit" class="btn btn-warning w-100">Update Room</button>                         
                        <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>                     
                    </form>                 
                </div>             
            </div>         
        </div>     
    </div> 
    
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#editRoomForm').on('submit', function(e) {
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