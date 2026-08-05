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
    $room_number = trim($_POST['room_number']);
    $block_floor = trim($_POST['block_floor']);
    $capacity = trim($_POST['capacity']);     
    $rent = trim($_POST['rent']);
    $description = trim($_POST['description']);    
    

    if (empty($room_number) || empty($block_floor) || empty($capacity) || empty($rent)) {         
        $error = "All fields except Description are required.";     
    } else {         
       
        $check = $pdo->prepare("SELECT id FROM rooms WHERE room_number = ? AND id != ?");         
        $check->execute([$room_number, $id]);                  
        
        if ($check->rowCount() > 0) {             
            $error = "Room Number already exists.";         
        } else {             
            $update = $pdo->prepare("UPDATE rooms SET room_number = ?, block_floor = ?, capacity = ?, rent = ?, description = ? WHERE id = ?");             
            $update->execute([$room_number, $block_floor, $capacity, $rent, $description, $id]);             
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
            <div class="col-md-8">                 
                <h4 class="card-title mb-3">Edit Room</h4>                 
                <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>                                  
                
                <div class="card p-4 shadow-sm">                     
                    <form method="POST" id="editRoomForm">                         
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">                             
                                <label class="text-dark">Room Number <span class="text-danger">*</span></label>                             
                                <input type="text" name="room_number" id="room_number" class="form-control" value="<?= htmlspecialchars($room['room_number']) ?>" required>                         
                            </div>
                            
                            <div class="col-md-6 form-group mb-3">                             
                                <label class="text-dark">Block / Floor <span class="text-danger">*</span></label>                             
                                <input type="text" name="block_floor" id="block_floor" class="form-control" value="<?= htmlspecialchars($room['block_floor']) ?>" required>                         
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">                             
                                <label class="text-dark">Capacity (Seater) <span class="text-danger">*</span></label>                             
                                <input type="number" name="capacity" id="capacity" class="form-control" value="<?= htmlspecialchars($room['capacity']) ?>" required>                         
                            </div>                         
                            
                            <div class="col-md-6 form-group mb-3">                             
                                <label class="text-dark">Rent (Per Month) <span class="text-danger">*</span></label>                             
                                <input type="number" step="0.01" name="rent" id="rent" class="form-control" value="<?= htmlspecialchars($room['rent']) ?>" required>                         
                            </div>
                        </div>

                        <div class="form-group mb-4">                             
                            <label class="text-dark">Room Description</label>                             
                            <textarea name="description" id="description" class="form-control" rows="3"><?= htmlspecialchars($room['description']) ?></textarea>                         
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
            let roomNumber = $('#room_number').val().trim();
            let blockFloor = $('#block_floor').val().trim();
            let capacity = $('#capacity').val().trim();
            let rent = $('#rent').val().trim();
            
            if (roomNumber === '' || blockFloor === '' || capacity === '' || rent === '') {
                alert('All fields except Description are required.');
                e.preventDefault();
                return false;
            }
            if (capacity <= 0 || rent < 0) {
                alert('Capacity must be greater than 0 and Rent cannot be negative.');
                e.preventDefault();
                return false;
            }
        });
    });
    </script>

<?php include '../includes/footer.php'; ?>