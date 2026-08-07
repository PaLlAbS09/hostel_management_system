<?php
session_start();
include '../config/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../student_registration.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../student_registration.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT id FROM students WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: ../student_registration.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert = $pdo->prepare("INSERT INTO students (student_name, email, phone, password) VALUES (?, ?, ?, ?)");
    
    if ($insert->execute([$name, $email, $phone, $hashed_password])) {
        $_SESSION['success'] = "Registration successful! You can now login.";
        header("Location: ../student_login.php");
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: ../student_registration.php");
        exit();
    }
} else {
    header("Location: ../student_registration.php");
    exit();
}
?>