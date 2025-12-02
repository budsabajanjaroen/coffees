<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_satisfaction = $_POST['id_satisfaction'];

        // ดึงข้อมูลปัจจุบันจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT * FROM satisfaction WHERE id_satisfaction = :id_satisfaction");
        $stmt->bindParam(':id_satisfaction', $id_satisfaction, PDO::PARAM_INT);
        $stmt->execute();
        $satisfaction = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$satisfaction) {
            throw new Exception('ไม่พบข้อมูลสำหรับ ID ที่ระบุ');
        }

        $uploadFolder = '../../img/satisfaction/';
        $img1 = $satisfaction['img1_satisfaction']; // ใช้รูปเดิมถ้าไม่มีการอัปโหลดใหม่
        $img2 = $satisfaction['img2_satisfaction']; // ใช้รูปเดิมถ้าไม่มีการอัปโหลดใหม่

        // จัดการการอัปโหลดไฟล์ image1
        if (isset($_FILES['img1_satisfaction']) && $_FILES['img1_satisfaction']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath1 = $_FILES['img1_satisfaction']['tmp_name'];
            $fileName1 = uniqid('img1_', true) . '.' . pathinfo($_FILES['img1_satisfaction']['name'], PATHINFO_EXTENSION);
            $destination1 = $uploadFolder . $fileName1;

            // ลบรูปเดิมถ้ามี
            if (!empty($img1) && file_exists($uploadFolder . $img1)) {
                unlink($uploadFolder . $img1);
            }

            // ย้ายไฟล์ใหม่
            if (!move_uploaded_file($fileTmpPath1, $destination1)) {
                throw new Exception('การย้ายไฟล์ img1_satisfaction ล้มเหลว');
            }

            $img1 = $fileName1;
        }

        // จัดการการอัปโหลดไฟล์ image2
        if (isset($_FILES['img2_satisfaction']) && $_FILES['img2_satisfaction']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath2 = $_FILES['img2_satisfaction']['tmp_name'];
            $fileName2 = uniqid('img2_', true) . '.' . pathinfo($_FILES['img2_satisfaction']['name'], PATHINFO_EXTENSION);
            $destination2 = $uploadFolder . $fileName2;

            // ลบรูปเดิมถ้ามี
            if (!empty($img2) && file_exists($uploadFolder . $img2)) {
                unlink($uploadFolder . $img2);
            }

            // ย้ายไฟล์ใหม่
            if (!move_uploaded_file($fileTmpPath2, $destination2)) {
                throw new Exception('การย้ายไฟล์ img2_satisfaction ล้มเหลว');
            }

            $img2 = $fileName2;
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $sql = "UPDATE satisfaction 
                SET method_satisfaction = :method_satisfaction, 
                    maintenance_satisfaction = :maintenance_satisfaction, 
                    caution_satisfaction = :caution_satisfaction, 
                    img1_satisfaction = :img1_satisfaction, 
                    img2_satisfaction = :img2_satisfaction 
                WHERE id_satisfaction = :id_satisfaction";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':method_satisfaction', $_POST['method_satisfaction'], PDO::PARAM_STR);
        $stmt->bindParam(':maintenance_satisfaction', $_POST['maintenance_satisfaction'], PDO::PARAM_STR);
        $stmt->bindParam(':caution_satisfaction', $_POST['caution_satisfaction'], PDO::PARAM_STR);
        $stmt->bindParam(':img1_satisfaction', $img1, PDO::PARAM_STR);
        $stmt->bindParam(':img2_satisfaction', $img2, PDO::PARAM_STR);
        $stmt->bindParam(':id_satisfaction', $id_satisfaction, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            throw new Exception('การอัปเดตฐานข้อมูลล้มเหลว');
        }

        $_SESSION['success'] = 'อัปเดตข้อมูลสำเร็จ!';
        header('Location: ../page_satisfaction.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_satisfaction.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'วิธีการส่งข้อมูลไม่ถูกต้อง';
    header('Location: ../page_satisfaction.php');
    exit();
}
?>
