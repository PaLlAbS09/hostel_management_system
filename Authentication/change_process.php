<?php  
session_start(); 
require '../config/dbcon.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $email = trim($_POST['email']);     
    $old_password = $_POST['old_password'];     
    $new_password = $_POST['new_password'];     
    $confirm_password = $_POST['confirm_password'];     
    
    if (empty($email) || empty($old_password) || empty($new_password) || empty($confirm_password)) {         
        $_SESSION['error'] = "All fields are required.";         
        header("Location: ../change_password.php");         
        exit();     
    }     
    if ($new_password !== $confirm_password) {         
        $_SESSION['error'] = "New passwords do not match.";         
        header("Location: ../change_password.php");         
        exit();     
    }     
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");     
    $stmt->execute([$email]);     
    $user = $stmt->fetch();          
    
    if ($user && password_verify($old_password, $user['password'])) {         
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);         
        $update = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");                  
        
        if ($update->execute([$hashed_password, $email])) {             
            $_SESSION['success'] = "Password updated successfully. Please login with your new password.";             
            header("Location: ../login.php");             
            exit();         
        } else {             
            $_SESSION['error'] = "Failed to update password. Please try again.";             
            header("Location: ../change_password.php");             
            exit();         
        }     
    } else {         
        $_SESSION['error'] = "Invalid Email or Old Password.";         
        header("Location: ../change_password.php");         
        exit();     
    } 
} else {     
    header("Location: ../change_password.php");     
    exit(); 
}
?>