<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบว่าชื่อผู้ใช้นี้มีในฐานข้อมูลหรือไม่
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // ถ้าผู้ใช้ถูกต้อง ให้สร้าง session และทำการเข้าสู่ระบบ
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid credentials, please try again.";
    }
    $password = "123456"; // รหัสผ่านที่ผู้ใช้กรอกมา
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // สร้าง hash

echo $hashed_password; // แสดงค่า hash ที่ได้
}
?>
