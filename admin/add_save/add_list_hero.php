<?php
session_start();
include '../../db.php'; // ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีไฟล์ที่อัปโหลด
    if (isset($_FILES['vdo']) && $_FILES['vdo']['error'] === UPLOAD_ERR_OK) {
        // ข้อมูลไฟล์
        $fileTmpPath = $_FILES['vdo']['tmp_name'];
        $fileName = $_FILES['vdo']['name'];
        $fileSize = $_FILES['vdo']['size'];
        $fileType = $_FILES['vdo']['type'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // ตรวจสอบประเภทไฟล์
        $allowedExtensions = ['mp4', 'mov', 'avi', 'mkv'];
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            $_SESSION['error'] = 'ประเภทไฟล์ไม่รองรับ (เฉพาะ mp4, mov, avi, mkv)';
            header('Location: ../page_hero.php');
            exit();
        }

        // ตรวจสอบขนาดไฟล์ (เช่น ไม่เกิน 100MB)
        if ($fileSize > 100 * 1024 * 1024) {
            $_SESSION['error'] = 'ขนาดไฟล์เกิน 100MB';
            header('Location: ../page_hero.php');
            exit();
        }

        // ตั้งชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ
        $newFileName = uniqid('vdo_', true) . '.' . $fileExtension;

        // กำหนดเส้นทางสำหรับเก็บไฟล์
        $uploadFolder = '../../vdo/';
        $destination = $uploadFolder . $newFileName;

        // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($fileTmpPath, $destination)) {
            try {
                // บันทึกข้อมูลลงฐานข้อมูล
                $sql = "INSERT INTO hero (vdo_hero) VALUES (:vdo_hero)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':vdo_hero', $newFileName, PDO::PARAM_STR);
                $stmt->execute();

                $_SESSION['success'] = 'อัปโหลดวิดีโอสำเร็จ!';
                header('Location: ../page_hero.php');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage();
                header('Location: ../page_hero.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
            header('Location: ../page_hero.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'กรุณาเลือกไฟล์วิดีโอ';
        header('Location: ../page_hero.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'วิธีการส่งข้อมูลไม่ถูกต้อง';
    header('Location: ../page_hero.php');
    exit();
}
?>