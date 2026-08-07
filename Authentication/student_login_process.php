<?php
session_start();
include '../config/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and Password are required.";
        header("Location: ../student_login.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute([$email]);
    $student = $stmt->fetch();

    
    if ($student && !empty($student['password']) && password_verify($password, $student['password'])) {
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['student_name'];
        header("Location: ../student_dashboard/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid Email or Password.";
        header("Location: ../student_login.php");
        exit();
    }
} else {
    header("Location: ../student_login.php");
    exit();
}
?>