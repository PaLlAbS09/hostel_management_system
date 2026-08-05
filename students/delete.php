<?php  
include '../config/auth.php'; 
include '../config/dbcon.php'; 

if (isset($_GET['id'])) {     
    $id = $_GET['id'];     
    $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");     
    $stmt->execute([$id]);     
    $_SESSION['success'] = "Room deleted successfully."; 
}

header("Location: index.php"); 
exit(); 
?>