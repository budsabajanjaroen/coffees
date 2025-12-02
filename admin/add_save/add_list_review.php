<?php
session_start();
include '../../db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // ตรวจสอบว่าไฟล์ถูกอัปโหลด
        if (isset($_FILES['img_review']) && $_FILES['img_review']['error'] === UPLOAD_ERR_OK) {
            $uploadFolder = '../../img/review/'; // โฟลเดอร์เก็บไฟล์รูปภาพ

            // ตั้งชื่อไฟล์ใหม่แบบไม่ซ้ำ
            $fileTmpPath = $_FILES['img_review']['tmp_name'];
            $fileName = uniqid('review_', true) . '.' . pathinfo($_FILES['img_review']['name'], PATHINFO_EXTENSION);
            $destination = $uploadFolder . $fileName;

            // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
            if (!move_uploaded_file($fileTmpPath, $destination)) {
                throw new Exception('การย้ายไฟล์ล้มเหลว');
            }

            // เตรียมข้อมูลสำหรับเพิ่มในฐานข้อมูล
            $nameReview = $_POST['name_review'];
            $positionReview = $_POST['position_review'];
            $review = $_POST['review'];

            $stmt = $pdo->prepare("
                INSERT INTO review (img_review, name_review, position_review, review)
                VALUES (:img_review, :name_review, :position_review, :review)
            ");
            $stmt->bindParam(':img_review', $fileName, PDO::PARAM_STR);
            $stmt->bindParam(':name_review', $nameReview, PDO::PARAM_STR);
            $stmt->bindParam(':position_review', $positionReview, PDO::PARAM_STR);
            $stmt->bindParam(':review', $review, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new Exception('การเพิ่มข้อมูลในฐานข้อมูลล้มเหลว');
            }

            // ตั้งค่า success message
            $_SESSION['success'] = 'เพิ่มข้อมูลสำเร็จ!';
            header('Location: ../page_review.php');
            exit();
        } else {
            throw new Exception('กรุณาอัปโหลดรูปภาพ');
        }
    } catch (Exception $e) {
        // ตั้งค่า error message
        $_SESSION['error'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
        header('Location: ../page_review.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'วิธีการส่งข้อมูลไม่ถูกต้อง';
    header('Location: ../page_review.php');
    exit();
}
?>
