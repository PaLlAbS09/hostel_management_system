<?php  
session_start(); 
require_once '../config/dbcon.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $name = trim($_POST['name']);     
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);     
    $password = $_POST['password'];     
    $confirm_password = $_POST['confirm_password'];          

    if (empty($name) || empty($email) || empty($password)) {         
        $_SESSION['error'] = "All fields are required.";         
        header("Location: ../registration.php");         
        exit();     
    }     
    if ($password !== $confirm_password) {         
        $_SESSION['error'] = "Passwords do not match.";         
        header("Location: ../registration.php");         
        exit();     
    }     

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");     
    $stmt->execute([$email]);     
    if ($stmt->rowCount() > 0) {         
        $_SESSION['error'] = "Email is already registered.";         
        header("Location: ../registration.php");         
        exit();     
    }     

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);          
    $insert = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");     
    
    if ($insert->execute([$name, $email, $hashed_password])) {         
        $_SESSION['success'] = "Registration successful! You can now login.";         
        header("Location: ../login.php");         
        exit();     
    } else {         
        $_SESSION['error'] = "Something went wrong. Please try again.";         
        header("Location: ../registration.php");         
        exit();     
    } 
}
?>