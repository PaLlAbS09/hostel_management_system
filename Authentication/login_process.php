<?php  
session_start(); 
require_once '../config/dbcon.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);     
    $password = trim($_POST['password']);     

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and Password are required.";
        header("Location: ../login.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");     
    $stmt->execute([$email]);     
    $user = $stmt->fetch();     

    if ($user && password_verify($password, $user['password'])) {         
        $_SESSION['user_id'] = $user['id'];         
        $_SESSION['user_name'] = $user['name'];         
        header("Location: ../dashboard/index.php");     
    } else {         
        $_SESSION['error'] = "Invalid Email or Password";         
        header("Location: ../login.php");     
    }     
    exit(); 
}
?>