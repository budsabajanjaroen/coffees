<?php
$host = 'localhost';  // หรือ IP ของเซิร์ฟเวอร์ฐานข้อมูล
$dbname = 'happympmho_main';  // ชื่อฐานข้อมูล
$username = 'happympmho_main';  // ชื่อผู้ใช้ฐานข้อมูล
$password = 'DYHr1L4oaJFAikkG0';  // รหัสผ่านฐานข้อมูล

try {
    // สร้างการเชื่อมต่อ PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
